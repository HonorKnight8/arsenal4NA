<?php

namespace lib;

//当前session表字段：PHPSESSID, update_time, client_ip, data
//考虑新加字段：StaffID、默认超时时间、用户自定义超时时间（勾选“保存登录状态”）、客户端信息？
class Session
{
	public static function loginStatus()
	{
		require_once 'lib/connect_DB.php';
		Session::start($pdo);
		$PHPSESSID = session_id();
		// echo $PHPSESSID . "<br />"; // 调试

		$stmt = $pdo->prepare("select PHPSESSID, update_time, client_ip, data from session where PHPSESSID=:PHPSESSID");
		$stmt->execute(array(":PHPSESSID" => $PHPSESSID));
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		// $sessionData = explode(',', $row['data']);
		// var_dump(empty($row['data']));

		if (!empty($row['data']) && $_SESSION['loginStatus'] == 1) {
			//data不为空 且 loginStatus等于1，说明已登录
			//根据phphsessid获取用户名
			$stmt = $pdo->prepare("select staffID, staffName from staffs where staffID=:staffID");
			$stmt->execute(array(":staffID" => $_SESSION["staffID"]));
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
			$_SESSION["staffName"] = $row["staffName"];
		} else {
			// 未登录
			$_SESSION['loginStatus'] = 0;   //后续可以直接根据这个值来判断是否登录
			$_SESSION['permission'] = -1;   //后面边栏的条件判断要用到，避免报“Notice”
		}

		// echo "<pre>";                    //调试
		// print_r($row['data']);
		// print_r($row);                    //调试
		// print_r($_SESSION);                //调试
		// echo "</pre>";                    //调试
		// echo session_id() . "<br/ >";    //调试
	}

	////////////////////////////////////////////////////////////////////////////////
	private static $handler = null;
	private static $ip = null;
	private static $lifetime = null;
	private static $time = null;

	private static function init($handler)
	{
		self::$handler = $handler;
		self::$ip = !empty($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : 'unknown';
		self::$lifetime = ini_get('session.gc_maxlifetime');
		self::$time = time();
	}

	static function start(\PDO $pdo)
	{
		self::init($pdo);
		session_set_save_handler(
			// array("Session", "open"),	类中调用回调函数需要使用数组的形式：类名，方法名	
			array(__CLASS__, "open"),	//可以用__CLASS__表示本类名
			array(__CLASS__, "close"),
			array(__CLASS__, "read"),
			array(__CLASS__, "write"),
			array(__CLASS__, "destroy"),
			array(__CLASS__, "gc")
		);

		session_start();
	}

	//在运行session_start(); //启动
	public static function open($path, $name)
	{
		return true;
	}

	//session_write_close()  session_destroy() 
	public static function close()
	{
		return true;
	}

	//session_start(), $_SESSION， 读取session数据到$_SESSION中
	public static function read($PHPSESSID)
	{
		$sql = "select PHPSESSID, update_time, client_ip, data from session where PHPSESSID= ?";

		$stmt = self::$handler->prepare($sql);

		$stmt->execute(array($PHPSESSID));

		if (!$result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			return '';
		}

		//问题2（可能是这个位置）：登录用户直接关闭浏览器，来自于该用户的IP的session（该IP的一直没访问，没触发），隔天都没被回收
		if (self::$ip  != $result["client_ip"]) {
			self::destroy($PHPSESSID);
			return '';
		}


		//问题1：这里只是盲目地把刷新时间久于$lifetime地session删掉，造成已登录用户，一段时间没动作之后，退出登录状态
		if (($result["update_time"] + self::$lifetime) < self::$time) {
			self::destroy($PHPSESSID);
			return '';
		}

		return $result['data'];
	}

	//结束时和session_write_close()强制提交SESSION数据 $_SESSION[]="aaa";
	public static function write($PHPSESSID, $data)
	{
		$sql = "select PHPSESSID, update_time, client_ip, data from session where PHPSESSID= ?";

		$stmt = self::$handler->prepare($sql);

		$stmt->execute(array($PHPSESSID));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		@$resultRows = count($result);
		// echo $resultRows; //调试
		if ($resultRows == 4) {
			if ($result['data'] != $data || self::$time > ($result['update_time'] + 30)) {
				$sql = "update session set update_time = ?, data =? where PHPSESSID = ?";

				$stm = self::$handler->prepare($sql);
				$stm->execute(array(self::$time, $data, $PHPSESSID));
			}
		} else {
			if ($resultRows !== 4) {
				$sql = "insert into session(PHPSESSID, update_time, client_ip, data) values(?,?,?,?)";

				$sth = self::$handler->prepare($sql);

				$sth->execute(array($PHPSESSID, self::$time, self::$ip, $data));
			}
		}

		return true;
	}

	//session_destroy()
	public static function destroy($PHPSESSID)
	{
		$sql = "delete from session where PHPSESSID = ?";

		$stmt = self::$handler->prepare($sql);

		$stmt->execute(array($PHPSESSID));

		return true;
	}

	//ession.gc_probability和session.gc_divisor值决定的，open(), read() session_start也会执行gc
	private static function gc($lifetime)
	{
		$sql = "delete from session where update_time < ?";

		$stmt = self::$handler->prepare($sql);

		$stmt->execute(array(self::$time - $lifetime));

		return true;
	}
}



// 这两行相当于session_start();
// require_once 'connect_DB.php';
// Session::start($pdo);
// 由index.php中的new LoginStatus();替代

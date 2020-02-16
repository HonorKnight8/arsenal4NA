<?php
class Session
{
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

	static function start(PDO $pdo)
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

		if (!$result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			return '';
		}

		if (self::$ip  != $result["client_ip"]) {
			self::destroy($PHPSESSID);
			return '';
		}

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
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
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

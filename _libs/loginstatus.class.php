<?php
class LoginStatus
{
    // public function getLoginStatus()
    function __construct()
    {
        require_once 'session.class.php';
        $PHPSESSID = session_id();
        // echo $PHPSESSID . "<br />"; // 调试

        $stmt = $pdo->prepare("select PHPSESSID, update_time, client_ip, data from session where PHPSESSID=:PHPSESSID");
        $stmt->execute(array(":PHPSESSID" => $PHPSESSID));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $sessionData = explode(',', $row['data']);
        // var_dump(empty($row['data']));

        if (!empty($row['data']) && $_SESSION['loginStatus'] == 1) {
            //data不为空 且 loginStatus等于1，说明已登录
            //根据phphsessid获取用户名
            $stmt = $pdo->prepare("select staffID, staffName from staffs where staffID=:staffID");
            $stmt->execute(array(":staffID" => $_SESSION["staffID"]));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["staffName"] = $row["staffName"];
            // $return = 1;
            // return "已登录";
        } else {
            // 未登录
            $_SESSION['loginStatus'] = 0;   //后续可以直接根据这个值来判断是否登录
            // $return = 0;
            // return "未登录";
        }


        // return  $return;




        // echo "<pre>";                    //调试
        // print_r($row['data']);
        // print_r($row);                    //调试
        // print_r($_SESSION);                //调试
        // echo "</pre>";                    //调试
        // echo session_id() . "<br/ >";    //调试
    }
}




// //这段是调试信息
// echo "<pre>";
// // print_r($row);
// print_r($_SESSION);
// echo "</pre>";
// echo session_id() . "<br/ >";
// //$PHPSESSID并非超全变量，经常提示未定义，应该直接用session_id() 



// // if ($arrayRows !== 4) { //不等于4，说明数据库中没有记录，应该进行写入
// $_SESSION["permission"] = $row["permission"];
// $_SESSION["staffID"] = $row["staffID"];
// $_SESSION["loginStatus"] = 1;

// echo $data;

// echo "<pre>";
// // print_r($row);
// print_r($_SESSION);
// echo "</pre>";
//     // $stmt = $pdo->prepare("insert into session(PHPSESSID, update_time, client_ip, data) values(:PHPSESSID,:update_time, :client_ip, :data)");

//     // $stmt->execute(array(":PHPSESSID" => 99, ":update_time" => "kkk1", ":client_ip" => "451", ":data" => null));
// // }

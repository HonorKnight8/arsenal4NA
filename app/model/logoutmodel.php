<?php

namespace app\model;

class LogoutModel
{
    public static $resultMessage;
    public static function logout()
    {
        // dump($_SESSION);
        // dump($_COOKIE);
        // echo session_name();
        // exit();

        //清空SESSION值
        $_SESSION = array();

        //删除客户端的在COOKIE中的Sessionid
        if (isset($_COOKIE[session_name()])) {
            setCookie(session_name(), '', time() - 3600, '/');
        }
        //彻底销毁session
        session_destroy();

        // 重新初始化session??
        $_SESSION["loginStatus"] = 0;
        // header("Location:index.php");
    }
}

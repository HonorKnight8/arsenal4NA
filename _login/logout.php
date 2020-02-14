<?php

require_once '../_libs/session.class.php';

$username = $_SESSION["staffName"];
$sid = session_id();

//清空SESSION值
$_SESSION = array();


//删除客户端的在COOKIE中的Sessionid
if (isset($_COOKIE[session_name()])) {
    setCookie(session_name(), '', time() - 3600, '/');
}
//彻底销毁session
session_destroy();

header("Location:../index.php");

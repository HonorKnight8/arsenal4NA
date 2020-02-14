<?php
// echo "哼哼哈嘿";
//要先把url传过来的sid赋值给session_id，否则session_start()会生成新的ID
// if (isset($_GET["sid"])) {
// 	session_id($_GET["sid"]);
// }
require_once '../_libs/session.class.php';
// echo session_id() . "<br />";
if (isset($_POST["sub"])) {

    //测试1开始，列举并输出表名
    // $stmt = $pdo->prepare("show tables");
    // $stmt->execute();
    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // 	print_r($row);
    // 	echo '<br>';
    // }
    //测试1结束（OK）
    //测试2开始，读取用户表
    // $stmt = $pdo->prepare("select * from users where id=:id");
    // $stmt->execute(array(":id" => 1));
    // $row = $stmt->fetch();
    // print_r($row);
    //测试2结束（OK）

    $stmt = $pdo->prepare("select staffID, password, permission from userpwd where staffID=:staffID and password=:password");
    $stmt->execute(array(":staffID" => $_POST["staffID"], ":password" => sha1($_POST["password"])));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // print_r($row);
    // var_dump($row);
    // var_dump(print_r($row));
    @$arrayRows = count($row);
    // echo $arrayRows;
    // var_dump($arrayRows);
    // echo '1<br />';
    // if ($result->num_rows > 0) {
    if ($arrayRows == 3) {
        // $row = $result->fetch_assoc();

        $_SESSION["permission"] = $row["permission"];
        $_SESSION["staffID"] = $row["staffID"];
        $_SESSION["loginStatus"] = 1;
        // echo '2<br />';
        // print_r($row);
        // echo '<br />' . $_COOKIE['PHPSESSID'] . '<br />';
        // print_r($_COOKIE);


        header("Location:../index.php");
        // 前面有输出，不能用header函数，改用JS跳转
        // echo '<script>';
        // // echo "location='index.php?" . SID . "'";
        // // echo "location='index.php?PHPSESSID=" . session_id() . "'";
        // echo "location='../index.php?" . SID . "'";
        // //常量：SID
        // //如果开启cookie，该值为空；
        // //如果未开启cookie，SID相当于“PHPSESSID=&lt;?php echo session_id() ?&gt;”
        // echo '</script>';
    } else {
        echo "用户名密码有误！<br>";
        // exit;
    }
} else {
    header("Location:../index.php?action=Login");
}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arsenal4NA</title>

    <link rel="stylesheet" type="text/css" href="_css/main.css" />
    <link rel="stylesheet" type="text/css" href="_css/others.css" />
    <script src="_js/js.js"></script>
</head>

<!-- <body onload='openNav()'> -->

<body>
    <?php
    header('content-type:text/html;charset=utf-8');
    // include "_libs/connect_DB.php";
    // 优先从path1中找类文件，然后从path2中找
    spl_autoload_register(
        function ($className) {
            $path1 = "_libs/" . strtolower($className) . ".class.php";
            $path2 = "_preferences/" . strtolower($className) . ".class.php";
            $path3 = "_process/" . strtolower($className) . ".class.php";
            $path4 = "Contacts/" . strtolower($className) . ".class.php";
            $path5 = "ITAM/" . strtolower($className) . ".class.php";
            $path6 = "MACInquire/" . strtolower($className) . ".class.php";
            $path7 = "WinFWAnalyzer/" . strtolower($className) . ".class.php";
            $path8 = "SubnetCalc/" . strtolower($className) . ".class.php";
            $path9 = "Scripts/" . strtolower($className) . ".class.php";
            $path10 = "Exam/" . strtolower($className) . ".class.php";
            if (file_exists($path1)) {
                include $path1;
            } else if (file_exists($path2)) {
                include $path2;
            } else if (file_exists($path3)) {
                include $path3;
            } else if (file_exists($path4)) {
                include $path4;
            } else if (file_exists($path5)) {
                include $path5;
            } else if (file_exists($path6)) {
                include $path6;
            } else if (file_exists($path7)) {
                include $path7;
            } else if (file_exists($path8)) {
                include $path8;
            } else if (file_exists($path9)) {
                include $path9;
            } else if (file_exists($path10)) {
                include $path10;
            }
            // else {
            //     include "nosuchfile.php";
            // }
        }
    );
    // spl_autoload_register(function ($className) {
    //     include "_libs/" . strtolower($className) . ".class.php";
    // });

    // include '_libs/topbar.class.php';
    // include '_libs/sidebar.class.php';
    // include '_libs/main.class.php';
    // include '../_libs/loginstatus.class.php';

    if (isset($_GET["sid"])) {
        session_id($_GET["sid"]);
    }

    //判断登录状态
    // $loginStatus = new LoginStatus;
    // $loginStatus->getLoginStatus();

    // echo LoginStatus::getLoginStatus();
    new LoginStatus();
    // echo $getLoginStatus->getLoginStatus();
    // $loginStatus = $getLoginStatus->getLoginStatus();
    // var_dump($loginStatus);

    // if (isset($_POST["submit"])) {
    if (count($_POST) !== 0) {
        //保存当前页面位置，用于登录后跳转回当前页面
        $_SESSION['currentPage'] = $_REQUEST["Page"];
        // echo count($_POST) . '<br />';
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '触发post-submit';
        echo new Process();
    } else {
        echo new TopBar();
        //顶栏

        echo new SideBar();
        //侧栏

        echo new Main();
        //主页面
    }

    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arsenal4NA</title>

    <link rel="stylesheet" type="text/css" href="_css/sidebar.css" />
    <link rel="stylesheet" type="text/css" href="_css/css.css" />
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
            $path2 = "_login/" . strtolower($className) . ".class.php";
            $path3 = "Contacts/" . strtolower($className) . ".class.php";
            if (file_exists($path1)) {
                include $path1;
            } else if (file_exists($path2)) {
                include $path2;
            } else if (file_exists($path3)) {
                include $path3;
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


    //判断登录状态
    if (isset($_GET["sid"])) {
        session_id($_GET["sid"]);
    }
    // $loginStatus = new LoginStatus;
    // $loginStatus->getLoginStatus();

    // echo LoginStatus::getLoginStatus();
    $getLoginStatus = new LoginStatus();
    // echo $getLoginStatus->getLoginStatus();
    $loginStatus = $getLoginStatus->getLoginStatus();
    // var_dump($loginStatus);


    echo new TopBar($loginStatus);
    //顶栏

    echo new SideBar();
    //侧栏

    echo new Main();
    //主页面
    ?>
</body>

</html>
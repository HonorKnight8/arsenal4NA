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
    spl_autoload_register(function ($className) {
        include "_libs/" . strtolower($className) . ".class.php";
    });

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



    echo new TopBar($loginStatus);
    //顶栏

    echo new SideBar();
    //侧栏

    echo new Main();
    //主页面
    ?>
</body>

</html>
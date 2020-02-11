<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arsenal4NA</title>

    <link rel="stylesheet" type="text/css" href="_css/sidebar.css" />
    <link rel="stylesheet" type="text/css" href="_css/css.css" />

    <script type="text/javascript">
        /*打开侧栏，修改侧栏宽度，主体左跨度、背景透明度*/
        function openNav() {
            document.getElementById("mySidenav").style.width = "180px";
            document.getElementById("main").style.marginLeft = "180px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }
        /*关闭侧栏，恢复原始侧栏宽度，主体左跨度、背景透明度*/
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }
    </script>
</head>

<body>
    <?php
    header('content-type:text/html;charset=utf-8');
    spl_autoload_register(function ($className) {
        include "_libs/" . strtolower($className) . ".class.php";
    });

    echo new SideBar();
    //侧栏

    echo new Main();
    //主页面
    ?>
</body>

</html>
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
    <!--侧栏界面设计-->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" title="关闭菜单" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php?action=HomePage">首页</a><br />
        <a href="index.php?action=Scripts" title="批处理、注册表、LinuxShell脚本下载">常用脚本</a><br />
        <a href="MAC_Inquire/MAC_Inquire.php" title="根据MAC地址查询所属厂商">MAC查询</a><br />
        <a href="index.php?action=Subnet_Calc" title="子网掩码计算及相关工具">子网计算</a><br />
        <a href="index.php?action=WinFW_analyze" title="Windows防火墙日志简要分析">防火墙日志</a><br />
        <hr>
        <a href="index.php?action=Contacts" title="企业内部通讯录">通讯录</a><br />
        <a href="index.php?action=Exam" title="在线考试系统，可用于面试、内训">在线考试</a><br />
        <a href="index.php?action=ITAM" title="IT资产管理：桌面、机房、网络、虚拟资产">ITAM</a><br />
    </div>

    <!--主页面，全部HTML化-->
    <?php
    spl_autoload_register(function ($className) {
        include "_libs/" . strtolower($className) . ".class.php";
    });

    echo new Main();
    ?>
</body>

</html>
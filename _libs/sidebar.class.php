<?php
class SideBar
{
    // function __construct($action = "")
    // {
    // }

    function __toString()
    {

        $div = '<div id="mySidenav" class="sidenav">';
        $div .= '<a href="javascript:void(0)" title="关闭菜单" class="closebtn" onclick="closeNav()">&times;</a>';
        $div .= '<a href="index.php?action=HomePage" title="首页">首页</a><br />';
        $div .= '<a href="index.php?action=Scripts" title="批处理、注册表、LinuxShell脚本下载">常用脚本</a><br />';
        $div .= '<a href="MAC_Inquire/MAC_Inquire.php" title="根据MAC地址查询所属厂商">MAC查询</a><br />';
        // $div .= '<a href="index.php?action=MACInquire" title="根据MAC地址查询所属厂商">MAC查询</a><br />';
        $div .= '<a href="index.php?action=SubnetCalc" title="子网掩码计算及相关工具">子网计算</a><br />';
        $div .= '<a href="index.php?action=WinFWAnalyzer" title="Windows防火墙日志简要分析">防火墙日志</a><br />';
        $div .= '<hr>';
        $div .= '<a href="index.php?action=Contacts" title="企业内部通讯录">通讯录</a><br />';
        $div .= '<a href="index.php?action=Exam" title="在线考试系统，可用于面试、内训">在线考试</a><br />';
        $div .= '<a href="index.php?action=ITAM" title="IT资产管理：桌面、机房、网络、虚拟资产">ITAM</a><br />';
        $div .= '</div>';
        return $div;
    }
}

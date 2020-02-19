<?php
class SideBar
{
    private $menu;
    private $div_sidenav;
    function __construct($action = "")
    {
        $this->menu = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "0";

        //建立全部菜单数组
        $menuArray = array(
            //首页及工具
            'HomePage' => array(
                'HomePage' => '<a class="menu" href="index.php?action=HomePage" title="首页">首页</a>',
                'Scripts' => '<a class="sub_menu" href="index.php?action=Scripts" title="批处理、注册表、LinuxShell脚本下载">常用脚本</a>',
                // 'MACInquire' => '<a class="sub_menu" href="MAC_Inquire/MAC_Inquire.php" title="根据MAC地址查询所属厂商">MAC查询</a>',
                'MACInquire' => '<a class="sub_menu" href="index.php?action=MACInquire" title="根据MAC地址查询所属厂商">MAC查询</a>',
                'SubnetCalc' => '<a class="sub_menu" href="index.php?action=SubnetCalc" title="子网掩码计算及相关工具">子网计算</a>',
                'WinFWAnalyzer' => '<a class="sub_menu" href="index.php?action=WinFWAnalyzer" title="Windows防火墙日志简要分析">防火墙日志</a>'
            ),
            //通讯录系统
            'Contacts' => array(
                'Contacts' => '<a class="menu" href="index.php?action=Contacts" title="企业内部通讯录">通讯录</a>'
            ),
            //在线考试系统
            'Exam' => array(
                'Exam' => '<a class="menu" href="index.php?action=Exam" title="在线考试系统，可用于面试、内训">在线考试</a>'
            ),
            //IT资产管理系统
            'ITAM' => array(
                'ITAM' => '<a class="menu" href="index.php?action=ITAM" title="IT资产管理：桌面、机房、网络、虚拟资产">ITAM</a>'
            ),
            //偏好设置
            'preferences' => array(
                'preferences' => '<a class="menu" href="index.php?action=preferences" title="偏好设置、后台管理">偏好设置</a>',
                'PreferencesPersonal' => '<a class="sub_menu" href="index.php?action=PreferencesPersonal" class="link" >修改个人信息</a>',
                'PreferencesHR' => '<a class="sub_menu" href="index.php?action=PreferencesHR" class="link" >HR管理</a>',

            ),
        );

        //设置“同义”数组，二级菜单，与一级菜单显示同样的菜单
        $synonymArray = array(
            'HomePage' => array('HomePage', 'Scripts', 'MACInquire', 'SubnetCalc', 'WinFWAnalyzer', '0'), //0代表刚打开的主页，没action
            'Contacts' => array('Contacts'),
            'Exam' => array('Exam'),
            'ITAM' => array('ITAM'),
            'preferences' => array('preferences', 'PreferencesPersonal', 'PreferencesHR')
        );

        foreach ($synonymArray as  $key1 => $subarray) {
            foreach ($subarray as  $key2 => $value) {
                if ($value == $this->menu) {
                    $menu = $key1;
                }
            }
        }

        $this->div_sidenav = '<div id="mySidenav" class="sidenav">';
        $this->div_sidenav .= '<a href="javascript:void(0)" title="关闭菜单" class="closebtn" onclick="closeNav()">&times;</a>';

        // 当前菜单，置顶，显示两级
        foreach ($menuArray as  $key1 => $value) {
            if ($key1 == $menu) {
                foreach ($value as $key2 => $all_menu)
                    if ($key1 == 'preferences') {   //preferences类链接，必须判断权限
                        if ($_SESSION['loginStatus'] == 1) {    //判断是否登录
                            if ($key2 == "PreferencesHR") {     //HR管理页面，对HR和超管可见，>>>后续遇到继续添加<<<
                                if ($_SESSION['permission'] == 99 || $_SESSION['permission'] == 15) {
                                    $this->div_sidenav .=  $all_menu;
                                }
                            } else {  //其他preferences类链接，
                                $this->div_sidenav .=  $all_menu;
                            }
                        }
                    } else { //非preferences类链接，直接输出
                        $this->div_sidenav .=  $all_menu;
                    }
            }
        }
        //分割线及其他菜单（只显示一级）
        $this->div_sidenav .=  '<hr class="sidehr" />';
        foreach ($menuArray as  $key => $value) {
            if ($key !== $menu && $key !== "preferences") {
                $this->div_sidenav .=  $menuArray[$key][$key];
            }
        }
        //已登录状态且action不等于preferences，显示preferences一级菜单，访客不显示
        if ($menu !== "preferences" && $_SESSION['loginStatus'] == 1) {
            $this->div_sidenav .=  '<hr class="sidehr" />';
            $this->div_sidenav .=  $menuArray["preferences"]["preferences"];
        }
    }

    function __toString()
    {
        $this->div_sidenav .= '</div>';
        return $this->div_sidenav;
    }
}

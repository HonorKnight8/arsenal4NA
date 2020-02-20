<?php
class Main
{
    private $action;
    private $menu;

    function __construct($action = "")
    {
        $this->action = $action;
        $this->menu = isset($_REQUEST["Page"]) ? $_REQUEST["Page"] : "0";
        $_SESSION['currentPage'] = $this->menu; //保存当前页面位置，用于登录后跳转回当前页面
        //echo $this->action;
        //echo $this->shape;
    }

    //当一个对象被当作字符串对待的时候，会触发这个魔术方法，引用处被echo：echo new Body();
    // __toString() 方法用于一个类被当成字符串时应怎样回应。例如 echo $obj; 应该显示些什么。此方法必须返回一个字符串，否则将发出一条 E_RECOVERABLE_ERROR 级别的致命错误。
    function __toString()
    {
        //$form = '<form action="' . $this->action . '" method="post" >';
        $div = '<div class="main" id="main">';

        switch ($this->menu) {
            case "HomePage":
                $div .= $this->HomePage();
                break;
            case "Scripts":
                $div .= new Scripts();
                break;
            case "MACInquire":
                $div .= new MACInquire();
                break;
            case "SubnetCalc":
                $div .= new SubnetCalc();
                break;
            case "WinFWAnalyzer":
                $div .= new WinFWAnalyzer();
                break;
            case "Contacts":
                $div .= new Contacts();
                break;
            case "Exam":
                $div .= new Exam();
                break;
            case "ITAM":
                $div .= new ITAM();
                break;
            case "preferences":
                $div .= new Preferences();
                break;
            case "PreferencesPersonal":
                $div .= new PreferencesPersonal();
                break;
            case "PreferencesHR":
                $div .= new PreferencesHR();
                break;
            case "ModifyStaffInfo":
                $div .= new ModifyStaffInfo();
                break;
            default:
                $div .= $this->HomePage();
        }
        $div .= '</div>';
        return $div;
    }


    private function HomePage()
    {
        $div = '<div class="div_homepage">';
        $div .= '<h4>&emsp;&emsp;arsenal4NA(arsenal for Network Administrator)，即：“网管军火库/工具箱”，本攻城狮自己写的一些网络管理、HelpDesk、基础IT运维工作中可能会用到的工具。</h4><br />';
        $div .= '<hr style="height:2px;border:none;border-top:3px solid Black;" />';
        $div .= '<b>目前进度：</b><br /><br />';

        $div .= '1. 小工具类<br />';
        $div .= '&emsp;&emsp;* MAC地址归属厂商查询，**完成**<br />';
        $div .= '&emsp;&emsp;* 子网计算，0%<br />';
        $div .= '&emsp;&emsp;* Windows系统防火墙日志分析，0%<br />';
        $div .= '&emsp;&emsp;* 常用脚本，*基本完成*<br />';
        $div .= '2. 通讯录系统，**开发中**<br />';
        $div .= '3. 会议室预定、公共设备借用，0%<br />';
        $div .= '4. 考试系统，0%<br />';
        $div .= '5. IT资产管理系统，0%<br />';
        $div .= '6. _后台管理，开发中，与各功能模块同步进行<br />';
        $div .= '7. _整体框架，*基本完成*，持续调整<br />';

        $div .= '</div>';
        return $div;
    }
}

<?php
class TopBar
{
    private $welcome;
    private $menu;
    private $title;
    private $message;
    function __construct($message = NULL)
    {
        // $welcomeUser = '欢迎你，' . $_SESSION['staffName'];
        $this->welcome = ($_SESSION['loginStatus'] == 1) ? '欢迎你，' . $_SESSION['staffName'] : '&nbsp;';
        $this->message = $message;

        $this->menu = isset($_REQUEST["Page"]) ? $_REQUEST["Page"] : NULL;
        switch ($this->menu) {
            case "HomePage":
                $this->title = NULL;
                break;
            case "Scripts":
                $this->title = '——常用脚本下载';
                break;
            case "MACInquire":
                $this->title = '——MAC地址归属厂商查询工具';
                break;
            case "SubnetCalc":
                $this->title = '——子网掩码计算工具';
                break;
            case "WinFWAnalyzer":
                $this->title = '——Windows系统防火墙日志分析工具';
                break;
            case "Contacts":
                $this->title = '——公司同事通讯录';
                break;
            case "Exam":
                $this->title = '——在线考试系统';
                break;
            case "ITAM":
                $this->title = '——ITAM：IT资产管理系统';
                break;
            case "Preferences":
                $this->title = '——偏好设置';
                break;
            case "PreferencesPersonal":
                $this->title = '——偏好设置';
                break;
            case "PreferencesHR":
                $this->title = '——偏好设置';
                break;
            default:
                $this->title = NULL;
        }
    }
    // function __construct($action = "")
    // {
    //     $this->action = $action;
    //     $this->menu = isset($_REQUEST["Page"]) ? $_REQUEST["Page"] : "0";
    // }
    function __toString()
    {
        // onclick
        // onmouseover    onmouseout 含子元素
        // onmouseenter   onmouseleave 不含子元素
        $div = '<div class="topbar" id="topbar">';
        $div .= '<span class="openNav" onmouseenter="openNav()" title="打开菜单" top:6px;>&#9776;</span>';
        $div .= '<span style="font-size:20px;font-weight:900;" top:6px;>&nbsp;&nbsp;&nbsp;arsenal4NA</span>';
        if ($this->message == NULL) {
            $div .= '<span style="font-size:18px">' . $this->title . '</span>';
        } else {
            $div .= '<span class="processResultMessage" >' . $this->message . '</span>';
        }
        $div .= '<span style="font-size:20px;font-weight:300;position:absolute;top:12px;right:60px;">' . $this->welcome . '</span>';
        $div .= '<a class="userinfo" href="index.php?Page=preferences" title="偏好设置">&#9787</a>';
        $div .= '<hr style="height:0px;border:none;border-top:4px dashed LawnGreen;" width="100%" />';
        $div .= '</div>';
        return $div;
    }
}

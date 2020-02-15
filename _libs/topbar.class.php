<?php
class TopBar
{
    private $welcome;
    private $menu;
    private $title;
    private $message;
    function __construct($message = 'noMessage')
    {
        $welcomeUser = '欢迎你，' . $_SESSION['staffName'];
        $this->welcome = ($_SESSION['loginStatus'] == 1) ? $welcomeUser : '&nbsp;';

        $this->menu = isset($_REQUEST["action"]) ? $_REQUEST["action"] : NULL;
        switch ($this->menu) {
            case "HomePage":
                $this->title .= NULL;
                break;
            case "Scripts":
                $this->title .= '——常用脚本下载';
                break;
            case "MACInquire":
                $this->title .= '——MAC地址归属厂商查询工具';
                break;
            case "SubnetCalc":
                $this->title .= '——子网掩码计算工具';
                break;
            case "WinFWAnalyzer":
                $this->title .= '——Windows系统防火墙日志分析工具';
                break;
            case "Contacts":
                $this->title .= '——公司同事通讯录';
                break;
            case "contactsPersonalModify":
                $this->title .= '——公司同事通讯录';
                break;
            case "contactsHR":
                $this->title .= '——公司同事通讯录';
                break;
            case "Exam":
                $this->title .= '——在线考试系统';
                break;
            case "ITAM":
                $this->title .= '——ITAM：IT资产管理系统';
                break;
            case "Personal":
                $this->title .= '——常用脚本下载';
                break;
            default:
                $this->title = NULL;
        }

        $this->message = $message;
    }
    // function __construct($action = "")
    // {
    //     $this->action = $action;
    //     $this->menu = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "0";
    // }
    function __toString()
    {
        $div = '<div class="topbar" id="topbar">';
        $div .= '<span class="openNav" onclick="openNav()" title="打开菜单">&#9776;</span>';
        $div .= '<span style="font-size:30px">arsenal4NA</span>';
        if ($this->message == 'noMessage') {
            $div .= '<span style="font-size:18px">' . $this->title . '</span>';
        } else {
            $div .= '<span class="processResultMessage" >' . $this->message . '</span>';;
        }
        $div .= '<span style="font-size:20px;position:absolute;top:6px;right:60px;">' . $this->welcome . '</span>';
        $div .= '<a class="userinfo" href="index.php?action=Personal" title="用户信息">&#9787</a><br />';
        // $div .= '<span class="link" style="font-size:30px;cursor:pointer;position:absolute;top: 0;right: 0px;" title="登陆页面">&#9787</span>';
        $div .= '</div>';
        return $div;
    }
}

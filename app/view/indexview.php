<?php

namespace app\view;

class indexView
{
    public static $welcome;
    public static $title;
    public static $message;

    public $altogether; // 页面公共部分：头部、边栏、顶栏，均由index继承
    function __construct($message = NULL)
    {
        // $message 顶栏显示信息

        // Header
        $this->altogether = self::header();

        // sidebar
        $this->altogether .= self::sidebar();

        // topbar
        $this->altogether .= self::topbar($message);

        $this->altogether .= '<div class="main" id="main">';
    }


    public static function topbar($message)
    {
        // $welcomeUser = '欢迎你，' . $_SESSION['staffName'];
        self::$welcome = ($_SESSION['loginStatus'] == 1) ? '欢迎你，' . $_SESSION['staffName'] : '&nbsp;';
        self::$message = $message;

        // 顶栏显示标题
        self::$title = NULL;


        // onclick
        // onmouseover    onmouseout 含子元素
        // onmouseenter   onmouseleave 不含子元素
        $topbar = '<div class="topbar" id="topbar">';
        $topbar .= '<span class="openNav" onmouseenter="openNav()" title="打开菜单" top:6px;>&#9776;</span>';
        $topbar .= '<span style="font-size:20px;font-weight:900;" top:6px;>&nbsp;&nbsp;&nbsp;arsenal4NA</span>';
        if (self::$message == NULL) {
            $topbar .= '<span style="font-size:18px">' . self::$title . '</span>';
        } else {
            $topbar .= '<span class="processResultMessage" >' . self::$message . '</span>';
        }
        $topbar .= '<span style="font-size:20px;font-weight:300;position:absolute;top:12px;right:60px;">' . self::$welcome . '</span>';
        $topbar .= '<a class="userinfo" href="index.php?Page=preferences" title="偏好设置">&#9787</a>';
        $topbar .= '<hr style="height:0px;border:none;border-top:4px dashed LawnGreen;" width="100%" />';
        $topbar .= '</div>';
        return $topbar;
    }

    public static function sidebar()
    {
        $sidebar = '<div id="sidenav" class="sidenav">';
        $sidebar .= '<a href="javascript:void(0)" title="关闭菜单" class="closebtn" onclick="closeNav()">&times;</a>';
        $sidebar .= '<a class="menu" href="/index/index/" title="首页">首页</a>';
        $sidebar .= '<a class="menu" href="/blockeedir/blockeedir/" title="Employee Directory: 通讯录">通讯录</a>';
        $sidebar .= '<a class="menu" href="/blockpubb/blockpubb/" title="Public Utilities Booking & Borrow: 公共设施预定、借用">PUBB</a>';
        $sidebar .= '<a class="menu" href="/blockexam/blockexam/" title="Exam: 在线考试">考试</a>';
        $sidebar .= '<a class="menu" href="/blockdms/blockdms/" title="Document Management System: 文档管理">文档管理</a>';
        $sidebar .= '<a class="menu" href="/blockitam/blockitam/" title="I.T. Asset Management: IT资产管理">IT资产管理</a>';
        $sidebar .= '<div class="dropdown">';
        $sidebar .= '<a href="#" class="menu">ZAX工具集</a>';
        $sidebar .= '<div class="dropdown-content">';
        $sidebar .= '<a class="sub_menu" href="/zax/sp/" title="Scripts: 常用脚本下载">SP:&nbsp;常用脚本</a>';
        $sidebar .= '<a class="sub_menu" href="/zax/maci/" title="MACInquire: MAC地址归属厂商查询">MACI:&nbsp;MA查询</a>';
        $sidebar .= '<a class="sub_menu" href="/zax/ipi/" title="IPInquire: IP地址地理位置查询">IPI:&nbsp;IP查询</a>';
        $sidebar .= '<a class="sub_menu" href="/zax/snc/" title="SubnetCalc: 子网计算器">SNC:&nbsp;子网计算</a>';
        $sidebar .= '<a class="sub_menu" href="/zax/edc/" title="Encode&Decode: 多种编码、解码工具">EDC:&nbsp;编解码</a>';
        $sidebar .= '<a class="sub_menu" href="/zax/wfwla/" title="WinFWLogAnalyzer: Windows系统防火墙日志分析">WFWLA:&nbsp;日志分析</a>';
        $sidebar .= '</div>';
        $sidebar .= '</div>';
        $sidebar .= '<a class="menu" href="/backend/backend/" title="后台管理">后台管理</a>';
        $sidebar .= '</div>';

        return $sidebar;
    }

    public static function header()
    {
        $header = '<!DOCTYPE html>';
        $header .= '<html lang="en">';
        $header .= '<head>';
        $header .= '<meta charset="UTF-8">';
        $header .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $header .= '<title>arsenal4NA</title>';
        $header .= '<link rel="stylesheet" type="text/css" href="/app/common/main.css" />';
        $header .= '<link rel="stylesheet" type="text/css" href="/app/common/others.css" />';
        $header .= '<script src="/app/common/js.js"></script>';

        // $header .= '<script type="text/javascript">';
        // // /*打开侧栏，修改侧栏宽度，主体左跨度、背景透明度*/
        // $header .= 'function openNav() {';
        // $header .= 'document.getElementById("sidenav").style.width = "180px";';
        // $header .= 'document.getElementById("main").style.marginLeft = "180px";';
        // $header .= 'document.getElementById("topbar").style.marginLeft = "180px";';
        // $header .= 'document.body.style.backgroundColor = "rgba(0,0,0,0.4)";';
        // $header .= '}';
        // // /*关闭侧栏，恢复原始侧栏宽度，主体左跨度、背景透明度*/
        // $header .= 'function closeNav() {';
        // $header .= 'document.getElementById("sidenav").style.width = "0";';
        // $header .= 'document.getElementById("main").style.marginLeft = "0";';
        // $header .= 'document.getElementById("topbar").style.marginLeft = "0";';
        // $header .= 'document.body.style.backgroundColor = "white";';
        // $header .= '}';
        // $header .= '</script>';

        $header .= '</head>';
        $header .= '<body>';
        return $header;
    }
}

<?php
class TopBar
{
    private $welcome;
    function __construct($loginStatus)
    {
        $welcomeUser = '欢迎你，' . $_SESSION['staffName'];
        $this->welcome = ($loginStatus == 1) ? $welcomeUser : '&nbsp;';
    }
    function __toString()
    {
        $div = '<div id="topbar">';
        $div .= '<span class="link" style="font-size:30px;cursor:pointer" title="打开菜单" onclick="openNav()">&#9776;</span>';
        $div .= '<span style="font-size:30px">arsenal4NA</span>';
        $div .= '<span style="font-size:20px;position:absolute;top:6px;right:60px;" title="打开菜单">' . $this->welcome . '</span>';
        $div .= '<a href="index.php?action=Personal" class="link" style="font-size:30px;cursor:pointer;position:absolute;top: 0;right: 0px;" title="用户管理">&#9787</a><br />';
        // $div .= '<span class="link" style="font-size:30px;cursor:pointer;position:absolute;top: 0;right: 0px;" title="登陆页面">&#9787</span>';
        $div .= '</div>';
        return $div;
    }
}

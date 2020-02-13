<?php
class TopBar
{
    private $welcome;
    function __construct($loginStatus)
    {
        $this->welcome = $loginStatus;
    }
    function __toString()
    {
        $div = '<div id="topbar">';
        $div .= '<span class="menubtn" style="font-size:30px;cursor:pointer" title="打开菜单" onclick="openNav()">&#9776;</span>';
        $div .= '<span style="font-size:30px">arsenal4NA</span>';
        $div .= '<span style="font-size:20px;cursor:pointer;position:absolute;top:6px;right:60px;" title="打开菜单">' . $this->welcome . '</span>';
        $div .= '<span class="loginbtn" style="font-size:30px;cursor:pointer;position:absolute;top: 0;right: 0px;" title="打开菜单">&#9787</span>';
        $div .= '</div>';
        return $div;
    }
}

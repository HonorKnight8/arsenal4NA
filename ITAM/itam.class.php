<?php
class ITAM
{
    private $div_itam;
    function __construct($action = "")
    {
        $this->div_itam = '<div id="itam">';
        //判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            //已登录状态
            $this->div_itam .= '<b>这是ITAM（IT资产管理系统）</b>';
        } else {
            $this->div_itam .= new Login();
        }
    }

    function __toString()
    {
        // if ($_SESSION['loginStatus'] == 1) {
        //     //已登录状态
        // }
        $this->div_itam .= '</div>';
        return $this->div_itam;
    }
}

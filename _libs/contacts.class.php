<?php
class Contacts
{
    // function __construct($action = "")
    // {
    // }

    function __toString()
    {
        //判断登录状态
        $div = '<div>';
        $div .= '<span>Contacts，本功能介绍</span><p>';
        $div .= '</div>';

        return $div;
    }
}

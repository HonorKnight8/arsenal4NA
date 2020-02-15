<?php

class ContactsHR extends Contacts
{
    protected function thisPage()    //本页面特有信息
    {
        $this->divContacts .= '<span><b>这是内部通讯录HR管理页</b></span><br />';
    }

    function __toString()
    {
        if ($_SESSION['loginStatus'] == 1) {
            //已登录状态
            self::thisPage();
        }
        $this->divContacts .= '</div>';
        return $this->divContacts;
    }
}

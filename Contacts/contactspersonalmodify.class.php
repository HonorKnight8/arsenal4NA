<?php
class ContactsPersonalModify extends Contacts
{
    // function __construct($action = "")
    // {
    // }

    function __toString()
    {
        if ($_SESSION['loginStatus'] == 1) {
            //已登录状态
            $this->divContacts .= '<span><b>这是内部通讯录个人修改页</b></span><br />';
        }
        $this->divContacts .= '</div>';
        return $this->divContacts;
    }
}

<?php
class Preferences
{
    protected $div_preferences;
    function __construct()
    {
        $this->div_preferences = '<div id="personal">';
        //判断登录状态
        if ($_SESSION['loginStatus'] == 0) {
            // header("Location:../index.php?action=" . $_SESSION['currentPage']);
            $this->div_preferences .= new Login();
        } else {
            //已登录状态，显示个人后台

            //显示退出连接
            $this->div_preferences .= '<form action="" method="post">';
            $this->div_preferences .= '<input type="submit" name="logout" value="退出"></form>';
        }
    }

    protected function thisPage()    // 本页面特有内容
    {
        // $this->divContacts .= '<br /><span><b>这是内部通讯录功能默认页</b></span><br />';
        // $this->divContacts .= self::getSomebodyInfo();
    }

    function __toString()
    {
        // if ($_SESSION['loginStatus'] == 1) {
        //     // 已登录状态，附加本页面特有内容
        //     self::thisPage();
        // }
        $this->div_preferences .= '</div>';
        return $this->div_preferences;
    }
}

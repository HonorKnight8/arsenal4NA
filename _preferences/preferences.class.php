<?php
class Preferences
{
    protected $div_preferences;
    function __construct()
    {
        $this->div_preferences = '<div class="div_preferences" id="div_preferences">';
        //判断登录状态
        if ($_SESSION['loginStatus'] == 0) {
            // header("Location:index.php?Page=login");
            $this->div_preferences .= new Login();
        } else {
            //已登录状态，显示个人后台

            //显示退出连接
            $this->div_preferences .= '<form action="" method="post">';
            $this->div_preferences .= '<input class="submit" type="submit" name="logout" value="退出/登出"></form>';
        }
    }

    protected function thisPage()    // 本页面特有内容
    {
        $form = '';
        $form .= '<br /><span><b>这是“测试：偏好设置功能——默认页”</b></span><br />';
        return $form;
    }

    function __toString()
    {
        if ($_SESSION['loginStatus'] !== 0) {
            $this->div_preferences .= self::thispage();
        }
        $this->div_preferences .= '</div>';
        return $this->div_preferences;
    }
}

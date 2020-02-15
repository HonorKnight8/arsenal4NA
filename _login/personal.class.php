<?php
class Personal
{
    private $div_personal;
    function __construct($action = "")
    {
        $this->div_personal = '<div id="personal">';
        //判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            //已登录状态
            $this->div_personal .= '<form action="_login/logout.php" method="post">';
            $this->div_personal .= '<input type="submit" name="sub" value="退出"></form>';
        } else {
            $this->div_personal .= new Login();
        }
    }

    function __toString()
    {
        // if ($_SESSION['loginStatus'] == 1) {
        //     //已登录状态
        // }
        $this->div_personal .= '</div>';
        return $this->div_personal;
    }
}

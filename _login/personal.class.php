<?php
class Personal
{
    private $div_personal;
    function __construct()
    {
        $this->div_personal = '<div id="personal">';
        //判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            //已登录状态，显示个人后台

            //显示退出连接
            $this->div_personal .= '<form action="" method="post">';
            $this->div_personal .= '<input type="submit" name="logout" value="退出"></form>';
        } else {
            // header("Location:../index.php?action=" . $_SESSION['currentPage']);
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

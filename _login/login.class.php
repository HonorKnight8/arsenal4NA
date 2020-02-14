<?php
class Login
{
    private $div_login;
    function __construct($action = "")
    {
        $this->div_login = '<div id="login">';

        // 判断登录状态
        // $_SESSION['loginStatus'] = 0;
        if ($_SESSION['loginStatus'] == 1) {
            //个人后台
            $this->div_login .= new Personal();
        } else {
            //登录页面


            $this->div_login .= '<form action="_login/login.php" method="post">';
            $this->div_login .= '<table align="center" border="1" width="300">';
            $this->div_login .= '<caption><h1>用户登录</h1></caption>';
            $this->div_login .= '<tr><th>用户名</th><td>';
            $this->div_login .= '<input type="text" name="staffID"></td></tr>';
            $this->div_login .= '<tr><th>密 码</th><td>';
            $this->div_login .= '<input type="password" name="password"></td></tr>';
            $this->div_login .= '<tr><td colspan="2" align="center">';
            $this->div_login .= '<input type="submit" name="sub" value="登 录"></td></tr></table></form>';
        }
    }

    function __toString()
    {
        $this->div_login .= '</div>';
        return $this->div_login;
    }
}

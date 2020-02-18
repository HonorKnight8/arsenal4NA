<?php
class Login
{
    private $div_login;
    function __construct($action = "")
    {
        $this->div_login = '<div class="div_login" id="div_login">';

        // 判断登录状态
        // $_SESSION['loginStatus'] = 0;
        if ($_SESSION['loginStatus'] == 1) {
            //个人后台
            $this->div_login .= new PreferencesPersonal();
        } else {
            //登录页面
            // $this->div_login .= '<form action="_login/login.php" method="post">';
            $this->div_login .= '<form action="" method="post">';
            $this->div_login .= '<fieldset><legend>用户登录</legend>';
            $this->div_login .= '&emsp;&emsp;&emsp;工号：<input type="text" name="staffID" style="width:250px" placeholder="请输入用户名（即工号）..." required><br />';
            $this->div_login .= '&emsp;&emsp;&emsp;密码：<input type="password" name="password" style="width:250px" placeholder="请输入密码以验证身份..." required><br />';
            $this->div_login .= '输入验证码：<input type="text" name="inputcaptchaget" id="" style="width:250px" placeholder="请输入下方的验证码……"><br />';
            $this->div_login .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="_libs/captchaget0.php" alt="" id="verifyimage" /><a onclick="document.getElementById(\'verifyimage\').src=\'_libs/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
            $this->div_login .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" name="login" value="登 录">';
            $this->div_login .= '</fieldset></form>';
        }
    }

    function __toString()
    {
        $this->div_login .= '</div>';
        return $this->div_login;
    }
}

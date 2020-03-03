<?php

namespace app\view;

class LoginView extends \app\view\IndexView
{

    // 继承自基类\app\view\IndexView
    // function __construct()
    // {
    // }

    function __toString()
    {
        $div = '';
        $div .= '<div class="div_login" id="div_login">';

        $div .= $this->thisPage();

        $div .= '</div>';
        $div .= '</div></body></html>';
        return  $this->altogether . $div;
    }

    private function thisPage()
    {
        $page = '';

        // 判断登录状态
        // $_SESSION['loginStatus'] = 0;
        // if ($_SESSION['loginStatus'] == 1) {
        //     $page .= new PreferencesPersonal();
        // } else {
        //登录页面
        $page = '<div class="div_login" id="div_login">';
        // $page .= '<form action="_login/login.php" method="post">';
        $page .= '<form action="" method="post">';
        $page .= '<fieldset><legend>用户登录</legend>';
        $page .= '&emsp;&emsp;&emsp;工号：<input type="text" name="staffID" style="width:250px" placeholder="请输入用户名（即工号）..." required><br />';
        $page .= '&emsp;&emsp;&emsp;密码：<input type="password" name="password" style="width:250px" placeholder="请输入密码以验证身份..." required><br />';
        $page .= '输入验证码：<input type="text" name="inputcaptchaget" id="" style="width:250px" placeholder="请输入下方的验证码……" required autocomplete="off" /><br />';
        $page .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="/captcha/captchaget1/" alt="" id="verifyimage" /><a class="a_in_content" onclick="document.getElementById(\'verifyimage\').src=\'/captcha/captchaget1/?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $page .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input class="submit" type="submit" name="login" value="登 录">';
        $page .= '</fieldset></form>';
        $page .= '</div>';
        // }
        return $page;
    }
}

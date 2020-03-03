<?php

namespace app\controller;

class LoginController
{
    public static function login()
    {

        if (isset($_POST['login'])) {
            // 登录动作
            \app\model\LoginModel::login();


            if ($_SESSION['loginStatus'] == 1) {
                // 登录成功，跳转回原来的页面
                $ctrl = new \lib\Entry::$ctrlClass();
                $actionName = \lib\Entry::$actionName;
                $ctrl->$actionName();

                // header("Location:../index.php");
                // header("Location:../index.php?Page=" . $_SESSION['currentPage']); //跳转回登录前请求的页面

                // 若前面有输出，则不能用header函数，改用JS跳转
                // echo '<script>';
                // // echo "location='index.php?" . SID . "'";
                // // echo "location='index.php?PHPSESSID=" . session_id() . "'";
                // echo "location='../index.php?" . SID . "'";
                // //常量：SID
                // //如果开启cookie，该值为空；
                // //如果未开启cookie，SID相当于“PHPSESSID=&lt;?php echo session_id() ?&gt;”
                // echo '</script>';
            } else {
                // 登录失败，继续显示登录页面，及错误信息
                echo new \app\view\LoginView;
                echo '<center class="processResultMessage">' . \app\model\LoginModel::$resultMessage . '</center>';
            }
        } else {
            echo new \app\view\LoginView;
        }

        // dump(\lib\Route::$pathArray);
        // dump($_SESSION);
        // dump($_COOKIE);

    }
}

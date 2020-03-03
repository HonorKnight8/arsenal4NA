<?php

namespace app\blockitam\controller;

class BlockITAMController
{
    public function blockitam()
    {
        // 判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            // 已登录状态
            echo new \app\blockitam\view\BlockITAMView;
        } else {
            // 未登录状态，显示登录页面
            \app\controller\LoginController::login();
        }
    }
}

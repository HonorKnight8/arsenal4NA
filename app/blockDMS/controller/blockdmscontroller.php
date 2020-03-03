<?php

namespace app\blockdms\controller;

class BlockDMSController
{
    public function blockdms()
    {
        // 判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            // 已登录状态
            echo new \app\blockdms\view\BlockDMSView;
        } else {
            // 未登录状态，显示登录页面
            \app\controller\LoginController::login();
        }
    }
}

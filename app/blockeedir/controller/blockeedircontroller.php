<?php

namespace app\blockeedir\controller;

class BlockEEDIRController
{
    public function blockeedir()
    {
        // 判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            // 已登录状态
            echo new \app\blockeedir\view\BlockEEDIRView;
        } else {
            // 未登录状态，显示登录页面
            \app\controller\LoginController::login();
        }
    }
}

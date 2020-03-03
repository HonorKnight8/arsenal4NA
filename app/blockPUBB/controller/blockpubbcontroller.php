<?php

namespace app\blockpubb\controller;

class BlockPUBBController
{
    public function blockpubb()
    {
        // 判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            // 已登录状态
            echo new \app\blockpubb\view\BlockPUBBView;
        } else {
            // 未登录状态，显示登录页面
            \app\controller\LoginController::login();
        }
    }
}

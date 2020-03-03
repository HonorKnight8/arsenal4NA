<?php

namespace app\blockexam\controller;

class BlockExamController
{
    public function blockexam()
    {
        // 判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            // 已登录状态
            echo new \app\blockexam\view\BlockExamView;
        } else {
            // 未登录状态，显示登录页面
            \app\controller\LoginController::login();
        }
    }
}

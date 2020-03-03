<?php

namespace app\controller;

class LogoutController
{
    public static function logout()
    {
        // 进行登出
        \app\model\LogoutModel::logout();
        // 跳转到首页
        echo new \app\view\HomePageView;
    }
}

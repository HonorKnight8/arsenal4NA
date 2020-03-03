<?php

namespace app\model;

class LoginModel
{
    public static $resultMessage;
    public static function login()
    {
        if ($_POST['inputcaptchaget'] == NULL || strtolower($_POST['inputcaptchaget']) !== strtolower($_SESSION['captchaCreated'])) {
            self::$resultMessage = '！！验证码输入错误！！';
        } else {
            // select($table, $columns, $where)
            $datas = \lib\Entry::$model->select("userpwd", [
                "staffID",
                "password",
                "permission"
            ], [
                "password" => sha1($_POST["password"]),
                "staffID" => $_POST["staffID"]
            ]);
            // dump($datas);
            // echo $datas[0]['staffID'];

            // 之前用的判断方法
            // @$arrayRows = count($datas);
            // dump($arrayRows);
            // count() 函数计算数组中的单元数目或对象中的属性个数。 对于数组，返回其元素的个数，对于其他值，返回 1。如果参数是变量而变量没有定义，则返回 0。
            // 用这个判断“也许”会造成误判，登录成功返回正好是1，"对于其他值，返回 1"

            if (isset($datas[0]['staffID']) && $datas[0]['staffID'] == $_POST["staffID"]) {
                $_SESSION["permission"] = $datas[0]["permission"];
                $_SESSION["staffID"] = $datas[0]["staffID"];
                $_SESSION["loginStatus"] = 1;
                // dump($_SESSION);

                $datas = \lib\Entry::$model->select("staffs", [
                    "staffID",
                    "staffName"
                ], [
                    "staffID" => $_POST["staffID"]
                ]);
                // dump($datas);

                $_SESSION["staffName"] = $datas[0]["staffName"];
                // dump($_SESSION["staffName"]);
                // exit();

            } else {
                self::$resultMessage = '！！用户名密码有误！！';
            }
        }
    }
}

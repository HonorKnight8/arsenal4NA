<?php

use Whoops\Handler\XmlResponseHandler;

header('content-type:text/html;charset=utf-8');

// 入口文件
// 1.定义常量
// 2.加载函数库
// 3.启动框架

// 用绝对路径，会不会造成windows、Linux不同系统下的问题？？？
define('ROOT', realpath('./'));
define('APP', realpath('./app'));
define('MODULE', '\app');            //方便使用命名空间调用类
define('DEBUG', true);  // Debug开关
// echo ROOT . "<br \>" . APP . "<br \>" . MODULE . "<br \>" . DEBUG;

include ROOT . '/only4debuging/p.php';  // 只为方便开发、调试使用的函数 p()
include "vendor/autoload.php";  //composer第三方库的自动加载

if (DEBUG) {
    // 若开启Debug，则加载filp/whoops库，用于错误提示
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();

    ini_set('display_error', 'On');
} else {
    ini_set('display_error', 'Off');
}

// 测试filp/whoops
// ssssssssssq();
// exit();

// 测试symfony/var-dumper
// p($_SERVER);
// exit();


include ROOT . '/lib/entry.class.php';
spl_autoload_register('\lib\Entry::load');
\lib\Entry::run();
// 启动入口

// // 自动加载指定目录的类
// // 改为使用Entry::load + namespace自动加载类：spl_autoload_register('\lib\Entry::load');
// spl_autoload_register(
//     function ($className) {
//         $path1 = ROOT . "/lib/" . strtolower($className) . ".class.php";
//         // echo $path1;
//         // exit();
//         if (file_exists($path1)) {
//             include $path1;
//         }
//         // else if (file_exists($path2)) {
//         //     include $path2;
//         // } 
//         // else {
//         //     include "nosuchfile.php";
//         // }
//     }
// );
// //测试自动加载指定目录的类
// // Groceries::p(array(1, 2, 3, 4, 5));
// // exit();

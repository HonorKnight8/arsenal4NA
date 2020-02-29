<?php

namespace lib;

class Entry
{
    static public $classMap = array();
    public $assign;

    static public function run()
    {
        // // 测试数据库连接，>>>>>>>>>>>>>保留这段<<<<<<<<<<<<<<<<
        // require_once 'lib/connect_DB.php';
        // // 测试1，列举并输出表名
        // $stmt = $pdo->prepare("show tables");
        // $stmt->execute();
        // while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        //     print_r($row);
        //     echo '<br>';
        // }
        // // 测试2，读取session表
        // $stmt = $pdo->prepare("select * from session");
        // $stmt->execute();
        // $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        // print_r($row);
        // // 测试结束（OK）
        // exit();

        //初始化session
        \lib\Session::loginStatus();
        // exit();

        //调用路由，获取对应控制器、方法
        \lib\Route::route();
        $actionArray = \lib\Route::$actionArray;
        $getArray = \lib\Route::$getArray;
        // echo '<pre>' . print_r($actionArray) . '</pre>';
        // echo '<pre>' . print_r($getArray) . '</pre>';
        // exit();
        $className = $actionArray[0];
        $actionName = $actionArray[1];
        // $classFile = $actionArray[2];

        // echo $actionArray[2];

        // 判断类名是否包含zax、block
        if (strpos($className, 'Zax') !== false || strpos($className, 'Block') !== false) {
            // 类名含有zax、block，说明是小工具、子系统，路径不一样
            $ctrlfile = APP . '\\' . strtolower($className) . '/controller/' . strtolower($className) . 'controller.php';
            $ctrlClass = MODULE . '\\' . strtolower($className) . '\\controller\\' . $className . 'Controller';
        } else if (strpos($className, 'Captcha') !== false) {
            // 类名含有Captcha，验证码类
            $ctrlfile = ROOT . '\lib\\' . $actionArray[2] . strtolower($className) . '.class.php';
            $ctrlClass =  '\lib\\' . $className;
        } else if (strlen($actionArray[2]) > 1) {
            // 在配置文件中指明了类文件目录
            $ctrlfile = ROOT . $actionArray[2] . strtolower($className) . 'controller.php';
            $ctrlClass =  $actionArray[2] . $className . 'Controller';
        } else {
            //其他情况，就是APP目录下的controller
            $ctrlfile = APP . '/controller/' . strtolower($className) . 'controller.php';
            $ctrlClass = MODULE . '\\controller\\' . $className . 'Controller';
            // 这句是“类的命名空间路径”：'\app\ctrl\indexController'
        }
        // echo $className;
        // echo $ctrlfile;
        // echo $ctrlClass;
        // exit();

        if (is_file($ctrlfile)) {
            include $ctrlfile;
            $ctrl = new $ctrlClass();
            $ctrl->$actionName();
            // \core\lib\log::log('ctrl:' . $ctrlClass . PHP_EOL . 'action' . $action);
        } else {
            throw new \Exception('找不到控制器' . $ctrlClass);
        }


        // 启动日志类
        // \core\lib\log::init();
        // // \core\lib\log::log('test1');
        // // \core\lib\log::log('test2');
        // // \core\lib\log::log('test3');
        // // \core\lib\log::log('test4');
        // // \core\lib\log::log('test5');
        // // \core\lib\log::log($_SERVER, 'server');
    }

    static public function load($class)
    {

        // echo $class;
        // exit();

        if (isset(self::$classMap[$class])) {
            return true;
        } else {
            $classPath = str_replace('\\', '/', $class);
            // 将类的命名空间，转换为路径
            $files = ROOT . '/' . $classPath . '.class.php';
            if (is_file($files)) {
                include $files;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }

    // public function assign($name, $value)
    // {
    //     $this->assign[$name] = $value;
    // }

    // public function display($file)
    // {
    //     // 引入第三方库“twig/twig”前备份
    //     // $file = APP . '/views/' . $file;
    //     // if (is_file($file)) {
    //     //     // p($this->assign);
    //     //     // exit();
    //     //     extract($this->assign);
    //     //     include $file;
    //     // }
    //     $file = APP . '/views/' . $file;
    //     if (is_file($file)) {
    //         // p($this->assign);
    //         // exit();

    //         // \Twig\Autoloader::register();
    //         $loader = new \Twig\Loader\FilesystemLoader(APP . '/views');
    //         $twig = new \Twig\Environment($loader, [
    //             // 'cache' => '/path/to/compilation_cache',
    //             'cache' => IMOOC . '/log/twig',
    //             'debug' => DEBUG    // twig本身带有缓存，会造成改了index.html代码看不出来效果
    //         ]);
    //         $template = $twig->load('index.html');
    //         $template->display($this->assign ? $this->assign : '');
    //     }
    // }
}

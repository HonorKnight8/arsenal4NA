<?php

namespace lib;

class Route
{
    // public static $pathArray;       // 保存用户当前访问的页面 // 不用这个，直接用entry里的方法
    public static $actionArray;     // 该页面对应的array（控制器，方法，控制器文件路径）
    public static $getArray;        // url剩余其他全部作文get参数
    static public function route()
    {
        // xxx.com/index.php/index/index
        // 1.隐藏index.php         >>> xxx.com/index/index
        // 2.获取URL中的参数部分    >>> /index/index
        // 第一节作为控制器，第二节作为方法，剩下的全部两两作为get
        // 3.返回对应的控制器方法(一个控制器类中可能存在多个方法)

        $path = '';       // 浏览器提交的URL参数（域名后面的部分）
        $actionName = ''; // 'CtrlName::ActionName'

        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $path = $_SERVER['REQUEST_URI'];
            $pathArray = explode('/', trim($path, '/'));
            // self::$pathArray = $pathArray;  // 保存用户当前访问的页面 // 不用这个，直接用entry里的方法
            $pathLength = count($pathArray);

            //应进行URL长度、合规性判断

            $actionName = $pathArray[0] . '::' . $pathArray[1];
            self::$actionArray = \lib\Conf::get($actionName, 'route');
            // echo $actionName;
            // echo '<pre>' . print_r(self::$actionArray) . '</pre>';
            // exit();
            if (self::$actionArray != 'noMatchFound') {
                // 有匹配项，也可以用is_array()来判断

                // 将URL的剩下部分转换成GET：index/index/id/1/str/2/test/3 
                // 要得到：id1 str2 test3
                unset($pathArray[0]);
                unset($pathArray[1]);
                $count = count($pathArray) + 2;
                $i = 2;
                while ($i < $count) {
                    if (isset($pathArray[$i + 1])) {
                        self::$getArray[$pathArray[$i]] = $pathArray[$i + 1];
                    }
                    $i = $i + 2;
                }
            } else {
                // 无匹配项目，跳到首页
                self::$actionArray = \lib\Conf::get('index::index', 'route');
            }

            // echo '<pre>' . print_r(self::$getArray) . '</pre>';
            // exit();
        } else {
            self::$actionArray = \lib\Conf::get('index::index', 'route');
            // echo '<pre>' . print_r(self::$actionArray) . '</pre>';
            // echo '<pre>' . print_r(self::$getArray) . '</pre>';
            // exit();
        }
    }
}

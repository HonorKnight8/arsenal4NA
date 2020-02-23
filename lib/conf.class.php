<?php

namespace lib;

class Conf
{
    static public $conf = array();
    static public function get($name, $file)    //从$file配置文件里加载指定的$name配置项
    {
        /**
         * 0. 先判断是否已经缓存过了
         * 1. 判断配置文件是否存在
         * 2. 判断配置项是否存在
         * 3. 缓存配置（假如已经加载）
         */
        // p(self::$conf);
        if (isset(self::$conf[$file])) {
            return self::$conf[$file][$name];
        } else {
            // p(1);   // 测试配置文件是否会重复加载
            $path = ROOT . '\config\\' . $file . '.conf.php';
            // echo $file;
            // exit();
            if (is_file($path)) {
                $conf = include $path;

                if (isset($conf[$name])) {
                    self::$conf[$file] = $conf;
                    // p($conf);
                    // exit();
                    return $conf[$name];
                } else {
                    throw new \Exception('没有这个配置项' . $name);
                }
            } else {
                throw new \Exception('找不到配置文件' . $file);
            }
        }
    }

    static public function all($file)   //从$file配置文件里加载全部配置项
    {
        if (isset(self::$conf[$file])) {
            return self::$conf[$file];
        } else {
            // p(1);   // 测试配置文件是否会重复加载
            $path = IMOOC . '\core\config\\' . $file . '.php';
            // p($file);
            // exit();
            if (is_file($path)) {
                $conf = include $path;
                self::$conf[$file] = $conf;
                return $conf;
            } else {
                throw new \Exception('找不到配置文件' . $file);
            }
        }
    }
}

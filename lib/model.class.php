<?php

namespace core\lib;

use core\lib\conf;
use Medoo\Medoo;    //Medoo.php里面有两个类

// include "vendor/autoload.php";

class model extends Medoo
{
    public function __construct()
    {
        $option = conf::all('database');
        parent::__construct($option);
    }
}


// 未使用第三方库catfan/medoo之前，直接用pdo的方式
// class model extends \PDO
// {
//     public function __construct()
//     {
//         // $dsn = 'mysql:host=192.168.56.56;dbname=test4phpl';
//         // $username = 'phpl';
//         // $passwd = 'phpl.369*';
//         $database = conf::all('database');
//         // p($database);
//         try {
//             parent::__construct($database['DSN'], $database['USERNAME'], $database['PASSWD']);
//         } catch (\PDOException $e) {
//             p($e->getMessage());
//         }
//     }
// }

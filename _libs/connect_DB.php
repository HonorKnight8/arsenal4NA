<?php

//连接数据库
$user = 'saA4NA';
$pwd = 'saA4NA.369*';

$dbms = 'mysql';
$host = '192.168.56.56';
// $host = 'localhost';
$port = '3306';
$dbName = 'a4NA';
$charset = 'utf8';
$dsn = "$dbms:host=$host;port=$port;dbname=$dbName;charset=$charset";

//$driver_opt = array(PDO::ATTR_AUTOCOMMIT => 0, PDO::ATTR_PERSISTENT => true);
$driver_opt = array();

try {
    $pdo = new PDO($dsn, $user, $pwd, $driver_opt);

    // $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
} catch (PDOException $e) {
    echo "数据库连接失败,原因:" . $e->getMessage();
    exit;
}

<?php

namespace app\controller;

// use core\lib\model;

class indexController extends \lib\Entry
// 继承入口类
{
    public function index()
    {
        //示例8：Twig
        dump($_SERVER);
        // $data = 'Hello World 20200222_b';
        // $this->assign('data', $data);
        // $this->display('index.html');
        echo 'index';

        // 示例7：Medoo+model类
        // $model = new \app\model\user1Model();
        // $ret = $model->lists();
        // dump($ret);

        // $ret = $model->getOne('孙七');
        // dump($ret);

        // $data = array(
        //     "name" => "孙七七",
        //     "age" => "17",
        //     "class" => "七班"
        // );
        // $ret = $model->setOne('孙七', $data);
        // dump($ret);

        // $ret = $model->delOne('李');
        // dump($ret);

        // 示例6：Medoo数据库操作
        // $model = new model();   //连接
        // dump($model);

        // 查询
        // $data = $model->select('shops', '*');
        // dump($data);

        //插入
        // $data = array(
        //     "name" => "测试0222",
        //     "age" => "18",
        //     "class" => "一"
        // );
        // $ret = $model->insert('user1', $data);
        // dump($ret);




        // 示例5：配置文件：模型类
        // p(new \core\lib\model());

        // 示例4：配置文件：路由类
        // p(\core\lib\conf::get('CTRL', 'route'));
        // p(\core\lib\conf::get('ACTION', 'route'));

        // 示例3：
        // $data = 'Hello World';
        // $title = '视图文件';
        // $this->assign('title', $title);
        // $this->assign('data', $data);
        // $this->display('index.html');
    }
}

// 示例1、2
// class indexCtrl
// {
//     public function index()
//     {
//         // 示例1
//         // p('it is index');

//         //示例2
//         // // new model();
//         // $model = new \core\lib\model();
//         // $sql = 'select * from shops';
//         // $ret = $model->query($sql);
//         // // p($ret);
//         // p($ret->fetchall());
//     }
// }

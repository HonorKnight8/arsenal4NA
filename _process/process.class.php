<?php
class Process
{
    protected $processResultMessage;
    function __construct()
    {
        //获取post动作，调用相应的方法进行处理，并返回处理结果
        // echo count($_POST) . '<br />';
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';




        $this->processResultMessage = '处理结果XXXXXXXXXX,XXXXXXXXXX,XXXXXXXXXX,XXXXXXXXXX,XXXXXXXXXX,XXXXXXXXXX,';
    }

    function __toString()
    {

        //将程序处理结果传给Topbar，将信息显示在topbar上面
        $result = new TopBar($this->processResultMessage);
        //顶栏

        $result .= new SideBar();
        //侧栏

        $result .= new Main();
        //主页面
        return $result;
    }
}

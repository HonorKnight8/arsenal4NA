<?php
class Main
{
    private $action;
    private $menu;


    function __construct($action = "")
    {
        $this->action = $action;
        $this->menu = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "0";
        //echo $this->action;
        //echo $this->shape;
    }

    //当一个对象被当作字符串对待的时候，会触发这个魔术方法，引用处被echo：echo new Body();
    // __toString() 方法用于一个类被当成字符串时应怎样回应。例如 echo $obj; 应该显示些什么。此方法必须返回一个字符串，否则将发出一条 E_RECOVERABLE_ERROR 级别的致命错误。
    function __toString()
    {
        //$form = '<form action="' . $this->action . '" method="post" >';

        $div = '<div id="main">';
        $div .= '<tr><td><span style="font-size:30px;cursor:pointer" class="menubtn" title="打开菜单" onclick="openNav()">&#9776; </span></td><td ><span style="font-size:30px">arsenal4NA</span></td></tr>';

        $div .= '<br /><center><a href="_libs/func_test.php">函数测试</a></center><br />';


        switch ($this->menu) {
            case "HomePage":
                $div .= $this->HomePage();
                break;
            case "Scripts":
                $div .= $this->Scripts();
                break;
            case "MAC_Inquire":
                $div .= $this->MAC_Inquire();
                break;
            case "Subnet_Calc":
                $div .= $this->Subnet_Calc();
                break;
            case "WinFW_analyze":
                $div .= $this->WinFW_analyze();
                break;
            case "Contacts":
                $div .= $this->Contacts();
                break;
            case "Exam":
                $div .= $this->Exam();
                break;
            case "ITAM":
                $div .= $this->ITAM();
                break;
            default:
                $div .= $this->HomePage();
        }
        $div .= '</div>';
        return $div;
    }


    private function HomePage()
    {
        $body = '<div class="div1"><h4>&emsp;&emsp;arsenal4NA(arsenal for Network Administrator)，即：“网管军火库/工具箱”，本攻城狮自己写的一些网络管理、HelpDesk、基础IT运维工作中可能会用到的工具。</h4><br /><hr style="height:1px;border:none;border-top:5px dashed LawnGreen;" width="75%" /></div>';
        return $body;
    }
    private function Scripts()
    {
        return "Scripts";
    }
    private function MAC_Inquire()
    {
        return "MAC_Inquire";
    }
    private function Subnet_Calc()
    {
        return "Subnet_Calc";
    }
    private function WinFW_analyze()
    {
        return "WinFW_analyze";
    }

    private function Contacts()
    {
        //判断登录状态
        return "Contacts";
    }
    private function Exam()
    {
        return "Exam";
    }
    private function ITAM()
    {
        return "ITAM";
    }

    // private function getCircle()
    // {
    //     $input = '<b>请输入 ｜ 圆形 ｜ 的半径：</b><p>';
    //     $input .= '半径: <input type="text" name="radius" value="' . $_POST['radius'] . '" ><br>';
    //     $input .= '<input type="hidden" name="action" value="circle">';
    //     return $input;
    // }
}

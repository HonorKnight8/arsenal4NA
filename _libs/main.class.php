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
        // $div .= '<br /><center><a href="_libs/func_test.php">函数测试</a></center><br />';

        switch ($this->menu) {
            case "HomePage":
                $div .= $this->HomePage();
                break;
            case "Scripts":
                // $div .= $this->Scripts();
                $div .= new Scripts();
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
                // $div .= $this->Contacts();
                $div .= new Contacts();
                break;
            case "contactsPersonalModify":
                $div .= new ContactsPersonalModify();
                break;
            case "contactsHR":
                $div .= new ContactsHR();
                break;
            case "Exam":
                $div .= $this->Exam();
                break;
            case "ITAM":
                $div .= $this->ITAM();
                break;
            case "Personal":
                $div .= new Personal();
                break;
            default:
                $div .= $this->HomePage();
        }
        $div .= '</div>';
        return $div;
    }


    private function HomePage()
    {
        $div = '<div class="div1">';
        $div .= '<h4>&emsp;&emsp;arsenal4NA(arsenal for Network Administrator)，即：“网管军火库/工具箱”，本攻城狮自己写的一些网络管理、HelpDesk、基础IT运维工作中可能会用到的工具。</h4><br />';
        $div .= '<hr style="height:1px;border:none;border-top:5px dashed LawnGreen;" width="75%" />';
        $div .= '<span><b>目前进度：</b></span><br /><br />';
        $div .= '<span>“常用脚本”：功能基本完成</span><br /><br />';
        $div .= '<span>“MAC查询”：功能基本完成</span><br />';
        $div .= '<span>&emsp;&emsp;1、基于过程开发，待改造</span><br />';
        $div .= '<span>&emsp;&emsp;2、添加批量查询功能</span><br /><br />';
        $div .= '<span>“通讯录”：正在开发</span><br /><br />';
        $div .= '<span>其他：未动工</span><br /><br />';

        $div .= '</div>';
        return $div;
    }
    /*     private function Scripts()
    {
        // return new Scripts();
        return "<p>Scripts";
    } */
    private function MAC_Inquire()
    {
        return "<p>MAC_Inquire";
    }
    private function Subnet_Calc()
    {
        return "<p>Subnet_Calc";
    }
    private function WinFW_analyze()
    {
        return "<p>WinFW_analyze";
    }

    //     private function Contacts()
    // {
    //     //判断登录状态
    //     return "Contacts";
    // }

    private function Exam()
    {
        return "<p>Exam";
    }
    private function ITAM()
    {
        return "<p>ITAM";
    }
}

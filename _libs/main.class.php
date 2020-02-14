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

        switch ($this->menu) {
            case "HomePage":
                $div .= $this->HomePage();
                break;
            case "Scripts":
                $div .= new Scripts();
                break;
            case "MACInquire":
                $div .= new MACInquire();
                break;
            case "SubnetCalc":
                $div .= new SubnetCalc();
                break;
            case "WinFWAnalyzer":
                $div .= new WinFWAnalyzer();
                break;
            case "Contacts":
                $div .= new Contacts();
                break;
            case "contactsPersonalModify":
                $div .= new ContactsPersonalModify();
                break;
            case "contactsHR":
                $div .= new ContactsHR();
                break;
            case "Exam":
                $div .= new Exam();
                break;
            case "ITAM":
                $div .= new ITAM();
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
}

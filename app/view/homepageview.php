<?php

namespace app\view;

class HomePageView extends \app\view\IndexView
{

    // 继承自基类\app\view\IndexView
    // function __construct()
    // {
    // }

    function __toString()
    {
        $div = '';
        $div .= '<div class="div_homepage" id="div_homepage">';

        $div .= $this->thisPage();
        // $this->div_macinquire .= self::$div_inquireResult;

        $div .= '</div>';
        $div .= '</div></body></html>';
        return  $this->altogether . $div;
    }

    private function thisPage()
    {
        $page = '';
        $page .= '<fieldset><legend>简介及开发进度(2020-03-02 PM)</legend>';
        $page .= '&emsp;&emsp;这是本攻城狮自己写的一些网络管理、HelpDesk、基础IT运维工作中可能会用到的工具。作为学习编程过程中的一项实践（这个项目的开发进度可能比较缓慢）；同时也作为自己若干年网管、基础IT运维工作的总结；也作为日后工作的提高。<br />';
        $page .= '&emsp;&emsp;如果你在公司从事“网管”、“HelpDesk”、“桌面运维”之类的工作，或者说公司只有你一个ITSupport的情况下，这个工具可能会有所帮助。<br />';
        $page .= '1. <b>核心功能：EEDIR</b>(Employee Directory, 通讯录、系统用户管理)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '2. <b>功能块：PUBB</b>(Public Utilities Booking & Borrow, 公共设施预定、借用，)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '3. <b>功能块：Exam</b>(Exam, 在线考试系统：招聘、内训)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '4. <b>功能块：DMS</b>(Document Management System, 文档管理系统)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '5. <b>功能块：ITAM</b>(I.T. Asset Management, IT资产管理：桌面、机房、网络、虚拟资产)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '6. <b>ZAX工具集</b><br />';
        $page .= '  * SP(Scripts, 常用脚本下载)<br />';
        $page .= '....................................<span style="color:Chocolate;">50%</span><br />';
        $page .= '  * MACI(MACInquire, MAC地址归属厂商查询)<br />';
        $page .= '.................................<span style="color:Chocolate;">100%</span><br />';
        $page .= '  * IPI(IPInquire, IP地址相关信息查询)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '  * SNC(SubnetCalc, 子网计算器)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '  * EDC(Encode & Decode, 编解码工具)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '  * WFWLA(WinFWLogAnalyzer, Windows系统防火墙日志分析)<br />';
        $page .= '......................................<span style="color:Chocolate;">0%</span><br />';
        $page .= '7. <b>后台管理</b><br />';
        $page .= '与各功能块同步进行<br />';
        $page .= '8. <b>整体框架</b><br />';
        $page .= '*基本完成*，20200223，基于MVC+URL路由搭建了一个简单框架<br />';

        $page .= '</fieldset>';

        return $page;
    }
}

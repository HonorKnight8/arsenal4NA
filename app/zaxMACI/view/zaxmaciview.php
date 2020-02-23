<?php

namespace app\zaxmaci\view;

class ZaxMACIview
{
    static public $div_inquireResult;
    function __construct($action = "")
    {
        $this->div_macinquire = '<div class="div_macinquire" id="div_macinquire">';

        $this->div_macinquire .= $this->thisPage();

        $this->div_macinquire .= SELF::$div_inquireResult;
    }

    function __toString()
    {
        $this->div_macinquire .= '</div>';
        return $this->div_macinquire;
    }

    private function thisPage()
    {
        $page = '<form action="" method="post" >';
        $page .= '<fieldset><legend>查询MAC地址所归属的厂商</legend>';
        $page .= '<h4>资料更新时间：2020-02-19</h4>';
        $page .= '请在下面的框中输入要查询的MAC地址，支持的输入格式有：<br />';
        $page .= '&emsp;&emsp;1、使用“-”进行分隔的格式：00-1A-11-A1-B2-C3<br />';
        $page .= '&emsp;&emsp;2、使用“:”进行分隔的格式：00:1A:11:A1:B2:C3<br />';
        $page .= '&emsp;&emsp;3、使用“空格”进行分隔的格式：00&nbsp;1A&nbsp;11&nbsp;A1&nbsp;B2&nbsp;C3<br />';
        $page .= '&emsp;&emsp;4、不使用任何符号进行分隔的格式：001A11A1B2C3<br />';
        $page .= '也可以只输入前三个字节（输入长度大于等于3个字节，至完整长度的MAC地址，均能自动识别）：<br />';
        $page .= '&emsp;&emsp;5、00-1A-11<br />';
        $page .= '&emsp;&emsp;6、00:1A:11<br />';
        $page .= '&emsp;&emsp;7、00&nbsp;1A&nbsp;11<br />';
        $page .= '&emsp;&emsp;8、001A11<br />';
        $page .=  '<br />';

        $page .= '输入MAC地址：(进行批量查询，请用<span style="background-color:gray;font-weight:900;color:rgb(200, 0, 0);" >逗号“,”分隔</span>)<br />';
        $page .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<textarea name="inputmac" rows="10" cols="33" placeholder="请输入有效的MAC地址……" required></textarea><br />';
        $page .= '输入验证码：<input type="text" name="inputcaptchaget" id="" placeholder="请输入下方的验证码……" required autocomplete="off" /><br />';
        $page .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="lib/captchaget0.php" alt="" id="verifyimage" /><a class="a_in_content" onclick="document.getElementById(\'verifyimage\').src=\'lib/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $page .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input class="submit" type="submit" name="macinquire" value="查询">';
        $page .= '</fieldset></form>';

        return $page;
    }
}

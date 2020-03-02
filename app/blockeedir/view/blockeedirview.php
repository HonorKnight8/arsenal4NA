<?php

namespace app\blockeedir\view;

class BlockEEDIRView extends \app\view\IndexView
{

    // 继承自基类\app\view\IndexView
    // function __construct()
    // {
    // }

    function __toString()
    {
        $div = '';
        $div .= '<div class="div_eedir" id="div_eedir">';

        $div .= $this->thisPage();

        $div .= '</div>';
        $div .= '</div></body></html>';
        return  $this->altogether . $div;
    }

    private function thisPage()
    {
        $page = '';
        $page .= '<fieldset><legend>EEDIR: 通讯录</legend>';
        $page .= '本功能开发进度：0%';
        $page .= '</fieldset>';

        return $page;
    }
}

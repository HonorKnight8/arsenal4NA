<?php

namespace app\zaxedc\view;

class ZaxEDCView extends \app\view\IndexView
{

    // 继承自基类\app\view\IndexView
    // function __construct()
    // {
    // }

    function __toString()
    {
        $div = '';
        $div .= '<div class="div_edc" id="div_edc">';

        $div .= $this->thisPage();

        $div .= '</div>';
        $div .= '</div></body></html>';
        return  $this->altogether . $div;
    }

    private function thisPage()
    {
        $page = '';
        $page .= '<fieldset><legend>EDC: 编解码工具</legend>';
        $page .= '本功能开发进度：0%';
        $page .= '</fieldset>';

        return $page;
    }
}

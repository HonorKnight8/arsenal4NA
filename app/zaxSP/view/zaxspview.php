<?php

namespace app\zaxsp\view;

class ZaxSPView extends \app\view\IndexView
{

    // 继承自基类\app\view\IndexView
    // function __construct()
    // {
    // }

    function __toString()
    {
        $div = '';
        $div .= '<div class="div_sp" id="div_sp">';

        $div .= $this->thisPage();

        $div .= '</div>';
        $div .= '</div></body></html>';
        return  $this->altogether . $div;
    }

    private function thisPage()
    {
        $page = '';
        $page .= '<fieldset><legend>SP: 常用脚本下载</legend>';
        $page .= '本功能开发进度：50%<p>';
        $page .= \app\zaxsp\model\ZaxSPModel::$hyperLinks;
        $page .= '</fieldset>';

        return $page;
    }
}

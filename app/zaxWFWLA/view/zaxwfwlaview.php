<?php

namespace app\zaxwfwla\view;

class ZaxWFWLAView extends \app\view\IndexView
{

    // 继承自基类\app\view\IndexView
    // function __construct()
    // {
    // }

    function __toString()
    {
        $div = '';
        $div .= '<div class="div_wfwla" id="div_wfwla">';

        $div .= $this->thisPage();

        $div .= '</div>';
        $div .= '</div></body></html>';
        return  $this->altogether . $div;
    }

    private function thisPage()
    {
        $page = '';
        $page .= '<fieldset><legend>WFWLA: Windows系统防火墙日志分析</legend>';
        $page .= '本功能开发进度：0%';
        $page .= '</fieldset>';

        return $page;
    }
}

<?php

namespace app\zaxipi\view;

class ZaxIPIView extends \app\view\IndexView
{

    // 继承自基类\app\view\IndexView
    // function __construct()
    // {
    // }

    function __toString()
    {
        $div = '';
        $div .= '<div class="div_ipi" id="div_ipi">';

        $div .= $this->thisPage();
        // $this->div_macinquire .= self::$div_inquireResult;

        $div .= '</div>';
        $div .= '</div></body></html>';
        return  $this->altogether . $div;
    }

    private function thisPage()
    {
        $page = '';
        $page .= '<form action="" method="post" >';
        $page .= '<fieldset><legend>IPI: IP地址查询</legend>';
        $page .= '本功能开发进度：0%';
        $page .= '</fieldset></form>';

        return $page;
    }
}

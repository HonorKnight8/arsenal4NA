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
        $page .= '<fieldset><legend>这是首页</legend>';
        $page .= '本功能开发进度：0%';
        $page .= '</fieldset>';

        return $page;
    }
}

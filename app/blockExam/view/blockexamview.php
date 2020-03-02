<?php

namespace app\blockexam\view;

class BlockExamView extends \app\view\IndexView
{

    // 继承自基类\app\view\IndexView
    // function __construct()
    // {
    // }

    function __toString()
    {
        $div = '';
        $div .= '<div class="div_exam" id="div_exam">';

        $div .= $this->thisPage();

        $div .= '</div>';
        $div .= '</div></body></html>';
        return  $this->altogether . $div;
    }

    private function thisPage()
    {
        $page = '';
        $page .= '<fieldset><legend>Exam: 考试系统</legend>';
        $page .= '本功能开发进度：0%';
        $page .= '</fieldset>';

        return $page;
    }
}

<?php
class Exam
{
    private $div_exam;
    function __construct($action = "")
    {
        $this->div_exam = '<div id="exam">';
        //判断登录状态
        if ($_SESSION['loginStatus'] == 1) {
            //已登录状态
            $this->div_exam .= '<b>这是在线考试系统</b>';
        } else {
            $this->div_exam .= new Login();
        }
    }

    function __toString()
    {
        // if ($_SESSION['loginStatus'] == 1) {
        //     //已登录状态
        // }
        $this->div_exam .= '</div>';
        return $this->div_exam;
    }
}

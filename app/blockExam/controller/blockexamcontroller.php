<?php

namespace app\blockexam\controller;

class BlockExamController
{
    public function blockexam()
    {
        echo new \app\blockexam\view\BlockExamView;
    }
}

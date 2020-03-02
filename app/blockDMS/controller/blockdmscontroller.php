<?php

namespace app\blockdms\controller;

class BlockDMSController
{
    public function blockdms()
    {
        echo new \app\blockdms\view\BlockDMSView;
    }
}

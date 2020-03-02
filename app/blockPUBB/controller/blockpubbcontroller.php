<?php

namespace app\blockpubb\controller;

class BlockPUBBController
{
    public function blockpubb()
    {
        echo new \app\blockpubb\view\BlockPUBBView;
    }
}

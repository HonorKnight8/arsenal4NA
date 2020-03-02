<?php

namespace app\zaxsp\controller;

class ZaxSPController
{
    public function zaxsp()
    {
        // 调用model，生成下载链接
        \app\zaxsp\model\ZaxSPModel::getHyperLinks();

        // 输出页面
        echo new \app\zaxsp\view\ZaxSPView;
    }
}

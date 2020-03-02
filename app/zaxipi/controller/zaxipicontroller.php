<?php

namespace app\zaxipi\controller;

class ZaxIPIController
{
    public function zaxipi()
    {
        echo new \app\zaxipi\view\ZaxIPIView;
    }
}

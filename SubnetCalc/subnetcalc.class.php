<?php
class SubnetCalc
{
    private $div_subnetcalc;
    function __construct()
    {
        $this->div_subnetcalc = '<div id="subnetcalc">';
        $this->div_subnetcalc .= '<b>这是子网掩码计算工具</b>';
    }

    function __toString()
    {
        $this->div_subnetcalc .= '</div>';
        return $this->div_subnetcalc;
    }
}

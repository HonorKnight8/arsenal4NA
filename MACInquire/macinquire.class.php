<?php
class MACInquire
{
    private $div_macinquire;
    function __construct($action = "")
    {
        $this->div_macinquire = '<div id="macinquire">';
        $this->div_macinquire .= '<b>这是MAC地址归属厂商查询工具</b>';
    }

    function __toString()
    {
        $this->div_macinquire .= '</div>';
        return $this->div_macinquire;
    }
}

<?php
class WinFWAnalyzer
{
    private $div_winfwanalyzer;
    function __construct()
    {
        $this->div_winfwanalyzer = '<div id="winfwanalyzer">';
        $this->div_winfwanalyzer .= '<b>这是Windows系统防火墙日志分析工具</b>';
    }

    function __toString()
    {
        $this->div_winfwanalyzer .= '</div>';
        return $this->div_winfwanalyzer;
    }
}

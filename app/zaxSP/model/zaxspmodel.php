<?php

namespace app\zaxsp\model;

class ZaxSPModel
{
    public static $hyperLinks;
    public static function getHyperLinks()
    {
        $hyperLinks = '';
        $arr = scandir("app/zaxsp/scripts_win/");
        foreach ($arr as $value) {  //脚本文件
            if (!($value == '.' || $value == '..')) {
                $encode = mb_detect_encoding($value, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5', 'LATIN1'));
                if ($encode != 'UTF-8') {
                    $value = mb_convert_encoding($value, 'UTF-8', $encode);
                }
                $hyperLinks .= '<a href="/app/zaxsp/scripts_win/' . $value . '" title="' . $value . '">' . $value . '</a><br />';
            }
        }
        $hyperLinks .= '<br />';
        $arr = scandir("app/zaxsp/scripts_linux/");
        foreach ($arr as $value) {  //脚本文件
            if (!($value == '.' || $value == '..')) {
                $encode = mb_detect_encoding($value, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5', 'LATIN1'));
                if ($encode != 'UTF-8') {
                    $value = mb_convert_encoding($value, 'UTF-8', $encode);
                }
                $hyperLinks .= '<a href="/app/zaxsp/scripts_linux/' . $value . '" title="' . $value . '">' . $value . '</a><br />';
            }
        }
        self::$hyperLinks = '';
        self::$hyperLinks .= '<div>';
        self::$hyperLinks .= $hyperLinks;
        self::$hyperLinks .= '</div>';
    }
}

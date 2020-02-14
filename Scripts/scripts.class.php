<?php
class Scripts
{
    // function __construct()
    // {
    // }

    function __toString()
    {
        $hyperLinks = '';
        $arr = scandir("Scripts/Windows/");
        foreach ($arr as $value) {  //脚本文件
            if (!($value == '.' || $value == '..')) {
                $encode = mb_detect_encoding($value, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5', 'LATIN1'));
                if ($encode != 'UTF-8') {
                    $value = mb_convert_encoding($value, 'UTF-8', $encode);
                }
                $hyperLinks .= '<a href="Scripts/Windows/' . $value . '" title="' . $value . '">' . $value . '</a><br />';
            }
        }
        $hyperLinks .= '<br />';
        $arr = scandir("Scripts/Linux/");
        foreach ($arr as $value) {  //脚本文件
            if (!($value == '.' || $value == '..')) {
                $encode = mb_detect_encoding($value, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5', 'LATIN1'));
                if ($encode != 'UTF-8') {
                    $value = mb_convert_encoding($value, 'UTF-8', $encode);
                }
                $hyperLinks .= '<a href="Scripts/Linux/' . $value . '" title="' . $value . '">' . $value . '</a><br />';
            }
        }
        $div = '<div>';
        $div .= '<span>本页面收录一些常用的脚本</span><p>';
        $div .= $hyperLinks;
        $div .= '</div>';

        return $div;
    }
}

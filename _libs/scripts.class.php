<?php
class Scripts
{
    const dir_windows = '../Scripts/Windows/';
    const dir_Linux = '../Scripts/linux/';
    // function __construct()
    // {
    // }

    function __toString()
    {
        $hyperLinks = '';
        $arr = scandir("Scripts/Windows/");
        foreach ($arr as $value) {  //脚本文件
            if (!($value == '.' || $value == '..')) {
                $hyperLinks .= '<a href="Scripts/Windows/' . $value . '" title="' . $value . '">' . $value . '</a><br />';
            }
        }
        $hyperLinks .= '<br />';
        $arr = scandir("Scripts/linux/");
        foreach ($arr as $value) {  //脚本文件
            if (!($value == '.' || $value == '..')) {
                $hyperLinks .= '<a href="Scripts/linux/' . $value . '" title="' . $value . '">' . $value . '</a><br />';
            }
        }
        return $hyperLinks;
    }
}

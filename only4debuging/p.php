<?php
// 只为方便开发、调试使用的函数
function p($var)
{
    if (is_bool($var)) {
        var_dump($var);
        echo '<br />';
    } else if (is_NULL($var)) {
        var_dump(NULL);
        echo '<br />';
    } else {
        echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:20px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre><br />";
    }
    // } else if (is_array($var)) {
    //     echo '<pre>';
    //     print_r($var);
    //     echo '</pre>';
    //     echo '<br />';
    // } else {
    // if (is_string($var))

}

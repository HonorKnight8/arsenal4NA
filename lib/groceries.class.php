<?php

namespace lib;

class Groceries
{
    /**
     * 检查网页控件post提交的日期是合法日期数值
     * @param  string $data  输入字符串
     * @return bool 返回结果
     */
    static function checkPostDate($data)
    {
        if (date('Y-m-d', strtotime($data)) == $data) {
            return true;
        } else {
            return false;
        }
    }
}

<?php
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

    /**
     * 通用的，对输入字符串进行处理：去掉头尾空格，去掉反斜杠，特殊字符转换为HTML实体
     * @param   string   $data 输入字符串
     * @return  string   $data 返回字符串
     */
    static function cleanInputString_1($data)
    {    //定义函数，对输入进行预处理
        $data = trim($data);
        //trim() 函数，移除字符串两侧的空白字符或其他预定义字符。（之去掉两侧的，字符串中间的不处理）
        $data = stripslashes($data);
        //stripslashes() 函数，删除反斜杠：
        $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        //htmlspecialchars() 函数，将特殊字符转换为 HTML 实体
        //& (& 符号) 	&amp;
        //" (双引号) 	&quot;
        //' (单引号) 	设置了 ENT_QUOTES 后， &#039; (如果是 ENT_HTML401) ，或者 &apos; (如果是 //ENT_XML1、 ENT_XHTML 或 ENT_HTML5)。
        //< (小于) 	&lt;
        //> (大于) 	&gt;
        return $data;
    }

    /**
     * 字符串处理：去掉头尾空格，去掉反斜杠，特殊字符转换为HTML实体
     * @param   string   $data 输入字符串
     * @param   string   $type 类型（实现不同类型不同处理）
     * @return  string   $data 返回字符串
     */
    static function cleanInputString_2($data, $type = 1)
    {
        // $type
        // 1    纯数字，大小写字母（密码）

        return $data;
    }


    /**
     * 字符串半角和全角间相互转换
     * @param string $str 待转换的字符串
     * @param int  $type TODBC:转换为半角；TOSBC，转换为全角
     * @return string 返回转换后的字符串
     */
    static function convertStrType($str, $type)
    {  //全角、半角转换
        $dbc = array(
            '０', '１', '２', '３', '４',
            '５', '６', '７', '８', '９',
            'Ａ', 'Ｂ', 'Ｃ', 'Ｄ', 'Ｅ',
            'Ｆ', 'Ｇ', 'Ｈ', 'Ｉ', 'Ｊ',
            'Ｋ', 'Ｌ', 'Ｍ', 'Ｎ', 'Ｏ',
            'Ｐ', 'Ｑ', 'Ｒ', 'Ｓ', 'Ｔ',
            'Ｕ', 'Ｖ', 'Ｗ', 'Ｘ', 'Ｙ',
            'Ｚ', 'ａ', 'ｂ', 'ｃ', 'ｄ',
            'ｅ', 'ｆ', 'ｇ', 'ｈ', 'ｉ',
            'ｊ', 'ｋ', 'ｌ', 'ｍ', 'ｎ',
            'ｏ', 'ｐ', 'ｑ', 'ｒ', 'ｓ',
            'ｔ', 'ｕ', 'ｖ', 'ｗ', 'ｘ',
            'ｙ', 'ｚ', '－', '　', '：',
            '．', '，', '／', '％', '＃',
            '！', '＠', '＆', '（', '）',
            '＜', '＞', '＂', '＇', '？',
            '［', '］', '｛', '｝', '＼',
            '｜', '＋', '＝', '＿', '＾',
            '￥', '￣', '｀'
        );
        $sbc = array( //半角
            '0', '1', '2', '3', '4',
            '5', '6', '7', '8', '9',
            'A', 'B', 'C', 'D', 'E',
            'F', 'G', 'H', 'I', 'J',
            'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y',
            'Z', 'a', 'b', 'c', 'd',
            'e', 'f', 'g', 'h', 'i',
            'j', 'k', 'l', 'm', 'n',
            'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x',
            'y', 'z', '-', ' ', ':',
            '.', ',', '/', '%', ' #',
            '!', '@', '&', '(', ')',
            '<', '>', '"', '\'', '?',
            '[', ']', '{', '}', '\\',
            '|', '+', '=', '_', '^',
            '￥', '~', '`'

        );
        if ($type == 'TODBC') {
            return str_replace($sbc, $dbc, $str); //半角到全角
        } elseif ($type == 'TOSBC') {
            return str_replace($dbc, $sbc, $str); //全角到半角
        } else {
            return $str;
        }
    }
}

<?php

namespace app\zaxmaci\controller;

class ZaxMACIController
{
    private $div_macinquire;
    static $div_inquireResult;
    public function zaxmaci()
    {
        // echo 'ZaxMACI';

        if (isset($_POST['macinquire'])) {
            \app\zaxmaci\view\ZaxMACIView::$div_inquireResult = self::doInquire($_POST['macinquire']);
        }
        echo new \app\zaxmaci\view\ZaxMACIView;
    }

    static function doInquire($MAC)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<br />';
        // var_dump($_POST['inputmac']);
        // var_dump(isset($_POST['inputmac']));
        // ???不能用isset($_POST['inputmac'])判断输入框是否有输入，即使是空的也会返回ture

        // 用了session存验证码
        if (strlen($_POST['inputcaptchaget']) == 0 || strtolower($_POST['inputcaptchaget']) !== strtolower($_SESSION['captchaCreated'])) {
            return '<span class="processResultMessage" >验证码错误</span><br />';
            // <span class="processResultMessage" >  </span>
        } else
        if (strlen($_POST['inputmac']) == 0) {
            //判断输入的MAC地址是否为空
            return '<span class="processResultMessage" >未输入任何MAC地址</span><br />';
        } else {

            $mac = \lib\StringOprate::convertStrType($_POST['inputmac'], 'TOSBC'); //将全角“：”转换为半角“:”，将全角“，”转换为半角“,”
            $mac = \lib\StringOprate::cleanInputString($mac); //去掉首尾空格、反斜杠，特殊字符转换为HTML实体
            $mac = str_replace(PHP_EOL, '', $mac);      //去掉分行
            //去掉行末的逗号。并不需要，反正中间如果多了逗号，会造成数组的某个值为空，在后面检索的时候判断
            $macArray = explode(',', $mac);         //将字符串以“,”分隔成数组
            $macArray = array_unique($macArray);    //去重
            // echo '<pre>';
            // print_r($macArray);
            // echo '</pre>';

            if (count($macArray) > 256) { //判断数组长度，限制每次最多只能进行256个查询
                return '<span class="processResultMessage" >批量查询的MAC地址数量太大，一次批量查询最多支持256条MAC</span><br />';
            } else {
                $resule = '<b>查询结果：</b><br />';
                $t1 = microtime(true);
                foreach ($macArray as  $key => $singleMac) { // 遍历数组，每个值调用一次
                    if (strlen($singleMac) !== 0) { // 判断singleMac长度
                        //调用函数进行查询
                        // echo $singleMac . '<br />';
                        $resule .= \app\zaxmaci\model\ZaxMACIModel::inquireOneMac($singleMac);
                    }
                }
                $t2 = microtime(true);
            }

            $resule .= '<span style="background-color:gray">耗时' . round($t2 - $t1, 3) . '秒</span><br />';
            $resule .= '<a href="http://standards-oui.ieee.org/oui/oui.txt"><span style="background-color:Khaki">参考：IEEE公布的MAC地址归属厂商列表</span></a><br /><br />';
            return  $resule;
        }
    }
}

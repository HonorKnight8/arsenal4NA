<?php
class MACInquire
{
    private $div_macinquire;
    static $div_inquireResult;
    function __construct($action = "")
    {
        $this->div_macinquire = '<div class="div_macinquire" id="div_macinquire">';

        $this->div_macinquire .= $this->thisPage();

        $this->div_macinquire .= SELF::$div_inquireResult;
    }

    function __toString()
    {
        $this->div_macinquire .= '</div>';
        return $this->div_macinquire;
    }

    private function thisPage()
    {
        $page = '<form action="" method="post" >';
        $page .= '<fieldset><legend>查询MAC地址所归属的厂商</legend>';
        $page .= '<h4>资料更新时间：2020-02-19</h4>';
        $page .= '请在下面的框中输入要查询的MAC地址，支持的输入格式有：<br />';
        $page .= '&emsp;&emsp;1、使用“-”进行分隔的格式：00-1A-11-A1-B2-C3<br />';
        $page .= '&emsp;&emsp;2、使用“:”进行分隔的格式：00:1A:11:A1:B2:C3<br />';
        $page .= '&emsp;&emsp;3、使用“空格”进行分隔的格式：00&nbsp;1A&nbsp;11&nbsp;A1&nbsp;B2&nbsp;C3<br />';
        $page .= '&emsp;&emsp;4、不使用任何符号进行分隔的格式：001A11A1B2C3<br />';
        $page .= '也可以只输入前三个字节（输入长度大于等于3个字节，至完整长度的MAC地址，均能自动识别）：<br />';
        $page .= '&emsp;&emsp;5、00-1A-11<br />';
        $page .= '&emsp;&emsp;6、00:1A:11<br />';
        $page .= '&emsp;&emsp;7、00&nbsp;1A&nbsp;11<br />';
        $page .= '&emsp;&emsp;8、001A11<br />';
        $page .=  '<br />';

        $page .= '输入MAC地址：(进行批量查询，请用<span style="background-color:gray;font-weight:900;color:rgb(200, 0, 0);" >逗号“,”分隔</span>)<br />';
        $page .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<textarea name="inputmac" rows="10" cols="33" placeholder="请输入有效的MAC地址……" required></textarea><br />';
        $page .= '输入验证码：<input type="text" name="inputcaptchaget" id="" placeholder="请输入下方的验证码……" required autocomplete="off" /><br />';
        $page .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="_libs/captchaget0.php" alt="" id="verifyimage" /><a class="a_in_content" onclick="document.getElementById(\'verifyimage\').src=\'_libs/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $page .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input class="submit" type="submit" name="macinquire" value="查询">';
        $page .= '</fieldset></form>';

        return $page;
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

        if (strlen($_POST['inputcaptchaget']) == 0 || strtolower($_POST['inputcaptchaget']) !== strtolower($_SESSION['captchaCreated'])) {
            return '<span class="processResultMessage" >验证码错误</span><br />';
            // <span class="processResultMessage" >  </span>
        } else if (strlen($_POST['inputmac']) == 0) {
            //判断输入的MAC地址是否为空
            return '<span class="processResultMessage" >未输入任何MAC地址</span><br />';
        } else {

            $mac = Groceries::convertStrType($_POST['inputmac'], 'TOSBC'); //将全角“：”转换为半角“:”，将全角“，”转换为半角“,”
            $mac = Groceries::cleanInputString_1($mac); //去掉首尾空格、反斜杠，特殊字符转换为HTML实体
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
                        $resule .= Self::inquireOneMac($singleMac);
                    }
                }
                $t2 = microtime(true);
            }

            $resule .= '<span style="background-color:gray">耗时' . round($t2 - $t1, 3) . '秒</span><br />';
            $resule .= '<a href="http://standards-oui.ieee.org/oui/oui.txt"><span style="background-color:Khaki">参考：IEEE公布的MAC地址归属厂商列表</span></a><br /><br />';
            return  $resule;
        }
    }

    /**
     * 查询MAC地址归属厂商
     * @param  string $mac  准备查询的MAC地址
     * @return string 返回查询结果：“'你输入的MAC地址<span style="background-color:Lavender">“' . $mac_head . '”</span>被分配给<span style="background-color:SpringGreen;color:Navy;font-size: 24px;">' . $result . '</span><br />'”
     */
    static function inquireOneMac($mac)
    {
        //判断资料文件是否存在
        $ouifile = "MACInquire/oui.txt";
        if (!file_exists($ouifile)) {
            return '<span class="processResultMessage" >资料文件不存在，请联系管理员</span>';
        } else {
            $macOrignal = $mac;
            //去掉“:”、“-”和几种空格
            $mac = preg_replace('/[\:]/', '', $mac);
            $mac = preg_replace('/[\-]/', '', $mac);
            $mac = preg_replace('/[\s+]/', '', $mac);
            $mac = preg_replace('/[\n+]/', '', $mac);
            $mac = preg_replace('/[\r+]/', '', $mac);
            $mac = preg_replace('/[\t+]/', '', $mac);

            if (preg_match('/[^a-f0-9\-\:\s\,]/i', $mac)) { //验证字符串是否包含不应该在MAC地址中出现的字符
                return  '你输入的MAC地址<span style="background-color:Lavender">“' . $mac . '”</span><span class="processResultMessage">含有不应该出现的字符</span><br />';
            } else if ((strlen($mac) < 6) or (strlen($mac) > 12)) { //验证字符串长度
                return  '你输入的MAC地址<span style="background-color:Lavender">“' . $mac . '”</span><span class="processResultMessage">长度不符合要求（应至少包含前3个字节，不能长于一个MAC地址）</span><br />';
            } else {
                $mac_head = substr($mac, 0, 6);
                //截取前6位
                $mac_head = substr_replace(substr_replace($mac_head, '-', 2, 0), '-', 5, 0);
                //重新插入“-”

                $handler = fopen($ouifile, "r");
                $result = 1;
                do {
                    //当目标文件正在被notepad打开时，会造成死循环
                    $line = fgets($handler);
                    //  echo $line;
                    if (substr_count($line, $mac_head) > 0) {                // 进行比较
                        $result = $line;
                    }
                } while ((!feof($handler) and $result == 1)); //$result的值改变，或，达到文件末尾，则跳出循环
                //}while(!feof($handler));  //不管有没有匹配到，都循环到最后一行
                fclose($handler); //关闭文件

                if ($result == 1) { //判断$result的值是否改变
                    return  '你输入的MAC地址<span style="background-color:Lavender">“' . $macOrignal . '”</span><span style="background-color:Gainsboro;color:OrangeRed;font-size: 24px;">未匹配到相关记录</span><br />';
                } else {
                    $result = mb_substr($result, 18);
                    //将匹配到的那行字符串，去掉前面没用的部分
                    return  '你输入的MAC地址<span style="background-color:Lavender">“' . $macOrignal . '”</span>被分配给<span style="background-color:SpringGreen;color:Navy;font-size: 24px;">' . $result . '</span><br />';
                }
            }
        }
    }
}

<?php

namespace app\zaxmaci\model;

class ZaxMACIModel
{

    /**
     * 查询MAC地址归属厂商
     * @param string $mac 准备查询的MAC地址
     * @return string 返回查询结果：“'你输入的MAC地址<span style="background-color:Lavender">“' . $mac_head . '”</span>被分配给<span style="background-color:SpringGreen;color:Navy;font-size: 24px;">' . $result . '</span><br />'”
     */
    static function inquireOneMac($mac)
    {
        //判断资料文件是否存在
        $ouifile = "app/zaxMACI/oui.txt";
        if (!file_exists($ouifile)) {
            return '<span class="processResultMessage">资料文件不存在，请联系管理员</span>';
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
                return '你输入的MAC地址<span style="background-color:Lavender">“' . $mac . '”</span><span class="processResultMessage">含有不应该出现的字符</span><br />';
            } else if ((strlen($mac) < 6) or (strlen($mac) > 12)) { //验证字符串长度
                return '你输入的MAC地址<span style="background-color:Lavender">“' . $mac . '”</span><span class="processResultMessage">长度不符合要求（应至少包含前3个字节，不能长于一个MAC地址）</span><br />';
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
                    // echo $line;
                    if (substr_count($line, $mac_head) > 0) { // 进行比较
                        $result = $line;
                    }
                } while ((!feof($handler) and $result == 1)); //$result的值改变，或，达到文件末尾，则跳出循环
                //}while(!feof($handler)); //不管有没有匹配到，都循环到最后一行
                fclose($handler); //关闭文件

                if ($result == 1) { //判断$result的值是否改变
                    return '你输入的MAC地址<span style="background-color:Lavender">“' . $macOrignal . '”</span><span style="background-color:Gainsboro;color:OrangeRed;font-size: 24px;">未匹配到相关记录</span><br />';
                } else {
                    $result = mb_substr($result, 18);
                    //将匹配到的那行字符串，去掉前面没用的部分
                    return '你输入的MAC地址<span style="background-color:Lavender">“' . $macOrignal . '”</span>被分配给<span style="background-color:SpringGreen;color:Navy;font-size: 24px;">' . $result . '</span><br />';
                }
            }
        }
    }
}

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
	<title>MAC_Inquire</title>
	<style>
		.error {color: #FF0000;}
		<!--设置出错时的样式。-->
	</style>
</head>
<body>

<?php
header('content-type:text/html;charset=utf-8');
session_start();

require_once '../_func&ext/functions.php';

$rereg='<a href="MAC_Inquire.php">后退</a>';
//echo "<pre>";print_r($_POST);echo "</pre><br />";
//echo "<pre>";print_r($_SESSION);echo "</pre><br />";
$verify_a = strtolower($_SESSION['verify_a']);
$verify_r = strtolower($_POST['verify_r']);

$result= 1;
$macinputErr= "";

$showinput = $_POST["macinput"];
//$macinput = strtr($showinput, "：", ":");			//将全角“：”转换为半角“:”，未达到预期
//$macinput = str_replace('：', ':', $showinput);	//将全角“：”转换为半角“:”
$macinput = convertStrType($showinput, 'TOSBC');	//将全角“：”转换为半角“:”
    
if ($verify_r!=$verify_a){
    $macinputErr = "验证码输入错误";
}else if (empty($_POST["macinput"])) {	//验证是否为空
    $macinputErr = "错误：MAC地址不能为空";
}else{
    if (preg_match('/[^a-f0-9\-\:\s]/i', $macinput)){	//验证输入字符串是否包含不应该在MAC地址中出现的字符
        $macinputErr = "错误：输入的MAC地址只能包含：“0至9”、“A至F”、“空格”、“-”、“:”（注意冒号为半角）";
    }else{
        $macinput = text_input($macinput);	//调用函数，处理字符串
        $macinput = preg_replace('/[\:]/', '', $macinput);
        $macinput = preg_replace('/[\-]/', '', $macinput);

        if ((strlen($macinput) < 6) or (strlen($macinput) > 12)){
            $macinputErr = "错误：输入的MAC地址，长度不符合要求（应至少包含前3个字节，不能长于一个MAC地址）";
        }
        else {
            $mac_head = substr ( $macinput , 0 , 6 );
            $mac_head = substr_replace(substr_replace($mac_head,'-', 2,0),'-', 5,0);

            $handler=fopen("oui.txt","r");

            do{
                    $line = fgets($handler);
                //  echo $line;
                    if (substr_count($line,$mac_head)>0) {				// 进行比较
                     $result = $line;
                    }
            //当目标文件正在被notepad打开时，会造成死循环
            }while((!feof($handler) and $result==1)); //$result的值改变，或，达到文件末尾，则跳出循环
            //}while(!feof($handler));  //不管有没有匹配到，都循环到最后一行
            fclose($handler); //关闭文件

            if($result==1){//判断$result的值是否改变
                $display = '<font style="background-color:Gainsboro;color:OrangeRed;font-size: 24px;"><b>未匹配到相关记录</b></font>';
            }else {
                //处理结果字符串
                $result = mb_substr($result,18);
                $display = '<font style="background-color:SpringGreen;color:Navy;font-size: 24px;">'.$result.'</font>';
            }

        }
    }
    
}
echo <<<EOF1
<span class="error">{$macinputErr}</span>{$rereg}<br />
<font>你输入的MAC地址是：</font><font style="background-color:Lavender">{$showinput}</font><br />
<font>经查询，该MAC地址被分配给如下厂商：</font><br />
{$display}<br /><br />
<a href="http://standards-oui.ieee.org/oui/oui.txt"><span style="background-color:Khaki">参考：IEEE公布的MAC地址归属厂商列表</span></a><br />
EOF1;







//echo "调试信息：";
//echo $macinput;
//echo "<pre>";print_r($_POST);echo "</pre><br />";
//echo "<pre>";print_r($_SESSION);echo "</pre><br />";














?>






</body>
</html>
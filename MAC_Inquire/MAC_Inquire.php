<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
	<title>Document</title>
	<style>
		.error {color: #FF0000;}
		<!--设置出错时的样式。-->
	</style>
</head>
<body>

<?php

header('content-type:text/html;charset=utf-8');

require_once '../_func&ext/functions.php';

$PHP_self=htmlspecialchars($_SERVER["PHP_SELF"]);
$macinputErr= "";
echo <<<EOF1
<h2>MAC地址归属厂商查询</h2>
<h4>资料更新时间：2020-01-29</h4>
<font>请在下面的框中输入要查询的MAC地址，支持的输入格式有：<br />
1、使用“-”进行分隔的格式：00-1A-11-A1-B2-C3<br />
2、使用“:”进行分隔的格式：00:1A:11:A1:B2:C3<br />
3、使用“空格”进行分隔的格式：00&nbsp;1A&nbsp;11&nbsp;A1&nbsp;B2&nbsp;C3<br />
4、不使用任何符号进行分隔的格式：001A11A1B2C3<br />
也可以只输入前三个字节（输入长度大于等于3个字节，至完整长度的MAC地址，均能自动识别）：<br />
5、00-1A-11<br />
6、00:1A:11<br />
7、00&nbsp;1A&nbsp;11<br />
8、001A11<br />
</font><br />

<form method="post" action="{$PHP_self}">
	<b>MAC地址输入：</b><input type="text" name="macinput">
	<span class="error">*</span><span>必填项</span>
	<br /><br />
	<input type="submit" name="submit" value="提交">
</form>
EOF1;

$macinput= "";	//定义变量并设置为空值
$result= 1;
$display= "";

//$line='';



if ($_SERVER["REQUEST_METHOD"] == "POST"){	//若不进行本判断，则第一次打开页面也会报“MAC地址不能为空”的错误

	$showinput = $_POST["macinput"];
	//$macinput = strtr($showinput, "：", ":");			//将全角“：”转换为半角“:”，未达到预期
	//$macinput = str_replace('：', ':', $showinput);	//将全角“：”转换为半角“:”
	$macinput = convertStrType($showinput, 'TOSBC');	//将全角“：”转换为半角“:”

	if (empty($_POST["macinput"])) {	//验证是否为空
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
				}while((!feof($handler) and $result==1)); //$result结果改变，或，达到文件末尾，则跳出循环
				//}while(!feof($handler));  //不管有没有匹配到，都循环到最后一行
				fclose($handler); //关闭文件

				if($result==1){//判断$result是否为空
					$display = '<font style="background-color:Gainsboro;color:OrangeRed;font-size: 24px;"><b>未匹配到相关记录</b></font>';
				}else {
					$display = '<font style="background-color:SpringGreen;color:Navy;font-size: 24px;">'.$result.'</font>';
				}

			}
		}
	}



//echo $macinput;	//debug
echo <<<EOF2
<span class="error">{$macinputErr}</span><br />
<font>你输入的MAC地址是：</font><font style="background-color:Lavender">{$showinput}</font><br />
<font>经查询，该MAC地址被分配给如下厂商：</font><br />
{$display}<br />
EOF2;

}

?>
<br />
<a href="http://standards-oui.ieee.org/oui/oui.txt"><span style="background-color:Khaki">参考：IEEE公布的MAC地址归属厂商列表</span></a><br />



</body>
</html>

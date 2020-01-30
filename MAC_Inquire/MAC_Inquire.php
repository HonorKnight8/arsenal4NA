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
    <h1 style="text-align: center">arsenal4NA</h1>
	<h3 style="text-align: center">&emsp;&emsp;“网管军火库/工具箱”（arsenal for Network Administrator），一些网络工作中经常会用到的工具。</h3>
    <br />
	<hr style="height:1px;border:none;align: center;border-top:5px dashed LawnGreen;" width="60%"/>
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

<form method="post" action="doAction.php">
	<table>
		<tr>
			<td><b>MAC地址输入：</b></td>
			<td><input type="text" name="macinput" id="" placeholder="请输入有效的MAC地址……"></td>
			<td><span class="error">*</span><span>必填项</span></td>
		<tr>
		<tr>
			<td><b>请输入验证码：</b></td>
			<td><input type="text" name="verify_r" id="" placeholder="请输入右侧的验证码……"></td>
			<td><img src="getverify.php" alt="" id='verifyimage'/><a onclick="document.getElementById('verifyimage').src='getverify.php?r='+Math.random()" href="javascript:void(0)">看不清，换一个</a></td>
		<tr>
	</table>
	<input type="submit" name="submit" value="提交">
</form>


</body>
</html>
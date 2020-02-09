<?php

require_once 'verify.func.php';

$fontfile='../fonts/Roboto-Black.ttf';

getVerify($fontfile,$length=6,$type=1,$pixel=100,$whiteline=7,$line=2,$arc=1,$width=200,$height=50,$codeName='verifycode');


/*
require_once 'functions.php';

$MACs=array(
    '00-1A-11-A1-B2-C3 '
    ,'00:1A:11:A1:B2:C3'
    ,'00 1A 11 A1 B2 C3'
    ,'001A11A1B2C3'
    ,'00-1A-11'
    ,'00:1A:11'
    ,'00 1A 11'
    ,'001A11'
    ,'  001A11  '
);

foreach($MACs as $key=>$value){
    echo '第'.$key.'值是：|'.$value.'|,处理后是：|'.text_input($value).'|<br />';
}


echo '<br /><br />';
$str = '1２AＢcｄ,。.:：';
echo convertStrType($str, 'TOSBC');
echo '<br />';
echo convertStrType($str, 'TODBC');
echo '<br />';
*/







/*
$line='';
$result=1;
$mac_head='001A11';
$handler=fopen("../MAC_Inquire/oui_test.txt","r");

do{
    $line = fgets($handler);
  //  echo $line;
    if (substr_count($line,$mac_head)>0) {				// 进行比较
     $result = $line;
    }
//当目标文件正在被notepad打开时，会造成死循环
}while((!feof($handler) and $result==1)); //$result结果改变，或，达到文件末尾，则跳出循环
//}while(!feof($handler));  //不管有没有匹配到，都循环到最后一行
echo $line.'<br/>';
echo $result.'<br/>';
fclose($handler); //关闭文件
*/



?>

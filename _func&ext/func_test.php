<?php

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













?>
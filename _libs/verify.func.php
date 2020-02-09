<?php

/** 验证码函数
 * $fontfile   str  字体文件，必选参数
 * $type       int  验证码类型：1、数字；2、汉字（千字文）
 * $length     int  验证码长度（字符数）
 * $pixel      int  干扰元素：像素点
 * $whiteline  int  干扰元素：白色线段
 * $line       int  干扰元素：线段
 * $arc        int  干扰元素：弧线
 * $width      int  画布宽度
 * $height     int  画布高度
 * $codeName   str  存入session的名字
 * return      void 无返回值
 */

 //array_rand()函数的局限之一：使用类型1时，长度不能大于10；类型2，长度不能大于52；依此类推
 //array_rand()函数的局限之二：无重复
 //array_rand()函数的局限之二：伪随机

function getVerify($fontfile,$length=6,$type=1,$pixel=100,$whiteline=7,$line=2,$arc=1,$width=200,$height=50,$codeName='verifycode'){
//其他页面调用该函数时，存在字体相对路径不同的问题，故将字体文件路径改为必选参数
    

    //创建画布
    //$width=200;
    //$height=50;
    $image=imagecreatetruecolor($width,$height);

    //创建颜色
    $white=imagecolorallocate($image,255,255,255);
    ///填充背景
    imagefilledrectangle($image, 0, 0, $width, $height, $white);
    ///创建随机颜色（函数）
    function getRandColor($image){
        return $randColor=imagecolorallocate($image,mt_rand(0,222),mt_rand(0,222),mt_rand(0,222));
    }


    //$type=1;
    //$length=6;

//array_rand算法，是按顺序取值
    switch($type){
        case 1: //数字+字母
            $string = str_shuffle('ABCDEFGHJKLMNPQRTUVWXYacdefghijkmnpqrtuvwxy3489');
            //echo $string;
        break;
        case 2: //汉字（千字文）
            $str="天,地,玄,黄,宇,宙,洪,荒,日,月,盈,昃,辰,宿,列,张,寒,来,暑,往,秋,收,冬,藏,闰,余,成,岁,律,吕,调,阳,云,腾,致,雨,露,结,为,霜,金,生,丽,水,玉,出,昆,冈,剑,号,巨,阙,珠,称,夜,光,果,珍,李,柰,菜,重,芥,姜,海,咸,河,淡,鳞,潜,羽,翔,龙,师,火,帝,鸟,官,人,皇,始,制,文,字,乃,服,衣,裳,推,位,让,国,有,虞,陶,唐,吊,民,伐,罪,周,发,殷,汤,坐,朝,问,道,垂,拱,平,章,爱,育,黎,首,臣,伏,戎,羌,遐,迩,一,体,率,宾,归,王,鸣,凤,在,竹,白,驹,食,场,化,被,草,木,赖,及,万,方,盖,此,身,发,四,大,五,常,恭,惟,鞠,养,岂,敢,毁,伤,女,慕,贞,洁,男,效,才,良,知,过,必,改,得,能,莫,忘,罔,谈,彼,短,靡,恃,己,长,信,使,可,覆,器,欲,难,量,墨,悲,丝,染,诗,赞,羔,羊,景,行,维,贤,克,念,作,圣,德,建,名,立,形,端,表,正,空,谷,传,声,虚,堂,习,听,祸,因,恶,积,福,缘,善,庆,尺,璧,非,宝,寸,阴,是,竞,资,父,事,君,曰,严,与,敬,孝,当,竭,力,忠,则,尽,命,临,深,履,薄,夙,兴,温,凊,似,兰,斯,馨,如,松,之,盛,川,流,不,息,渊,澄,取,映,容,止,若,思,言,辞,安,定,笃,初,诚,美,慎,终,宜,令,荣,业,所,基,籍,甚,无,竟,学,优,登,仕,摄,职,从,政,存,以,甘,棠,去,而,益,咏,乐,殊,贵,贱,礼,别,尊,卑,上,和,下,睦,夫,唱,妇,随,外,受,傅,训,入,奉,母,仪,诸,姑,伯,叔,犹,子,比,儿,孔,怀,兄,弟,同,气,连,枝,交,友,投,分,切,磨,箴,规,仁,慈,隐,恻,造,次,弗,离,节,义,廉,退,颠,沛,匪,亏,性,静,情,逸,心,动,神,疲,守,真,志,满,逐,物,意,移,坚,持,雅,操,好,爵,自,縻,都,邑,华,夏,东,西,二,京,背,邙,面,洛,浮,渭,据,泾,宫,殿,盘,郁,楼,观,飞,惊,图,写,禽,兽,画,彩,仙,灵,丙,舍,旁,启,甲,帐,对,楹,肆,筵,设,席,鼓,瑟,吹,笙,升,阶,纳,陛,弁,转,疑,星,右,通,广,内,左,达,承,明,既,集,坟,典,亦,聚,群,英,杜,稿,钟,隶,漆,书,壁,经,府,罗,将,相,路,侠,槐,卿,户,封,八,县,家,给,千,兵,高,冠,陪,辇,驱,毂,振,缨,世,禄,侈,富,车,驾,肥,轻,策,功,茂,实,勒,碑,刻,铭,盘,溪,伊,尹,佐,时,阿,衡,奄,宅,曲,阜,微,旦,孰,营,桓,公,匡,合,济,弱,扶,倾,绮,回,汉,惠,说,感,武,丁,俊,义,密,勿,多,士,实,宁,晋,楚,更,霸,赵,魏,困,横,假,途,灭,虢,践,土,会,盟,何,遵,约,法,韩,弊,烦,刑,起,翦,颇,牧,用,军,最,精,宣,威,沙,漠,驰,誉,丹,青,九,州,禹,迹,百,郡,秦,并,岳,宗,泰,岱,禅,主,云,亭,雁,门,紫,塞,鸡,田,赤,诚,昆,池,碣,石,钜,野,洞,庭,旷,远,绵,邈,岩,岫,杳,冥,治,本,于,农,务,兹,稼,穑,俶,载,南,亩,我,艺,黍,稷,税,熟,贡,新,劝,赏,黜,陟,孟,轲,敦,素,史,鱼,秉,直,庶,几,中,庸,劳,谦,谨,敕,聆,音,察,理,鉴,貌,辨,色,贻,厥,嘉,猷,勉,其,祗,植,省,躬,讥,诫,宠,增,抗,极,殆,辱,近,耻,林,皋,幸,即,两,疏,见,机,解,组,谁,逼,索,居,闲,处,沉,默,寂,寥,求,古,寻,论,散,虑,逍,遥,欣,奏,累,遣,戚,谢,欢,招,渠,荷,的,历,园,莽,抽,条,枇,杷,晚,翠,梧,桐,蚤,凋,陈,根,委,翳,落,叶,飘,摇,游,鹍,独,运,凌,摩,绛,霄,耽,读,玩,市,寓,目,囊,箱,易,輶,攸,畏,属,耳,垣,墙,具,膳,餐,饭,适,口,充,肠,饱,饫,烹,宰,饥,厌,糟,糠,亲,戚,故,旧,老,少,异,粮,妾,御,绩,纺,侍,巾,帷,房,纨,扇,圆,洁,银,烛,炜,煌,昼,眠,夕,寐,蓝,笋,象,床,弦,歌,酒,宴,接,杯,举,殇,矫,手,顿,足,悦,豫,且,康,嫡,后,嗣,续,祭,祀,烝,尝,稽,颡,再,拜,悚,惧,恐,惶,笺,牒,简,要,顾,答,审,详,骸,垢,想,浴,执,热,愿,凉,驴,骡,犊,特,骇,跃,超,骧,诛,斩,贼,盗,捕,获,叛,亡,布,射,僚,丸,嵇,琴,阮,箫,恬,笔,伦,纸,钧,巧,任,钓,释,纷,利,俗,并,皆,佳,妙,毛,施,淑,姿,工,颦,妍,笑,年,矢,每,催,曦,晖,朗,曜,璇,玑,悬,斡,晦,魄,环,照,指,薪,修,祜,永,绥,吉,劭,矩,步,引,领,俯,仰,廊,庙,束,带,矜,庄,徘,徊,瞻,眺,孤,陋,寡,闻,愚,蒙,等,诮,谓,语,助,者,焉,哉,乎,也";
            $arr=explode(',',$str);
            //echo "<pre>";print_r($arr);echo "</pre>";
            shuffle($arr);//不能直接打乱utf-8的字符串，会乱码；先打乱数组
            //$string=str_shuffle(join('',array_rand(array_flip($arr),$length)));
            $string=join('',array_rand(array_flip($arr),$length));
            //echo $string;
        break;
        default:
        exit('非法参数');//非法参数
        break;
    }

    //开始绘画
    for($i=0;$i<$length;$i++){
        $size=ceil((($width-0)/$length)*0.7+mt_rand(-5,10));
        $angle=mt_rand(-45,45);
        $x=15+ceil(($width-20)/$length)*$i;
        //$y=mt_rand(ceil($height/3),$height-20);
        $y=$height-15+mt_rand(-5,2);
        $color=getRandColor($image);
        //$fontfile='D:\Apache24\htdocs\Demo\Topic4_1\fonts\SourceHanSerifCN-Medium.otf';
        $text=mb_substr($string,$i,1,'utf-8');
//        global $v_code;
//        $v_code[$i] = $text;
        $verify_a .=$text;
        imagettftext($image,$size,$angle,$x,$y,$color,$fontfile,$text);
    }
    session_start();
    $_SESSION['verify_a']=$verify_a;

    //$pixel=1;
    //$line=1;
    //$arc=1;

    //设置画笔粗细，对像素点无效
    imagesetthickness($image, 3);

    //添加干扰元素
    ///绘制像素，这个的干扰效果不大，除非能画大的“点”（要用椭圆、矩形、多边形）
    if($pixel>0){
        for($i=1;$i<=$pixel;$i++){
            imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
        }
    }

    ///绘制白色（与背景色相同）线段，对字符形成打断的效果
    if($whiteline>0){
        for($i=1;$i<=$whiteline;$i++){
                imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$white);
        }
    }


    ///绘制线段
    if($line>0){
        for($i=1;$i<=$line;$i++){
                imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
        }
    }

    ///绘制圆弧
    if($arc>0){
        for($i=1;$i<=$arc;$i++){
            imagearc($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width/2),mt_rand(0,$height),mt_rand(0,360),mt_rand(0,360),getRandColor($image));
        }
    }

    //要在header前面加这句，不然显示错误
    ob_clean();

    //告诉浏览器以图片的形式来显示
    header('content-type:image/png');

    //输出
    imagepng($image);

    //销毁资源
    imagedestory($image);

    return $verify_a;
}

//getVerify(2,8,500,7,10,200,50);

?>
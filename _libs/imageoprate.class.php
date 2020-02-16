<?php
class ImageOprate
{
    /**
     * 图片转base64
     * @param ImageFile String 图片路径
     * @return 转为base64的图片
     */
    static function Base64EncodeImage($ImageFile)
    {
        if (file_exists($ImageFile) || is_file($ImageFile)) {
            $base64_image = '';
            $image_info = getimagesize($ImageFile);
            $image_data = fread(fopen($ImageFile, 'r'), filesize($ImageFile));
            $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
            return $base64_image;
        } else {
            return false;
        }
    }



    /**
     * 返回图片信息
     * $filename str   图片源文件
     * return    array
     */
    static function getImageInfo($filename)
    {
        if (@!$info = getimagesize($filename)) {    //@是错误抑制符
            exit('文件不是真实图片');
        }
        //echo "<pre>";print_r($info);echo "</pre>";exit;
        $fileInfo['width'] = $info[0];
        $fileInfo['height'] = $info[1];
        //$mime=image_type_to_mime_type($info[2]);
        $mime = $info['mime'];
        $fileInfo['mime'] = $info['mime'];
        //$fileInfo['ext']=str_replace('image/','',$mime);
        $fileInfo['ext'] = strtolower(image_type_to_extension($info[2]));
        $createFun = str_replace('/', 'createfrom', $mime);
        $outFun = str_replace('/', '', $mime);
        $fileInfo['createFun'] = $createFun;
        $fileInfo['outFun'] = $outFun;
        return $fileInfo;
    }


    /**
     * 形成缩略图函数
     * $filename
     * $dst_w
     * $dst_h
     * $scale
     * $dest
     * $pre
     * $delSource
     * return
     */
    static function thumb($filename, $dst_w = null, $dst_h = null,  $dest = 'thumb', $pre = 'thumb_', $scale = 0.5, $delSource = false)
    {
        //$filename='../image/pretty scenery.jpg';
        //echo "<pre>";print_r(getImageInfo($filename));echo "</pre>";

        //$scale=0.5;
        //$dst_w=200;
        //$dst_h=300;
        //$dest='../image/thumb';
        //$pre='thumb_';    //输出文件名前缀
        //$delSource=false;
        //$randNum=mt_rand(100000,999999);
        //$randNum=md5(time());
        $randNum = md5_file($filename) . '_' . crc32(time());

        $fileInfo = self::getImageInfo($filename);

        // echo "<pre>";
        // print_r($fileInfo);
        // echo "</pre>";

        $src_w = $fileInfo['width'];
        $src_h = $fileInfo['height'];

        if (is_numeric($dst_w) && is_numeric($dst_h)) {
            $ratio_orig = $src_w / $src_h;
            if ($dst_w / $dst_h > $ratio_orig) {
                $dst_w = $dst_h * $ratio_orig;
            } else {
                $dst_h = $dst_w / $ratio_orig;
            }
        } else {
            $dst_w = ceil($src_w * $scale);
            $dst_h = ceil($src_h * $scale);
        }

        $dst_image = imagecreatetruecolor($dst_w, $dst_h);
        $src_image = $fileInfo['createFun']($filename);

        // var_dump($dst_image);
        // var_dump($src_image);

        imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

        if ($dest && !file_exists($dest)) {
            mkdir($dest, 0777, true);
        }
        $dstName = "{$pre}{$randNum}" . $fileInfo['ext'];
        $destination = $dest ? $dest . '/' . $dstName : $dstName;

        // var_dump($dstName);
        // var_dump($destination);

        $fileInfo['outFun']($dst_image, $destination);
        imagedestroy($src_image);
        imagedestroy($dst_image);
        if ($delSource) {
            unlink($filename);
        }
        return $destination;
    }
}

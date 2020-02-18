<?php
class ProcessContacts extends Process
{

    /**
     * 获取员工信息
     * @param  string $executorID  操作者ID；
     * @param  string $staffID  操作目标ID；
     * @return string $processResultMessage 返回结果
     */
    static function modifyStaffInfo($executorID, $staffID)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        if ($_POST['inputcaptchaget_3'] == NULL || strtolower($_POST['inputcaptchaget_3']) !== strtolower($_SESSION['captchaCreated'])) {
            return  '！！验证码输入错误';
        } else {

            //应该写一个函数进行安全检查和合规性检查，日后写post表单注意统一字段名
            //先进行字符串安全性检查

            //然后进行合规性检查

            // //用户名必须为字母、数字与下划线
            // if (!preg_match('/^\w+$/i', $user['name'])) 
            // (preg_match('/[^a-z0-9]/i', $_POST['newpassword_1']) || !(preg_match('/[0-9]/', $_POST['newpassword_1']) && preg_match('/[a-z]/', $_POST['newpassword_1']) && preg_match('/[A-Z]/', $_POST['newpassword_1'])))

            // preg_match('/[^a-z0-9]/i', $_POST['newpassword_1'])
            // 判断各字段合规性

            if ($_POST['sex'] !== '男' && $_POST['sex'] !== '女') {
                // [sex] => 性别 只能是'男'或'女'
                return '“性别”项填写错误';
            } else if (!is_numeric($_POST['extensionNum']) || $_POST['extensionNum'] == NULL) {
                // [extensionNum] => 分机号，非空，纯数字，长度？？？
                return '分机号填写错误';
            } else if (!preg_match('/^[\w\.\-]+@[\w\-]+\.\w+$/i', $_POST['eMail'])) {
                // [eMail] => 电子邮箱规范，非空
                return '电子邮箱不符合规范';
            } else if (!($_POST['cellPhoneNum'] == NULL || preg_match('/^1\d{10}$/i', ($_POST['cellPhoneNum'])))) {
                //[cellPhoneNum] => 手机号，1开头的11位数字
                return '手机号不符合规范';
            } else if (!($_POST['showCellPhoneNum'] == 1 || $_POST['showCellPhoneNum'] == NULL)) {
                // [showCellPhoneNum] => 0  只能是空或1
                return '!!“显示手机号”设置项数据异常';
            } else if (!($_POST['birthMonth'] == NULL || Groceries::checkPostDate($_POST['birthMonth']))) {
                // [birthMonth] =>  日期，最后只显示年月
                return '出生年月项数据异常';
            } else if (!($_POST['showBirthMonth'] == 1 || $_POST['showBirthMonth'] == NULL)) {
                // [showBirthMonth] => 0  只能是空或1
                return '!!“显示出生年月”设置项数据异常';
            } else if (mb_strlen($_POST['homeland'], 'utf-8') > 20) {
                // [homeland] => 字符串，长度（做个选择？免输入？）？？？
                return '!!“来自”项字符过长';
            } else if (!($_POST['showHomeland'] == 1 || $_POST['showHomeland'] == NULL)) {
                // [showHomeland] => 0  只能是空或1
                return '!!“显示来自”设置项数据异常';
            } else if (mb_strlen($_POST['selfIntroduction'], 'utf-8') > 300) {
                // [selfIntroduction] =>        字符串，长度 ？？？(千字文能完整存进去)
                return '!!“自我介绍”最长300字';
            } else if (!((is_numeric($_POST['qq']) && $_POST['qq'] >= 10000) || $_POST['qq'] == NULL)) {
                // [qq] =>  数字，大于等于10000，长度也可以限制
                return '!!“QQ”项填写错误';
            } else if (!($_POST['showQQ'] == 1 || $_POST['showQQ'] == NULL)) {
                // [showQQ] => 0  只能是空或1
                return '!!“显示QQ”设置项数据异常';
            } else if (!(!preg_match('/[^\w\-]/i', $_POST['wechat']) || $_POST['wechat'] == NULL)) {
                // [wechat] =>  非中字符串，长度？？？
                return '!!“微信”项填写错误';
            } else if (!($_POST['showWechat'] == 1 || $_POST['showWechat'] == NULL)) {
                // [showWechat] => 0  只能是空或1
                return '!!“显示微信”设置项数据异常';
            } else if (!(!preg_match('/[^\w\-]/i', $_POST['dingtalk']) || $_POST['dingtalk'] == NULL)) {
                // [dingtalk] => 非中字符串，长度？？？
                return '!!“微信”项填写错误';
            } else if (!($_POST['showDingtalk'] == 1 || $_POST['showDingtalk'] == NULL)) {
                // [showDingtalk] => 0  只能是空或1
                return '!!“显示钉钉”设置项数据异常';
            } else {
                if ($executorID !== $staffID) { //说明是管理员操作，多改4项

                } else {  //员工自己操作，16项

                    // 上传数据库
                    require '_libs/connect_DB.php';
                    $stmt = $pdo->prepare("update staffs set sex=:sex, extensionNum=:extensionNum, eMail=:eMail, cellPhoneNum=:cellPhoneNum, showCellPhoneNum=:showCellPhoneNum, birthMonth=:birthMonth, showBirthMonth=:showBirthMonth, homeland=:homeland, showHomeland=:showHomeland, selfIntroduction=:selfIntroduction, qq=:qq, showQQ=:showQQ, wechat=:wechat, showWechat=:showWechat, dingtalk=:dingtalk, showDingtalk=:showDingtalk where staffID=:staffID");
                    $stmt->execute(array(
                        ":sex" => $_POST['sex'],
                        ":extensionNum" => $_POST['extensionNum'],
                        ":eMail" => $_POST['eMail'],
                        ":cellPhoneNum" => $_POST['cellPhoneNum'],
                        ":showCellPhoneNum" => $_POST['showCellPhoneNum'],
                        ":birthMonth" => $_POST['birthMonth'],
                        ":showBirthMonth" => $_POST['showBirthMonth'],
                        ":homeland" => $_POST['homeland'],
                        ":showHomeland" => $_POST['showHomeland'],
                        ":selfIntroduction" => $_POST['selfIntroduction'],
                        ":qq" => $_POST['qq'],
                        ":showQQ" => $_POST['showQQ'],
                        ":wechat" => $_POST['wechat'],
                        ":showWechat" => $_POST['showWechat'],
                        ":dingtalk" => $_POST['dingtalk'],
                        ":showDingtalk" => $_POST['showDingtalk'],
                        ":staffID" => $staffID
                    ));



                    // return '！！人员信息修改2';
                }
            }
        }
    }

    static function changeHeadPhoto($staffID)
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";
        // 获取文件信息
        $fileInfo = $_FILES["file"];
        // echo "<pre>";
        // print_r($fileInfo);
        // echo "</pre>";
        // echo $fileInfo['tmp_name'];

        //判断验证码是否正确
        if ($_POST['inputcaptchaget_1'] == NULL || strtolower($_POST['inputcaptchaget_1']) !== strtolower($_SESSION['captchaCreated'])) {
            Parent::$processResultMessage = '！！验证码输入错误';
        } else {
            //判断是否修改头像
            if ($_FILES['file']['size'] !== 0) {
                //判断是否合乎要求
                if ($fileInfo["type"] !== "image/jpeg" && $fileInfo["type"] !== "image/gif" && $fileInfo["type"] !== "image/png" && $fileInfo["type"] !== "image/bmp" && $fileInfo["type"] !== "image/webp") {
                    //文件类型错误
                    Parent::$processResultMessage = '!!文件类型错误，仅支持：jpg、gif、png、bmp、webp';
                } else if ($fileInfo["size"] > 1048576) {
                    //文件大小超出限制
                    Parent::$processResultMessage = '!!文件大小超出限制（1MB）';
                } else {

                    //转存
                    $filename = "./Contacts/images/headphoto_upload_orignal/" . $staffID . '-' . time() . '.' . mb_substr($fileInfo['type'], 6);
                    if (!file_exists('./Contacts')) {
                        mkdir('./Contacts', 0777, true);
                    }
                    if (!file_exists('./Contacts/images')) {
                        mkdir('./Contacts/images', 0777, true);
                    }
                    if (!file_exists('./Contacts/images/headphoto_upload_orignal')) {
                        mkdir('./Contacts/images/headphoto_upload_orignal', 0777, true);
                    }
                    move_uploaded_file($fileInfo["tmp_name"], $filename);

                    //调整尺寸，暂存
                    $imageInfo = ImageOprate::getImageInfo($filename);
                    // echo "<pre>";
                    // print_r($imageInfo);
                    // echo "</pre>";

                    if (!file_exists('./Contacts/tmp')) {
                        mkdir('./Contacts/tmp', 0777, true);
                    }

                    $headPhoto = ImageOprate::thumb($filename, $dst_w = 220, $dst_h = 320, $dest = './Contacts/tmp', $pre = 'headPhoto_');

                    $b64 = ImageOprate::Base64EncodeImage($headPhoto);

                    // 上传数据库
                    require '_libs/connect_DB.php';
                    $stmt = $pdo->prepare("update staffs set headPhoto=:headPhoto,showHeadPhoto=:showHeadPhoto where staffID=:staffID");
                    $stmt->execute(array(":headPhoto" => $b64, ":showHeadPhoto" => $_POST['showHeadPhoto'], ":staffID" => $staffID));

                    //删除暂存文件
                    unlink($headPhoto);
                    // echo 1;
                }
            } else {
                //头像是否显示[showHeadPhoto] => hide
                require '_libs/connect_DB.php';
                $stmt = $pdo->prepare("update staffs set showHeadPhoto=:showHeadPhoto where staffID=:staffID");
                $stmt->execute(array(":showHeadPhoto" => $_POST['showHeadPhoto'], ":staffID" => $staffID));
                // echo 2;
            }
        }
    }
}

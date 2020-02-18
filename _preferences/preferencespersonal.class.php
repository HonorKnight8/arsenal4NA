<?php
class PreferencesPersonal extends Preferences
{
    protected function thisPage()    //本页面特有信息
    {
        $staffInfoArray = Contacts::getStaffInfo($_SESSION['staffID'], 1);

        $titlle = '<br /><span><b>这是偏好设置：个人信息修改页</b></span><br />';

        $form1 = '<div>';
        $form1 .= '<img src="' . $staffInfoArray['headPhoto'] . '" style="float:right;" />';
        $form1 .= '<form action="" method="post" enctype="multipart/form-data">';
        $form1 .= '<fieldset><legend>头像照片设置</legend>';
        $form1 .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="file" name="file" id="file" placeholder="选择要上传的照片" accept="image/jpeg, image/gif, image/png, image/webp, image/bmp" /><br />';
        $form1 .= '&emsp;&emsp;&emsp;注意：支持的文件格式有：jpg、gif、png、webp、bmp<br />';
        $form1 .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;建议照片的横竖比例等于或接近于：1:1.45(证件照比例)<br />';
        $form1 .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;照片大小不得大于1MB<br />';
        $form1 .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="showHeadPhoto" value="1"';
        $form1 .= $staffInfoArray['showHeadPhoto'] == 1 ? 'checked' : '';
        $form1 .= '>显示照片';
        $form1 .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="showHeadPhoto" value="0"';
        $form1 .= $staffInfoArray['showHeadPhoto'] == 0 ? 'checked' : '';
        $form1 .= '>隐藏照片<br />';
        $form1 .= '&emsp;&emsp;&emsp;注意：显示/隐藏照片选项，对全员生效<br />';
        $form1 .= '输入验证码：<input type="text" name="inputcaptchaget_1" id="" placeholder="请输入右侧的验证码……" required autocomplete="off">';
        $form1 .= '<img src="" alt="" id="verifyimage_1" /><a onclick="document.getElementById(\'verifyimage_1\').src=\'_libs/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $form1 .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" name="PreferencesPersonal_1" value="上传" />';
        $form1 .= '</fieldset></form></div>';

        //修改密码
        $form2 = '<div><form action="" method="post">';
        $form2 .= '<fieldset><legend>修改密码</legend>';
        $form2 .= '&emsp;当前密码：<input type="password" name="currentPassword" id="" style="width:250px" placeholder="请输入当前密码以验证身份..." required><br />';
        $form2 .= '&emsp;&emsp;新密码：<input type="password" name="newpassword_1" id="" style="width:250px" placeholder="请输入新密码..." required><br />';
        $form2 .= '确认新密码：<input type="password" name="newpassword_2" id="" style="width:250px" placeholder="请再一次输入新密码..." required><br />';
        $form2 .= '&emsp;&emsp;&emsp;注意：密码长度最小8位，最大24位位<br />';
        $form2 .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;密码只能包含数字、大小写字母<br />';
        $form2 .= '输入验证码：<input type="text" name="inputcaptchaget_2" id="" placeholder="请输入右侧的验证码……" required autocomplete="off">';
        $form2 .= '<img src="" alt="" id="verifyimage_2" /><a onclick="document.getElementById(\'verifyimage_2\').src=\'_libs/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $form2 .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" name="PreferencesPersonal_2" value="修改密码" />';
        $form2 .= '</fieldset></form></div>';

        //修改其他信息的部分
        $form3 = self::modifyStaffInfoDiv($staffInfoArray, $_SESSION['staffID'], $_SESSION['staffID']);


        return $titlle . $form1 . $form2 . $form3;
    }

    //form3写个函数，分成：管理员操作，普通员工自己操作(后续还可以用于新建)
    static function modifyStaffInfoDiv($staffInfoArray, $executorID, $staffID)
    {
        // $executor==$staffID，用这个条件作判断，相等就是自己操作，否则就是管理员操作

        $modifyStaffInfoDiv = '<div><form action="" method="post">';
        $modifyStaffInfoDiv .= '<fieldset><legend>其他信息修改</legend>';

        // 人员档案ID应该用身份证号？
        $modifyStaffInfoDiv .= '人员档案ID：<input type="text" name="personID" id="" style="width:250px" value="' . $staffInfoArray['personID'] . '" disabled /><br />';
        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;工号：<input type="text" name="staffID" id="" style="width:250px" value="' . $staffInfoArray['staffID'] . '" disabled /><br />';
        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;姓名：<input type="text" name="staffName" id="" style="width:250px" value="' . $staffInfoArray['staffName'] . '"';
        $modifyStaffInfoDiv .=  $executorID == $staffID ? 'disabled' : '';
        $modifyStaffInfoDiv .= '/><br />';
        $modifyStaffInfoDiv .= '&emsp;加入时间：<input type="date" name="entryTime" id="" style="width:250px" value="' . $staffInfoArray['entryTime'] . '" ';
        $modifyStaffInfoDiv .=  $executorID == $staffID ? 'disabled' : '';
        $modifyStaffInfoDiv .=  ' /><br />';
        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="onceIn" value="' . $staffInfoArray['onceIn'] . '" ';
        $modifyStaffInfoDiv .= $staffInfoArray['onceIn'] == 1 ? 'checked ' : '';
        $modifyStaffInfoDiv .=  $executorID == $staffID ? 'disabled' : '';
        $modifyStaffInfoDiv .=  ' />曾经入职';
        $modifyStaffInfoDiv .= '&emsp;&emsp;|&emsp;&emsp;<input type="checkbox" name="isIn" value="' . $staffInfoArray['isIn'] . '"';
        $modifyStaffInfoDiv .= $staffInfoArray['isIn'] == 1 ? 'checked ' : '';
        $modifyStaffInfoDiv .=  $executorID == $staffID ? 'disabled' : '';
        $modifyStaffInfoDiv .=  ' />当前在职<br /><hr>';

        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;性别：<input type="text" name="sex" id="" style="width:250px" value="' . $staffInfoArray['sex'] . '" /><br />';
        $modifyStaffInfoDiv .= '&emsp;&emsp;分机号：<input type="text" name="extensionNum" id="" style="width:250px" value="' . $staffInfoArray['extensionNum'] . '" /><br />';
        $modifyStaffInfoDiv .= '&emsp;电子邮箱：<input type="text" name="eMail" id="" style="width:250px" value="' . $staffInfoArray['eMail'] . '" /><br />';

        $modifyStaffInfoDiv .= '&emsp;&emsp;手机号：<input type="text" name="cellPhoneNum" id="" style="width:250px" value="' . $staffInfoArray['cellPhoneNum'] . '" />';
        $modifyStaffInfoDiv .= '<input type="checkbox" name="showCellPhoneNum" value="1" ';
        $modifyStaffInfoDiv .= $staffInfoArray['showCellPhoneNum'] == 1 ? 'checked ' : '';
        $modifyStaffInfoDiv .= ' />显示手机号<br />';

        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;注意：手机号默认对同部门公开，显示/隐藏选项只对部门之外的其他同事生效<br />';
        $modifyStaffInfoDiv .= '&emsp;出生年月：<input type="date" name="birthMonth" id="" style="width:250px" value="' . $staffInfoArray['birthMonth'] . '" />';
        $modifyStaffInfoDiv .= '<input type="checkbox" name="showBirthMonth" value="1" ';
        $modifyStaffInfoDiv .= $staffInfoArray['showBirthMonth'] == 1 ? 'checked ' : '';
        $modifyStaffInfoDiv .= ' />显示出生年月<br />';

        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;来自：<input type="text" name="homeland" id="" style="width:250px" value="' . $staffInfoArray['homeland'] . '" />';
        $modifyStaffInfoDiv .= '<input type="checkbox" name="showHomeland" value="1" ';
        $modifyStaffInfoDiv .= $staffInfoArray['showHomeland'] == 1 ? 'checked ' : '';
        $modifyStaffInfoDiv .= ' />显示来自<br />';

        $modifyStaffInfoDiv .= '自我介绍：<br />&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<textarea name="selfIntroduction" rows="10" cols="33">' . $staffInfoArray['selfIntroduction'] . '</textarea><br />';

        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;&ensp;QQ：<input type="text" name="qq" id="" style="width:250px" value="' . $staffInfoArray['qq'] . '" />';
        $modifyStaffInfoDiv .= '<input type="checkbox" name="showQQ" value="1" ';
        $modifyStaffInfoDiv .= $staffInfoArray['showQQ'] == 1 ? 'checked ' : '';
        $modifyStaffInfoDiv .= ' />显示QQ<br />';

        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;微信：<input type="text" name="wechat" id="" style="width:250px" value="' . $staffInfoArray['wechat'] . '" />';
        $modifyStaffInfoDiv .= '<input type="checkbox" name="showWechat" value="1" ';
        $modifyStaffInfoDiv .= $staffInfoArray['showWechat'] == 1 ? 'checked ' : '';
        $modifyStaffInfoDiv .= ' />显示微信<br />';

        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;钉钉：<input type="text" name="dingtalk" id="" style="width:250px" value="' . $staffInfoArray['dingtalk'] . '" />';
        $modifyStaffInfoDiv .= '<input type="checkbox" name="showDingtalk" value="1" ';
        $modifyStaffInfoDiv .= $staffInfoArray['showDingtalk'] == 1 ? 'checked ' : '';
        $modifyStaffInfoDiv .= ' />显示钉钉<br />';

        $modifyStaffInfoDiv .= '输入验证码：<input type="text" name="inputcaptchaget_3" id="" placeholder="请输入右侧的验证码……" required autocomplete="off"/>';
        $modifyStaffInfoDiv .= '<img src="" alt="" id="verifyimage_3" /><a onclick="document.getElementById(\'verifyimage_3\').src=\'_libs/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $modifyStaffInfoDiv .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" name="PreferencesPersonal_3" value="上传" />';
        $modifyStaffInfoDiv .= '</fieldset></form></div>';
        return $modifyStaffInfoDiv;
    }

    function __toString()
    {
        if ($_SESSION['loginStatus'] == 1) {
            $this->div_preferences .= self::thispage();
        }
        $this->div_preferences .= '</div>';
        return $this->div_preferences;
    }
}

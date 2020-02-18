<?php
class PreferencesPersonal extends Preferences
{
    protected function thisPage()    //本页面特有信息
    {
        include '_libs/connect_DB.php'; //以调用页面的位置来看相对路径
        //获取除“头像”外的全部列明
        $stmt = $pdo->prepare("select column_name from information_schema.columns where table_schema ='a4NA' and table_name = :table_name");
        $stmt->execute(array(":table_name" => "staffs"));
        $stmt->setFetchMode(PDO::FETCH_NUM);

        $columns = '';
        while ($columnsArray = $stmt->fetch()) {
            $columns .= $columnsArray[0] . ',';
        }
        $columns = substr($columns, 0, -1);
        $columns = str_replace("headPhoto,", "", $columns);

        //读取除“头像”外的全部列的值
        $stmt = $pdo->prepare("select $columns from staffs where staffID = :staffID ");
        $stmt->execute(array(":staffID" => $_SESSION['staffID']));
        $staffInfoArray = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($staffInfoArray);
        // echo '</pre>';


        $this->div_preferences .= '<br /><span><b>这是偏好设置：个人信息修改页</b></span><br />';
        $this->div_preferences .= '<span><b>修改：其他信息（性别，分机号，电子邮箱，手机号，显示手机号，出生年月，显示出身年月，来自，显示故乡，自我介绍，显示自我介绍，QQ，显示QQ，微信号，显示微信，钉钉号，显示钉钉）</b></span><br />';


        //头像照片设置
        $this->div_preferences .= '<form action="" method="post" enctype="multipart/form-data">';
        $this->div_preferences .= '<fieldset><legend>头像照片设置</legend>';
        $this->div_preferences .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="file" name="file" id="file" placeholder="选择要上传的照片" accept="image/jpeg, image/gif, image/png, image/webp, image/bmp" /><br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;注意：支持的文件格式有：jpg、gif、png、webp、bmp<br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;建议照片的横竖比例等于或接近于：1:1.45(证件照比例)<br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;照片大小不得大于1MB<br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="showHeadPhoto" value="1"';
        if ($staffInfoArray['showHeadPhoto'] == 1) {
            $this->div_preferences .= 'checked';
        }
        $this->div_preferences .= '>显示照片';
        $this->div_preferences .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="showHeadPhoto" value="0"';
        if ($staffInfoArray['showHeadPhoto'] == 0) {
            $this->div_preferences .= 'checked';
        }
        $this->div_preferences .= '>隐藏照片<br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;注意：显示/隐藏照片选项，对全员生效<br />';
        $this->div_preferences .= '输入验证码：<input type="text" name="inputcaptchaget_1" id="" placeholder="请输入右侧的验证码……">';
        $this->div_preferences .= '<img src="" alt="" id="verifyimage_1" /><a onclick="document.getElementById(\'verifyimage_1\').src=\'_libs/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" name="PreferencesPersonal_1" value="上传" />';
        $this->div_preferences .= '</fieldset></form>';

        //修改密码
        $this->div_preferences .= '<form action="" method="post">';
        $this->div_preferences .= '<fieldset><legend>修改密码</legend>';
        $this->div_preferences .= '&emsp;当前密码：<input type="password" name="currentPassword" id="" style="width:250px" placeholder="请输入当前密码以验证身份..." required><br />';
        $this->div_preferences .= '&emsp;&emsp;新密码：<input type="password" name="newpassword_1" id="" style="width:250px" placeholder="请输入新密码..." required><br />';
        $this->div_preferences .= '确认新密码：<input type="password" name="newpassword_2" id="" style="width:250px" placeholder="请再一次输入新密码..." required><br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;注意：密码长度最小8位，最大24位位<br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;密码只能包含数字、大小写字母<br />';
        $this->div_preferences .= '输入验证码：<input type="text" name="inputcaptchaget_2" id="" placeholder="请输入右侧的验证码……">';
        $this->div_preferences .= '<img src="" alt="" id="verifyimage_2" /><a onclick="document.getElementById(\'verifyimage_2\').src=\'_libs/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" name="PreferencesPersonal_2" value="修改密码" />';
        $this->div_preferences .= '</fieldset></form>';


        //其他信息修改



    }

    function __toString()
    {
        if ($_SESSION['loginStatus'] == 1) {
            //已登录状态
            self::thisPage();
        }
        $this->div_preferences .= '</div>';
        return $this->div_preferences;
    }
}

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
        echo '<pre>';
        print_r($staffInfoArray);
        echo '</pre>';








        $this->div_preferences .= '<br /><span><b>这是偏好设置：个人信息修改页</b></span><br />';
        $this->div_preferences .= '<span><b>修改：密码</b></span><br />';
        $this->div_preferences .= '<span><b>修改：头像照片，显示头像照片</b></span><br />';
        $this->div_preferences .= '<span><b>修改：其他信息（性别，分机号，电子邮箱，手机号，显示手机号，出生年月，显示出身年月，来自，显示故乡，自我介绍，显示自我介绍，QQ，显示QQ，微信号，显示微信，钉钉号，显示钉钉）</b></span><br />';

        // $this->div_preferences .= '<center><form action="" method="post" enctype="multipart/form-data">';
        // $this->div_preferences .= '<table border=1><tr><th colspan="2">修改头像照片</th></tr><tr><td>';
        // $this->div_preferences .= '<input type="file" name="file" id="file" placeholder="选择要上传的照片" required accept="image/jpeg, image/gif, image/png, image/webp, image/bmp" />';
        // $this->div_preferences .= '</td><td><input type="submit" name="PreferencesPersonal_1" value="上传" /></td></tr><tr>';
        // $this->div_preferences .= '<td colspan="2">支持的文件格式有：jpg、gif、png、webp、bmp<br />';
        // $this->div_preferences .= '建议照片的横竖比例等于或接近于：1:1.45(证件照比例)<br />';
        // $this->div_preferences .= '照片大小不得大于100KB';
        // $this->div_preferences .= '</td></tr></table></form><center>';

        $this->div_preferences .= '<form action="" method="post" enctype="multipart/form-data">';
        $this->div_preferences .= '<fieldset><legend>头像照片设置</legend>';
        $this->div_preferences .= '<input type="file" name="file" id="file" placeholder="选择要上传的照片" accept="image/jpeg, image/gif, image/png, image/webp, image/bmp" /><br />';
        $this->div_preferences .= '注意：支持的文件格式有：jpg、gif、png、webp、bmp<br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;建议照片的横竖比例等于或接近于：1:1.45(证件照比例)<br />';
        $this->div_preferences .= '&emsp;&emsp;&emsp;照片大小不得大于1MB<br />';
        $this->div_preferences .= '<input type="radio" name="showHeadPhoto" value="1"';
        if ($staffInfoArray['showHeadPhoto'] == 1) {
            $this->div_preferences .= 'checked';
        }
        $this->div_preferences .= '>显示照片';
        $this->div_preferences .= '<input type="radio" name="showHeadPhoto" value="0"';
        if ($staffInfoArray['showHeadPhoto'] == 0) {
            $this->div_preferences .= 'checked';
        }
        $this->div_preferences .= '>隐藏照片<br />';
        $this->div_preferences .= '注意：显示/隐藏选项，对全员生效<br />';
        $this->div_preferences .= '<input type="submit" name="PreferencesPersonal_1" value="上传" />';
        $this->div_preferences .= '</fieldset></form>';




        // $this->div_preferences .= '</td></tr></table><form action="" method="post"><input type="submit" name="login" value="登入" /></form><form action="" method="post"><input type="submit" name="logout" value="登出" /></form>';
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

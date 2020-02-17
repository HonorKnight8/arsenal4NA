<?php
class Process
{
    protected $menu;
    protected $processResultMessage;
    protected $staffID;
    function __construct()
    {
        $this->staffID = $_SESSION["staffID"];
        //调试信息
        // echo count($_POST) . '<br />';
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        //获取post动作，调用相应的方法进行处理，并返回处理结果
        if (isset($_POST['login'])) {
            $this->login();
            // $this->processResultMessage = '！！！登录页面！！！';
        } else if (isset($_POST['logout'])) {
            $this->logout();
            // $this->processResultMessage = '！！！退出！！！';
        } else if (isset($_POST['PreferencesPersonal_1'])) {
            $this->changeHeadPhoto($this->staffID);
        } else if (isset($_POST['PreferencesPersonal_2'])) {
            // $this->changePassword($this->staffID);
            $this->processResultMessage = '！！！修改密码！！！';
        } else {
            //返回数据出错
            $this->processResultMessage = '！！！提交数据出错，请检查！！！';
        }
    }

    function __toString()
    {

        //将程序处理结果传给Topbar，将信息显示在topbar上面
        $result = new TopBar($this->processResultMessage);
        //顶栏

        $result .= new SideBar();
        //侧栏

        $result .= new Main();
        //主页面
        return $result;
    }



    public function changePassword($staffID)
    {
        //获取post
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        //验证旧密码合法性，验证正确性

        //验证新密码的两次输入一致性，合法性

        //验证码

        //执行修改
    }

    public function changeHeadPhoto($staffID)
    {
        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";
        // 获取文件信息
        $fileInfo = $_FILES["file"];
        // echo "<pre>";
        // print_r($fileInfo);
        // echo "</pre>";
        // echo $fileInfo['tmp_name'];

        //判断是否修改头像
        if ($_FILES['file']['size'] !== 0) {
            //判断是否合乎要求
            if ($fileInfo["type"] !== "image/jpeg" && $fileInfo["type"] !== "image/gif" && $fileInfo["type"] !== "image/png" && $fileInfo["type"] !== "image/bmp" && $fileInfo["type"] !== "image/webp") {
                //文件类型错误
                $this->processResultMessage = '!!文件类型错误，仅支持：jpg、gif、png、bmp、webp';
            } else if ($fileInfo["size"] > 1048576) {
                //文件大小超出限制
                $this->processResultMessage = '!!文件大小超出限制（1MB）';
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

                $headPhoto = ImageOprate::thumb($filename, $dst_w = 220, $dst_w = 320, $dest = './Contacts/tmp', $pre = 'headPhoto_');

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


    private function Login()
    {
        require '_libs/connect_DB.php';

        $stmt = $pdo->prepare("select staffID, password, permission from userpwd where staffID=:staffID and password=:password");
        $stmt->execute(array(":staffID" => $_POST["staffID"], ":password" => sha1($_POST["password"])));

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // print_r($row);
        // var_dump($row);
        // var_dump(print_r($row));
        @$arrayRows = count($row);
        // count() 函数计算数组中的单元数目或对象中的属性个数。 对于数组，返回其元素的个数，对于其他值，返回 1。如果参数是变量而变量没有定义，则返回 0。

        // echo $arrayRows;
        // var_dump($arrayRows);
        // if ($result->num_rows > 0) {
        if ($arrayRows == 3) {
            // $row = $result->fetch_assoc();

            $_SESSION["permission"] = $row["permission"];
            $_SESSION["staffID"] = $row["staffID"];
            $_SESSION["loginStatus"] = 1;
            // print_r($row);
            // echo '<br />' . $_COOKIE['PHPSESSID'] . '<br />';
            // print_r($_COOKIE);


            // header("Location:../index.php");
            header("Location:../index.php?action=" . $_SESSION['currentPage']); //跳转回登录前请求的页面

            // 若前面有输出，则不能用header函数，改用JS跳转
            // echo '<script>';
            // // echo "location='index.php?" . SID . "'";
            // // echo "location='index.php?PHPSESSID=" . session_id() . "'";
            // echo "location='../index.php?" . SID . "'";
            // //常量：SID
            // //如果开启cookie，该值为空；
            // //如果未开启cookie，SID相当于“PHPSESSID=&lt;?php echo session_id() ?&gt;”
            // echo '</script>';
        } else {
            $this->processResultMessage = '！！用户名密码有误！！';
            // echo "用户名密码有误！<br />";
        }
    }

    private function logout()
    {
        $username = $_SESSION["staffName"];
        $sid = session_id();

        //清空SESSION值
        $_SESSION = array();


        //删除客户端的在COOKIE中的Sessionid
        if (isset($_COOKIE[session_name()])) {
            setCookie(session_name(), '', time() - 3600, '/');
        }
        //彻底销毁session
        session_destroy();

        header("Location:index.php");
    }
}

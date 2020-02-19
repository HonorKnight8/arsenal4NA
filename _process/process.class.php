<?php
class Process
{
    protected $menu;
    static $processResultMessage;
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
            // Self::$processResultMessage = '！！！登录页面！！！';
        } else if (isset($_POST['PreferencesPersonal_1'])) {
            ProcessContacts::changeHeadPhoto($this->staffID);
        } else if (isset($_POST['PreferencesPersonal_2'])) {
            $this->changePassword($this->staffID);
            // Self::$processResultMessage = '！！！修改密码！！！';
        } else if (isset($_POST['PreferencesPersonal_3'])) {
            // $this->changePassword($this->staffID);
            Self::$processResultMessage = ProcessContacts::modifyStaffInfo($_SESSION["staffID"], $_SESSION["staffID"]);
            // Self::$processResultMessage = '！！人员信息修改';
        } else if (isset($_POST['macinquire'])) {
            // $this->changePassword($this->staffID);
            // Self::$processResultMessage = ProcessContacts::modifyStaffInfo($_SESSION["staffID"], $_SESSION["staffID"]);
            MACInquire::$div_inquireResult = MACInquire::doInquire($_POST['macinquire']);
        } else if (isset($_POST['logout'])) {
            $this->logout();
            // Self::$processResultMessage = '！！！退出！！！';
        } else {
            //返回数据出错
            Self::$processResultMessage = '！！！提交数据出错，请检查！！！';
        }
    }

    function __toString()
    {

        //将程序处理结果传给Topbar，将信息显示在topbar上面
        $result = new TopBar(Self::$processResultMessage);
        //顶栏

        $result .= new SideBar();
        //侧栏

        $result .= new Main();
        //主页面
        return $result;
    }



    public function changePassword($staffID)
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        //验证码
        if ($_POST['inputcaptchaget_2'] == NULL || strtolower($_POST['inputcaptchaget_2']) !== strtolower($_SESSION['captchaCreated'])) {
            Self::$processResultMessage = '！！验证码输入错误';
        } else {
            //验证旧密码合法性，验证正确性
            require '_libs/connect_DB.php';
            $stmt = $pdo->prepare("select password from userpwd where staffID=:staffID");
            $stmt->execute(array(":staffID" => $staffID));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (sha1($_POST['currentPassword']) !== $row["password"]) {
                Self::$processResultMessage = '！！当前密码输入错误';
            } else if ($_POST['newpassword_1'] == NULL || $_POST['newpassword_1'] !== $_POST['newpassword_1']) {
                //验证新密码的两次输入一致性
                Self::$processResultMessage = '！！两次输入的新密码不一致';
            } else if (preg_match('/[^a-z0-9]/i', $_POST['newpassword_1']) || !(preg_match('/[0-9]/', $_POST['newpassword_1']) && preg_match('/[a-z]/', $_POST['newpassword_1']) && preg_match('/[A-Z]/', $_POST['newpassword_1']))) {
                //验证新密码的合规性之包含字符
                Self::$processResultMessage = '！！密码只能包含数字、大小写字母三种字符，且三种字符至少各有一个';
            } else if (strlen($_POST['newpassword_1']) < 8 || strlen($_POST['newpassword_1']) > 24) {
                //验证新密码的合规性之长度
                Self::$processResultMessage = '！！允许密码长度：8-24';
            } else {
                //执行修改
                $stmt = $pdo->prepare("update userpwd set password=:password where staffID=:staffID");
                $stmt->execute(array(":password" => sha1($_POST['newpassword_1']), ":staffID" => $staffID));
                // Self::$processResultMessage = '！！修改密码';
            }
        }
    }

    private function Login()
    {
        if ($_POST['inputcaptchaget'] == NULL || strtolower($_POST['inputcaptchaget']) !== strtolower($_SESSION['captchaCreated'])) {
            Self::$processResultMessage = '！！验证码输入错误';
        } else {
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
                Self::$processResultMessage = '！！用户名密码有误！！';
                // echo "用户名密码有误！<br />";
            }
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

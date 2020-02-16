<?php
class Process
{
    protected $menu;
    protected $processResultMessage;
    function __construct()
    {
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
        } else if (isset($_POST['sub_CPM_1'])) {
            $this->processResultMessage = '！！！修改照片！！！';
        } else {
            //提交数据出错
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
            echo "用户名密码有误！<br />";
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

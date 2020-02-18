<?php
class Contacts
{
    protected $divContacts;

    function __construct($action = "")
    {
        //判断登录状态
        $this->divContacts = '<div class="div_contacts">';
        if ($_SESSION['loginStatus'] == 0) {
            $this->divContacts .= new Login();
        } else if ($_SESSION['loginStatus'] == 1) {
            //已登录状态
        }
    }

    protected function thisPage()    //本页面特有信息
    {
        $this->divContacts .= '<br /><span><b>这是内部通讯录功能默认页</b></span><br />';
        $staffInfoArray = self::getStaffInfo($_SESSION['staffID'], 1);
        $this->divContacts .= self::StaffInfoDiv($staffInfoArray);
    }

    function __toString()
    {
        if ($_SESSION['loginStatus'] == 1) {
            //已登录状态
            self::thisPage();
        }
        $this->divContacts .= '</div>';
        return $this->divContacts;
    }




    /**
     * 获取员工信息
     * @param  string $staffID  员工ID；
     * @param  bool $includeHeadPhoto  指定是否获取头像：默认0，不获取；
     * @return array 返回结果（数组）
     */
    static function getStaffInfo($staffID, $includeHeadPhoto = 0)
    {
        include '_libs/connect_DB.php'; //以调用页面的位置来看相对路径
        if ($includeHeadPhoto == 0) {
            //获取全部列名
            $stmt = $pdo->prepare("select column_name from information_schema.columns where table_schema ='a4NA' and table_name = :table_name");
            $stmt->execute(array(":table_name" => "staffs"));
            $stmt->setFetchMode(PDO::FETCH_NUM);

            //将列名结果（是一个数组），拼成以“,”分隔的字符串
            $columns = '';
            while ($columnsArray = $stmt->fetch()) {
                $columns .= $columnsArray[0] . ',';
            }
            $columns = substr($columns, 0, -1); //去掉最后的逗号
            $columns = str_replace("headPhoto,", "", $columns); //去掉“头像”列
        } else {
            $columns = '*';
        }

        //读取
        $stmt = $pdo->prepare("select $columns from staffs where staffID = :staffID ");
        $stmt->execute(array(":staffID" => $staffID));
        $staffInfoArray = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($staffInfoArray);
        // echo '</pre>';
        return $staffInfoArray;
    }

    /**
     * 传入员工信息（数组）
     * @param  array $staffInfoArray  员工ID；
     * @return string 返回结果（html代码字符串）
     */
    static function StaffInfoDiv($staffInfoArray)
    {
        $StaffInfoDiv = '<table class="staffinfo"><tr>';
        $StaffInfoDiv .= '<td>姓名： ' . $staffInfoArray['staffName'] . '</td>';
        $StaffInfoDiv .= '<td>性别：' . $staffInfoArray['sex'] . '</td>';
        $StaffInfoDiv .= '<td>工号：' . $staffInfoArray['staffID'] . '</td>';
        $StaffInfoDiv .= '<td rowspan="4" width="9px"><img src="' . $staffInfoArray['headPhoto'] . '" /></td>';
        $StaffInfoDiv .= '</tr><tr><td colspan="2">电子邮箱：' . $staffInfoArray['eMail'] . '</td>';
        $StaffInfoDiv .= '<td>分机号：' . $staffInfoArray['extensionNum'] . '</td>';
        $StaffInfoDiv .= '</tr><tr><td colspan="2"> 手机号：' . $staffInfoArray['cellPhoneNum'] . '</td>';
        $StaffInfoDiv .= '<td>加入时间：' . $staffInfoArray['entryTime'] . '</td>';
        $StaffInfoDiv .= '</tr><tr><td colspan="2">来自：' . $staffInfoArray['homeland'] . '</td>';
        $StaffInfoDiv .= '<td>出身年月：' . $staffInfoArray['birthMonth'] . '</td>';
        $StaffInfoDiv .= '</tr><tr><td colspan="4">';
        $StaffInfoDiv .= 'QQ号：' . $staffInfoArray['qq'];
        $StaffInfoDiv .= '微信号：' . $staffInfoArray['wechat'];
        $StaffInfoDiv .= '钉钉：' . $staffInfoArray['dingtalk'];
        $StaffInfoDiv .= '</td></tr><tr><td colspan="4">自我介绍：' . $staffInfoArray['selfIntroduction'] . '</td></tr>';
        $StaffInfoDiv .= '</table>';

        return  $StaffInfoDiv;
    }
}

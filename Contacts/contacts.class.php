<?php
class Contacts
{
    protected $divContacts;
    static $staffInfoPool;

    function __construct($action = "")
    {
        //判断登录状态
        $this->divContacts = '<div class="div_contacts" id="div_contacts">';
        if ($_SESSION['loginStatus'] == 0) {
            $this->divContacts .= new Login();
        }
        // else if ($_SESSION['loginStatus'] == 1) {
        //     //已登录状态
        // }
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

    protected function thisPage()    //本页面特有信息
    {
        $this->divContacts .= '<br /><span><b>这是内部通讯录功能默认页</b></span><br />';

        // 这里显示查询表单：根据姓名、ID、（部门）查询员工信息
        $this->divContacts  .= '<form action="" method="post" >';
        $this->divContacts  .= '<fieldset><legend>查询同事信息</legend>';
        $this->divContacts  .= '&emsp;&emsp;&emsp;工号：<input type="text" name="inquireStaffID" id="" style="width:100px" placeholder="输入工号……" />';
        $this->divContacts  .= '姓名：<input type="text" name="inquireStaffName" id="" style="width:100px" placeholder="输入姓名……" />';
        $this->divContacts  .= '部门：<input type="text" name="inquireDepartment" id="" style="width:200px" placeholder="输入部门……" /><br />';
        $this->divContacts  .= '输入验证码：<input type="text" name="inputcaptchaget" id="" placeholder="输入右侧验证码……" required autocomplete="off" />';
        $this->divContacts  .= '<img src="" alt="" id="verifyimage" /><a class="a_in_content" onclick="document.getElementById(\'verifyimage\').src=\'_libs/captchaget0.php?r=\'+Math.random()" href="javascript:void(0)">显示/更换验证码</a><br />';
        $this->divContacts  .= '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input class="submit" type="submit" name="inquireStaff" value="查询">';
        $this->divContacts  .= '</fieldset></form>';

        // MAC查询页面的实现方法，是直接在后面附加：$this->div_macinquire .= SELF::$div_inquireResult; 这里需要清除旧信息（有、无查询动作，页面互有不一样的内容）

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo 1;
        // echo count($_POST);
        if (count($_POST) == 0) {
            //说明没进行本页面的查询动作，直接获取、输出自己的信息
            $staffInfoArray = self::getStaffInfo($_SESSION['staffID'], 1);
            $this->divContacts .= self::StaffInfoDiv($staffInfoArray);
        } else {
            //否则，就是查询动作，从结果池中读取（process已经调用函数将结果写入结果池）
            $this->divContacts .=  self::$staffInfoPool;
        }
    }



    /**
     * 无输入，无输出，处理员工查询（可能存在多个输出）
     */
    static function StaffInfoPool($postArray)
    {
        // echo '<pre>';
        // print_r($postArray);
        // echo '</pre>';

        // 根据StaffID输出人员信息
        // 可能存在输出查询结果（1个或多个（重名、部门））

        //判断验证码是否正确，全部做好再补
        // [inputcaptchaget] => 1

        //这是工号查询
        if (strlen($postArray['inquireStaffID']) !== 0) {
            //说明输入了工号
            $staffInfoArray = self::getStaffInfo($postArray['inquireStaffID'], 1);
            if (!is_array($staffInfoArray)) {
                //结果不是数组，那就是错误信息，直接把错误信息赋值给结果池
                self::$staffInfoPool = $staffInfoArray;
            } else {
                self::$staffInfoPool = self::StaffInfoDiv($staffInfoArray);
            }
        } else if (strlen($postArray['inquireStaffName']) !== 0) {
            //可能存在多个结果
            self::$staffInfoPool = '测试信息：根据姓名进行查询';
        } else {
            //可能存在多个结果
            self::$staffInfoPool = '测试信息：根据部门进行查询';
        }
    }




    /**
     * 获取员工信息
     * @param  string   $staffID            目标员工ID；
     * @param  bool     $includeHeadPhoto   是否获取头像：默认0，不获取；
     * @return string   '工号不合规定'
     * @return string   '该工号未使用'
     * @return string   '该员工已离职'
     * @return array    $staffInfoArray
     */
    static function getStaffInfo($staffID, $includeHeadPhoto = 0)
    {
        if (!is_numeric($staffID) || strlen($staffID) < 5) {
            return '工号不合规定';
        } else {
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

            if (!is_array($staffInfoArray)) {
                return '该工号未使用';
            } else if ($staffInfoArray['isIn'] !== '1') {
                return '该员工已离职';
            } else {
                return $staffInfoArray;
            }
        }
    }

    /**
     * 传入员工信息（数组）
     * @param   array   $staffInfoArray 目标员工ID；
     * @return  string  $StaffInfoDiv   返回结果页面
     */
    static function StaffInfoDiv($staffInfoArray)
    {
        $StaffInfoDiv = '<div>';
        $StaffInfoDiv .= '<form action="" method="post" enctype="multipart/form-data">';
        $StaffInfoDiv .= '<fieldset><legend>' . $staffInfoArray['staffName'] . '</legend>';
        $StaffInfoDiv .= '<img src="' . $staffInfoArray['headPhoto'] . '" style="float:right;" />';
        $StaffInfoDiv .= '&emsp;&emsp;姓名：' . $staffInfoArray['staffName'] . '<br />';
        $StaffInfoDiv .= '&emsp;&emsp;性别：' . $staffInfoArray['sex'] . '<br />';
        $StaffInfoDiv .= '&emsp;&emsp;工号：' . $staffInfoArray['staffID'] . '<br />';

        $StaffInfoDiv .= '电子邮箱：' . $staffInfoArray['eMail'] . '<br />';
        $StaffInfoDiv .= '&emsp;分机号：' . $staffInfoArray['extensionNum'] . '<br />';
        $StaffInfoDiv .= '&emsp;手机号：' . $staffInfoArray['cellPhoneNum'] . '<br />';
        $StaffInfoDiv .= '加入时间：' . $staffInfoArray['entryTime'] . '<br />';
        $StaffInfoDiv .= '&emsp;&emsp;来自：' . $staffInfoArray['homeland'] . '<br />';
        $StaffInfoDiv .= '出身年月：' . date('Y年n月', strtotime($staffInfoArray['birthMonth'])) . '<br />';
        // 输出的日期格式调整成“x年x月”
        $StaffInfoDiv .= '&emsp;&thinsp;&thinsp;QQ号：' . $staffInfoArray['qq'] . '<br />';
        $StaffInfoDiv .= '&emsp;微信号：' . $staffInfoArray['wechat'] . '<br />';
        $StaffInfoDiv .= '&emsp;&emsp;钉钉：' . $staffInfoArray['dingtalk'] . '<br />';
        $StaffInfoDiv .= '自我介绍：' . $staffInfoArray['selfIntroduction'] . '<br />';
        $StaffInfoDiv .= '</fieldset></form>';
        if ($_SESSION['permission'] == 99 || $_SESSION['permission'] == 15) {
            //默认自己应该
            // $staffInfoArray['staffID']
            $StaffInfoDiv .= '<a class="a_in_content" href="index.php?action=PreferencesPersonal" class="link" >查看详情/修改个人信息</a>';
        }
        //当有权限修改该员工信息时，才显示
        $StaffInfoDiv .= '</div>';



        return  $StaffInfoDiv;
        // 旧设计，表格方式，暂留++++++
        // $StaffInfoDiv = '<table class="staffinfo"><tr>';
        // $StaffInfoDiv .= '<td>姓名： ' . $staffInfoArray['staffName'] . '</td>';
        // $StaffInfoDiv .= '<td>性别：' . $staffInfoArray['sex'] . '</td>';
        // $StaffInfoDiv .= '<td>工号：' . $staffInfoArray['staffID'] . '</td>';
        // $StaffInfoDiv .= '<td rowspan="4" width="9px"><img src="' . $staffInfoArray['headPhoto'] . '" /></td>';
        // $StaffInfoDiv .= '</tr><tr><td colspan="2">电子邮箱：' . $staffInfoArray['eMail'] . '</td>';
        // $StaffInfoDiv .= '<td>分机号：' . $staffInfoArray['extensionNum'] . '</td>';
        // $StaffInfoDiv .= '</tr><tr><td colspan="2"> 手机号：' . $staffInfoArray['cellPhoneNum'] . '</td>';
        // $StaffInfoDiv .= '<td>加入时间：' . $staffInfoArray['entryTime'] . '</td>';
        // $StaffInfoDiv .= '</tr><tr><td colspan="2">来自：' . $staffInfoArray['homeland'] . '</td>';
        // $StaffInfoDiv .= '<td>出身年月：' . $staffInfoArray['birthMonth'] . '</td>';
        // $StaffInfoDiv .= '</tr><tr><td colspan="4">';
        // $StaffInfoDiv .= 'QQ号：' . $staffInfoArray['qq'];
        // $StaffInfoDiv .= '微信号：' . $staffInfoArray['wechat'];
        // $StaffInfoDiv .= '钉钉：' . $staffInfoArray['dingtalk'];
        // $StaffInfoDiv .= '</td></tr><tr><td colspan="4">自我介绍：' . $staffInfoArray['selfIntroduction'] . '</td></tr>';
        // $StaffInfoDiv .= '</table>';
        // 旧设计，表格方式，暂留++++++
    }

    // 添加查询功能，基于员工姓名（重名的情况也要考虑），工号。
    // 至于要不要基于部门查询，还在考虑之中：有则方便，无则更安全。或者做出来，让管理员决定是否开启。


    // 做完查询，接着完善部门岗位
}

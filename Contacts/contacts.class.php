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
            // $this->divContacts .= '<h4>&emsp;&emsp;arsenal4NA——内部通讯录，用于查询公司同事通讯录。</h4>';
            $this->divContacts .= '<hr style="height:1px;border:none;border-top:5px dashed LawnGreen;" width="100%" />';
            $this->divContacts .= '<a href="index.php?action=Contacts" class="link">通讯录首页</a>&emsp;&emsp;';
            $this->divContacts .= '<a href="index.php?action=contactsPersonalModify" class="link" >修改个人信息</a>&emsp;&emsp;';
            //判断用户权限，99超管，15HR
            if ($_SESSION['permission'] == 99 || $_SESSION['permission'] == 15) {
                $this->divContacts .= '<a href="index.php?action=contactsHR" class="link" >HR管理</a><br />';
            }
        } else {
            return "登录状态异常，请清空cookie后重试";
        }
    }

    protected function thisPage()    //本页面特有信息
    {
        $this->divContacts .= '<span><b>这是内部通讯录功能默认页</b></span><br />';
        $this->divContacts .= self::getSomebodyInfo();
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


    private function getSomebodyInfo()
    {
        // //从数据库读取自己的资料
        include '_libs/connect_DB.php'; //以调用页面的位置来看先对路径

        $stmt = $pdo->prepare("select staffID, staffName, sex, extensionNum, eMail, entryTime, headPhoto, cellPhoneNum, birthMonth, homeland, selfIntroduction, qq, wechat, dingtalk from staffs where staffID = :staffID ");
        $stmt->execute(array(":staffID" => $_SESSION['staffID']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // $result = print_r($row);
        // $result = '工号：' . $row['staffID'] . '<br />';
        // $result .= '姓名：' . $row['staffName'] . '<br />';
        // $result .= '性别：' . $row['sex'] . '<br />';
        // $result .= '分机号：' . $row['extensionNum'] . '<br />';
        // $result .= '电子邮箱：' . $row['eMail'] . '<br />';
        // $result .= '加入时间：' . $row['entryTime'] . '<br />';
        // $result .= '头像：' . $row['headPhoto'] . '<br />';
        // $result .= '手机号：' . $row['cellPhoneNum'] . '<br />';
        // $result .= '出身年月：' . $row['dateOfBirth'] . '<br />';
        // $result .= '来自：' . $row['comeFrom'] . '<br />';
        // $result .= '自我结束：' . $row['selfIntroduction'] . '<br />';
        // $result .= 'QQ号：' . $row['qq'] . '<br />';
        // $result .= '微信号：' . $row['wechat'] . '<br />';
        // $result .= '钉钉：' . $row['dingtalk'] . '<br />';

        $result = '<table class="staffinfo"><tr>';
        $result .= '<td>姓名： ' . $row['staffName'] . '</td>';
        $result .= '<td>性别：' . $row['sex'] . '</td>';
        $result .= '<td>工号：' . $row['staffID'] . '</td>';
        $result .= '<td rowspan="4" width="9px"><img src="' . $row['headPhoto'] . '" /></td>';
        $result .= '</tr><tr><td colspan="2">电子邮箱：' . $row['eMail'] . '</td>';
        $result .= '<td>分机号：' . $row['extensionNum'] . '</td>';
        $result .= '</tr><tr><td colspan="2"> 手机号：' . $row['cellPhoneNum'] . '</td>';
        $result .= '<td>加入时间：' . $row['entryTime'] . '</td>';
        $result .= '</tr><tr><td colspan="2">来自：' . $row['homeland'] . '</td>';
        $result .= '<td>出身年月：' . $row['birthMonth'] . '</td>';
        $result .= '</tr><tr><td colspan="4">';
        $result .= 'QQ号：' . $row['qq'];
        $result .= '微信号：' . $row['wechat'];
        $result .= '钉钉：' . $row['dingtalk'];
        $result .= '</td></tr><tr><td colspan="4">自我介绍：' . $row['selfIntroduction'] . '</td></tr>';
        $result .= '</table>';

        return  $result;
    }






    //暂存，可用于列表
    /*     private function getSomebodyInfo__________list()
    {
        // //从数据库读取自己的资料
        // // require_once '../../_libs/connect_DB.php';
        include '_libs/connect_DB.php'; //以调用页面的位置来看先对路径

        $stmt = $pdo->prepare("select staffID, staffName, sex, extensionNum, eMail, entryTime, headPhoto, cellPhoneNum, dateOfBirth, comeFrom, selfIntroduction, qq, wechat, dingtalk from staffs where staffID = :staffID ");
        $stmt->execute(array(":staffID" => $_SESSION['staffID']));

        $stmt->bindColumn("staffID", $staffID);
        $stmt->bindColumn("staffName", $staffName);
        $stmt->bindColumn("sex", $sex);
        $stmt->bindColumn("extensionNum", $extensionNum);
        $stmt->bindColumn("eMail", $eMail);
        $stmt->bindColumn("entryTime", $entryTime);
        $stmt->bindColumn("headPhoto", $headPhoto);
        $stmt->bindColumn("cellPhoneNum", $cellPhoneNum);
        $stmt->bindColumn("dateOfBirth", $dateOfBirth);
        $stmt->bindColumn("comeFrom", $comeFrom);
        $stmt->bindColumn("selfIntroduction", $selfIntroduction);
        $stmt->bindColumn("qq", $qq);
        $stmt->bindColumn("wechat", $wechat);
        $stmt->bindColumn("dingtalk", $dingtalk);

        $stmt->execute(array(":staffID" => $_SESSION['staffID']));

        $result .=  '<table border=1 align="center">';

        $result .=  '<tr>';
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $field = $stmt->getColumnMeta($i);
            $result .=  '<th>' . $field["name"] . "</th>";
        }

        $result .=  '</tr>';

        while ($stmt->fetch()) {
            $result .=  '<tr>';
            $result .=  '<td>' . $staffID . '</td>';
            $result .=  '<td>' . $staffName . '</td>';
            $result .=  '<td>' . $sex . '</td>';
            $result .=  '<td>' . $extensionNum . '</td>';
            $result .=  '<td>' . $eMail . '</td>';
            $result .=  '<td>' . $entryTime . '</td>';
            $result .=  '<td>' . $headPhoto . '</td>';
            $result .=  '<td>' . $cellPhoneNum . '</td>';
            $result .=  '<td>' . $dateOfBirth . '</td>';
            $result .=  '<td>' . $comeFrom . '</td>';
            $result .=  '<td>' . $selfIntroduction . '</td>';
            $result .=  '<td>' . $qq . '</td>';
            $result .=  '<td>' . $wechat . '</td>';
            $result .=  '<td>' . $dingtalk . '</td>';

            $result .=  '</tr>';
        }
        $result .=  '</table>';

        $result .=  "总记录数：" . $stmt->rowCount() . "<br>";
        $result .=  "总字段数：" . $stmt->columnCount() . "<br>";

        // $result .= '<p>默认页面';
        // $result .= '</div>';
        return $result;
    } */
}

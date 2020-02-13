<?php
class Main
{
    private $action;
    private $menu;
    private $div;


    function __construct($action = "")
    {
        $this->action = $action;
        $this->menu = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "0";
        //echo $this->action;
        //echo $this->shape;
    }

    //当一个对象被当作字符串对待的时候，会触发这个魔术方法，引用处被echo：echo new Body();
    // __toString() 方法用于一个类被当成字符串时应怎样回应。例如 echo $obj; 应该显示些什么。此方法必须返回一个字符串，否则将发出一条 E_RECOVERABLE_ERROR 级别的致命错误。
    function __toString()
    {
        //$form = '<form action="' . $this->action . '" method="post" >';

        $this->div = '<div id="main">';
        $this->div .= '<div class="div_contants">';
        $this->div .= '<h4>&emsp;&emsp;arsenal4NA——内部通讯录，用于查询内部通讯录。</h4><br />';
        $this->div .= '<hr style="height:1px;border:none;border-top:5px dashed LawnGreen;" width="75%" />';
        $this->div .= '<a href="index.php?action=personalModify" class="link" title="企业内部通讯录">个人修改</a><br />';
        $this->div .= '<a href="index.php?action=HR" class="link" title="企业内部通讯录">HR管理</a><br />';



        // $div .= '<br /><center><a href="_libs/func_test.php">函数测试</a></center><br />';


        switch ($this->menu) {
            case "Default":
                $this->div .= $this->default1();
                break;
            case "personalModify":
                $this->div .= $this->personalModify();
                break;
            case "HR":
                $this->div .= $this->HR();
                break;
            default:
                $this->div .= $this->default1();
        }
        $this->div .= '</div>';
        return $this->div;
    }





    private function default1()
    {
        //从数据库读取自己的资料
        // require_once '../../_libs/connect_DB.php';
        include '../_libs/connect_DB.php'; //以调用页面的位置来看先对路径

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

        $this->div .=  '<table border=1 align="center">';

        $this->div .=  '<tr>';
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $field = $stmt->getColumnMeta($i);
            $this->div .=  '<th>' . $field["name"] . "</th>";
        }

        $this->div .=  '</tr>';

        while ($stmt->fetch()) {
            $this->div .=  '<tr>';
            $this->div .=  '<td>' . $staffID . '</td>';
            $this->div .=  '<td>' . $staffName . '</td>';
            $this->div .=  '<td>' . $sex . '</td>';
            $this->div .=  '<td>' . $extensionNum . '</td>';
            $this->div .=  '<td>' . $eMail . '</td>';
            $this->div .=  '<td>' . $entryTime . '</td>';
            $this->div .=  '<td>' . $headPhoto . '</td>';
            $this->div .=  '<td>' . $cellPhoneNum . '</td>';
            $this->div .=  '<td>' . $dateOfBirth . '</td>';
            $this->div .=  '<td>' . $comeFrom . '</td>';
            $this->div .=  '<td>' . $selfIntroduction . '</td>';
            $this->div .=  '<td>' . $qq . '</td>';
            $this->div .=  '<td>' . $wechat . '</td>';
            $this->div .=  '<td>' . $dingtalk . '</td>';

            $this->div .=  '</tr>';
        }
        $this->div .=  '</table>';

        $this->div .=  "总记录数：" . $stmt->rowCount() . "<br>";
        $this->div .=  "总字段数：" . $stmt->columnCount() . "<br>";







        $this->div .= '<p>默认页面';
        $this->div .= '</div>';
        // return $this->div;
    }

    private function personalModify()
    {
        // return new HR();
        $this->div .= '<p>个人修改页面';
        $this->div .= '</div>';
    }

    private function HR()
    {
        // return new HR();
        $this->div .= '<p>HR管理页面';
        $this->div .= '</div>';
    }
}

<?php

class PreferencesHR extends Preferences
{
    // function __construct(){} 构建函数从基类继承
    protected function thisPage()    //本页面特有信息
    {
        $form = '<br /><span><b>这是“测试：偏好设置功能——HR管理页”</b></span><br />';
        return $form;
    }


    // function __toString(){} 函数，虽然代码完全一样，但经测试如果从基类继承，则只会显示基类的页面
    function __toString()
    {
        if ($_SESSION['loginStatus'] == 1) {
            $this->div_preferences .= self::thispage();
        }
        $this->div_preferences .= '</div>';
        return $this->div_preferences;
    }
}

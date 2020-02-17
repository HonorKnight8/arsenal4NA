<?php

class PreferencesHR extends Preferences
{
    protected function thisPage()    //本页面特有信息
    {
        $this->div_preferences .= '<br /><span><b>这是偏好设置：HR管理页</b></span><br />';
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

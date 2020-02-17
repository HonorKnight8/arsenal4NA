<?php
require "captcha.class.php";
require "session.class.php";
require "loginstatus.class.php";
new LoginStatus();

$config = array('type' => 0, 'difficultyDegree' => 0, 'fontFile' => "../_fonts/SourceHanSerifCN-Medium.otf");
$captcha = new Captcha($config);

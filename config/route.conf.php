<?php
return array(
    'index::index' => array('Index', 'index', ''),          // 首页
    'blockeedir::blockeedir' => array('BlockEEDIR', 'blockeedir', ''),           // 本项目后台：BE（backend）
    'blockdms::blockdms' => array('BlockDMS', 'blockdms', ''),         // 子系统：DMS(Document Management System)
    'blockexam::blockexam' => array('BlockExam', 'blockexam', ''),         // 子系统：Exam
    'blockitam::blockitam' => array('BlockITAM', 'blockitam', ''),         // 子系统：ITAM(IT资产管理，I.T. Asset Management)
    'blockpubb::blockpubb' => array('BlockPUBB', 'blockpubb', ''),         // 子系统：PUBB(Public Utilities Booking & Borrow)
    'backend::backend' => array('Backend', 'backend', '\app\backend\controller\\'),           // 本项目后台：BE（backend）
    // 
    'zax::sp' => array('ZaxSP', 'zaxsp', ''),                 // ZAX小工具集：SP（Scripts）
    'zax::maci' => array('ZaxMACI', 'zaxmaci', ''),             // ZAX小工具集：MACI（MACInquire）
    'zax::ipi' => array('ZaxIPI', 'zaxipi', ''),             // ZAX小工具集：IPI（IPInquire）
    'zax::snc' => array('ZaxSNC', 'zaxsnc', ''),             // ZAX小工具集：SNC（SubnetCalc）
    'zax::edc' => array('ZaxEDC', 'zaxedc', ''),             // ZAX小工具集：EDC（encode&decode）
    'zax::wfwla' => array('ZaxWFWLA', 'zaxwfwla', ''),          // ZAX小工具集：WFWLA（WinFWLogAnalyzer）
    // 
    'captcha::captchaget0' => array('Captcha', 'captchaget0', ''),          // 验证码，4位
    'captcha::captchaget1' => array('Captcha', 'captchaget1', ''),          // 验证码，6位
    'logout::logout' => array('Logout', 'logout', '')                       // 登出
);
// 'index::index' => array('类名', '该类中的方法名', '文件目录(如有必要)')
// /index/index/ 路径不要漏了最后面的“/”

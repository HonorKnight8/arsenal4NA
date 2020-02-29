<?php
return array(
    'index::index' => array('Index', 'index', ''),          // 首页
    'backend::backend' => array('Backend', 'backend', '\app\backend\controller\\'),           // 本项目后台：BE（backend）
    'blockdms::blockdms' => array('BlockDMS', 'blockdms', ''),         // 子系统：DMS(Document Management System)
    'blockexam::blockexam' => array('BlockExam', 'blockexam', ''),         // 子系统：Exam
    'blockitam::blockitam' => array('BlockITAM', 'blockitam', ''),         // 子系统：ITAM(IT资产管理I.T. Asset Management)
    'blockpubb::blockpubb' => array('BlockPUBB', 'blockpubb', ''),         // 子系统：PUBB(Public Utilities Booking & Borrow)
    'zax::maci' => array('ZaxMACI', 'zaxmaci', ''),             // 小工具：MACI（MACInquire）
    'zax::snc' => array('ZaxSNC', 'zaxsnc', ''),             // 小工具：SNC（SubnetCalc）
    'zax::sp' => array('ZaxSP', 'zaxsp', ''),                 // 小工具：SP（Scripts）（这个其实展示成分比较大）
    'zax::wfwla' => array('ZaxWFWLA', 'zaxwfwla', ''),          // 小工具：WFWLA（WinFWLogAnalyzer）
    'captcha::captchaget0' => array('Captcha', 'captchaget0', ''),          // 小工具：WFWLA（WinFWLogAnalyzer）
    'captcha::captchaget1' => array('Captcha', 'captchaget1', '')          // 小工具：WFWLA（WinFWLogAnalyzer）
);
// 'index::index' => array('Index', 'index', '文件目录(如有必要)')
// /index/index/ 路径必要漏了最后面的“/”

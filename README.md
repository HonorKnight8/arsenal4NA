# arsenal4NA

## 项目名称
arsenal4NA(arsenal for Network Administrator)，即：“网管军火库/工具箱”。<br />

## 背景、简介
这是本攻城狮自己写的一些网络管理、HelpDesk、基础IT运维工作中可能会用到的工具。作为学习编程过程中的一项实践（这个项目的开发**进度可能比较缓慢**）；同时也作为自己若干年网管、基础IT运维工作的总结；也作为日后工作的提高。<br />
如果你在公司从事“网管”、“HelpDesk”、“桌面运维”之类的工作，或者说公司只有你一个ITSupport的情况下，这个工具可能会有所帮助。<br />

## 开发、测试、运行环境
Win10+Apache2.4.41+PHP7.3<br />
CentOS7+Apache2.4.6+MariaDB5.5+PHP7.2<br />
php扩展：mysqlnd、pdo、mbstring、gd<br />

### 功能模块及当前进度
1. **核心功能：EEDIR**...................................0%<br />
(Employee Directory, 通讯录、系统用户管理)<br />
2. **功能块：PUBB**......................................0%<br />
(Public Utilities Booking & Borrow, 公共设施预定、借用，)<br />
3. **功能块：Exam**......................................0%<br />
(Exam, 在线考试系统：招聘、内训)<br />
4. **功能块：DMS**.......................................0%<br />
(Document Management System, 文档管理系统)<br />
5. **功能块：ITAM**......................................0%<br />
(I.T. Asset Management, IT资产管理：桌面、机房、网络、虚拟资产)<br />
6. **ZAX工具集**
  * SP(Scripts, 常用脚本下载)...........................50%<br />
  * MACI(MACInquire, MAC地址归属厂商查询)..............100%<br />
  * IPI(IPInquire, IP地址相关信息查询)...................0%<br />
  * SNC(SubnetCalc, 子网计算器)..........................0%<br />
  * EDC(Encode & Decode, 编解码工具).....................0%<br />
  * WFWLA(WinFWLogAnalyzer, Windows系统防火墙日志分析)...0%<br />
7. **后台管理**<br />
开发中，与各功能模块同步进行<br />
8. **整体框架**<br />
*基本完成*，20200223，基于MVC+URL路由搭建了一个简单框架<br />

### 使用说明
测试、演示数据库中内建了几个账号，用户名密码为：

用户名  | 密码  | 权限
---- | ---- | ----
10001  | liuyi | 普通
10002  | chener | 普通
10003  | zhangsan | 普通
10004  | lisi | 普通
10005  | wangwu | 普通
10006  | zhaoliu | 普通
10007  | sunqi | 普通
10008  | zhouba | 普通
10009  | wujiu | HR
10010  | zhengshi | 全站超管


## 版本管理
Git、GitHub<br />

## 作者、贡献者
作者：HonorKnight8<br />
贡献者：<br />

## 版权说明
本工具遵循"GNU GENERAL PUBLIC LICENSE Version 3"协议<br />
（希望能在一定程度上为本行业添砖加瓦）

## 鸣谢:
PHP.net、《细说PHP》、w3school、runoob.com、慕课网...<br />
GitHub、VScode、Notepad++、Xdebug...<br />
朋友谭工...<br />

### PS:
本项目因为包含了一个IEEE的MAC地址资料文件（/MACInquire/oui.txt），所以相关贡献者的代码行数统计数值需要注意。<br />
1. 准确的数量应该是：
* 当前项目代码行数 = 总代码行数 - 总删除行数 - 当前oui.txt文件行数
* 项目历史总提交代码行数 = 总代码行数 - 历史总提交oui.txt文件行数
2. 例如：2020-02-20,14:10
* 当前项目代码行数 = 336,564 - 168,162 - 165,061 = 3,341行
* 项目历史总提交代码行数 = 336,564 - 164,737 - 165,061 = 6,766行
* (项目历史上共上传了两次oui.txt文件，分别位164,737、165,061行)

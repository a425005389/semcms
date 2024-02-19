<?php
//CopyRight sem-cms.com 公元2015(黑蚂蚁.阿梁：【qq:1181698019】制作开发)
/*数据库链接代码*/
ini_set('display_errors','off');
header("Content-type: text/html; charset=utf-8");
$url = "localhost";//连接数据库的地址
$user = "semcms"; //账号
$password = "semcms";//密码
$dbdata="semcms";//数据库名称
$db_conn = new mysqli();
$db_conn -> connect($url, $user, $password, $dbdata);
$db_conn -> set_charset('utf8');
if ($db_conn -> connect_errno){
	printf("Connect failed: %s\n", $db_conn->connect_error);
	exit();
}
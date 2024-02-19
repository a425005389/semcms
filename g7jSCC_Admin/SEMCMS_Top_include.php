<?php
include_once './Include/inc.php';
include_once 'SEMCMS_Function.php';
$SCQuanXian=checkuser($db_conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="SC_Page_Config/Css/SC_Back.css" type="text/css" />
  <script charset="utf-8" src="SC_Page_Config/Js/jquery.js"></script>
  <script charset="utf-8" src="SC_Page_Config/Js/tinybox.js"></script>
   	<link rel="stylesheet" href="../Edit/themes/default/default.css" />
  	<link rel="stylesheet" href="../Edit/plugins/code/prettify.css" />
  	<script charset="utf-8" src="../Edit/kindeditor.js?v=20230808"></script>
  	<script charset="utf-8" src="../Edit/lang/zh_CN.js"></script>
  	<script charset="utf-8" src="../Edit/plugins/code/prettify.js"></script>
	<script>
    KindEditor.options.filterMode = false;
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="contents"],textarea[name="ctent"],textarea[name="tag_homeabout"],textarea[name="tag_contacts"]', {
				cssPath : '../Edit/plugins/code/prettify.css',
				uploadJson : '../Edit/php/upload_json.php',
				fileManagerJson : '../Edit/php/file_manager_json.php',
				allowFileManager : true
 
			});
			prettyPrint();
		});
	</script>
  <script charset="utf-8" src="SC_Page_Config/Js/pub.js"></script>    
  <title>欢迎使用黑蚂蚁·SEMCMS外贸网站管理系统</title>
  </head>
<?php 
ob_start();
include_once '../../../Include/db_conn.php';
include_once '../../../Include/contorl.php';
include_once '../../Include/function.php';
$SCQuanXian=checkuser($db_conn);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../../SC_Page_Config/Css/SC_Back.css" type="text/css" />
  <script charset="utf-8" src="../../SC_Page_Config/Js/jquery.js"></script>
  <script charset="utf-8" src="../../SC_Page_Config/Js/tinybox.js"></script>
    <link rel="stylesheet" href="../../../Edit/themes/default/default.css" />
    <link rel="stylesheet" href="../../../Edit/plugins/code/prettify.css" />
    <script charset="utf-8" src="../../../Edit/kindeditor.js"></script>
    <script charset="utf-8" src="../../../Edit/lang/zh_CN.js"></script>
    <script charset="utf-8" src="../../../Edit/plugins/code/prettify.js"></script>
  <script>
    KindEditor.options.filterMode = false;
    KindEditor.ready(function(K) {
      var editor1 = K.create('textarea[name="contents"]', {
        cssPath : '../../../Edit/plugins/code/prettify.css',
        uploadJson : '../../../Edit/php/upload_json.php',
        fileManagerJson : '../../../Edit/php/file_manager_json.php',
        allowFileManager : true
 
      });
      prettyPrint();
    });
    
      KindEditor.ready(function(K) {
      var editor1 = K.create('textarea[name="ctent"]', {
        cssPath : '../../../Edit/plugins/code/prettify.css',
        uploadJson : '../../../Edit/php/upload_json.php',
        fileManagerJson : '../../../Edit/php/file_manager_json.php',
        allowFileManager : true
 
      });
      prettyPrint();
    });
      
     KindEditor.ready(function(K) {
      var editor1 = K.create('textarea[name="tag_homeabout"]', {
        cssPath : '../../../Edit/plugins/code/prettify.css',
        uploadJson : '../../../Edit/php/upload_json.php',
        fileManagerJson : '../../../Edit/php/file_manager_json.php',
        allowFileManager : true
 
      });
      prettyPrint();
    });
    
    KindEditor.ready(function(K) {
      var editor1 = K.create('textarea[name="tag_contacts"]', {
        cssPath : '../../../Edit/plugins/code/prettify.css',
        uploadJson : '../../../Edit/php/upload_json.php',
        fileManagerJson : '../../../Edit/php/file_manager_json.php',
        allowFileManager : true
 
      });
      prettyPrint();
    });
    
  </script>
  <script charset="utf-8" src="../../SC_Page_Config/Js/pub.js"></script>   
        
    <title>欢迎使用黑蚂蚁·SEMCMS外贸网站管理系统</title>
    </head>



      <body class="rgithbd">
<div class="divtitle"><img src="../../SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > 语言设置</div>

<h1>你好〜暂没开通此功能,需要开通联系QQ：1181698019(黑蚂蚁）,谢谢！   </h1>

<?php

mysqli_close($db_conn);

?>
</body>
</html>

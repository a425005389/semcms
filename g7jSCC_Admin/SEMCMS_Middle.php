<?php include_once 'SEMCMS_Top_include.php'; ?>

<body class="rgithbd">
<div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > 欢迎使用SEMCMS外贸网站管理系统</div>
 
  <?php
$sysos = $_SERVER["SERVER_SOFTWARE"];      //获取服务器标识的字串
$sysversion = PHP_VERSION;                   //获取PHP服务器版本
//以下两条代码连接MySQL数据库并获取MySQL数据库版本信息
$mysqlinfo = mysqli_get_server_info($db_conn);
//从服务器中获取GD库的信息
if(function_exists("gd_info")){                 
$gd = gd_info();
$gdinfo = $gd['GD Version'];
}else {
$gdinfo = "未知";
}
//从GD库中查看是否支持FreeType字体
$freetype = $gd["FreeType Support"] ? "支持" : "不支持";
//从PHP配置文件中获得是否可以远程文件获取
$allowurl= ini_get("allow_url_fopen") ? "支持" : "不支持";
//从PHP配置文件中获得最大上传限制
$max_upload = ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled";
//从PHP配置文件中获得脚本的最大执行时间
$max_ex_time= ini_get("max_execution_time")."秒";
//以下两条获取服务器时间，中国大陆采用的是东八区的时间,设置时区写成Etc/GMT-8
date_default_timezone_set("Etc/GMT-8");
$systemtime = date("Y-m-d H:i:s",time());
$ip=$_SERVER['REMOTE_ADDR'];
$xymc=$_SERVER['SERVER_PROTOCOL'];
$webport=$_SERVER['SERVER_PORT'];
$domain=$_SERVER['SERVER_NAME'];
$weblang=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
$webyq=$_SERVER['SERVER_SOFTWARE'];
 
echo '<table class="table" width="98%" cellspacing="1" cellpadding="0">';
echo  '<tr><td colspan="10"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" /> 系统信息 </td></tr> ';
echo '<tr><td>系统要求</td><td colspan="4">Apache + PHP版本:5.6 + Mysql版本:5.6</td></tr>';
echo "<tr><td>Web服务器：</td><td>PHP版本：</td><td>MySQL版本：</td><td>GD库版本： </td><td>FreeType：</td></tr>";
echo "<tr><td>$sysos </td><td>$sysversion </td><td>$mysqlinfo </td><td>$gdinfo  </td><td>$freetype </td></tr>";
echo "<tr><td>远程文件获取：</td><td>最大上传限制：</td><td>最大执行时间：</td><td>服务器时间： </td><td>客户端IP：</td></tr>";
echo "<tr><td>$allowurl   </td><td>$max_upload </td><td>$max_ex_time  </td><td> $systemtime  </td><td>$ip</td></tr>";
echo "<tr><td>服务器解译引擎：</td><td>服务器语言：</td><td>用户域名：</td><td>服务器Web端口： </td><td>通信协议的名称和版本：</td></tr>";
echo "<tr><td>$webyq   </td><td>$weblang </td><td>$domain  </td><td> $webport  </td><td>$xymc</td></tr>";
 
echo "</table>";
?>



 
   <table width="98%" class="table" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" /> 联系我们 </td>
    </tr> 
    <tr><td>官方网址：</td><td><a href="http://www.sem-cms.com"/>http://www.sem-cms.com/</a> </td> <td>官方交流平台：</td><td><a href="http://www.sem-cms.com/talk/"/>http://www.sem-cms.com/talk/</a></td></tr>
        <tr><td>联系QQ： </td><td>QQ:1181698019[黑蚂蚁.阿梁]</td> <td>联系邮件：</td><td><a href="mailto:info@sem-cms.com">info@sem-cms.com</a></td></tr>
        <tr><td>微信公众号： </td><td>sem-cms</td> <td>二维码：<br>扫一扫加关注,及时了解系统更新</td><td><img src="SC_Page_Config/Image/wxgzh.jpg"></td></tr>
</table>
</body>
</html>

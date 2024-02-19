<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="SC_Page_Config/Css/SC_Back.css" type="text/css" />
<script charset="utf-8" src="SC_Page_Config/Js/tinybox.js"></script>
</head>
<body>
  <?php
  if ($_GET['type']=="find"){
  
  ?>  
    <form name="form" action="../Include/web_check.php?type=fintpassword" method="post">
<table width="500" cellpadding="0" cellspacing="0" class="table">
<tr><td colspan="2" align="right" class="tdsbg"><span style=" float:left;"><b>找回账号密码!</b></span><a href="javascript:TINY.box.hide()"><img src="SC_Page_Config/Image/icons/hr.gif" border="0" /></a></td></tr>
<tr><td width="20%" align="right" valign="middle">输入E-mail:</td><td align="left" valign="middle"><input name="Email" type="text" id="Email" size="50" /></td></tr>
<tr><td align="right" valign="middle"> </td><td align="center" valign="middle"><input type="hidden" name="furl" id="furl" value="<?php echo $url =  "http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF'];  ?>" > <input type="submit" name="button" id="button" value="确认找回!" /></td></tr>
</table> 
</form>   
  <?php
  }else{
  

     ?>  
    <form name="form" action="../Include/web_check.php?type=findok" method="post">
<table width="500" cellpadding="0" cellspacing="0" class="table">
<tr><td colspan="2" align="right" class="tdsbg"><span style=" float:left;"><b>找回账号密码!</b></span><a href="javascript:TINY.box.hide()"><img src="SC_Page_Config/Image/icons/hr.gif" border="0" /></a></td></tr>
<tr><td width="20%" align="right" valign="middle">输入E-mail:</td><td align="left" valign="middle"><input name="Email" type="text" readonly="readonly" id="Email" value="<?php echo $_GET['umail']; ?>" size="50" /></td></tr>
<tr><td width="20%" align="right" valign="middle">输入密码:</td><td align="left" valign="middle"><input name="umima" type="password"  id="umima"  size="30" /></td></tr>
<tr><td width="20%" align="right" valign="middle">输入认证码:</td><td align="left" valign="middle"><input name="uyzm" type="text"  id="uyzm"  size="30" /> 认证码已发到邮箱</td></tr>
<tr><td align="right" valign="middle"> </td><td align="center" valign="middle"><input type="hidden" name="furl" id="furl" value="<?php echo $url =  "http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF'];  ?>" >  <input type="submit" name="button" id="button" value="确认找回!" /></td></tr>
</table> 
</form>   
    
    
    
  <?php } ?> 
</body>
</html>

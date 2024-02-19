<?php 
include_once 'SEMCMS_Top_include.php';
 ?>
 
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=1">综合管理</a> > 模版管理 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>
 
 
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="5"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">模版管理</span> </td>
  </tr>
  <tr><td>序号</td><td>图片</td><td>模版名称</td><td>是否当前模版</td><td>操作</td></tr>
 <?php
 
  TemplateDir("../Templete/",$webTemplate,$db_conn);
 ?>
</table>
</form> 
 

<?php  

 include_once 'SEMCMS_bot.php'; 
?>
</body>
</html>

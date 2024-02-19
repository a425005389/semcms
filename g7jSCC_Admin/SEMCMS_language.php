<?php include_once 'SEMCMS_Top_include.php';

 
 ?>
    <body class="rgithbd">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
    <tr>
          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">栏目管理</span>  </td>
  </tr>
   <?php  
   echo languageqx("1",$SCQuanXian,$db_conn,$lgid,"");  
   mysqli_close($db_conn);
   ?>
  
</table>

</body>
</html>

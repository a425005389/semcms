<?php 

include_once 'SEMCMS_Top_include.php'; 

if ($type=="iq"){
 //询盘信息

    $sql="select * from sc_msg where ID=".$_GET['ID'];
    $query=$db_conn->query($sql);
    while($row=mysqli_fetch_array($query)){
    $PID=$row['msg_pid'];
    $email=$row['msg_email'];
    $message=$row['msg_content'];
    $IP=$row['msg_ip'];
    $time=$row['msg_time'];
     }
 
    
//产品信息
 if ($PID!=0){

    $sql="select * from sc_products where ID=".$PID;
    $query=$db_conn->query($sql);
    while($row=mysqli_fetch_array($query)){
       $productsname=$row['products_name'];
     }    
 }else{

     $productsname="来自联系我们的留言";

}
 
?>
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=1">综合管理</a> > 邮件发送 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

 
<form action="../Include/web_check.php?type=Remail" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">询盘回复</span> </td>
  </tr>
 
  <tr><td width="200" align="center">收件人 <span class="red"> *</span></td><td><input name="in_emial" type="text" id="in_emial" style="width:40%;" value="<?php echo $email;?>"  ></td></tr>
  <tr><td width="200" align="center">邮件标题 <span class="red"> *</span></td><td><input name="in_title" type="text" id="in_title" style="width:90%;" value="Re:" >  </td></tr>
 
   <tr><td width="200" align="center">邮件正文 <span class="red"> *</span></td><td><textarea name="contents" id="contents" style="width:98%;height:500px;visibility:hidden;">Re:<br><br><br>========================================================================<br>On <?php echo $time;?> wrote:<br><?php echo $message;?><br>========================================================================</textarea> <span class="red"></span></td></tr>
      
   <tr><td width="200" align="center"></td><td>
 
           <input type="submit" value="发送" name="submit" id="submit" onclick="return SubmitEmial();" ></td></tr> 
</table>
</form>
 
<?php
}else{


    $sql="select * from sc_email where ID=".$_GET['ID'];
    $query=$db_conn->query($sql);
    while($row=mysqli_fetch_array($query)){
    $email=$row['e_ml'];

     }
?>


    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=1">综合管理</a> > 邮件发送 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

 
<form action="../Include/web_check.php?type=Remail" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">询盘回复</span> </td>
  </tr>
 
  <tr><td width="200" align="center">收件人 <span class="red"> *</span></td><td><input name="in_emial" type="text" id="in_emial" style="width:40%;" value="<?php echo $email;?>"  ></td></tr>
  <tr><td width="200" align="center">邮件标题 <span class="red"> *</span></td><td><input name="in_title" type="text" id="in_title" style="width:90%;" >  </td></tr>
 
   <tr><td width="200" align="center">邮件正文 <span class="red"> *</span></td><td><textarea name="contents" id="contents" style="width:98%;height:500px;visibility:hidden;"> </textarea> <span class="red"></span></td></tr>
      
   <tr><td width="200" align="center"></td><td>
 
           <input type="submit" value="发送" name="submit" id="submit" onclick="return SubmitEmial();" ></td></tr> 
</table>
</form>



<?
}
 include_once 'SEMCMS_bot.php'; 

?>
</body>
</html>

<?php include_once 'SEMCMS_Top_include.php'; ?>
 
<body>
 <?php
 //询盘信息

    $sql="select * from sc_msg where ID=".$_GET['ID'];
    $query=$db_conn->query($sql);
    while($row=mysqli_fetch_array($query)){
    $PID=$row['msg_pid'];
    $email=$row['msg_email'];
    $message=$row['msg_content'];
    $IP=$row['msg_ip'];
    $time=$row['msg_time'];
    $names=$row['msg_name'];
    $tel=$row['msg_tel'];
     }
    
//产品信息
  if ($PID!=""){
     $sql="select * from sc_products where ID=".$PID;
    $query=$db_conn->query($sql);
    if (mysqli_num_rows($query)>0){
    $row=mysqli_fetch_array($query);
    $productsname=$row['products_name'];

     }else{

      $productsname="来自联系我们的留言";
      
    }
     
?>
<table width="700" cellpadding="0" cellspacing="0" class="table">
    <tr><td colspan="2" align="right" class="tdsbg"><span style=" float:left;"><?php echo $productsname;?></span><a href="javascript:TINY.box.hide()"><img src="SC_Page_Config/Image/icons/hr.gif" border="0" /></a></td></tr>
<tr><td>姓名:</td><td><?php echo $names; ?></td></tr>
<tr><td>电话:</td><td><?php echo $tel; ?></td></tr>
<tr><td>邮箱:</td><td><!--email_off--><?php echo $email; ?><!--/email_off--></td></tr>
<tr><td>留言内容:</td><td><?php echo $message; ?></td></tr>
<tr><td>来路IP:</td><td><?php echo $IP; ?></td></tr>
<tr><td>时间:</td><td><?php echo $time; ?></td></tr>
 
</table>
<?php }else{

echo "操作失败";
}
 ?>
    </body>
 
</html>

<?php include_once 'SEMCMS_Top_include.php'; ?>
 
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php">综合管理</a> > 用户管理 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

<?php 

if($type=="add"){

?>
<form action="?Class=add&CF=user" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">添加用户</span> </td>
  </tr>
  
   <tr><td width="200" align="center">姓名<span class="red"> *</span></td><td><input name="user_name" type="text" id="user_name" size="40"   >  </td></tr>
    <tr><td width="200" align="center">账号 <span class="red"> *</span></td><td><input name="user_admin" type="text" id="user_admin" size="40"   >  </span></td></tr>
    <tr><td width="200" align="center">密码<span class="red"> *</span></td><td> <input name="user_ps" type="password" id="user_ps" size="40"    >  </td></tr>
    <tr><td width="200" align="center">电话 <span class="red"> *</span></td><td><input name="user_tel" type="text" id="user_tel" size="40"   > </td></tr>
    <tr><td width="200" align="center">邮箱 <span class="red"> *</span></td><td><input name="user_email" type="text" id="user_email" size="40"   ><span class="red">当忘记密码的时候可以用来找回,不能有重复</span> </td></tr>       
       
   <tr><td width="200" align="center"></td><td>
 
         
           <input type="submit" value="增加" name="submit" id="submit" onclick="return SubmitUser();" > <span class="red">新增用户后需要分配权限才能登陆 </span></td></tr> 
</table>
</form>
<?php
}elseif($type=="edit"){
    
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM sc_user WHERE ID=".$_GET["ID"])); 

?>

<form action="?Class=edit&CF=user&page=<?php echo $page; ?>" name="form" id="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">编辑用户</span> </td> 
 </tr>
  <tr><td width="200" align="center">姓名<span class="red"> *</span></td><td><input name="user_name" type="text" id="user_name" size="40" value="<?php echo $row['user_name'];?>"   >  </td></tr>
    <tr><td width="200" align="center">账号 <span class="red"> *</span></td><td><input name="user_admin" type="text" id="user_admin" size="40" value="<?php echo $row['user_admin'];?>"  >  </span></td></tr>
    <tr><td width="200" align="center">密码<span class="red"> *</span></td><td> <input name="user_ps" type="password" id="user_ps" size="40"   > <span class="red">  此项为空不更新密码 </span> </td></tr>
    <tr><td width="200" align="center">电话 <span class="red"> *</span></td><td><input name="user_tel" type="text" id="user_tel" size="40" value="<?php echo $row['user_tel'];?>"   > </td></tr>
    <tr><td width="200" align="center">邮箱 <span class="red"> *</span></td><td><input name="user_email" type="text" id="user_email" size="40" value="<?php echo $row['user_email'];?>"   ><span class="red">当忘记密码的时候可以用来找回,不能有重复</span> </td></tr>       
       
   <tr><td width="200" align="center"></td><td>
    
           <input type="hidden" name="ID"  value="<?php echo $_GET["ID"] ?>" >
           <input type="submit" value="编辑" name="submit" id="submit" ></td></tr> 
</table>
</form>

<?php
}else{

?>
        <form name="form" id="form" method="post" action="?Class=Deleted&CF=user&page=<?php echo $page; ?>">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">用户管理</span> <span id="uploads" class="sr"><a href="?type=add"><img src="SC_Page_Config/Image/icons/add.png" align="absmiddle" />增加用户 </a></span> </td>
  </tr>
  <tr>
      <td width="5%" align="center"> <strong>选择</strong></td><td width="5%" align="center"><strong>序号</strong></td> <td><strong>姓名</strong></td> <td><strong>账号</strong></td> <td><strong>邮箱</strong></td><td width="12%" align="center"><strong>操作时间</strong> </td><td width="15%" align="center"><strong>操作</strong></td>
      
  </tr>
   <?php 
   //
 $sql=$db_conn->query("select * from sc_user");     
 $all_num=mysqli_num_rows($sql); //总条数

 $page_num=10; //每页条数

 $page_all_num = ceil($all_num/$page_num); //总页数

 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数

 $page=(int)$page; //安全强制转换

 $limit_st = ($page-1)*$page_num; //起始数
   
   
   
    $sql="select  * from  sc_user  order by  ID asc  limit $limit_st,$page_num ";
    $query=$db_conn->query($sql);
    Panduans(mysqli_num_rows($query));
    $js=1;
    while($row=mysqli_fetch_array($query)){
        
 
        
     
 ?>
  <tr><td align="center"><input type="checkbox" name="AID[]" id="AID[]" value="<?php echo $row['ID'];?>" /></td><td align="center"><?php echo $js; ?></td>  <td> <?php echo $row['user_name'] ?> </td><td><?php echo $row['user_admin'] ?></td><td><?php echo $row['user_email'] ?></td> <td><?php echo $row['user_time'];?> </td><td align="center">  <a href="?type=edit&ID=<?php echo $row['ID']; ?>&page=<?php echo $page; ?>"><img src="SC_Page_Config/Image/icons/page_white_edit.png" align="absmiddle" >编辑</a> <a href="javascript:views('<?php echo $row['user_qx']; ?>','<?php echo $row['ID']; ?>');"><img src="SC_Page_Config/Image/icons/page_white_edit.png" align="absmiddle" >权限分配</a></td></tr>
       
   <?php
   $js=$js+1;
    }
   ?>
  <tr><td colspan="8"><span style="float: left;"><input type="button" id="button" value="选择所有" onclick="checkAll('AID[]')" /> <input type="button" value="清空选中"  id="button" onclick="clearAll('AID[]')" /> <input type="submit"  id="submit" value="删除选中"  onclick="return confirm('确定将此记录删除?')" /></span> <span class="sr2">总共  <?php echo $all_num; ?> 条记录 <?php show_page($all_num,$page,$page_num);   ?></span></td></tr>
  
</table>
</form>

<?php } 
 include_once 'SEMCMS_bot.php'; 
?>
 <script type="text/javascript">
function views(str,id){TINY.box.show("SEMCMS_Fenpei.php?uid="+id+"&st="+str,1,700,400,1)}
</script>
</body>
</html>

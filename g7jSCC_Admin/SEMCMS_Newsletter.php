<?php include_once 'SEMCMS_Top_include.php'; ?>
 
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=1">综合管理</a> > 订阅邮箱 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

 
                
<table width="98%" class="table" cellpadding="0" cellspacing="0">
       <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">邮件搜索</span>   </td>
  </tr>
  <tr><td colspan="8" align="center"> <form name="form" method="post" action="?">输入E-mail查询： <input type="text" value="<?php echo $Searchp; ?>" id="search"  name="search" size="60"> <input type="submit" id="submit" value="搜索"></form> </td><tr>
 </table>
 
        <form name="form" id="form" method="post" action="?Class=Deleted&CF=Newsletter&page=<?php echo $page; ?>">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">订阅邮箱管理</span>   <span id="uploads" class="sr"><a href="?sy=ok"><img src="SC_Page_Config/Image/icons/tick.png" align="absmiddle" />查看所有订阅邮箱</a></span></td>
  </tr>
  <tr>
      <td width="5%" align="center"><input type="hidden" name="languageID" id="languageID" value=""><strong>选择</strong></td><td width="5%" align="center"><strong>序号</strong></td> <td><strong>E-mail</strong></td> <td><strong>IP</strong></td> <td><strong>时间</strong></td>    
      
  </tr>
   <?php 
   //
   if (@$_GET['sy']=="ok"){

    $listnums=10000;

   }else{
       
    $listnums=10;      

   }
   
   if($Searchp!==""){  
   
      $sql=$db_conn->query("select * from sc_email where e_ml like '%".$Searchp."%'");    

   }else{

      $sql=$db_conn->query("select * from sc_email order by ID desc");       

   }
   
 $all_num=mysqli_num_rows($sql); //总条数

 $page_num=$listnums; //每页条数

 $page_all_num = ceil($all_num/$page_num); //总页数

 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数

 $page=(int)$page; //安全强制转换

 $limit_st = ($page-1)*$page_num; //起始数
 
    $sql="select  * from  sc_email  order by ID desc  limit $limit_st,$page_num ";
    
    if($Searchp!==""){

      $sql="select  * from  sc_email where e_ml like '%".$Searchp."%'  order by ID desc  limit $limit_st,$page_num ";
  
   }else{

      $sql="select  * from  sc_email  order by ID desc  limit $limit_st,$page_num ";    
   }   
    
    
    $query=$db_conn->query($sql);
    Panduans(mysqli_num_rows($query));
    $js=1;
    while($row=mysqli_fetch_array($query)){
 
 ?>
  <tr><td align="center"><input type="checkbox" name="AID[]" id="AID[]" value="<?php echo $row['ID'];?>" /></td><td align="center"><?php echo $js; ?></td>  <td> <?php echo $row['e_ml'] ?> </td><td><?php echo $row['e_ip'] ?> <a href="http://ip.sem-cms.com/" target="_blank">查询IP地区</a></td> <td><?php echo $row['e_tm'];?> </td> </tr>
       
   <?php
   $js=$js+1;
    }
   ?>
  <tr><td colspan="8"><span style="float: left;"><input type="button" id="button" value="选择所有" onclick="checkAll('AID[]')" /> <input type="button" value="清空选中"  id="button" onclick="clearAll('AID[]')" /> <input type="submit"  id="submit" value="删除选中"  onclick="return confirm('确定将此记录删除?')" /></span> <span class="sr2">总共  <?php echo $all_num; ?> 条记录 <?php show_page($all_num,$page,$page_num);   ?></span></td></tr>
  
</table>
</form>

<?php 
 include_once 'SEMCMS_bot.php'; 
?>

</body>
</html>

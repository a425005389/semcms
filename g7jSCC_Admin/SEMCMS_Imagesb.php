<?php include_once 'SEMCMS_Top_include.php';

if (isset($_GET["tk"])){$tk = $_GET["tk"];}else{$tk="";}
if (isset($_GET["fm"])){$fm = $_GET["fm"];}else{$fm="";}
if (isset($_GET["fms"])){$fms = $_GET["fms"];}else{$fms="";}
if (isset($_GET["vs"])){$vs = $_GET["vs"];}else{$vs="";}
if (isset($_GET["xz"])){$xz = $_GET["xz"];}else{$xz="";}

if ($xz=="xz") {
$vs="<div class=\'pimg\'><img src=\'$vs\' width=\'50\'><input name=\'products_Images[]\' value=\'".$vs."\' type=\'hidden\' size=\'60\'  ></div>";
echo"<script language='javascript'>window.opener.document.getElementById('proimgs').innerHTML+='".$vs."';</script>";  
echo  "<script language=javascript>window.close();</script>";
 
}

if ($tk==""){
 ?>
 
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=<?php echo $_GET['lgid']; ?>">综合管理</a> > 图片库管理 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">图片上传</span> </td>
  </tr>
<tr><td><form name="forms" id="forms" method="post" action="?Class=add&CF=Images&page=<?php echo $page; ?>">名称：<input type="text" name="images_name" id="images_name" size="40"> 图片：<input name="images_url" type="text" id="images_url" size="70"   >  <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/prdoucts/&filed=images_url&filedname=forms','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span> <input type="submit" value="保存" name="submit" id="submit" ></form></td></tr>
</table>


<?php } ?>
        <form name="form" id="form" method="post" action="?Class=Deleted&CF=Images&page=<?php echo $page; ?>">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">图片管理</span> </td>
  </tr>
 <tr><td align="center">
   <?php 
   //
 $sql=$db_conn->query("select * from sc_images");     
 $all_num=mysqli_num_rows($sql); //总条数

 $page_num=50; //每页条数

 $page_all_num = ceil($all_num/$page_num); //总页数

 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数

 $page=(int)$page; //安全强制转换

 $limit_st = ($page-1)*$page_num; //起始数
   
   
   
    $sql="select  * from  sc_images order by ID desc";
    $query=$db_conn->query($sql);
    Panduans(mysqli_num_rows($query));
    $js=1;
    while($row=mysqli_fetch_array($query)){   
     
 ?>
  <div class="tk"><img src="<?php echo $row['images_url'];?>"><br>

    <?php echo $row['images_name'];?><?php if ($tk==""){?>
      <input type="checkbox" name="AID[]" id="AID[]" value="<?php echo $row['ID'];?>" />
      <?php }else{ echo '<br><a href="?xz=xz&fm='.$fm.'&fms='.$fms.'&vs='.$row['images_url'].'">选择</a>';} ?></div>
       
   <?php
   $js=$js+1;
    }
   ?>
   </td></tr>
  <tr><td colspan="8"><?php if ($tk==""){?><span style="float: left;"><input type="button" id="button" value="选择所有" onclick="checkAll('AID[]')" /> <input type="button" value="清空选中"  id="button" onclick="clearAll('AID[]')" /> <input type="submit"  id="submit" value="删除选中" onclick="return confirm('确定将此记录删除?不可恢复.')" /></span><?php } ?> <span class="sr2">总共  <?php echo $all_num; ?> 条记录 <?php show_page($all_num,$page,$page_num);   ?></span></td></tr>
  
</table>
</form>
 

<?php  
 include_once 'SEMCMS_bot.php'; 
?>
</body>
</html>

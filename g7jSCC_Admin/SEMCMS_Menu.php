<?php include_once 'SEMCMS_Top_include.php'; ?>
 
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=<?php echo $_GET['lgid']; ?>">综合管理</a> > 导航管理 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

<?php 

if ($type=="add"){

?>
<form action="?Class=add&CF=menu" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">添加导航</span> </td>
  </tr>
  
   <tr><td width="200" align="center">名称<span class="red"> *</span></td><td><input name="menu_name" type="text" id="menu_name" size="40"   >  </td></tr>
    <tr><td width="200" align="center">链接地址  <span class="red"> *</span></td><td><input name="menu_link" type="text" id="menu_link" size="60"   > <span class="red">如：http://www.sem-cms.com/,如果不需要链接直接写 "#"</span></td></tr>
   <tr><td width="200" align="center">页面Banner</td><td><input name="menu_banner" type="text" id="menu_banner" size="70"    >  <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/banner/&filed=menu_banner&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span><span class="red">页面中没有对应模块不需要上传,首页的Banner在Banner管理中上传</span></td></tr>

    <tr><td width="200" align="center">排序 <span class="red"> *</span></td><td> <input name="menu_paixu" type="text" id="menu_paixu" size="10"  value="10000"   > <span class="red">默认10000,从小到大排序如：1,2,3,4,5....</span></td></tr>
    <tr><td width="200" align="center">是否下拉 <span class="red"> *</span></td><td> <select name="menu_xiala" id="menu_xiala">
  <option value="0">否</option>
  <option value="1">是</option>
</select> <span class="red">只对产品,关于我们,新闻。</span></td></tr>
       
       
   <tr><td width="200" align="center"></td><td>
           <input type="hidden" name="languageID"  value="<?php echo $_GET["lgid"] ?>" >
         
           <input type="submit" value="增加" name="submit" id="submit" onclick="return SubmitMenu();" ></td></tr> 
</table>
</form>
<?php
}elseif($type=="edit"){
    
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM sc_menu WHERE ID=".$_GET["ID"]));
 
?>

<form action="?Class=edit&CF=menu&page=<?php echo $page; ?>" name="form" id="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">编辑导航</span> </td>
  </tr>
  <tr><td width="200" align="center">名称<span class="red"> *</span></td><td><input name="menu_name" type="text" id="menu_name" size="40" value="<?php echo $row['menu_name']; ?>"   ></td></tr>
    <tr><td width="200" align="center">链接地址  <span class="red"> *</span></td><td><input name="menu_link" type="text" id="menu_link" size="60" value="<?php echo $row['menu_link']; ?>"  > <span class="red">如：http://www.sem-cms.com/,如果不需要链接直接写 "#"</span></td></tr>

       <tr><td width="200" align="center">页面Banner</td><td><input name="menu_banner" type="text" id="menu_banner" size="70" value="<?php echo $row['menu_banner'];?>"  >  <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/banner/&filed=menu_banner&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span><span class="red">页面中没有对应模块不需要上传,首页的Banner在Banner管理中上传</span></td></tr>
    <tr><td width="200" align="center">排序 <span class="red"> *</span></td><td> <input name="menu_paixu" type="text" id="menu_paixu" size="10"  value="<?php echo $row['menu_paixu']; ?>"   > <span class="red">默认10000,从小到大排序如：1,2,3,4,5....</span></td></tr>
    <tr><td width="200" align="center">是否下拉 <span class="red"> *</span></td><td> <select name="menu_xiala" id="menu_xiala">
  <option value="0" <?php if ($row['menu_xiala']=="0"){echo 'selected="selected"';} ?> >否</option>
  <option value="1" <?php if ($row['menu_xiala']=="1"){echo 'selected="selected"';} ?> >是</option>
</select> <span class="red">只对产品,关于我们,新闻。</span></td></tr>
   <tr><td width="200" align="center"></td><td>
           <input type="hidden" name="languageID"  value="<?php echo $_GET["lgid"] ?>" >
           <input type="hidden" name="ID"  value="<?php echo $_GET["ID"] ?>" >
           <input type="submit" value="编辑" name="submit" id="submit" onclick="return SubmitMenu()" ></td></tr> 
</table>
</form>

<?php
}else{

?>
        <form name="form" id="form" method="post" action="?Class=Deleted&CF=menu&page=<?php echo $page; ?>">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">导航管理</span> <span id="uploads" class="sr"><a href="?type=add&lgid=<?php echo $_GET["lgid"] ?>"><img src="SC_Page_Config/Image/icons/add.png" align="absmiddle" />增加导航</a></span> </td>
  </tr>
  <tr>
      <td width="5%" align="center"><input type="hidden" name="languageID" id="languageID" value="<?php echo  $_GET['lgid'];?>"><strong>选择</strong></td><td width="5%" align="center"><strong>序号</strong></td> <td><strong>名称</strong></td> <td><strong>链接地址</strong></td> <td><strong>排序</strong></td><td width="12%" align="center"><strong>更新时间</strong> </td><td>Banner</td><td width="5%" align="center"><strong>操作</strong></td>
      
  </tr>
   <?php 
   //
 $sql=$db_conn->query("select * from sc_menu where languageID=".$_GET["lgid"]."");     
 $all_num=mysqli_num_rows($sql); //总条数

 $page_num=10; //每页条数

 $page_all_num = ceil($all_num/$page_num); //总页数

 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数

 $page=(int)$page; //安全强制转换

 $limit_st = ($page-1)*$page_num; //起始数
   
   
   
    $sql="select  * from  sc_menu where languageID=".$_GET['lgid']." order by  menu_paixu asc, ID asc  limit $limit_st,$page_num ";
    $query=$db_conn->query($sql);
    Panduans(mysqli_num_rows($query));
    $js=1;
    while($row=mysqli_fetch_array($query)){   
       if (empty($row['menu_banner'])){$mg='SC_Page_Config/Image/right_bg.jpg';}else{ $mg=$row['menu_banner'];}
     
 ?>
  <tr><td align="center"><input type="checkbox" name="AID[]" id="AID[]" value="<?php echo $row['ID'];?>" /></td><td align="center"><?php echo $js; ?></td>  <td> <?php echo $row['menu_name'] ?> </td><td><?php echo $row['menu_link'] ?></td><td><?php echo $row['menu_paixu'] ?></td> <td><?php echo $row['menu_time'];?> </td><td><img src='<?php echo $mg;?>' width='30' /></td><td align="center">  <a href="?type=edit&lgid=<?php echo $_GET['lgid'] ?>&ID=<?php echo $row['ID']; ?>&page=<?php echo $page; ?>"><img src="SC_Page_Config/Image/icons/page_white_edit.png" align="absmiddle" >编辑</a></td></tr>
       
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
</body>
</html>

<?php include_once 'SEMCMS_Top_include.php'; ?>
 
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=<?php echo $_GET['lgid']; ?>">综合管理</a> > 信息管理 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

<?php 
		
if (isset($_REQUEST["searchml"])){$CatID=$_REQUEST["searchml"];}else{$CatID="";}
 

if ($type=="add"){


?>
<form action="?Class=add&CF=info" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">添加信息</span> </td>
  </tr>
   <tr>

       <td width="200" align="center">信息分类  <span class="red"> *</span></td> <td  width="200"  align="left" valign="top" class='trs'><select name="info_lanmu"   id="info_lanmu"><?php echo infolm($_GET["lgid"],'0',$db_conn); ?></select></td></tr>
   <tr>  <td width="200" align="center">信息标题  <span class="red"> *</span></td><td><input name="info_title" type="text" id="info_title" size="80"  > </td></tr>
  
   <tr><td width="200" align="center">信息关键词（Keywords）</td><td><input name="info_keywords" type="text" id="info_keywords" size="60"   > <span class="red"> 词与词之间用英文逗号隔开如a,b,c,d  只支持 A-Z,a-z,0-9,- 的组合</span></td></tr>
   <tr><td width="200" align="center">信息描述(Description)</td><td><textarea name="info_des" type="text" id="info_des" style="width:90%;height:100px;" > </textarea><br><span class="red"> 控制在200个字符之内   </span></td></tr>
    <tr><td width="200" align="center">URL(seo)</td><td><input name="info_url" type="text" id="info_url" size="100" > <br><span class="red"> 词与词之间用 - 链接！如：a-b-c-d-e  </span></td></tr>   
   <tr><td width="200" align="center">详细内容  <span class="red"> *</span></td><td><textarea name="contents" id="contents" style="width:98%;height:500px;visibility:hidden;"> </textarea> <span class="red"></span></td></tr>
             <tr><td width="200" align="center">推荐到首页</td><td><input type="checkbox" name="info_tj" id="info_tj" value="yes"   /><span class="red"> 推荐显示在首页</span></td></tr>  
 <tr><td width="200" align="center">标识图</td><td><input name="info_image" type="text" id="info_image" size="70"   >  <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/default/&filed=info_image&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span></td></tr>       
   <tr><td width="200" align="center"></td><td>


           <input type="hidden" name="languageID"  value="<?php echo $_GET["lgid"] ?>" >
         
           <input type="submit" value="增加" name="submit" id="submit" onclick="return SubmitInfo();" ></td></tr> 
</table>
</form>
<?php
}elseif($type=="edit"){
    
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM sc_info WHERE ID=".$_GET["ID"]));
   

?>

<form action="?Class=edit&CF=info&page=<?php echo $page; ?>" name="form" id="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">信息编辑</span> </td>
  </tr>
   <tr>

       <td width="200" align="center">信息分类  <span class="red"> *</span></td> <td  width="200"  align="left" valign="top" class='trs'><select name="info_lanmu"   id="info_lanmu"><?php echo infolm($_GET["lgid"],$row['info_lanmu'],$db_conn); ?></select></td></tr>
   <tr>  <td width="200" align="center">信息标题  <span class="red"> *</span></td><td><input name="info_title" type="text" id="info_title" size="80" value="<?php echo $row["info_title"] ?>"  > </td></tr>
  
   <tr><td width="200" align="center">信息关键词（Keywords）</td><td><input name="info_keywords" type="text" id="info_keywords" size="60" value="<?php echo $row["info_keywords"] ?>"  > <br><span class="red"> 词与词之间用英文逗号隔开如a,b,c,d  </span></td></tr>
   <tr><td width="200" align="center">信息描述(Description)</td><td><textarea name="info_des" type="text" id="info_des" style="width:90%;height:100px;" > <?php echo $row["info_des"] ?></textarea><br><span class="red"> 控制在200个字符之内   </span></td></tr>
    <tr><td width="200" align="center">URL(seo)</td><td><input name="info_url" type="text" id="info_url" size="100" value="<?php echo $row["info_url"] ?>"  > <br><span class="red"> 词与词之间用 - 链接！如：a-b-c-d-e 只支持 A-Z,a-z,0-9,- 的组合 </span></td></tr>   
   <tr><td width="200" align="center">详细内容  <span class="red"> *</span></td><td><textarea name="contents" id="contents" style="width:98%;height:500px;visibility:hidden;"> <?php echo $row["info_content"] ?></textarea> <span class="red"></span></td></tr>

         <tr><td width="200" align="center">推荐到首页</td><td><input type="checkbox" name="info_tj" id="info_tj" value="yes" <?php if ($row['info_tj']==1){echo 'checked="checked"';}?>  /><span class="red"> 推荐显示在首页</span></td></tr>   
   <tr><td width="200" align="center">标识图</td><td><input name="info_image" type="text" id="info_image" size="70" value="<?php echo $row['info_image'];?>"  >  <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/default/&filed=info_image&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span></td></tr>  
   <tr><td width="200" align="center"></td><td>
           <input type="hidden" name="languageID"  value="<?php echo $_GET["lgid"] ?>" >
           <input type="hidden" name="ID"  value="<?php echo $_GET["ID"] ?>" >
           <input type="submit" value="编辑" name="submit" id="submit" onclick="return SubmitInfo()" ></td></tr> 
</table>
</form>

<?php
}else{

?>
        
        
     <table width="98%" class="table" cellpadding="0" cellspacing="0">
       <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">信息搜索</span>   </td>
  </tr>
  <tr><td colspan="8" align="center"> <form name="form" method="post" action="?lgid=<?php echo $_GET["lgid"];?>"><select name="searchml" id="searchml" style="height: 26px;"><option value="">请选择</option><?php echo get_strp('2',$_GET["lgid"],$CatID,$db_conn); ?></select> <input type="text" value="<?php echo $Searchp; ?>"   name="search" size="60"> <input type="submit" id="submit" value="搜索"></form> </td><tr>
 </table>
           
        <form name="form" id="form" method="post" action="?Class=Deleted&CF=info&page=<?php echo $page; ?>">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">信息管理</span> <span id="uploads" class="sr"><a href="?type=add&lgid=<?php echo $_GET["lgid"] ?>"><img src="SC_Page_Config/Image/icons/add.png" align="absmiddle" />增加信息</a></span> </td>
  </tr>
 
  <tr>
      <td width="5%" align="center"><input type="hidden" name="languageID" id="languageID" value="<?php echo  $_GET['lgid'];?>"><strong>选择</strong></td><td width="5%" align="center"><strong>序号</strong></td><td>所属分类</td><td>标识图</td> <td><strong>信息标题</strong></td> <td><strong>推荐</strong></td> <td width="12%" align="center"><strong>更新时间</strong> </td><td width="5%" align="center"><strong>操作</strong></td>
      
  </tr>
   <?php 
   //
   
 
   if ($CatID!="" && $Searchp!=""){
 
          $sql=$db_conn->query("select * from sc_info where languageID=".$_GET["lgid"]." and info_title like '%".$Searchp."%' and info_lanmu=$CatID"); 

   }elseif($CatID!="" && $Searchp==""){
 
          $sql=$db_conn->query("select * from sc_info where languageID=".$_GET["lgid"]." and info_lanmu=$CatID"); 

   }elseif($CatID=="" && $Searchp!=""){
     
          $sql=$db_conn->query("select * from sc_info where languageID=".$_GET["lgid"]." and info_title like '%".$Searchp."%'");  

   }else{

          $sql=$db_conn->query("select * from sc_info where languageID=".$_GET["lgid"]."");       
   }
 
 $all_num=mysqli_num_rows($sql); //总条数

 $page_num=20; //每页条数

 $page_all_num = ceil($all_num/$page_num); //总页数

 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数

 $page=(int)$page; //安全强制转换

 $limit_st = ($page-1)*$page_num; //起始数
   
 
 
   if ($CatID!="" && $Searchp!=""){
 
     $sql=$db_conn->query("select * from sc_info where languageID=".$_GET["lgid"]." and info_title like '%".$Searchp."%' and info_lanmu=$CatID order by ID desc limit $limit_st,$page_num");    

   }elseif($CatID!="" && $Searchp==""){
 
     $sql=$db_conn->query("select * from sc_info where languageID=".$_GET["lgid"]." and info_lanmu=$CatID order by ID desc  limit $limit_st,$page_num"); 

   }elseif($CatID=="" && $Searchp!=""){
     
     $sql=$db_conn->query("select * from sc_info where languageID=".$_GET["lgid"]." and info_title like '%".$Searchp."%' order by ID desc  limit $limit_st,$page_num");   

   }else{

     $sql=$db_conn->query("select * from sc_info where languageID=".$_GET["lgid"]." order by ID desc  limit $limit_st,$page_num");    

   }    
    
    $query=$sql;
    Panduans(mysqli_num_rows($query));
    $js=1;
    while($row=mysqli_fetch_array($query)){
        
 if (empty($row['info_image'])){$mg='SC_Page_Config/Image/right_bg.jpg';}else{ $mg=$row['info_image'];}
  
     
 ?>
  <tr><td align="center"><input type="checkbox" name="AID[]" id="AID[]" value="<?php echo $row['ID'];?>" /></td><td align="center"><?php echo $js; ?></td><td><?php echo ChecInfo("sc_categories","ID",$row['info_lanmu'],"f","category_name",$db_conn);?></td> <td><img src="<?php echo $mg;?>" width="30"></td>  <td><?php echo $row['info_title'] ?></td> <td><?php if($row['info_tj']=="0"){ echo "<img src='SC_Page_Config/Image/icons/cross.png' align='absmiddle'>";}else{ echo "<img src='SC_Page_Config/Image/icons/tick.png' align='absmiddle'>";}?></td><td><?php echo $row['info_time'];?> </td><td align="center">  <a href="?type=edit&lgid=<?php echo $_GET['lgid'] ?>&ID=<?php echo $row['ID']; ?>&page=<?php echo $page; ?>"><img src="SC_Page_Config/Image/icons/page_white_edit.png" align="absmiddle" >编辑</a></td></tr>
       
   <?php
   $js=$js+1;
    }
   ?>
  <tr><td colspan="8"><span style="float: left;"><input type="button" id="button" value="选择所有" onclick="checkAll('AID[]')" /> <input type="button" value="清空选中"  id="button" onclick="clearAll('AID[]')" /> <input type="submit"  id="submit" value="删除选中"  onclick="return confirm('确定将此记录删除?')" /></span> <span class="sr2">总共  <?php echo $all_num; ?> 条记录 <?php pshow_page($all_num,$page,$page_num,$Searchp,$CatID);   ?></span></td></tr>
  
</table>
</form>

<?php } 
 include_once 'SEMCMS_bot.php'; 
?>
</body>
</html>

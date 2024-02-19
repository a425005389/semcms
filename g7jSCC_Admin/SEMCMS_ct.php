<?php include_once 'SEMCMS_Top_include.php'; ?>
 
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=<?php echo $_GET['lgid']; ?>">综合管理</a> > 产品分类管理 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

<?php 

if ($type=="add"){

?>
<form action="?Class=add&CF=category" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">产品分类添加</span> </td>
  </tr>
   <tr><td width="200" align="center">分类名称</td><td><input name="category_name" type="text" id="category_name" size="40" onchange="upd('category_name','category_url');" >  <span class="red"> *</span></td></tr>
   <tr><td width="200" align="center">分类关键词（Keywords）</td><td><input name="category_key" type="text" id="category_key" size="60"   > <span class="red"> 词与词之间用英文逗号隔开如a,b,c,d  </span></td></tr>
   <tr><td width="200" align="center">分类描述(Description)</td><td><textarea name="category_des" type="text" id="category_des" style="width:60%;height:100px;" ></textarea><span class="red"> 控制在200个字符之内   </span></td></tr>
   <tr><td width="200" align="center">分类标识图</td><td><input name="category_img" type="text" id="category_img" size="60"  > <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/categories/&filed=category_img&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span> <span class="red">上传标识图</span></td></tr>
   <tr><td width="200" align="center">分类URL(seo)</td><td><input name="category_url" type="text" id="category_url" size="40" >   <span class="red"> 词与词之间用 - 链接！如：a-b-c-d-e 只支持 A-Z,a-z,0-9,- 的组合  </span></td></tr>
   <tr><td width="200" align="center">分类排序</td><td><input name="category_paixu" type="text" id="category_paixu" size="10"  value="10000"    > <span class="red">默认10000,从小到大排序如：1,2,3,4,5....</span></td></tr>
   <tr><td width="200" align="center">分类详细描述</td><td><textarea name="contents" style="width:95%;height:200px;visibility:hidden;"></textarea> <span class="red"></span></td></tr>
      <tr><td width="200" align="center">分类推荐</td><td><input type="checkbox" name="category_tj" id="category_tj" value="yes"   /><span class="red"> 推荐显示在首页</span></td></tr>       
   <tr><td width="200" align="center"></td><td>
           <input type="hidden" name="languageID"  value="<?php echo $_GET["lgid"] ?>" >
           <input type="hidden" name="PID"  value="<?php echo $_GET["pid"] ?>" > 
             <input type="hidden" name="types"  value="<?php echo $_GET["types"] ?>" >   
           <input type="submit" value="增加" name="submit" id="submit" ></td></tr> 
</table>
</form>
<?php
}elseif($type=="edit"){
    
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM sc_categories WHERE ID=".$_GET["pid"]))

?>

<form action="?Class=edit&CF=category" name="form" id="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">产品分类修改</span> </td>
  </tr>
  <tr><td width="200" align="center">分类名称</td><td><input name="category_name" type="text" id="category_name" size="40" value="<?php echo $row['category_name']; ?>"    >  <span class="red"> *</span></td></tr>
   <tr><td width="200" align="center">分类关键词（Keywords）</td><td><input name="category_key" type="text" id="category_key" size="60" value="<?php echo $row['category_key']; ?>"   > <span class="red"> 词与词之间用英文逗号隔开如a,b,c,d  </span></td></tr>
   <tr><td width="200" align="center">分类描述(Description)</td><td><textarea name="category_des" type="text" id="category_des" style="width:60%;height:100px;" ><?php echo $row['category_des']; ?> </textarea><span class="red"> 控制在200个字符之内   </span></td></tr>
   <tr><td width="200" align="center">分类标识图</td><td><input name="category_img" type="text" id="category_img" size="60" value="<?php echo $row['category_img']; ?>"  > <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/categories/&filed=category_img&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span> <span class="red">上传标识图</span></td></tr>
   <tr><td width="200" align="center">分类URL(seo)</td><td><input name="category_url" type="text" id="category_url" size="40" value="<?php echo $row['category_url']; ?>" >   <span class="red"> 词与词之间用 - 链接！如：a-b-c-d-e 只支持 A-Z,a-z,0-9,- 的组合 </span></td></tr>
   <tr><td width="200" align="center">分类排序</td><td><input name="category_paixu" type="text" id="category_paixu" size="10"  value="<?php echo $row['category_paixu']; ?>"> <span class="red">默认10000,从小到大排序如：1,2,3,4,5....</span></td></tr>
   <tr><td width="200" align="center">分类详细描述</td><td><textarea name="contents" style="width:95%;height:200px;visibility:hidden;"><?php echo $row['category_dest']; ?></textarea> <span class="red"></span></td></tr>
          <tr><td width="200" align="center">分类推荐</td><td><input type="checkbox" name="category_tj" id="category_tj" value="yes" <?php if ($row['category_tj']==1){echo 'checked="checked"';}?>  /><span class="red"> 推荐显示在首页</span></td></tr>   
   <tr><td width="200" align="center"></td><td>
 <input type="hidden" name="languageID"  value="<?php echo $_GET["lgid"] ?>" >
           <input type="hidden" name="PID"  value="<?php echo $_GET["pid"] ?>" >
           <input type="hidden" name="types"  value="<?php echo $_GET["types"] ?>" >    
           <input type="submit" value="修改" name="submit" id="submit" ></td></tr> 
</table>
</form>

<?php
}else{

?>
<table width="98%" class="tables" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="10"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">产品分类管理</span>  <span id="uploads" class="sr"><a href="?type=add&pid=<?php echo $_GET["pid"]; ?>&lgid=<?php echo $_GET["lgid"]; ?>&types=p"><img src="SC_Page_Config/Image/icons/add.png" align="absmiddle" />增加一级分类</a></span></td>
  </tr>
  <tr><td>排序</td><td>图片</td><td>名称</td><td>操作</td></tr>
  
   <?php echo get_str('4',$_GET["lgid"],"&types=p",$db_conn);?>
  
</table>


<?php } 
 include_once 'SEMCMS_bot.php'; 
?>
</body>
</html>

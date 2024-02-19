<?php include_once 'SEMCMS_Top_include.php'; ?>
 
    <body class="rgithbd">
<div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > SEO与文字标签设置 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

        <?php
 
        $row = mysqli_fetch_array($db_conn->query("SELECT * FROM sc_tagandseo WHERE languageID=".$_GET['lgid']))
     
      ?>
<form action="?Class=edit&CF=SeoTag" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
    <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" /> SEO设置 </td>
  </tr>
   <tr><td width="200" align="center">首页标题(meta title)</td><td><input name="tag_indexmetatit" type="text" id="tag_indexmetatit" value="<?php echo $row['tag_indexmetatit'];?>" size="100" > </td></tr>
   <tr><td width="200" align="center">首页关键词(keywords)</td><td><input name="tag_indexkey" type="text" id="tag_indexkey" value="<?php echo $row['tag_indexkey'];?>" size="100" > <span class="red"> 词与词之间用逗号隔开 </span></td></tr>
   <tr><td width="200" align="center">首页描述（description） </td><td><textarea name="tag_indexdes" type="text" id="tag_indexdes" cols="100" rows="5"><?php echo $row['tag_indexdes'];?></textarea> <span class="red"> 控制在200字符之内 </span></td></tr>
   <tr><td width="200" align="center">产品列表标题(meta title)</td><td><input name="tag_prometatit" type="text" id="tag_prometatit" value="<?php echo $row['tag_prometatit'];?>" size="100" > </td></tr>
   <tr><td width="200" align="center">产品列表页关键词(keywords)</td><td><input name="tag_prokey" type="text" id="tag_prokey" value="<?php echo $row['tag_prokey'];?>" size="100" > <span class="red"> 词与词之间用逗号隔开 </span></td></tr>
   <tr><td width="200" align="center">产品列表页描述（description） </td><td><textarea name="tag_prodes" type="text" id="tag_prodes" cols="100" rows="5"><?php echo $row['tag_prodes'];?></textarea> <span class="red"> 控制在200字符之内 </span></td></tr>
   <tr><td width="200" align="center">新闻信息列表标题(meta title)</td><td><input name="tag_newmetatit" type="text" id="tag_newmetatit" value="<?php echo $row['tag_newmetatit'];?>" size="100" > </td></tr>
   <tr><td width="200" align="center">新闻信息列表页关键词(keywords)</td><td><input name="tag_newkey" type="text" id="tag_newkey" value="<?php echo $row['tag_newkey'];?>" size="100" > <span class="red"> 词与词之间用逗号隔开 </span></td></tr>
   <tr><td width="200" align="center">新闻信息列表页描述（description） </td><td><textarea name="tag_newdes" type="text" id="tag_indexdes" cols="100" rows="5"><?php echo $row['tag_newdes'];?></textarea> <span class="red"> 控制在200字符之内 </span></td></tr>
   
      <tr><td width="200" align="center">首页关于我们 </td><td><textarea name="tag_homeabout" type="text" id="tag_homeabout"  style="width:98%;height:300px;visibility:hidden;"><?php echo $row['tag_homeabout'];?></textarea> <span class="red"> 可自由编辑 </span></td></tr>
      
         <tr><td width="200" align="center">联系我们 </td><td><textarea name="tag_contacts" type="text" id="tag_contacts"  style="width:98%;height:300px;visibility:hidden;"><?php echo $row['tag_contacts'];?></textarea>  <span class="red"> 可自由编辑  </span></td></tr>
    
</table>
 
 <table width="98%" class="table" cellpadding="0" cellspacing="0">
    <tr><input name="languageID" type="hidden" id="languageID" value="<?php echo $_GET['lgid'];?>" size="20" ><td colspan="8" align="center"><input type="submit" value="编辑" name="submit" id="submit" ></td></tr>
</table>
<br>
<br>
</form>
<?php 
 include_once 'SEMCMS_bot.php'; 
?>
</body>
</html>

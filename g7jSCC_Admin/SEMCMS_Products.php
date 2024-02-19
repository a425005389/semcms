<?php include_once 'SEMCMS_Top_include.php'; ?>
<script src="SC_Page_Config/Js/jquery-ui.js"></script>
<script>
  $(function() {

    $(function() {
    $( "#proimgs" ).sortable();
    $( "#proimgs" ).disableSelection();
    });
  });

</script>
    <body class="rgithbd">
        <div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=<?php echo $_GET['lgid']; ?>">综合管理</a> > 产品管理 <span class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png" align="absmiddle" /> 返回 </a></span> <span class="srs"><a href="javascript:myrefresh();"><img src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle" /> 刷新 </a></span></div>

<?php 

if (isset($_REQUEST["searchml"])){$CatID=$_REQUEST["searchml"];}else{$CatID="";}
if (isset($_GET["indextjs"])){$indextjs=$_GET["indextjs"];}else{$indextjs="";} 
if ($type=="add"){
?>
<form action="?Class=add&CF=products" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">添加产品</span> </td>
  </tr>
   <tr>
             <td width="11%" rowspan="20" align="left" valign="top" class='trs'><b>商品分类</b> <b><span class="red">*</span></b><br>可以按住Ctrl多选</td>
             <td  rowspan="20" align="left" valign="top" class='trs'><select name="products_category[]" size="24"   multiple="multiple" id="products_category"><?php echo get_strp('1',$_GET["lgid"],'0',$db_conn); ?></select></td>    
      
             <td width="200" align="center">产品标题(meta title) </td><td><input name="products_metatit" type="text" id="products_metatit" size="100" > <br><span class="red"> 可为空,当为空时显示产品名称   </span></td></tr>
              <td width="200" align="center">产品名称  <span class="red"> *</span></td><td><input name="products_name" type="text" id="products_name" size="100" onchange="upd('products_name','products_url');" > </td></tr>
  
   
   <tr><td width="200" align="center">产品型号</td><td><input name="products_model" type="text" id="products_model">  </td></tr>
   <tr><td width="200" align="center">产品关键词（Keywords）</td><td><input name="products_key" type="text" id="products_key" size="100"   ><br> <span class="red"> 词与词之间用英文逗号隔开如a,b,c,d  只支持 A-Z,a-z,0-9,- 的组合</span></td></tr>
   <tr><td width="200" align="center">产品描述(Description)</td><td><textarea name="products_des" type="text" id="products_des" style="width:90%;height:100px;" > </textarea><br><span class="red"> 控制在200个字符之内   </span></td></tr>
   <tr><td width="200" align="center">产品图片</td><td id="tp"><span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Uploads.php?Imageurl=../Images/prdoucts/','newwindow','height=550,width=980,top=200,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传图片</a></span>   <a href="javascript:" id="submit" onClick="window.open('SEMCMS_Images.php?tk=tk&fm=form&fms=products_Images&lgid=<?php echo $_GET["lgid"];?>','','status=no,scrollbars=yes,top=300,left=400,width=700,height=500')">选择图片</a> </td></tr>
   <tr><td width="200" align="center">托动图片可排序</td><td id="proimgs">  </td></tr>
    <tr><td width="200" align="center">产品URL(seo)</td><td><input name="products_url" type="text" id="products_url" size="100" ><br><span class="red"> 词与词之间用 - 链接！如：a-b-c-d-e  </span></td></tr>
      <tr><td width="200" align="center">亚马逊购买地址</td><td><input name="products_aurl" type="text" id="products_aurl" size="100" >  <br><span class="red"> 填写亚马逊对应的产品地址,可不填  </span></td></tr>
  
    
    <tr><td width="200" align="center">产品排序</td><td><input name="products_paixu" type="text" id="products_paixu" size="10"  value="10000"    > <br><span class="red">默认10000,从小到大排序如：1,2,3,4,5....</span></td></tr>
   <tr><td width="200" align="center">相关产品</td><td><input name="products_xiangguan" type="text" id="products_xiangguan" size="40" readonly="readonly">  <a href="javascript:" onClick="window.open('SEMCMS_RandProducrs.php?type=add&lgid=<?php echo $_GET["lgid"];?>','','status=no,scrollbars=yes,top=400,left=400,width=700,height=465')">选择</a>  <span class="red">此项为空随机调取</span></td></tr>
   <tr><td width="200" align="center">规格参数 <span class="red"> *</span></td><td><textarea name="ctent" id="ctent" style="width:98%;height:350px;visibility:hidden;"> </textarea> <span class="red"></span></td></tr>
   <tr><td width="200" align="center">产品详细描述  <span class="red"> *</span></td><td><textarea name="contents" id="contents" style="width:98%;height:500px;visibility:hidden;"> </textarea> <span class="red"></span></td></tr>
      
   <tr><td width="200" align="center"></td><td>
           <input type="hidden" name="languageID"  value="<?php echo $_GET["lgid"] ?>" >
         
           <input type="submit" value="增加" name="submit" id="submit" onclick="return SubmitProduct();" ></td></tr> 
</table>
</form>
<?php
}elseif($type=="edit"){
    
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM sc_products WHERE ID=".$_GET["ID"]));
         $arr=explode(",",$row['products_Images']);
         $vIm="";
         foreach($arr as $Im){
           
             if ($Im!==""){
                 
                 $vIm=$vIm."<div class='pimg'><img src='$Im' width='50'><input name='products_Images[]' value='".$Im."' type='hidden' size='60'  ><br><a href='?Class=Imagedelete&CF=products&lgid=".$_GET['lgid']."&ID=".$_GET['ID']."&imgurl=$Im' onClick='return delcfm();'>删除</a></div>";
                
                 
             }
             
         }

?>

<form action="?Class=edit&CF=products&page=<?php echo $page; ?>" name="form" id="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>  

          <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">产品编辑</span> </td>
  </tr>
   <tr>
             <td width="11%" rowspan="20" align="left" valign="top" class='trs'><b>商品分类</b> <b><span class="red">*</span></b><br>可以按住Ctrl多选</td>
             <td   rowspan="20" align="left" valign="top" class='trs'><select name="products_category[]" size="24"   multiple="multiple" id="products_category"><?php echo get_strp('1',$_GET["lgid"],$row["products_category"],$db_conn); ?></select></td>    
                  
             <td width="200" align="center">产品标题(meta title) </td><td><input name="products_metatit" type="text" id="products_metatit" size="100" value="<?php echo $row['products_metatit']; ?>"> <br> <span class="red"> 可为空,当为空时显示产品名称   </span></td></tr>
             <td width="200" align="center">产品名称  <span class="red"> *</span></td><td><input name="products_name" type="text" id="products_name" size="100" value="<?php echo $row['products_name']; ?>" > </td></tr>
   <tr><td width="200" align="center">产品型号</td><td><input name="products_model" type="text" id="products_model" value="<?php echo $row['products_model']; ?>">  </td></tr>
   <tr><td width="200" align="center">产品关键词（Keywords）</td><td><input name="products_key" type="text" id="products_key" size="100" value="<?php echo $row['products_key']; ?>"   > <br><span class="red"> 词与词之间用英文逗号隔开如a,b,c,d  </span></td></tr>
   <tr><td width="200" align="center">产品描述(Description)</td><td><textarea name="products_des" type="text" id="products_des" style="width:90%;height:100px;" > <?php echo $row['products_des']; ?> </textarea><br><span class="red"> 控制在200个字符之内   </span></td></tr>
   <tr><td width="200" align="center"> </td><td><span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Uploads.php?Imageurl=../Images/prdoucts/','newwindow','height=550,width=980,top=200,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传图片</a></span>   <a href="javascript:" id="submit" onClick="window.open('SEMCMS_Images.php?tk=tk&fm=form&fms=products_Images&lgid=<?php echo $_GET["lgid"];?>','','status=no,scrollbars=yes,top=300,left=400,width=700,height=500')">选择图片</a>  </td></tr>
   <tr><td width="200" align="center">拖动图片可排序</td><td id="proimgs" > <?php echo $vIm; ?>     </td></tr>
   
    <tr><td width="200" align="center">产品URL(seo)</td><td><input name="products_url" type="text" id="products_url" size="100" value="<?php echo $row['products_url']; ?>"  >  <br><span class="red"> 词与词之间用 - 链接！如：a-b-c-d-e 只支持 A-Z,a-z,0-9,- 的组合 </span></td></tr>
  <tr><td width="200" align="center">亚马逊购买地址</td><td><input name="products_aurl" type="text" id="products_aurl" size="100" value="<?php echo $row['products_aurl']; ?>" >  <br><span class="red"> 填写亚马逊对应的产品地址,可不填  </span></td></tr>
    <tr><td width="200" align="center">产品排序</td><td><input name="products_paixu" type="text" id="products_paixu" size="10"  value="<?php echo $row['products_paixu']; ?>"    > <span class="red">默认10000,从小到大排序如：1,2,3,4,5....</span></td></tr>
   <tr><td width="200" align="center">相关产品</td><td><input name="products_xiangguan" type="text" id="products_xiangguan" size="40" value="<?php echo $row['products_xiangguan']; ?>" readonly="readonly">  <a href="javascript:views('<?php echo $type;?>','<?php echo $_GET['lgid'];?>','<?php echo $_GET['ID'];?>','<?php echo $_GET['page'];?>');">选择</a> <span class="red">此项为空随机调取</span></td></tr>
   <tr><td width="200" align="center">规格参数 <span class="red"> *</span></td><td><textarea name="ctent" id="ctent" style="width:98%;height:350px;visibility:hidden;"><?php echo $row['products_guige']; ?></textarea> <span class="red"></span></td></tr>   
   <tr><td width="200" align="center">产品详细描述  <span class="red"> *</span></td><td><textarea name="contents" id="contents" style="width:98%;height:500px;visibility:hidden;"> <?php echo $row['products_content']; ?></textarea> <span class="red"></span></td></tr>
   
   <tr><td width="200" align="center"></td><td>
           <input type="hidden" name="languageID"  value="<?php echo $_GET["lgid"] ?>" >
           <input type="hidden" name="ID"  value="<?php echo $_GET["ID"] ?>" >
           <input type="submit" value="保存" name="submit" id="submit" onclick="return SubmitProduct()" ></td></tr> 
</table>
</form>

<?php
}else{

?>
        
<table width="98%" class="table" cellpadding="0" cellspacing="0">
       <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">商品搜索</span>   </td>
  </tr>
  <tr><td colspan="8" align="center"> <form name="form" method="post" action="?lgid=<?php echo $_GET["lgid"];?>"><select name="searchml" id="searchml" style="height: 26px;"><option value="">请选择</option><?php echo get_strp('1',$_GET["lgid"],$CatID,$db_conn); ?></select> <input type="text" value="<?php echo $Searchp; ?>"   name="search" size="60"> <input type="submit" id="submit" value="搜索"></form> </td><tr>
 </table>
        
<form name="form" id="form" method="post" action="#">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
          <td colspan="8"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">产品管理</span>  <span id="uploads" class="sr"><a href="?type=add&lgid=<?php echo $_GET["lgid"] ?>"><img src="SC_Page_Config/Image/icons/add.png" align="absmiddle" />增加产品</a></span> <span id="uploads" class="sr"><a href="?lgid=<?php echo $_GET["lgid"] ?>&indextjs=1"><img src="SC_Page_Config/Image/icons/tick.png" align="absmiddle" />查看首页推荐产品</a></span> </td>
  </tr>
   
  <tr>
      <td width="5%" align="center"><input type="hidden" name="languageID" id="languageID" value="<?php echo  $_GET['lgid'];?>"><strong>选择</strong></td><td width="5%" align="center"><strong>序号</strong></td><td width="8%" align="center"><strong>图片</strong></td> <td><strong>商品名称</strong></td><td width="15%" align="center"><strong>商品状态</strong></td><td width="12%" align="center"><strong>更新时间</strong> </td><td width="10%" align="center"><strong>操作</strong></td>
      
  </tr>
   <?php 
   //
 
   $flID="";
   if ($CatID!="" && $Searchp!=""){

     $flID=prolmid($CatID,$db_conn);
     $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." and products_name like '%".$Searchp."%' and $flID"); 

   }elseif($CatID!="" && $Searchp==""){

     $flID=prolmid($CatID,$db_conn);
     $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." and $flID");     

   }elseif($CatID=="" && $Searchp!=""){
     
     $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." and products_name like '%".$Searchp."%'");     

   }elseif($indextjs==1){

     $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." and products_index=1 ");   

   }else{

    $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]."");  

   }
 
 $all_num=mysqli_num_rows($sql); //总条数

 $page_num=20; //每页条数

 $page_all_num = ceil($all_num/$page_num); //总页数

 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数

 $page=(int)$page; //安全强制转换

 $limit_st = ($page-1)*$page_num; //起始数
 
 
    
    if ($CatID!="" && $Searchp!=""){

     $flID=prolmid($CatID,$db_conn);
     $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." and products_name like '%".$Searchp."%' and $flID order by ID desc  limit $limit_st,$page_num "); 

   }elseif($CatID!="" && $Searchp==""){

     $flID=prolmid($CatID,$db_conn);
     $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." and $flID order by ID desc  limit $limit_st,$page_num ");     
   
   }elseif($CatID=="" && $Searchp!=""){

     $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." and products_name like '%".$Searchp."%' order by ID desc  limit $limit_st,$page_num "); 

   }elseif($indextjs==1){

    $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." and products_index=1 order by ID desc  limit $limit_st,$page_num ");      
   }else{

     $sql=$db_conn->query("select * from sc_products where languageID=".$_GET["lgid"]." order by ID desc  limit $limit_st,$page_num ");       
   }
 
    $query=$sql;
    Panduans(mysqli_num_rows($query));
    $js=1;
    while($row=mysqli_fetch_array($query)){
        
        $Imgs=explode(",",$row['products_Images']); 
        $indextj=$row['products_index'];
        $prozt=$row['products_zt'];
        
        if ($indextj=="0"){
            $indext="<a href='?Class=indextj&CF=products&tj=1&lgid=".$_GET["lgid"]."&ID=".$row['ID']."&page=$page'><img src='SC_Page_Config/Image/icons/cross.png' align='absmiddle'>首页</a> ";
            
        }else{ $indext="<a href='?Class=indextj&CF=products&tj=0&lgid=".$_GET["lgid"]."&ID=".$row['ID']."&page=$page'><img src='SC_Page_Config/Image/icons/tick.png' align='absmiddle'>首页</a> ";}
        
           if ($prozt=="0"){
            $prozts="<a href='?Class=shangjia&CF=products&tj=1&lgid=".$_GET["lgid"]."&ID=".$row['ID']."&page=$page'><img src='SC_Page_Config/Image/icons/cross.png' align='absmiddle'>上架</a> ";
            
        }else{ $prozts="<a href='?Class=shangjia&CF=products&tj=0&lgid=".$_GET["lgid"]."&ID=".$row['ID']."&page=$page'><img src='SC_Page_Config/Image/icons/tick.png' align='absmiddle'>上架</a>  ";}    
 ?>
  <tr><td align="center"><input type="checkbox" name="AID[]" id="AID[]" value="<?php echo $row['ID'];?>" /></td><td align="center"><?php echo $js; ?></td><td align="center"><img src="<?php echo $Imgs[0]; ?>" width="50" /></td> <td><?php echo $row['products_name'] ?></td><td align="center"><?php echo $indext; echo $prozts; ?> </td><td><?php echo $row['products_time'];?> </td><td align="center">  <a href="?type=edit&lgid=<?php echo $_GET['lgid'] ?>&ID=<?php echo $row['ID']; ?>&page=<?php echo $page; ?>"><img src="SC_Page_Config/Image/icons/page_white_edit.png" align="absmiddle" >编辑</a>  <a href="?Class=Addls&CF=products&lgid=<?php echo $_GET['lgid'] ?>&ID=<?php echo $row['ID']; ?>&page=<?php echo $page; ?>"> <img src="SC_Page_Config/Image/icons/page_add.png" align="absmiddle" > 复制</a></td></tr>
       
   <?php
   $js=$js+1;
    }
   ?>
  <tr><td colspan="8"><span style="float: left;"><input type="button" id="button" value="选择所有" onclick="checkAll('AID[]')" /> <input type="button" value="清空选中"  id="button" onclick="clearAll('AID[]')" />  <input type="submit"  id="submit" value="删除选中"  onclick="return chgpro('?Class=Deleted&CF=products&page=<?php echo $page; ?>','del');" /> <input type="submit"  id="submit" value="推荐首页"  onclick="return chgpro('?Class=homes&CF=products&tj=1&page=<?php echo $page; ?>','home');" />  <input type="submit"  id="submit" value="下架首页"  onclick="return chgpro('?Class=homes&CF=products&tj=0&page=<?php echo $page; ?>','home');" />  <input type="submit"  id="submit" value="批量上架"  onclick="return chgpro('?Class=Shjia&CF=products&tj=1&page=<?php echo $page; ?>','home');" />  <input type="submit"  id="submit" value="批量下架"  onclick="return chgpro('?Class=Shjia&CF=products&tj=0&page=<?php echo $page; ?>','home');" /> </span>  <span class="sr2">总共  <?php echo $all_num; ?> 条记录 <?php pshow_page($all_num,$page,$page_num,$Searchp,$CatID);   ?></span></td></tr>
  
</table>
</form>

<?php } 
 include_once 'SEMCMS_bot.php'; 
 
?>
 <script type="text/javascript">
 
function views(type,lgid,prids,page){TINY.box.show("SEMCMS_RandProducrs.php?type="+type+"&lgid="+lgid+"&ID="+prids+"&page="+page,1,700,400,1)}
</script>

        <?php

        if (isset($_GET["sub"])){$sub=$_GET["sub"];}else{$sub="";}
        if ($sub=="ok"){ 
           $RealID = array(); 
           $RealID = $_POST["AID"];  
           $RealID = implode(",",$RealID); 
           echo'<script type="text/javascript">document.getElementById("products_xiangguan").value="'.$RealID.'";</script>;'; 
               }
        ?>

</body>
</html>

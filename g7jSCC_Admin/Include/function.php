<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//语种ID
if(isset($_COOKIE["ScLangId"])){
    $lgid=$_COOKIE["ScLangId"];
}else{
    $lgid=1;    
}

//操作提示信息
function actioninfo($str){
    if ($str=="001"){
        $str=" √  恭喜！操作成功！";
    }elseif ($str=="002") {
         $str=" ✖ Sorry！有相同存在！";
    } elseif($str=="003"){
        $str=" ✖ Sorry！带星号的必填！";
    } elseif($str=="004"){
        $str=" ✖ Sorry！请选择要操作的内容！";
    } elseif($str=="005"){
        $str=" ✖ Sorry！请选择要分配的内容！";
    }elseif($str=="006"){
        $str=" ✖ Sorry！数据写入不成功,请检查数据";
    }
  return $str;  
}

//删除指定文件
function Delfile($filename){
  if(file_exists($filename)){
    unlink($filename);
    }
   $filename=str_replace("prdoucts/", "prdoucts/small/", $filename);
  if(file_exists($filename)){
    unlink($filename);
    }
 }

//汇总语言权限
function languageqx($cstr,$cooks,$db_conn,$lgid,$flag){  
    $query=$db_conn->query("select * from sc_language where ID=$cstr");
    while($row=mysqli_fetch_assoc($query)){
       if ($row["language_open"]=="1"){
           $openstr=" <a href='?Language=open&ID=".$row['ID']."&flag=0'><img src='SC_Page_Config/Image/icons/open.png' align='absmiddle'>关闭</a>";  
       }else{
           $openstr=" <a href='?Language=open&ID=".$row['ID']."&flag=1'><img src='SC_Page_Config/Image/icons/close.png' align='absmiddle'>开启</a>";  
           }
   //  echo  '<tr><td width="300" align="left"><strong>'.$row["language_cname"].'</strong> <a href="?type=edit&ID='.$row['ID'].'"><img src="SC_Page_Config/Image/icons/page_white_edit.png" align="absmiddle" />[编辑]</a> <a href="?Language=delete&ID='.$row['ID'].'" onClick="return delcfm();"><img src="SC_Page_Config/Image/icons/cross.png" align="absmiddle" />[删除]</a>'.$openstr.'</td>'
            // . '<td>'.twofenlei($cooks,75).'</td></tr>';
        if($flag=="left"){
           echo  twofenlei($cooks,75,$db_conn,$lgid,$flag);
         }else{
           echo  '<tr><td width="100" align="left"><strong>'.$row["language_cname"].'</strong></td><td>'.twofenlei($cooks,75,$db_conn,$lgid).'</td></tr>';            
        }
     } 
  }  
  

//无限给分类
function get_str($id,$lgid,$types,$db_conn) {
    global $str; 
    $result=$db_conn->query("select * from sc_categories where category_pid= $id and languageID=$lgid order by category_paixu,ID asc");//查询pid的子类的分类 
    if($result){//如果有子类 
        while ($row = mysqli_fetch_assoc($result)) { //循环记录集 
         $js="<img src='SC_Page_Config/Image/emptys.gif' align='absmiddle'>";
         $retArr =explode(',',$row['category_path']);
         $countd=count($retArr)-3;
         if ($countd==1){
              $jia="<span id=uploads><a href='javascript:catopen(\"".$row['ID']."\");'>+ 展开</a></span>";
              $div1='<tr><td colspan="10" ><table width="100%" class="table2" cellpadding="0" cellspacing="0" id="cat'.$row['ID'].'" >';
              $div2="</table></td></tr>";
         }else{
              $jia="";
              $div1="";
              $div2="";
       }
         $kg="";
          for($i=0;$i<$countd;$i++) {
              $kg=$kg."<img src='SC_Page_Config/Image/empty.gif' align='absmiddle'>";
           } 
        if ($row["category_open"]=="1"){
           $openstr="<a href='?Class=open&CF=category&pid=".$row['ID']."&flag=0&lgid=".$lgid.$types."'><img src='SC_Page_Config/Image/icons/open.png' align='absmiddle'>关闭</a>"; 
         }else{
           $openstr="<a href='?Class=open&CF=category&pid=".$row['ID']."&flag=1&lgid=".$lgid.$types."'><img src='SC_Page_Config/Image/icons/close.png' align='absmiddle'>开启</a>";  
           }
           if (empty($row['category_img'])){$mg='SC_Page_Config/Image/right_bg.jpg';}else{ $mg=$row['category_img'];}
           if ($id==2){
               $str .= "<tr><td>".$row['category_paixu']."</td><td><img src='".$mg."' width='30'></td><td  >".$kg.$js." ".$row['category_name'] . " </td><td  >   <a href='?type=edit&pid=".$row['ID']."&lgid=".$lgid.$types."'><img src='SC_Page_Config/Image/icons/page_white_edit.png' align='absmiddle'>编辑</a> ".$openstr." <a href='?Class=delete&CF=category&pid=".$row['ID']."&lgid=".$lgid.$types."' onClick='return delcfm();'><img src='SC_Page_Config/Image/icons/cross.png' align='absmiddle'>删除</a> </td></tr>".$div1; //构建字符串 

           }else{
               $str .= "<tr><td width='10%'>".$row['category_paixu']."</td><td width='20%'><img src='".$mg."' width='30'></td><td width='30%'>".$kg.$js." ".$row['category_name'] . " </td><td >   <a href='SEMCMS_Categories.php?type=add&pid=".$row['ID']."&lgid=".$lgid.$types."'><img src='SC_Page_Config/Image/icons/application_add.png' align='absmiddle'>增加下一级</a> <a href='?type=edit&pid=".$row['ID']."&lgid=".$lgid.$types."'><img src='SC_Page_Config/Image/icons/page_white_edit.png' align='absmiddle'>编辑</a> ".$openstr." <a href='?Class=delete&CF=category&pid=".$row['ID']."&lgid=".$lgid.$types."' onClick='return delcfm();'><img src='SC_Page_Config/Image/icons/cross.png' align='absmiddle'>删除</a> ".$jia."</td></tr>".$div1; //构建字符串 
            }

            $kg="";
            $js="";
            get_str($row['ID'],$lgid,$types,$db_conn); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
            $str .=$div2;
        } 
    } 
    if($str==""){
        $str="<tr><td colospan='3'>暂无分类！</td></tr>";
    }else{
      $str=$str;
    }
    return $str; 
}

//信息分类
function infolm($lgid,$flag,$db_conn){ 
    $query=$db_conn->query("select * from sc_categories where languageID=".$lgid." and category_pid=2");
    while($row=mysqli_fetch_assoc($query)){    
              if ($flag==$row['ID']){
                  $xuanzes='selected="selected"';
              }else{
                  $xuanzes='';
              }
              echo "<option value=".$row['ID']." $xuanzes >".$row['category_name']."</option>";
     }   
}

//无限分类产品列表
function get_strp($id,$lgid,$flag,$db_conn) {
    global $strs;
    $result=$db_conn->query("select * from sc_categories where category_pid=$id and languageID=$lgid");
    if($result){//如果有子类 
        while ($row = mysqli_fetch_assoc($result)) { //循环记录集
         $xuanze='';
         $retArr =explode(',',$row['category_path']);
         $countd=count($retArr)-4;
         $kg="";
         $js="&nbsp;";
          for($i=0;$i<$countd;$i++) {
              $kg=$kg."-";
             if ($i==0){
                $js="&nbsp;&nbsp;|";
              }else{
                $js=$js."";
             }    
          } 
          if ($flag!=="0"){    
              $flid= explode(",", $flag);
             foreach ($flid as $value){
                 if ($row['ID']==$value){
                   $xuanze='selected="selected"';   
                 }
              } 
          }
            $strs .= "<option value=".$row['ID']." $xuanze>".$js.$kg."".$row['category_name'] ."&nbsp;&nbsp;</option>";
            get_strp($row['ID'],$lgid,$flag,$db_conn); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
    } 

    if($strs==""){
        $strs="<option value=''>暂无分类</option>";
      }else{
        $strs=$strs;
      }
    return $strs; 
} 


// 后台权限栏目
function onefenlei($cstr,$db_conn){ 
    $query=$db_conn->query("select * from sc_categories where  category_pid=3  and category_name<>'信息操作'");
    echo '<dl>';
    while($row=mysqli_fetch_assoc($query)){
        if (strpos($cstr,$row['ID'])!==false){  
            echo '<dt class="back_left_top"><img src="SC_Page_Config/Image/left.jpg" align="absmiddle" /><a href="javascript;">'.$row['category_name'].'</a></dt>' ;
        }else{
           echo''; 
        }
        echo '<dd><ul>';
        echo twofenlei($cstr,$row['ID'],$db_conn);
        }
        echo '</ul></dd></dl>';
  }


function twofenlei($cstr,$pid,$db_conn,$lgid=""){ // 后台权限栏目
    $qx75="";
    $query=$db_conn->query("select * from sc_categories where category_open=1 and  category_pid=$pid order by  category_paixu asc,ID asc");
    while($row=mysqli_fetch_assoc($query)){
        if ($pid==75){
            if (strpos($cstr,$row['ID'])!==false){
                $qx75.='<li><img src="SC_Page_Config/Image/left2.jpg" align="absmiddle" /> <a href="'.$row['category_url'].$lgid.'" target="mainFrame" >'.$row['category_name'].'</a></li>' ;  
            }else{
                echo'';  
            }
        }else{
           if (strpos($cstr,$row['ID'])!==false){  
               echo '<li><img src="SC_Page_Config/Image/left2.jpg" align="absmiddle" /> <a href="'.$row['category_url'].'" target="mainFrame" >'.$row['category_name'].'</a></li>' ;
           }else{
            echo'';
           }
        } 
    }
 return $qx75 ;
}

// 语种权限
function languagefenlei($cstr,$db_conn,$lgid){ 
    $query=$db_conn->query("select * from sc_language where  language_open=1");
    if(mysqli_num_rows($query)>1){
            while($row=mysqli_fetch_array($query)){
              if (strpos($cstr,$row['language_url'])!==false){
                  if($lgid==$row['ID']){
                    $st=" style='background:#000;'";
                  }else{
                    $st="";
                }
                  echo "<span ".$st." onclick=setCookie('ScLangId','".$row['ID']."')>".$row['language_cname']."</span>"; 
                }else{
                  echo''; 
                }
            }
    }
}


//权限分配
function fonefenlei($cstr,$db_conn){ // 后台权限栏目
    $query=$db_conn->query("select * from sc_categories where  category_pid=3"); 
    while($row=mysqli_fetch_array($query)){
        if (strpos($cstr,$row['ID'])!==false){
            $che=' checked="checked"'; 
        }else{
            $che="";   
        }
        echo '<ul>';
        echo '<li><input type="checkbox" name="ID[]" id="ID[]" value="'.$row['ID'].'" '.$che.'  /><b>'.$row['category_name'].'</b></li>' ;
        echo ftwofenlei($row['ID'],$cstr,$db_conn);
        echo '</ul>';
      }
}

// 后台权限栏目 
function ftwofenlei($pid,$cstr,$db_conn){
    $query=$db_conn->query("select * from sc_categories where  category_pid=$pid");
    while($row=mysqli_fetch_array($query)){
         if (strpos($cstr,$row['ID'])!==false){
            $che=' checked="checked"';  
        }else{
            $che="";   
        }
        echo '<li><input type="checkbox" name="ID[]" id="ID[]" value="'.$row['ID'].'" '.$che.'  />'.$row['category_name'].'</li>' ;
    }
}

// 语种权限
function flanguagefenlei($cstr,$db_conn){ 
    $query=$db_conn->query("select * from sc_language");      
    while($row=mysqli_fetch_array($query)){
        if (strpos($cstr,$row['language_url'])!==false){
           $che=' checked="checked"';
        }else{
           $che="";  
        }
        echo '<li><input type="checkbox" name="ID[]" id="ID[]" value="'.$row['language_url'].'"  '.$che.'  />'.$row['language_cname'].'</li>' ; 
    }   
}

function allproducts($Language,$db_conn){
    $indexpros="";
    $queryx=$db_conn->query("select * from  sc_products where languageID=$Language and products_zt=1  order by ID desc");
    while ($row = mysqli_fetch_array($queryx)) {
        $Imgs = explode(",", $row['products_Images']);
        $Imgs = str_replace("Images/prdoucts", "Images/prdoucts/small", $Imgs[0]);
        $indexpros.="<tr><td><img src='" . str_replace("../", "../", $Imgs) . "' alt='" . $row['products_name'] . "' width='50'></a></td><td>" . $row['products_name'] . "</td><td><input type='checkbox' name='AID[]' id='AID[]' value='".$row['ID']."' /></td></tr>";
    }
    return $indexpros; 
}


//筛选调用产品分类ID
function prolmid($ID,$db_conn){  
    $str="";
    $strs=""; 
    $query=$db_conn->query("select ID from sc_categories where LOCATE(',".$ID.",', category_path)>0 and category_open=1");
    while($row=mysqli_fetch_array($query)){  
      $str.= "LOCATE(',".$row['ID'].",', products_category)>0 or ";
    } 
      $strs ="(".rtrim($str,"or ").")";
      return $strs;
}


// 生成 google xml
function xmltogoogle($Language,$web_url,$db_conn){
    $htopen=ChecInfo("sc_config","ID",1,"f","web_jtopen",$db_conn);
    define("htmlopen",$htopen);
    $nav_xml="";$cate_xml="";$pro_xml="";$new_xml="";
    //取导航链接
    $hchx=chr(13).chr(10);
    $query=$db_conn->query("select * from sc_menu where languageID=$Language order by  menu_paixu asc,ID asc");
    while($row=mysqli_fetch_array($query)){
        if (strlen($row['menu_link'])<2){
            $linkurl=str_replace("/", "", $row['menu_link']);
            $linkurl=UrltoHtmlNav($linkurl);
        }else{
            $linkurl=UrltoHtmlNav($row['menu_link']);
        }
       $nav_xml.="<url>".$hchx;
       $nav_xml.='<loc>'.$web_url.$linkurl.'</loc>'.$hchx;
       $nav_xml.='<changefreq>always</changefreq>'.$hchx;
       $nav_xml.='<priority>1.0</priority>'.$hchx;
       $nav_xml.="</url>".$hchx;
     }
     
   //取产品分类链接
  
    $query=$db_conn->query("select * from sc_categories where languageID=$Language  and category_path like '%0,1,%' and ID >1 and category_open=1 order by ID asc");
    while($row=mysqli_fetch_array($query)){
        if ($htopen==1){
            $linkurl=trim($row['category_url'])==""? $row['ID']."/" : $row['category_url']."/";
        }else{
           $linkurl="product.php?ID=".$row['ID'];
        }
       $cate_xml.="<url>".$hchx;
       $cate_xml.='<loc>'.$web_url.$linkurl.'</loc>'.$hchx;
       $cate_xml.='<changefreq>always</changefreq>'.$hchx;
       $cate_xml.='<priority>1.0</priority>'.$hchx;
       $cate_xml.="</url>".$hchx;
     }
     
   //取产品链接 
    $query=$db_conn->query("select * from sc_products where languageID=$Language order by ID asc");
    while($row=mysqli_fetch_array($query)){
        if ($htopen==1){           
            $linkurl=trim($row['products_url'])==""? $row['ID'].".html" : $row['products_url'].".html";
        }else{
           $linkurl="view.php?ID=".$row['ID'];
        }      
       $pro_xml.="<url>".$hchx;
       $pro_xml.='<loc>'.$web_url.$linkurl.'</loc>'.$hchx;
       $pro_xml.='<changefreq>always</changefreq>'.$hchx;
       $pro_xml.='<priority>1.0</priority>'.$hchx;
       $pro_xml.="</url>".$hchx;
     }
     
 //取新闻信息链接
     
    $lmid=ChecInfo("sc_categories","category_url","About","l","ID",$db_conn);
    $query=$db_conn->query("select * from sc_info where languageID=$Language and info_lanmu <> $lmid order by ID asc");
    while($row=mysqli_fetch_array($query)){
         if ($htopen==1){           
            $linkurl=trim($row['info_url'])==""? "news/".$row['ID'].".html" : "news/".$row['info_url'].".html";
        }else{
           $linkurl="info.php?ID=".$row['ID'];
        }
       $new_xml.="<url>".$hchx;
       $new_xml.='<loc>'.$web_url.$linkurl.'</loc>'.$hchx;
       $new_xml.='<changefreq>always</changefreq>'.$hchx;
       $new_xml.='<priority>0.8</priority>'.$hchx;
       $new_xml.="</url>".$hchx;
     } 
     $item=$nav_xml.$cate_xml.$pro_xml.$new_xml;
     return $item;
}

//分页

function show_page($count,$page,$page_size){
    $page_count  = ceil($count/$page_size);  //计算得出总页
    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;
    //判断当前页码
    $page=(empty($page)||$page<0)?1:$page;
    //获取当前页url
    $url = $_SERVER['REQUEST_URI'];
    //去掉url中原先的page参数以便加入新的page参数
    $parsedurl=parse_url($url);
    $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
    if($url_query != ''){
        $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
        $url = str_replace($parsedurl['query'],$url_query,$url);
        if($url_query != ''){
            $url .= '&';
        }
    } else {
        $url .= '?';
    }
    //分页功能代码
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移 
    $navs='';
    if($pages != 0){
        if($page!=1){
            //$navs.="<a href=\"".$url."page=1\">首页</a> ";        //第一
            $navs.="<a href=\"".$url."page=".($page-1)."\">前一页</a>"; //上一 
        } else {
           // $navs .= "<span class='disabled'>首页</span>";
            $navs .= "";
        } 
        if($pages>$page_len)
        {
            //如果当前页小于等于左偏移
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;
            }
            else  //如果当前页大于左偏移
            {    
                //如果当前页码右偏移超出最大分页数
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }
                else
                {
                    //左右偏移都存在时的计�?
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++)
        {
            if($i==$page){$navs.="<span class='current'>".$i.'</span>';} 
            else {$navs.=" <a href=\"".$url."page=".$i."\">".$i."</a>";}
        }
        if($page!=$pages)
        {
            $navs.=" <a href=\"".$url."page=".($page+1)."\">下一页</a> ";//下
           // $navs.="<a href=\"".$url."page=".$pages."\">末页</a>";    //后
        } else {
            $navs .= "";
           // $navs .= "<span class='disabled'>末页</span>";
        }
        echo "$navs";
   }
}

 //产品分页函数
function pshow_page($count,$page,$page_size,$Searchp,$flID){

    $page_count  = ceil($count/$page_size);  //计算得出总页�?
 
    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;
 
    //判断当前页码
    $page=(empty($page)||$page<0)?1:$page;
    //获取当前页url
    $url = $_SERVER['REQUEST_URI'];
    //去掉url中原先的page参数以便加入新的page参数
    $parsedurl=parse_url($url);
    $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
    if($url_query != ''){
        $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
        $url_query = preg_replace("/(^|&)searchml=$flID/",'',$url_query);
        $url_query = preg_replace("/(^|&)search=$Searchp/",'',$url_query);
        $url = str_replace($parsedurl['query'],$url_query,$url);
        if($url_query != ''){
            $url .= '&';
        }
    } else {
        $url .= '?';
    }
    $url=  str_replace("&err=001", "", $url);
    //分页功能代码
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移 
 
    $navs='';
    if($pages != 0){
        if($page!=1){
             $navs.="<a href=\"".$url."page=1\">首页</a> ";        //第一
            $navs.="<a href=\"".$url."page=".($page-1)."&searchml=".$flID."&search=".$Searchp."\">前一页</a>"; //上一 
        } else {
           // $navs .= "<span class='disabled'>首页</span>";
            $navs .= "";
        }
        if($pages>$page_len)
        {
            //如果当前页小于等于左偏移
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;
            }
            else  //如果当前页大于左偏移
            {    
                //如果当前页码右偏移超出最大分页数
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }
                else
                {
                    //左右偏移都存在时的计�?
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++)
        {
            if($i==$page){$navs.="<span class='current'>".$i.'</span>';} 
            else {$navs.=" <a href=\"".$url."page=".$i."&searchml=".$flID."&search=".$Searchp."\">".$i."</a>";}
        }
        if($page!=$pages)
        {
            $navs.=" <a href=\"".$url."page=".($page+1)."&searchml=".$flID."&search=".$Searchp."\">下一页</a> ";//下一
            $navs.="<a href=\"".$url."page=".$pages."\">末页</a>";    // 
        } else {
            $navs .= "";
           // $navs .= "<span class='disabled'>末页</span>";
        }
        echo "$navs";
   }
}

//模版应用
function Mbapp($mb,$lujin,$mblujin,$dirpaths,$htmlopen){
       if ($htmlopen==1){$ml="j";}else{$ml="d";}
        $template="index.php,hta/".$ml."/.htaccess"; //开始应用模版
        $template_mb=explode(",",$template);
        for($i=0;$i<count($template_mb);$i++){
              $template_o = file_get_contents($mblujin.'Templete/'.$mb.'/Include/'.$template_mb[$i]);
              $templateUrl = $lujin.str_replace("hta/".$ml."/","", $template_mb[$i]);
              $output = str_replace('<{Template}>', $mb, $template_o);
              $output = str_replace('<{dirpaths}>', $dirpaths, $output);
              file_put_contents($templateUrl, $output);
           }
}

//使用如下类就可以生成图片缩略图,
class resizeimages
{
    //图片类型
    var $type;
    //实际宽度
    var $width;
    //实际高度
    var $height;
    //改变后的宽度
    var $resize_width;
    //改变后的高度
    var $resize_height;
    //是否裁图
    var $cut;
    //源图象
    var $srcimg;
    //目标图象地址
    var $dstimg;
    //临时创建的图象
    var $im;
 
    function resizeimage($img, $wid, $hei,$c,$dstpath)
    {
        $this->srcimg = $img;
        $this->resize_width = $wid;
        $this->resize_height = $hei;
        $this->cut = $c;
        //图片的类型
    
$this->type = strtolower(substr(strrchr($this->srcimg,"."),1));
 
        //初始化图象
        $this->initi_img();
        //目标图象地址
        $this -> dst_img($dstpath);
        //--
        $this->width = imagesx($this->im);
        $this->height = imagesy($this->im);
        //生成图象
        $this->newimg();
        ImageDestroy ($this->im);
    }
    function newimg()
    {
        //改变后的图象的比例
        $resize_ratio = ($this->resize_width)/($this->resize_height);
        //实际图象的比例
        $ratio = ($this->width)/($this->height);
        if(($this->cut)=="1")
        //裁图
        {
            if($ratio>=$resize_ratio)
            //高度优先
            {
                $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio)
            //宽度优先
            {
                $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width)/$resize_ratio));
                ImageJpeg ($newimg,$this->dstimg);
            }
        }
        else
        //不裁图
        {
            if($ratio>=$resize_ratio)
            {
                $newimg = imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, ($this->resize_width)/$ratio, $this->width, $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio)
            {
                $newimg = imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($this->resize_height)*$ratio, $this->resize_height, $this->width, $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
        }
    }
    //初始化图象
    function initi_img()
    {
        if($this->type=="jpg")
        {
            $this->im = imagecreatefromjpeg($this->srcimg);
        }
        if($this->type=="gif")
        {
            $this->im = imagecreatefromgif($this->srcimg);
        }
        if($this->type=="png")
        {
            $this->im = imagecreatefrompng($this->srcimg);
        }
    }
    //图象目标地址
    function dst_img($dstpath)
    {
        $full_length  = strlen($this->srcimg);
 
        $type_length  = strlen($this->type);
        $name_length  = $full_length-$type_length;
 
 
        $name         = substr($this->srcimg,0,$name_length-1);
        $this->dstimg = $dstpath;
 
 
//echo $this->dstimg;
    }
}


?>



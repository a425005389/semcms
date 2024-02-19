<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */	

if (isset($_GET["ID"])){$ID=test_input(verify_str($_GET["ID"]));}else{$ID="";}
if (isset($_GET["page"])){$page=test_input(verify_str($_GET["page"]));}else{$page="";} 
if (isset($_POST["search"])){

  $search=test_input(verify_str($_POST["search"]));
  $search = str_replace("_", "\_", $search); 
  $search = str_replace("%", "\%", $search); 

}else{

    $search="";

}


//网站 导航

function web_nav($Language,$web_url,$db_conn){
    $nav="";
    $query=$db_conn->query("select * from sc_menu where languageID=$Language  order by  menu_paixu asc,ID asc");

    while($row=mysqli_fetch_array($query)){

       if (strlen($row['menu_link'])<2){

           $linkurl=str_replace("/", "", $row['menu_link']);

        }else{

             $linkurl=$row['menu_link'];  

        }
 
        $nav.='<li><a href="'.$web_url.UrltoHtmlNav($linkurl).'">'.$row['menu_name'].'</a></li> ';

     }

     return datato($nav);  
}


//banner

function web_banner($Language,$db_conn,$web_url_meate,$flg){ //banner

    $banners="";
    $query=$db_conn->query("select * from sc_banner where languageID=$Language and banner_fenlei='$flg' order by  banner_paixu asc,ID asc");
    Panduan(mysqli_num_rows($query));

    while($row=mysqli_fetch_array($query)){
          $banners.= '<div class="swiper-slide"><a href="'.$row['banner_url'].'"><img src='.$web_url_meate.str_replace('../','',$row['banner_image']).' alt="wholesale pet supplies" loading="lazy" /></a></div> ';
     }

     return $banners;
}

//友情链接

function web_link($Language,$db_conn,$tag_link){

    $link="";
    $query=$db_conn->query("select * from sc_link where languageID=$Language  order by  link_paixu asc,ID asc");
    if(mysqli_num_rows($query)>0){

    while($row=mysqli_fetch_array($query)){

          $link.='<span><a href="'.$row['link_url'].'">'.$row['link_name'].'</a></span> ';

     }

    return "<div class='sc_link'>".$tag_link." : ".datato($link)."</div>";

    }

     
}


//语言汇总

function web_language($web_url,$db_conn){
    
    $lge="";
    $query=$db_conn->query("select * from sc_language where language_open=1  order by language_paixu asc,ID asc");

   if (mysqli_num_rows($query)>1){

    while($row=mysqli_fetch_array($query)){

        if ($row['language_mulu']==1){//判断根目录网站

             $lge.= '<span><a href="'.$web_url.'"><img src="'.$web_url.str_replace('../','',$row['language_Image']).'" align="absmiddle">'.$row['language_ename'].'</a></span> ';

        }else{

             $lge.= '<span><a href="'.$web_url.$row['language_url'].'/"><img src="'.$web_url.str_replace('../','',$row['language_Image']).'" align="absmiddle">'.$row['language_ename'].'</a></span> ';    
        }
     }

     return datato('<div class="sc_top_conment_1_left">'.$lge.'</div>'); 
  }
}


   
// 网站产品分类
   
function get_str($id,$lgid,$web_url,$db_conn) { //无限分类

    //global $str; 
    $str="";
    $result=$db_conn->query("select * from sc_categories where category_pid= $id and languageID=$lgid and category_open=1 order by category_paixu,ID asc");
   
    if($result){
       
        while ($row = mysqli_fetch_array($result)) { //循环记录集 
            
            $str .= "<li><a href='".$web_url.UrltoHtml($row['ID'],$row['category_url'],"pl")."'>".$row['category_name']."</a>".get_str2($row['ID'],$web_url,$db_conn); 
            $str .= '</li>'; 
    } 
    if($str==""){

        $str="<li>Empty!</li>";

    }else{

      $str=$str;

    }

      return datato($str); 
    } 
}

function get_str2($ids,$web_url,$db_conn) { //无限

    $str2="";
    $results = $db_conn->query("select * from sc_categories where category_pid=$ids and category_open=1 order by category_paixu,ID asc");//查询pid的子类的分类 
    
    if($results){//如果有子类 
        
        while ($row = mysqli_fetch_array($results)) { //循环记录集 
            
              $str2 .= "<li><a href='".$web_url.UrltoHtml($row['ID'],$row['category_url'],"pl")."'>".$row['category_name']."</a>".get_str2($row['ID'],$web_url,$db_conn)."</li>"; 
 
             } 
        if($str2==""){

            $str2=" ";

        }else{

          $str2="<ul>".$str2."</ul>";

        }

        return datato($str2); 
      } 
}
  

// 首页产品推荐 与 //首页新产品

function indexpro($str,$Language,$tag_inquiry,$web_url,$weblist,$db_conn,$web_url_meate){

    $indexpros = "";

    if($str == "tj"){

        $sql = "select * from  sc_products where languageID=$Language and products_zt=1 and products_index=1 order by  products_paixu asc, ID asc limit $weblist ";
        $querys = $db_conn->query($sql);
        if(mysqli_num_rows($querys)>0){
          $sql = "select * from  sc_products where languageID=$Language and products_zt=1 and products_index=1 order by  products_paixu asc, ID asc limit $weblist ";
        }else{
          $sql = "select * from  sc_products where languageID=$Language and products_zt=1  order by   ID desc limit $weblist "; 
        }

    } else {

        $sql = "select * from  sc_products where languageID=$Language and products_zt=1  order by   ID desc limit $weblist ";
    }

    $query = $db_conn->query($sql);
    Panduan(mysqli_num_rows($query));

    while($row = mysqli_fetch_array($query)){

        $Imgs = explode(",", $row['products_Images']);
        $Imgs =$web_url_meate . str_replace("Images/prdoucts", "Images/prdoucts/small", $Imgs[0]);

        if ($str == "tj") {

            $indexpros.="<div><ul><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'><img src='" . str_replace("../", "", $Imgs) . "' alt='" . $row['products_name'] . "' loading='lazy'></a></li><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $row['products_name'] . "</a></li><li><span class='inq'><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $tag_inquiry . "</a></span></li></ul></div>";
        
        }else {

            $indexpros.="<div><ul><dt><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'><img src='" . str_replace("../", "", $Imgs) . "' alt='" . $row['products_name'] . "' loading='lazy' ></a></dt><dd><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $row['products_name'] . "</a></dd><dd><span class='inq'><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $tag_inquiry . "</a></span></dd></ul></div>";
        }
    }

    return datato($indexpros);
}



//网站尾部信息[关于我们]

function wbabout($str,$Language,$web_url,$db_conn){
    
         $lanmuid=checkinfos($str,$Language,$db_conn);
         $aboulm="";
         $query=$db_conn->query("select * from sc_info where languageID=$Language and info_lanmu=$lanmuid");
        if ($query){
         while($row=mysqli_fetch_array($query)){
 
            $aboulm.="<li><a href='".$web_url.UrltoHtml($row['ID'],$row['info_url'],"ab")."'>". $row['info_title']."</a></li>";
         }
        }
         return datato($aboulm);
}

//产品栏目

function wbpro($Language,$web_url,$db_conn){

         $wbpro="";
         $query=$db_conn->query("select * from sc_categories where languageID=$Language and category_pid=1 and category_open=1 order by category_paixu,ID asc limit 5 ");

         while($row=mysqli_fetch_array($query)){
 
            $wbpro.="<li><a href='".$web_url.UrltoHtml($row['ID'],$row['category_url'],"pl")."'>". $row['category_name']."</a></li>";
         }
        
        return datato($wbpro); 
}

//联系方式

function wbcontact($webemail,$webskype,$webwathsapp,$web_url){ 
    
    $wbcontact="<li><img src='".$web_url."Images/default/Emailb.png' align='absmiddle'> <a href='mailto:".$webemail."'>".$webemail."</a></li><li><img src='".$web_url."Images/default/skypeb.png' align='absmiddle'> <a href='skype:".$webskype."?chat'>".$webskype."</a></li><li><img src='".$web_url."Images/default/Whatsappb.png' align='absmiddle'> <a href='javascript:;'>".$webwathsapp."</a></li>";
    return $wbcontact;
}

//分享

function wbfollowus($webshare){ 
    
    $wbfollow=$webshare;
    return datato($wbfollow);
}


function  downloadfile($Language,$web_url,$tag_download,$db_conn,$web_url_meate){ //1)资料下载
    
         $aboulm="";
         $query=$db_conn->query("select * from sc_download where languageID=$Language order by down_paixu asc ,ID asc");

         while($row=mysqli_fetch_array($query)){
            
            $kzm=explode(".",$row['down_file']);
            
            if (end($kzm)=="xls" ||  end($kzm)=="xlsx" ){

                $img="<img src='".$web_url_meate."Images/default/excel.png' width='30' alt='excel'>";

            }elseif(end($kzm)=="zip" ||  end($kzm)=="rar" ){

             $img="<img src='".$web_url_meate."Images/default/zip.png' width='30' alt='rar,zip'>";   

            }elseif(end($kzm)=="pdf"){

             $img="<img src='".$web_url_meate."Images/default/pdf.png' width='30' alt='pdf'>";  

            }else{

            $img="<img src='".$web_url_meate."Images/default/other.png' width='30' alt='other'>"; 

            }
             
            $aboulm.="<ul><li class='sc_d1'>$img</li><li class='sc_d2'>".$row['down_name']."</li><li class='sc_d3'><a href='".$web_url_meate.str_replace("../","",$row['down_file'])."'>$tag_download</a></li></ul>";
         }
        
         return datato($aboulm); 
}

//新闻栏目

function wbnews($Language,$web_url,$db_conn){

         $wbnews="";
         $query=$db_conn->query("select * from sc_categories where languageID=$Language and category_pid=2 and category_open=1 and category_url<>'About'");

         while($row=mysqli_fetch_array($query)){
 
            $wbnews.="<li><a href='".$web_url.UrltoHtml($row['ID'],$row['category_url'],"ne")."'>". $row['category_name']."</a></li>";
         }
        
         return datato($wbnews); 
}

function CheckAbID($db_conn,$Language){

            $query=$db_conn->query("select ID from sc_categories where languageID=$Language and category_pid=2 and category_open=1 and category_url='About'"); 
             while($row=mysqli_fetch_array($query)){

                return $row['ID'];
             }
}



function Neper($db_conn,$Language,$id,$tp,$web_url){

      $AbID= CheckAbID($db_conn,$Language);
       $prne="";
   
      if($tp=="ne"){
      $query=$db_conn->query("select ID,info_url,info_title from sc_info where languageID=$Language and   info_lanmu<>$AbID and ID > $id limit 1"); 
       $arro=' > ';
       }else{
        $query=$db_conn->query("select ID,info_url,info_title from sc_info where languageID=$Language and   info_lanmu<>$AbID and ID < $id  order by ID desc limit 1"); 
        $arro=' < ';
        }
            
             while($row=mysqli_fetch_array($query)){

              $prne="<li>".$arro."<a  href='".$web_url.UrltoHtml($row['ID'],$row['info_url'],"nv")."'>".$row['info_title']."</a></li>";
             }

              return datato($prne); 
}


//首页新闻

function indexwbnews($Language,$web_url,$db_conn,$web_url_meate){

         $indexnews="";
         $query=$db_conn->query("select * from sc_categories where languageID=$Language and category_pid=2 and category_open=1 and category_url<>'About'");

         while($row=mysqli_fetch_array($query)){

             $querys=$db_conn->query("select * from sc_info where languageID=$Language and info_lanmu=".$row['ID']." order by ID desc limit 6");

             while($rows=mysqli_fetch_array($querys)){
     
                $indexnews.="<div class='sc_index_new'><ul><li class='sc_indexnewli'><a href='".$web_url.UrltoHtml($rows['ID'],$rows['info_url'],"nv")."'><img src='".$web_url_meate.str_replace("../", "",$rows['info_image'])."' loading='lazy' ></a></li><li><a href='".$web_url.UrltoHtml($rows['ID'],$rows['info_url'],"nv")."'>". $rows['info_title']."</a></li></ul></div>";
                
             }           

         }
        
         return datato($indexnews); 
}


//产品总列表页面
 
// 查询所有分类的ID【共用】

function prolmid($Language,$ID,$db_conn){

    $str="";$strs="";
    $query=$db_conn->query("select * from sc_categories where category_path like '%,".$ID.",%' and languageID=$Language and category_open=1");
    Panduan(mysqli_num_rows($query));

    while($row=mysqli_fetch_array($query)){   
        
          $str.= "products_category like '%,".$row['ID'].",%' or ";

    } 
         $strs ="(".$str."products_category like '%,".$ID.",%')";

    return $strs;
}

// 产品列表

function productslist($Language,$tag_inquiry,$web_url,$tag_more,$db_conn,$web_url_meate) {
    
    //显示每个栏目下的3个产品

    $indexpros = "";$indexprost="";
    $query_p=$db_conn->query("select * from sc_categories where category_pid=1 and languageID=$Language and category_open=1  order by  category_paixu asc,ID asc ");
    Panduan(mysqli_num_rows($query_p));

    while($row=mysqli_fetch_array($query_p)){
      
        $lmID=prolmid($Language,$row['ID'],$db_conn);
        $protitle='<div class="sc_mid_c_right_title">'.$row['category_name'].'<span class="more"><a href="'.$web_url.UrltoHtml($row['ID'],$row['category_url'],"pl").'">'.$tag_more.'</a></span></div>';
     
        // 以下是产品信息
       
        $query= $db_conn->query("select * from  sc_products where languageID=$Language and products_zt=1 and  $lmID order by  products_paixu asc, ID asc limit 4");
        Panduan(mysqli_num_rows($query));
        while ($row = mysqli_fetch_array($query)) {

            $Imgs = explode(",", $row['products_Images']);
            $Imgs = $web_url_meate . str_replace("Images/prdoucts", "Images/prdoucts/small", $Imgs[0]);
     
                $indexpros.="<div><ul><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'><img src='" . str_replace("../", "", $Imgs) . "' alt='" . $row['products_name'] . "' loading='lazy' ></a></li><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $row['products_name'] . "</a></li><li><span class='inq'><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $tag_inquiry . "</a></span></li></ul></div>";
            
           }
           
        $indexprost =$protitle.'<div class="sc_pro">'.$indexpros.'</div>';
        echo datato($indexprost);
        $indexpros="";
     }
    
    //return $indexprost;
}



// 产品列表，获取相应的ID 列出产品

function productslistp($Language,$tag_inquiry,$web_url,$tag_more,$ID,$webplist,$db_conn,$web_url_meate){

    $indexpros="";$indexprost="";

     if (is_numeric($ID)){
   
        $query_p=$db_conn->query("select * from sc_categories where ID=$ID and languageID=$Language and category_open=1");

    }else{

        $query_p=$db_conn->query("select * from sc_categories where category_url='".$ID."' and languageID=$Language and category_open=1");
        
    }
    
    goto404(mysqli_num_rows($query_p));
    $row=mysqli_fetch_array($query_p);
    $lmID=prolmid($Language,$row['ID'],$db_conn);

    $protitle='<div class="sc_mid_c_right_title">'.$row['category_name'].'</div>';

     $sql=$db_conn->query("select * from sc_products where languageID=$Language and products_zt=1 and  $lmID");     
     $all_num=mysqli_num_rows($sql); //总条数
     $page_num=$webplist; //每页条数
     $page_all_num = ceil($all_num/$page_num); //总页数
     $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
     $page=(int)$page; //安全强制转换
     $limit_st = ($page-1)*$page_num; //起始数
    
 
    $query=$db_conn->query("select * from sc_products where languageID=$Language and products_zt=1 and  $lmID order by products_paixu asc, ID asc limit $limit_st,$page_num ");
    Panduan(mysqli_num_rows($query));
    while($row=mysqli_fetch_array($query)){
        
        $Imgs = explode(",", $row['products_Images']);
        $Imgs = $web_url_meate . str_replace("Images/prdoucts", "Images/prdoucts/small", $Imgs[0]);
        $indexpros.="<div><ul><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'><img src='" . str_replace("../", "", $Imgs) . "' alt='" . $row['products_name'] . "' loading='lazy' ></a></li><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $row['products_name'] . "</a></li><li><span class='inq'><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $tag_inquiry . "</a></span></li></ul></div>";
    }
       $indexprost =$protitle.'<div class="sc_pro">'.$indexpros.'</div>';

       if ($page_all_num>1){
  
         $fy="<div class='sc_mid_c_right_fy'>Total products ".$all_num.show_page($all_num,$page,$page_num)."</div>";
         
        }else{

          $fy="";
        }
       
    echo datato($indexprost).$fy;
 }
 

 //分页函数

function show_page($count,$page,$page_size){

    $page_count  = ceil($count/$page_size);  //计算得出总页 
    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;
    $page=(empty($page)||$page<0)?1:$page;
    $url = $_SERVER['REQUEST_URI'];

if (htmlopen==0){

    $parsedurl=parse_url($url);
    $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
    if($url_query != ''){
        $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
        $url = str_replace($parsedurl['query'],$url_query,$url);
        if($url_query != ''){

            $url .= '&';
           }
      }else{

        $url .= '?';
    }

    $page_len = ($page_len%2)?$page_len:$page_len+1;
    $pageoffset = ($page_len-1)/2;
 
    $navs='';
    if($pages != 0){
        if($page!=1){

          if($page==2){$navs.="<a href=\"".str_replace("&", "", $url)."\"> < </a>"; }else{$navs.="<a href=\"".$url."page=".($page-1)."\"> < </a>"; }

        } else {
            $navs .= "";
        }
        if($pages>$page_len){

            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;

            }else{

                if($page+$pageoffset>=$pages+1){

                    $init = $pages-$page_len+1;

                }else{

                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++)
        {
            if($i==$page){$navs.="<span class='current'>".$i.'</span>';} 
            else {
              if ($i==1){$navs.=" <a href=\"".str_replace("&", "", $url)."\">".$i."</a>";}else{$navs.=" <a href=\"".$url."page=".$i."\">".$i."</a>";}
              

            }
        }
        if($page!=$pages)
        {
            $navs.=" <a href=\"".$url."page=".($page+1)."\"> > </a> "; 
            
        } else {
            $navs .= "";
            
        }
        return " $navs";
   }


}else{

    $url=substr($url,0,strlen($url)-1); 
    $url=explode("_",$url);
    $url=$url[0];
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移 

    $navs='';
    if($pages != 0){
        if($page!=1){

            if($page==2){$navs.="<a href=\"".$url."/\"> < </a>"; }else{$navs.="<a href=\"".$url."_".($page-1)."/\"> < </a>"; }

        } else {
            $navs .= "";
        }
        if($pages>$page_len){
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;

            }else{    
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }
                else
                {
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++){

            if($i==$page){$navs.="<span class='current'>".$i.'</span>';} 

            else {

           if ($i==1){$navs.=" <a href=\"".str_replace("&", "", $url)."/\">".$i."</a>";}else{$navs.=" <a href=\"".$url."_".$i."/\">".$i."</a>";}
       
          }

        }
        if($page!=$pages){

            $navs.=" <a href=\"".$url."_".($page+1)."/\"> > </a> ";

        }else{

            $navs .= "";

        }
        return " $navs";
   }

  }

}

// 栏目层次

function lamcc($Language,$ID,$web_url,$db_conn){
 
   $strs="";
   $ID=rtrim($ID,",");
   $ID=ltrim($ID,",");
  // echo $ID;
    if (strpos($ID,"rand")!== false){//判断是否自定义随机产品
          $ID=explode("rand", $ID);
          $ID=explode(",",$ID[1]);
          $ID=end($ID);
          $sql="select * from sc_categories where ID =$ID and languageID=$Language and category_open=1";       
    }else{

       if (is_numeric($ID)){
            
         $sql="select * from sc_categories where ID =$ID and languageID=$Language and category_open=1";   
        }else{

          $sql="select * from sc_categories where category_url ='".$ID."' and languageID=$Language and category_open=1";     
        }     

    }

    $query=$db_conn->query($sql);

    goto404(mysqli_num_rows($query));
    while($row=mysqli_fetch_array($query)){   
 
      $str=substr(str_replace("0,1,","",$row['category_path']),0,-1);//去最后一个,号
    } 
    
    $arr = explode(",",$str);//分割
    foreach($arr as $u){
        
    $query=$db_conn->query("select * from sc_categories where ID =$u and category_open=1");
    Panduan(mysqli_num_rows($query));
    while($row=mysqli_fetch_array($query)){   
        
        $strs.="<a href='".$web_url.UrltoHtml($row['ID'],$row['category_url'],"pl")."'>".$row['category_name']."</a> > ";
     
        }      
    
    }
    $strs=substr($strs,0,-2);//去除最后两位
    return $strs;
}


//详细页面参数调用

function proview($ID,$ziduan,$web_url,$db_conn,$web_url_meate){

    $str2="";
    if(is_numeric($ID)){// 判读获取的ID 是否自定义

        $query=$db_conn->query("select * from sc_products where ID =$ID ");  

    }else{

        $query=$db_conn->query("select * from sc_products where  products_url='".$ID."' ");     
    }

        goto404(mysqli_num_rows($query));
        $row=mysqli_fetch_array($query);

        if($ziduan=="products_Images"){

            $strs= explode(",",$row[$ziduan]);
            $str1= "<div class='sc_mid_proview_1_left_1'><img src='".$web_url_meate.str_replace("../","",$strs[0])."' alt='".$row['products_name']."' loading='lazy' /></div>";

            foreach($strs as $st){

               if ($st!==""){ 

                  $str2.= " <div class=\"swiper-slide\"><img src='".$web_url_meate.str_replace("../","",$st)."' alt='".$row['products_name']."' loading='lazy' /> </div>";   
                
                }

            }        
  
        

            $str = $str2;
            //$str=$str1."<div class='sc_mid_proview_1_left_2'>".$str2."</div> ";

        }elseif($ziduan=="products_category"){

               $products_xiangguan=trim($row['products_xiangguan']);//判断是否自定义随机产品

            if (strlen($products_xiangguan)>0){

               $str= $products_xiangguan."rand".$row[$ziduan];  

            }else{

                  $str=ltrim($row[$ziduan],",");
                  $str=rtrim($str,",");
                  $str=explode(",",$str); 
                  $str=end($str);   
            }
            
        }else{

 

          $str=array('products_metatit'=>datato($row['products_metatit']),'products_name'=>datato($row['products_name']),'products_key'=>datato($row['products_key']),'products_des'=>datato($row['products_des']),'products_guige'=>datato($row['products_guige']),'products_model'=>datato($row['products_model']),'products_content'=>datato($row['products_content']),'products_aurl'=>datato($row['products_aurl']),'ID'=>datato($row['ID']));

        }
  
        return $str;
    
}

// 随机产品
 
function sjpro($Language,$tag_inquiry,$ID,$web_url,$db_conn,$web_url_meate){

    $indexpros = "";
    if (strpos($ID,"rand")!== false){//判读随机产品是否后台选择的

        $ID= explode("rand", $ID);

    $queryx = $db_conn->query("select * from  sc_products where languageID=$Language and products_zt=1 and ID in ($ID[0])"); 

    }else{

    $queryx = $db_conn->query("select * from  sc_products where languageID=$Language and products_zt=1 and products_category like '%".$ID."%' order by RAND() limit 4 ");   
    
    }
    
    Panduan(mysqli_num_rows($queryx));

    while ($row = mysqli_fetch_array($queryx)) {

        $Imgs = explode(",", $row['products_Images']);
        $Imgs = $web_url_meate. str_replace("Images/prdoucts", "Images/prdoucts/small", $Imgs[0]);
    
            $indexpros.="<div><ul><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'><img src='" . str_replace("../", "", $Imgs) . "' alt='" . $row['products_name'] . "' loading='lazy' ></a></li><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $row['products_name'] . "</a></li></ul></div>";
  
    }
    return datato($indexpros);
}

// 新闻信息调用


function infoview($ID,$db_conn,$Language){

    
   if(is_numeric($ID)){// 判读获取的ID 是否自定义

        $query=$db_conn->query("select * from sc_info where ID=$ID");

    }else{

        $query=$db_conn->query("select * from sc_info where  info_url='".$ID."' and languageID=".$Language);     
    }

    goto404(mysqli_num_rows($query));
    $row=mysqli_fetch_assoc($query);
    $Nav=array('info_title'=>datato($row['info_title']),'info_keywords'=>datato($row['info_keywords']),'info_des'=>datato($row['info_des']),'info_content'=>datato($row['info_content']),'info_lanmu'=>$row['info_lanmu'],'ID'=>$row['ID']);

    return $Nav;  
 
}
 

 // 新闻信息列表


function newslist($Language,$web_url,$ID,$tag_news,$webnlist,$db_conn,$web_url_meate){

 $indexpros="";$indexprost="";
 
 if ($ID!==""){// 新闻信息总列表
     
      if(is_numeric($ID)){
          $query_p=$db_conn->query("select * from sc_categories where ID=$ID and category_open=1");
      }else{
       $query_p=$db_conn->query("select * from sc_categories where category_url='".$ID."' and category_open=1"); 
      }

    goto404(mysqli_num_rows($query_p));

    while($row=mysqli_fetch_array($query_p)){

        $protitle='<div class="sc_mid_c_right_title">'.$row['category_name'].'</div>';
        $IDl=$row['ID'];

    }

        $sql=$db_conn->query("select * from sc_info where languageID=$Language and info_lanmu=$IDl"); 

 }else{

     $protitle='<div class="sc_mid_c_right_title">'.$tag_news.'</div>';
     $lanmuid=checkinfos("About",$Language,$db_conn);

     $sql=$db_conn->query("select * from sc_info where languageID=$Language and info_lanmu<>$lanmuid");    
 }
 
     $all_num=mysqli_num_rows($sql); //总条数
     $page_num=$webnlist; //每页条数
     $page_all_num = ceil($all_num/$page_num); //总页数
     $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
     $page=(int)$page; //安全强制转换
     $limit_st = ($page-1)*$page_num; //起始数

  if ($ID!==""){// 新闻信息总列表

      $sql="select  * from  sc_info where languageID=$Language and info_lanmu=$IDl order by ID desc limit $limit_st,$page_num ";

  }else{
      
     $sql="select  * from  sc_info where languageID=$Language and info_lanmu<>$lanmuid order by ID desc limit $limit_st,$page_num ";  
  }
    
    $query=$db_conn->query($sql);
    Panduan(mysqli_num_rows($query));
    while($row=mysqli_fetch_array($query)){
 
         if (strpos($row['info_image'],"Images/default/")==true){

           $nimg=$row['info_image'];  

         }else{

           $nimg="Images/default/logo.png";  

         }

        $indexpros.="<li><div class='sc_mid_c_right_new_d_1'><a href='".$web_url.UrltoHtml($row['ID'],$row['info_url'],"nv")."'><img src='".$web_url_meate.str_replace("../","",$nimg)."' loading='lazy' /></a></div><div class='sc_mid_c_right_new_d_2'><div class='sc_mid_c_right_new_d_3'><a href='".$web_url.UrltoHtml($row['ID'],$row['info_url'],"nv")."'><strong>".$row['info_title']."</strong></a></div><div class='sc_mid_c_right_new_d_3' id='hid'>".$row['info_des']."</div></div></li>";
        $nimg='';

        }

       $indexprost =$protitle.'<div class="sc_mid_c_right_new"><ul>'.$indexpros.'</ul></div>';
       if ($page_all_num>1){
           $fy="<div class='sc_mid_c_right_fy'>".show_page($all_num,$page,$page_num)."</div>";
        }else{
           $fy="";
        }
    echo datato($indexprost).$fy;
 }
 
 //产品信息分类名称及关键词描述调用 

 function pnlmcc($Language,$ID,$db_conn){

   if(is_numeric($ID)){ // 判读获取的ID 是否自定义
    
      $query=$db_conn->query("select * from sc_categories where ID=$ID");

    }else{
 
      $query=$db_conn->query("select * from sc_categories where category_url ='".$ID."'");
    }

    //Panduan(mysqli_num_rows($query));
    $row=mysqli_fetch_array($query);   
  
     $str=array('category_name'=>datato($row['category_name']),'category_key'=>datato($row['category_key']),'category_des'=>datato($row['category_des']));
    
    return $str;
    
 }
 

 //  列出搜索产品列表
 
 function searchprolist($Language,$tag_inquiry,$web_url,$skeywords,$webplist,$db_conn,$web_url_meate,$tag_searchms) {

     $indexpros="";$indexprost=""; $keywordstr="";
     $keywordsc = explode(" ",$skeywords);//分割

    foreach($keywordsc as $keyw){
        
        $keywordstr="products_name like '%".$keyw."%' and ";	   
    }

   $keywordstr=substr($keywordstr,0,-4);
   $sql=$db_conn->query("select * from sc_products where languageID=$Language and $keywordstr");     
   $all_num=mysqli_num_rows($sql); //总条数
   $page_num=$webplist; //每页条数
   $page_all_num = ceil($all_num/$page_num); //总页数
   $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
   $page=(int)$page; //安全强制转换
   $limit_st = ($page-1)*$page_num; //起始数
  
    $query=$db_conn->query("select  * from  sc_products where languageID=$Language and products_zt=1 and  $keywordstr order by  products_paixu asc, ID asc limit $limit_st,$page_num ");
    if (mysqli_num_rows($query)>0){
    while($row=mysqli_fetch_array($query)){
        
        $Imgs = explode(",", $row['products_Images']);
        $Imgs = $web_url_meate . str_replace("Images/prdoucts", "Images/prdoucts/small", $Imgs[0]);
        $indexpros.="<div><ul><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'><img src='" . str_replace("../", "", $Imgs) . "' alt='" . $row['products_name'] . "' loading='lazy' ></a></li><li><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $row['products_name'] . "</a></li><li><span class='inq'><a href='".$web_url.UrltoHtml($row['ID'],$row['products_url'],"pv")."'>" . $tag_inquiry . "</a></span></li></ul></div>";
    }
       $indexprost =$indexpros;

  
       //$fy="<div class='sc_mid_c_right_fy'>Total products ".$all_num.show_page($all_num,$page,$page_num)."</div>";

       $fy="";
       
          return datato($indexprost).$fy;

    }else{


          return "<div class='sech'>".datato($tag_searchms)."</div>";

     }
    }
 
 


function checkinfos($str,$Language,$db_conn){ //查询数据信息
      
    $result=$db_conn->query("select * from sc_categories where category_url='$str' and languageID=$Language "); 
 
    $row = mysqli_fetch_array($result); 
 
    if (!mysqli_num_rows($result)) 
        { 
         
     echo "";
        
        } 
    else 
        {     

        $strs=$row['ID'];
        return datato($strs);
        }     
    
}


//URL 转换  $urlo= ID $urlt=自定url $type=产品类型

function UrltoHtml($urlo,$urlt,$type){

  switch ($type) {

    case 'pv':
      
        if (htmlopen==1){

          $url=trim($urlt)==""? $urlo.".html" : $urlt.".html";

        }else{

          $url="view.php?ID=".$urlo;

        }

      break;
    
    case 'pl':

        if (htmlopen==1){

          $url=trim($urlt)==""? $urlo."/" : $urlt."/";

        }else{

          $url="product.php?ID=".$urlo;

        }

      break;

    case 'ab';

        if (htmlopen==1){

          $url=trim($urlt)==""? "about/".$urlo.".html" : "about/".$urlt.".html";

        }else{

          $url="about.php?ID=".$urlo;

        }

      break;

    case 'nv';

        if (htmlopen==1){

          $url=trim($urlt)==""? "news/".$urlo.".html" : "news/".$urlt.".html";

        }else{

          $url="info.php?ID=".$urlo;

        }

     break;

    case 'ne';

        if (htmlopen==1){

          $url=trim($urlt)==""? "news".$urlo."/" : "news/".$urlt."/";

        }else{

          $url="news.php?ID=".$urlo;

        }

     break;

  }

return $url;


}

 
function Panduan($str){  //判断数据,输出空符

     if ($str<1){

      echo '';

         }
    }   
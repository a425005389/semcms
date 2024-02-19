<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$Ant=new AntDateProcess();

$ImgUrl="";
$area_arr = array();
 
if (isset($_GET["Class"])){$Class = $_GET["Class"];}else{$Class="";}
if (isset($_GET["CF"])){$CF = $_GET["CF"];}else{$CF="";}
if (isset($_POST["languageID"])){$languageID = verify_str($_POST["languageID"]);}else{$languageID="";}
if (isset($_POST["AID"])){$area_arr = $_POST["AID"];$area_arr = implode(",",$area_arr);}else{$area_arr="";}
if (isset($_GET["ID"])){$ID=verify_str($_GET["ID"]);}elseif(isset($_POST["ID"])){$ID=verify_str($_POST["ID"]);}else{$ID="";}
if (isset($_GET["page"])){$page = verify_str($_GET["page"]);}else{$page="";}
if (isset($_GET["type"])){$type = $_GET["type"];}else{$type="";} 
if (isset($_GET["search"])){$Searchp=verify_str($_GET["search"]);}elseif(isset($_POST["search"])){$Searchp=verify_str($_POST["search"]);}else{$Searchp="";}
 

$web_url=ChecInfo("sc_config","ID","1","f","web_url",$db_conn);
$webTemplate=ChecInfo("sc_config","ID","1","f","web_Template",$db_conn);




//商品分类

if ($CF=="category"){

         $table="sc_categories";

         if($Class=="add" || $Class=="edit" ){

            $category_name = test_input($_POST["category_name"]);
            $category_key = test_input($_POST["category_key"]);
            $category_des = test_input($_POST["category_des"]);
            $category_img = test_input($_POST["category_img"]);
            $category_url = Streplace($_POST["category_url"]);
            $category_paixu = test_input($_POST["category_paixu"]);
            $contents = test_input($_POST["contents"]);
            $PID = test_input($_POST["PID"]);
            $types = $_POST["types"];
            $category_tj=test_input($_POST["category_tj"]);
           if ($category_tj=='yes'){$category_tj=1;}else{$category_tj=0;}

            $field="category_name,category_key,category_des,category_img,category_url,category_paixu,category_dest,languageID,category_pid,category_tj";
            $val=array($category_name,$category_key,$category_des,$category_img,$category_url,$category_paixu,$contents,$languageID,$PID,$category_tj);  

          }

        if($Class=="delete" || $Class=="open" ){

            $PID = test_input($_GET["pid"]);
            $languageID = test_input($_GET["lgid"]);
            $types = test_input($_GET["types"]);
         }

         switch ($Class) {

           case 'add': //增加
      
             if (empty($category_name)){

                if ($types=="p"){

                     header("Location: SEMCMS_Categories.php?lgid=".$languageID."&pid=1&err=002");   

                 }else{

                     header("Location: SEMCMS_Infocategories.php?lgid=".$languageID."&pid=2&err=002"); 

                 }
                 exit;

              }else{
              
               if ($Ant->checkdatas($table,"category_name",$category_name,$db_conn)=="0"){ //检测分类名称

                    $Ant->AntAdd($table,$field,$val,$db_conn); //写入数据库   

                    $flj=ChecInfo("sc_categories","ID",$PID,"f","category_path",$db_conn); //查找分类主节点

                    $flj2=ChecInfo("sc_categories","category_name",$category_name,"l","ID",$db_conn);  //查找ID

                    $zlj=$flj.$flj2.","; //组合成节点

                    $db_conn->query("update $table set category_path='$zlj' where ID=$flj2");

               }else{

                      if ($types=="p"){

                         header("Location: SEMCMS_Categories.php?lgid=".$languageID."&pid=1&err=002");

                      }else{

                        header("Location: SEMCMS_Infocategories.php?lgid=".$languageID."&pid=2&err=002");    
                          
                      }

                     exit;
                   }
              }

             break;

           case 'edit': //更新

              $PID=test_input($_POST["PID"]);
              $db_conn->query("update sc_categories set category_name='$category_name',category_key='$category_key',category_des='$category_des',category_img='$category_img',category_url='$category_url',category_paixu='$category_paixu',category_dest='$contents',category_tj='$category_tj' where ID='$PID'");

              break;

           case 'delete': //删除
             
              //统计相关的 ID
               $query=$db_conn->query("select * from sc_categories where locate(',$PID,',category_path)");   
               while($row=mysqli_fetch_array($query)){
                 $catid=$row['ID'];
                 if ($types=="p"){ //删除相关产品
                       $db_conn->query("delete from sc_products where locate(',$catid,',products_category)");
                  }else{ //删除相关信息
                       $db_conn->query("delete from  sc_info where info_lanmu=$catid");
                  }
                 $catid="";
               }
              
              $db_conn->query("delete from sc_categories where locate(',$PID,',category_path)>0"); //删除相关分类的

             break;

           case 'open': //开启

              $flag=$_GET["flag"];
             
              $db_conn->query("update sc_categories set category_open='$flag' where ID=$PID");

              break;
         }

            // 跳转

             if ($types=="p"){

                 header("Location: SEMCMS_Categories.php?lgid=".$languageID."&pid=1&err=001");  

             }else{

                 header("Location: SEMCMS_Infocategories.php?lgid=".$languageID."&pid=2&err=001");  

             }
//产品管理

}elseif ($CF=="products"){    
    
            $table="sc_categories";

            if($Class=="add" || $Class=="edit" ){

              $products_category=array(); 
              $products_category=$_POST["products_category"];
              $products_category =",".implode(",",$products_category).","; //接收到数据用,链接
              $products_metatit=test_input($_POST["products_metatit"]);
              $products_name=test_input($_POST["products_name"]);
              $products_model=test_input($_POST["products_model"]);
              $products_key=test_input($_POST["products_key"]);
              $products_des=test_input($_POST["products_des"]);
              $products_Images=array(); 
              $products_Images=$_POST["products_Images"];
              $products_url=Streplace(trim($_POST["products_url"]));
              $products_aurl=trim($_POST["products_aurl"]);
              $products_paixu=test_input($_POST["products_paixu"]);
              $products_xiangguan=test_input($_POST["products_xiangguan"]);
              $contents=test_input($_POST["contents"]);
              $products_guige=test_input($_POST["ctent"]);
              
            }

           switch ($Class){

             case 'add':
                
                if(empty($products_category) || empty($products_name) || empty($contents) ){  //判断空字段 

                   header("Location:SEMCMS_Products.php?type=add&lgid=".$languageID."&pid=1&err=003"); 

                }else{ 
                  
                       // 判断图片,图片处理程序    
                    if ($products_Images!==""){

                       foreach ($products_Images as $Img){ //循环更替             
                           //缩略图路径 
                           if ($Img!==""){
                              

                                $ImgUrl=$ImgUrl.$Img.",";//入库图片路径
                                $smallimg=str_replace("prdoucts/","prdoucts/small/",$Img);
                                $resizeimages = new resizeimages();
                                $resizeimage = $resizeimages->resizeimage("$Img", "500", "500", "0","$smallimg");
                               if ($Ant->checkdatas("sc_images","images_url",$Img,$db_conn)=="0"){ //相同图片的文件名称 不进行处理以下内容 
                                $db_conn->query("insert into sc_images(images_url,images_name,images_category) values('$Img','$products_name','$products_category')"); //写入图片库
                                 
                                 }
                             }
                          } 

                       }

                //记录写入数据库
                      $db_conn->query("insert into sc_products(products_category,products_name,products_model,products_key,products_des,products_Images,products_url,products_paixu,products_xiangguan,products_content,products_aurl,products_metatit,products_guige,languageID)"
                   . "values ('$products_category','$products_name','$products_model','$products_key','$products_des','$ImgUrl','$products_url','$products_paixu','$products_xiangguan','$contents','$products_aurl','$products_metatit','$products_guige','$languageID')");
                
                      header("Location: SEMCMS_Products.php?lgid=".$languageID."&err=001");  

                }

               break;
             
              case 'edit':
               
                  $ID=$_POST["ID"];
                  $gxtime=date("Y-m-d h:i:s",time()+8*60*60);

                  if(empty($products_category) || empty($products_name) || empty($contents)  ){  //判断空字段 

                     header("Location:SEMCMS_Products.php?type=edit&lgid=".$languageID."&ID=$ID&page=".$page."&err=003"); 

                  }else{ 
                    
                    // 判断图片,图片处理程序    
                    if ($products_Images!==""){

                       foreach ($products_Images as $Img){ //循环更替             
                           //缩略图路径 
                           if ($Img!==""){
                            $ImgUrl=$ImgUrl.$Img.",";//入库图片路径
                           
                                $smallimg=str_replace("prdoucts/","prdoucts/small/",$Img);
                                $resizeimages = new resizeimages();
                                $resizeimage = $resizeimages->resizeimage("$Img", "500", "500", "0","$smallimg");

                                //写入图片库
                           if ($Ant->checkdatas("sc_images","images_url",$Img,$db_conn)=="0"){ //相同图片的文件名称 不进行处理以下内容
                                $db_conn->query("insert into sc_images(images_url,images_name,images_category) values('$Img','$products_name','$products_category')");

                            }
                           
                             }
                          } 

                       }
                    $db_conn->query("update sc_products set  products_category='$products_category',products_name='$products_name',"
                         . "products_model='$products_model',products_key='$products_key',products_des='$products_des',"
                         . "products_Images='$ImgUrl',products_url='$products_url',"
                         . "products_paixu='$products_paixu',products_xiangguan='$products_xiangguan',"
                         . "products_content='$contents',products_time='$gxtime',products_metatit='$products_metatit',products_aurl='$products_aurl',products_guige='$products_guige' where ID='$ID'"); 

                  header("Location: SEMCMS_Products.php?lgid=".$languageID."&page=".$page."&err=001");  
                  }
               break;

              case 'Imagedelete'://图片删除

                $dimgurl=$_GET['imgurl'].",";
                $languageID=$_GET['lgid'];
                $db_conn->query("update sc_products set products_Images= replace (products_Images,'$dimgurl','')  where ID=$ID"); 
                header("Location:SEMCMS_Products.php?type=edit&lgid=".$languageID."&page=".$page."&ID=$ID&err=001"); 

               break;

              case 'indextj'://首页推荐 

                $languageID=$_GET['lgid'];
                $indext=$_GET['tj'];
                $db_conn->query("update sc_products set products_index='$indext' where ID=$ID"); 
                header("Location:SEMCMS_Products.php?lgid=".$languageID."&page=".$page."&err=001");                  

               break;

              case 'shangjia':// 上架下架 

                $languageID=$_GET['lgid'];
                $indext=$_GET['tj'];
                $db_conn->query("update sc_products set products_zt='$indext' where ID=$ID"); 
                header("Location:SEMCMS_Products.php?lgid=".$languageID."&page=".$page."&err=001");    
      
               break;

               case 'homes':// 批量推荐

                if ($area_arr==""){

                   header("Location:SEMCMS_Products.php?lgid=".$languageID."&page=".$page."&err=004");  

                   }else{ 
                        $indext=$_GET['tj'];
                        $db_conn->query("update sc_products set products_index='$indext' where ID in ($area_arr)");
                        header("Location:SEMCMS_Products.php?lgid=".$languageID."&page=".$page."&err=001");    
                     }

                break;

               case 'Shjia':// 批量上架

                if ($area_arr==""){

                   header("Location:SEMCMS_Products.php?lgid=".$languageID."&page=".$page."&err=004");  

                   }else{ 
                        $indext=$_GET['tj'];
                        $db_conn->query("update sc_products set products_zt='$indext' where ID in ($area_arr)");
                        header("Location:SEMCMS_Products.php?lgid=".$languageID."&page=".$page."&err=001");    
                     }

                break;   


              case 'Deleted':// 删除商品

                if ($area_arr==""){

                   header("Location:SEMCMS_Products.php?lgid=".$languageID."&err=004");  

                   }else{

                        $db_conn->query("delete from sc_products where ID in ($area_arr)");
                        header("Location:SEMCMS_Products.php?lgid=".$languageID."&page=".$page."&err=001");    
                     }

                break;

               case 'Addls'://添加类似产品

                  $languageID=$_GET['lgid'];
                  $db_conn->query("insert into sc_products(products_category,products_name,products_model,products_key,products_des,products_Images,products_paixu,products_xiangguan,products_content,languageID) SELECT products_category,products_name,products_model,products_key,products_des,products_Images,products_paixu,products_xiangguan,products_content,languageID FROM sc_products where ID='$ID'");
                  header("Location: SEMCMS_Products.php?lgid=".$languageID."&page=1&err=001");    

                break;                                      

           }

//信息管理 

}elseif ($CF=="info"){

        $table="sc_info";

     if($Class=="add" || $Class=="edit"){ //信息添加
         
         $info_title=test_input($_POST['info_title']);
         $info_keywords=test_input($_POST['info_keywords']);
         $info_des=test_input($_POST['info_des']);
         $info_url=Streplace(trim($_POST['info_url']));
         $info_content=test_input($_POST['contents']);
         $info_lanmu=test_input($_POST['info_lanmu']);
         $info_image=test_input($_POST['info_image']);
         $info_tj=test_input($_POST['info_tj']);
         if ($info_tj=='yes'){$info_tj=1;}else{$info_tj=0;}
         $field="info_title,info_keywords,info_des,info_url,info_content,info_lanmu,info_image,info_tj,languageID";
         $val=array($info_title,$info_keywords,$info_des,$info_url,$info_content,$info_lanmu,$info_image,$info_tj,$languageID);  

       }

     switch ($Class) {

       case 'add':
                   
            if(empty($info_title) || empty($info_content) || empty($info_lanmu) ){  //判断空字段 

               header("Location:SEMCMS_Info.php?type=add&lgid=".$languageID."&err=003"); 

             }else{  //写入数据库

              $Ant->AntAdd($table,$field,$val,$db_conn); //写入数据库   
              header("Location: SEMCMS_Info.php?lgid=".$languageID."&err=001");     
   
            }

         break;
       
       case 'edit':


           if(empty($info_title) || empty($info_content) || empty($info_lanmu) ){  //判断空字段 

               header("Location:SEMCMS_Info.php?type=add&lgid=".$languageID."&err=003"); 

            }else{

              $Ant->AntEdit($table,$field,$val,$ID,$db_conn); //更新数据
               header("Location: SEMCMS_Info.php?lgid=".$languageID."&page=".$page."&err=001"); 
              }  
         break;

        case 'Deleted':

              if ($area_arr==""){

                    header("Location:SEMCMS_Info.php?lgid=".$languageID."&err=004");  

               }else{

                    $Ant->AntDel($table,$area_arr,$db_conn);
                    header("Location:SEMCMS_Info.php?lgid=".$languageID."&page=".$page."&err=001");    
                }

        break;

     }

     //Banner管理

}elseif ($CF=="banner"){

         $table="sc_banner";

        if($Class=="add" || $Class=="edit"){ //信息添加

           $banner_image=test_input($_POST['banner_image']);
           $banner_url=test_input($_POST['banner_url']);
           $banner_fenlei=test_input($_POST['banner_fenlei']);
           $banner_paixu=test_input($_POST['banner_paixu']);
           $field="banner_image,banner_url,banner_fenlei,languageID,banner_paixu";
           $val=array($banner_image,$banner_url,$banner_fenlei,$languageID,$banner_paixu); 
        }

        switch ($Class) {

          case 'add':
         
            if(empty($banner_image) || empty($banner_url) || empty($banner_fenlei)){  //判断空字段 

               header("Location:SEMCMS_Banner.php?type=add&lgid=".$languageID."&err=003"); 

            }else{  //写入数据库

              $Ant->AntAdd($table,$field,$val,$db_conn); //写入数据库 
              header("Location: SEMCMS_Banner.php?lgid=".$languageID."&err=001");     
                
            }

            break;
          
          case 'edit':
         
            if(empty($banner_image) || empty($banner_url) || empty($banner_fenlei)){  //判断空字段 

               header("Location:SEMCMS_Banner.php?type=add&lgid=".$languageID."&err=003"); 

              }else{  //写入数据库
                
               $Ant->AntEdit($table,$field,$val,$ID,$db_conn); //更新数据
               header("Location: SEMCMS_Banner.php?lgid=".$languageID."&page=".$page."&err=001");    
         
              }
          
            break;

          case 'Deleted':
      
           if ($area_arr==""){

                header("Location:SEMCMS_Banner.php?lgid=".$languageID."&err=004"); 

             }else{

              //删除图片
               $query=$db_conn->query("select * from sc_banner WHERE ID in ($area_arr)");
               while($row=mysqli_fetch_array($query)){
                    Delfile($row['banner_image']);
                 }

                $Ant->AntDel($table,$area_arr,$db_conn);
                header("Location:SEMCMS_Banner.php?lgid=".$languageID."&page=".$page."&err=001");    
             }
                      
            break;


        }

}elseif ($CF=="link"){ //友情链接管理--------------------------

         $table="sc_link";

        if($Class=="add" || $Class=="edit"){ //信息添加

           $link_name=test_input($_POST['link_name']);
           $link_url=test_input($_POST['link_url']);
           $link_paixu=test_input($_POST['link_paixu']);
           $link_image=test_input($_POST['link_image']);
           $field="link_name,link_url,link_paixu,link_image,languageID";
           $val=array($link_name,$link_url,$link_paixu,$link_image,$languageID); 
        }

        switch ($Class) {

          case 'add':
 
            if(empty($link_name) || empty($link_url) || empty($link_paixu)  ){  //判断空字段 

               header("Location:SEMCMS_Link.php?type=add&lgid=".$languageID."&err=003"); 

            }else{  //写入数据库

               $Ant->AntAdd($table,$field,$val,$db_conn); //写入数据库 
               header("Location: SEMCMS_Link.php?lgid=".$languageID."&err=001");     
                
            }

            break;
          
          case 'edit':
            
             if(empty($link_name) || empty($link_url) || empty($link_paixu)  ){  //判断空字段 

               header("Location:SEMCMS_Link.php?type=edit&ID=".$ID."&lgid=".$languageID."&err=003"); 

            }else{  
                
              $Ant->AntEdit($table,$field,$val,$ID,$db_conn); //更新数据
              header("Location: SEMCMS_Link.php?lgid=".$languageID."&page=".$page."&err=001"); 

              }       

            break;

          case 'Deleted':

             if ($area_arr==""){

               header("Location:SEMCMS_Link.php?lgid=".$languageID."&err=004");  

             }else{

              //删除图片
               $query=$db_conn->query("select * from sc_link WHERE ID in ($area_arr)");
               while($row=mysqli_fetch_array($query)){
                 if (!empty($row['link_image'])){
                      Delfile($row['link_image']);
                    }
                 }
                $Ant->AntDel($table,$area_arr,$db_conn);
                header("Location:SEMCMS_Link.php?lgid=".$languageID."&page=".$page."&err=001");    
             }         

            break;          

        }

//文件下载管理

}elseif ($CF=="download"){  

         $table="sc_download";

        if($Class=="add" || $Class=="edit"){ //信息添加

           $link_name=test_input($_POST['down_name']);
           $link_url=test_input($_POST['down_file']);
           $link_paixu=test_input($_POST['down_paixu']);
           $field="down_name,down_file,down_paixu,languageID";
           $val=array($link_name,$link_url,$link_paixu,$languageID); 
        }

        switch ($Class) {

          case 'add':
           
            if(empty($link_name) || empty($link_url) || empty($link_paixu)  ){  //判断空字段 

               header("Location:SEMCMS_Link.php?type=add&lgid=".$languageID."&err=003"); 

            }else{  //写入数据库
                
               $Ant->AntAdd($table,$field,$val,$db_conn); //写入数据库 
               header("Location: SEMCMS_Download.php?lgid=".$languageID."&err=001");     
                
            }

            break;
          
          case 'edit':

             if(empty($link_name) || empty($link_url) || empty($link_paixu)  ){  //判断空字段 

                 header("Location:SEMCMS_Download.php?type=edit&ID=".$ID."&lgid=".$languageID."&err=003"); 

              }else{  //写入数据库
                
                 $Ant->AntEdit($table,$field,$val,$ID,$db_conn); //更新数据
                 header("Location: SEMCMS_Download.php?lgid=".$languageID."&page=".$page."&err=001");    
         
              }         
  
            break;

          case 'Deleted';

            if ($area_arr==""){

                     header("Location:SEMCMS_Download.php?lgid=".$languageID."&err=004");  

               }else{
 
                    $Ant->AntDel($table,$area_arr,$db_conn);
                    header("Location:SEMCMS_Download.php?lgid=".$languageID."&page=".$page."&err=001");    
                 }

            break;
        }

//综合信息管理

}elseif($CF=="zcansu"){
    
        if($Class=="edit"){
             
            $web_name=test_input($_POST['web_name']);
            $web_url=test_input($_POST['web_url']);
            $web_logo=test_input($_POST['web_logo']);
            $web_ico=test_input($_POST['web_ico']);
            $web_copy=test_input($_POST['web_copy']);
            $web_email=test_input($_POST['web_email']);
            $web_skype=test_input($_POST['web_skype']);
            $web_wathsapp=test_input($_POST['web_wathsapp']);
            $web_plist=test_input($_POST['web_plist']);
            $web_nlist=test_input($_POST['web_nlist']);
            $web_iflist=test_input($_POST['web_iflist']);
            $web_inlist=test_input($_POST['web_inlist']);
            $web_meate=trim($_POST['web_meate']);
            $web_tel=test_input($_POST['web_tel']);
            $web_google=test_input($_POST['web_google']);
            $web_share=test_input($_POST['web_share']);
            $web_umail=test_input($_POST['web_umail']);
            $web_pmail=test_input($_POST['web_pmail']);
            $web_dmail=test_input($_POST['web_dmail']);
            $web_smail=test_input($_POST['web_smail']);
            $web_tmail=test_input($_POST['web_tmail']);
            $web_jmail=test_input($_POST['web_jmail']);
            $web_mailopen=test_input($_POST['web_mailopen']);
            $web_jtopen=test_input($_POST['web_jtopen']);
            $web_zsyopen=test_input($_POST['web_zsyopen']);
            $web_duo=test_input($_POST['web_duo']);
            $web_https=test_input($_POST['web_https']);

            if ($web_mailopen=='yes'){$web_mailopen=1;}else{$web_mailopen=0;}
            if ($web_jtopen=='yes'){$web_jtopen=1;}else{$web_jtopen=0;}
            if ($web_zsyopen=='yes'){$web_zsyopen=1;}else{$web_zsyopen=0;}
            if ($web_https=='yes'){$web_https=1;}else{$web_https=0;}

            if ($web_duo=='yes'){$web_duo=1;}else{$web_duo=0;}

            if ($web_duo==1){ //开功能 

                  $db_conn->query("update sc_categories set category_open=1 where category_name='语种管理'");   

            }else{

                  $db_conn->query("update sc_categories set category_open=0 where category_name='语种管理'");
            }

                 $db_conn->query("update sc_config set web_name='$web_name',web_url='$web_url',web_logo='$web_logo',"
                     . "web_ico='$web_ico',web_copy='$web_copy',web_email='$web_email',web_skype='$web_skype',web_wathsapp='$web_wathsapp',"
                     . "web_plist='$web_plist',web_nlist='$web_nlist',web_inlist='$web_inlist',web_iflist='$web_iflist',web_meate='$web_meate',web_google='$web_google',web_share='$web_share',"
                     . "web_umail='$web_umail',web_pmail='$web_pmail',web_dmail='$web_dmail',web_smail='$web_smail',web_tmail='$web_tmail',"
                     . "web_jmail='$web_jmail',web_tel='$web_tel',web_mailopen='$web_mailopen',web_jtopen='$web_jtopen',web_zsyopen='$web_zsyopen',web_duo='$web_duo',web_https='$web_https' where ID=1"); 

                   header("Location:SEMCMS_Config.php?err=001");

         }

//SEO与文字管标签理

}elseif ($CF=="SeoTag"){ 
    
    
    if($Class=="edit"){

        $tag_indexmetatit=test_input($_POST['tag_indexmetatit']);
        $tag_indexkey=test_input($_POST['tag_indexkey']);
        $tag_indexdes=test_input($_POST['tag_indexdes']);
        $tag_prometatit=test_input($_POST['tag_prometatit']);
        $tag_prokey=test_input($_POST['tag_prokey']);
        $tag_prodes=test_input($_POST['tag_prodes']);
        $tag_newmetatit=test_input($_POST['tag_newmetatit']);
        $tag_newkey=test_input($_POST['tag_newkey']);
        $tag_newdes=test_input($_POST['tag_newdes']);
        $tag_homeabout=test_input($_POST['tag_homeabout']);
        $tag_contacts=test_input($_POST['tag_contacts']);
        
        $tag_time=date("Y-m-d h:i:s",time()+8*60*60);
     
        if ($Ant->checkdatas("sc_tagandseo","languageID",$languageID,$db_conn)=="0"){ //判断记录是否存在
        // 添加
        
        $db_conn->query("insert into sc_tagandseo(tag_indexkey,tag_indexdes,tag_prokey,tag_prodes,tag_newkey,tag_newdes,tag_homeabout,tag_contacts,tag_indexmetatit,tag_prometatit,tag_time,tag_service,tag_whosale,tag_newmetatit,languageID) values ('$tag_indexkey','$tag_indexdes','$tag_prokey','$tag_prodes','$tag_newkey','$tag_newdes','$tag_homeabout','$tag_contacts','$tag_indexmetatit','$tag_prometatit','$tag_time','$tag_newmetatit','$languageID')");

        }else{
       
        // 更新    

       $db_conn->query("update sc_tagandseo set tag_indexkey='$tag_indexkey',tag_indexdes='$tag_indexdes',tag_prokey='$tag_prokey',tag_prodes='$tag_prodes',tag_newkey='$tag_newkey',tag_newdes='$tag_newdes',tag_homeabout='$tag_homeabout',tag_contacts='$tag_contacts',tag_indexmetatit='$tag_indexmetatit',tag_prometatit='$tag_prometatit',tag_time='$tag_time',tag_newmetatit='$tag_newmetatit' where languageID=$languageID"); 
        }   
             header("Location:SEMCMS_SeoAndTag.php?lgid=".$languageID."&err=001"); 
               
    }
    
    
//导航管理

}elseif ($CF=="menu"){

         $table="sc_menu";

        if($Class=="add" || $Class=="edit"){ //信息添加

           $menu_name=test_input($_POST['menu_name']);
           $menu_link=test_input($_POST['menu_link']);
           $menu_paixu=test_input($_POST['menu_paixu']);
           $menu_xiala=test_input($_POST['menu_xiala']);
           $menu_banner=test_input($_POST['menu_banner']);
           $field="menu_name,menu_link,menu_paixu,menu_xiala,menu_banner,languageID";
           $val=array($menu_name,$menu_link,$menu_paixu,$menu_xiala,$menu_banner,$languageID); 
        }


        switch ($Class) {

          case 'add':

            if(empty($menu_name) || empty($menu_link) || empty($menu_paixu)){  //判断空字段 

               header("Location:SEMCMS_Menu.php?type=add&lgid=".$languageID."&err=003"); 

            }else{  //写入数据库
                
              $Ant->AntAdd($table,$field,$val,$db_conn); //写入数据库 
              header("Location: SEMCMS_Menu.php?lgid=".$languageID."&err=001");     
                
            }          

            break;
          
          case 'edit':

            if(empty($menu_name) || empty($menu_link) || empty($menu_paixu)){  //判断空字段 

               header("Location:SEMCMS_Menu.php?type=edit&ID=".$ID."&lgid=".$languageID."&err=003"); 

            }else{  //写入数据库
                
              $Ant->AntEdit($table,$field,$val,$ID,$db_conn); //更新数据
              header("Location: SEMCMS_Menu.php?lgid=".$languageID."&page=".$_GET['page']."&err=001"); 
              }

            break;

          case 'Deleted':

           if ($area_arr==""){

               header("Location:SEMCMS_Menu.php?lgid=".$languageID."&err=004");  

           }else{

                $Ant->AntDel($table,$area_arr,$db_conn);
                header("Location:SEMCMS_Menu.php?lgid=".$languageID."&page=".$page."&err=001");    
             }          

            break;

        }
    
 //用户理

}elseif ($CF=="user"){

         $table="sc_user";

        if($Class=="add" || $Class=="edit"){ //信息添加

           $user_name=test_input($_POST['user_name']);
           $user_admin=test_input($_POST['user_admin']);
           $user_ps=  test_input($_POST['user_ps']);
           $user_tel=test_input($_POST['user_tel']);
           $user_email=test_input($_POST['user_email']);
           $field="user_name,user_admin,user_ps,user_tel,user_email";
           $val=array($user_name,$user_admin,$user_ps,$user_tel,$user_email); 

        }

        switch ($Class) {

          case 'add':

            if(empty($user_name) || empty($user_admin) || empty($user_ps) || empty($user_email)  ){  //判断空字段 

               header("Location:SEMCMS_User.php?type=add&err=003"); 

             }else{  //写入数据库
                
              $Ant->AntAdd($table,$field,$val,$db_conn); //写入数据库 
              header("Location: SEMCMS_User.php?lgid=".$languageID."&err=001");     
                
            }

            break;
          
          case 'edit':
 
              if(empty($user_name) || empty($user_admin) || empty($user_email)){  //判断空字段 

                     header("Location:SEMCMS_User.php?type=edit&ID=".$ID."&err=003"); 

                }else{  //写入数据库
                    
                    if ($user_ps==""){   //  密码为空不修改  

                     $db_conn->query("update sc_user set user_name='$user_name',user_tel='$user_tel',user_admin='$user_admin',user_email='$user_email' where ID=$ID"); 
                     
                    }else{
                     $user_ps=md5($user_ps);
                     $db_conn->query("update sc_user set user_name='$user_name',user_tel='$user_tel',user_admin='$user_admin',user_ps='$user_ps',user_email='$user_email' where ID=$ID");   
                  
                    }
                     
                    header("Location: SEMCMS_User.php?page=".$_GET['page']."&err=001");    
             
              }

            break;

          case 'Deleted':

              if ($area_arr==""){

                      header("Location:SEMCMS_User.php?err=004");

                   }else{
  
                      $Ant->AntDel($table,$area_arr,$db_conn);
                      header("Location:SEMCMS_User.php?page=".$_GET['page']."&err=001");   

                   }

            break;

        }

//权限分配

}elseif ($CF=="fenpei"){ 
    
        $area_arr = $_POST["ID"]; 
        $uid=$_POST['uid'];

           if ($area_arr==""){

                header("Location:SEMCMS_User.php?err=005");  

           }else{

                $area_arr = implode(",",$area_arr); //接收到数据用,链接
                $db_conn->query("update sc_user set user_qx='$area_arr' where ID=$uid");
                header("Location:SEMCMS_User.php?&err=001");   

            }

//邮箱订阅管理

}elseif($CF=="Newsletter"){ //删除
    
       if ($Class=="Deleted"){
     
            if ($area_arr==""){

                    header("Location:SEMCMS_Newsletter.php?err=004");  

               }else{
     
                    $db_conn->query("delete from sc_email WHERE ID in ($area_arr)");
                    header("Location:SEMCMS_Newsletter.php?page=".$_GET['page']."&err=001");    
                 } 
       } 

 
//图片管理

}elseif($CF=="Images"){ //删除


   $table="sc_images";

     if ($Class=="add" || $Class=='edit'){
         if($_POST['category_name']!=''){
             $images_category=','.test_input($_POST['category_name']).',';
         }else{
             $images_category='';
         }

         $images_name=test_input($_POST['images_name']);
         $images_url=test_input($_POST['images_url']); 
         $field="images_url,images_name,images_category";
         $val=array($images_url,$images_name,$images_category);
     }

   switch ($Class) {

    case 'Deleted':

            if ($area_arr==""){

                    header("Location:SEMCMS_Images.php?err=004");  

               }else{

                    //删除图片
                    $query=$db_conn->query("select * from sc_images WHERE ID in ($area_arr)");
                    while($row=mysqli_fetch_array($query)){
                         Delfile($row['images_url']);
                       }
                    $db_conn->query("delete from sc_images WHERE ID in ($area_arr)");

                    header("Location:SEMCMS_Images.php?page=".$_GET['page']."&err=001");    
                 } 
    break;

    case 'add';


           
             if(empty($images_name) || empty($images_url)){  //判断空字段 

               header("Location:SEMCMS_Images.php?err=003"); 

             }else{  //写入数据库
                
              $Ant->AntAdd($table,$field,$val,$db_conn); //写入数据库 
              header("Location: SEMCMS_Images.php?err=001");     
                
            }
       case 'edit';



           if(empty($images_name) || empty($images_url)){  //判断空字段

               header("Location:SEMCMS_Images.php?id=".$_POST['ID']."&err=003");

           }else{  //写入数据库
               $db_conn->query("update sc_images set images_url='$images_url',images_name='$images_name',images_category='$images_category' where ID=".$_POST['ID']);
               header("Location: SEMCMS_Images.php?page=".$_GET['page']."&err=001");

           }
    break;


   }
   
//询盘管理
}elseif($CF=="Inquriy"){ //删除
    
       if ($Class=="Deleted"){
     
            if ($area_arr==""){

                    header("Location:SEMCMS_Inquiry.php?err=004");  

               }else{
     
                    $db_conn->query("delete from sc_msg WHERE ID in ($area_arr)");
                    header("Location:SEMCMS_Inquiry.php?page=".$_GET['page']."&err=001");    
                 } 
       } 

 //用户登陆与退出

}elseif($CF=="users"){  
 
   if($Class=="login"){ //登陆   
       
       $US=test_input($_POST['UserName']);
       $PS=test_input($_POST['UserPass']);
     
        if(empty($US) || empty($PS)){

                 echo "<script language='javascript'>alert('账号或密码不能为空!');top.location.href='index.html';</script>";

        }else{

                $PS=md5($PS);
                $query=$db_conn->query("select * from sc_user where user_admin='$US' and user_ps='$PS'");
                if (mysqli_num_rows($query)>0 ){

                      $row=mysqli_fetch_assoc($query);

                      setcookie("scusername", $row['user_name'],time()+3600*24,"/");
                      setcookie("scuseradmin", $row['user_admin'],time()+3600*24,"/");
                      setcookie("scuserpass", $row['user_ps'],time()+3600*24,"/");//设定时间为24个小时
                      header("Location:SEMCMS_Main.php");  

                  }else{

                       echo "<script language='javascript'>alert('账号或密码错误!');top.location.href='index.html';</script>";

                   }
        }

  }elseif($Class=="loginout"){ //退出

       setcookie("scusername", "",time()-3600*24,"/");
       setcookie("scuseradmin", "", time()-3600*24,"/");
       setcookie("scuserpass", "", time()-3600*24,"/");
       header("Location:index.html");  
       
}
    
//模版应用

}elseif ($CF=="template"){ 
    
    $jtopen=ChecInfo("sc_config","ID","1","f","web_jtopen",$db_conn);

    $db_conn->query("update sc_config set web_Template ='".$_GET['mb']."' where ID=1");// 更新模版标记
    $query=$db_conn->query("select * from sc_language where language_open=1");
       if (mysqli_num_rows($query)>0){

        while($row=mysqli_fetch_array($query)){

          if ($row['language_mulu']==1){

                  Mbapp($_GET['mb'],"../","../","",$jtopen);

           }else{

                  Mbapp($_GET['mb'],"../".$row['language_url']."/","../","../",$jtopen);
                }
        }

      }
      header("Location:SEMCMS_Template.php");
 
}elseif ($CF=="sitemap"){ //生成sitemap

    $output="";
    $template_o = file_get_contents('plug/sitemap.xml');
    $templateUrl = '../sitemap.xml';
    $query=$db_conn->query("select * from sc_language where language_open=1");

    if (mysqli_num_rows($query)>0){

          while($rows=mysqli_fetch_array($query)){

            if ($rows['language_mulu']==1){

                    $web_url_l=$web_url;

             }else{

                    $web_url_l=$web_url.$rows['language_url']."/";
                  }

                  $output=$output.xmltogoogle($rows['ID'],$web_url_l,$db_conn);
           }

      }
      $output = str_replace('<{xml}>',$output,$template_o);
      file_put_contents($templateUrl, $output);
      echo "<script>alert('sitemap成功生成!');history.go(-1);</script>";
}
 
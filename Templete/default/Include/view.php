<?php 
include_once  '../../../Include/web_inc.php';
include_once  '../../../Templete/'.$webTemplate.'/Include/Function.php';
$prv=proview($ID,"All",$web_url,$db_conn,$web_url_meate); //All 是用来区分图片 与目录
$prcate=proview($ID,"products_category",$web_url,$db_conn,$web_url_meate);
$primg=proview($ID,"products_Images",$web_url,$db_conn,$web_url_meate);
$products_aurls=$prv['products_aurl'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php if(empty($prv['products_metatit'])){echo $prv['products_name'];}else{echo $prv['products_metatit'];}?></title>
<meta content="<?php echo $prv['products_key'];?>" name="keywords">
<meta content="<?php echo $prv['products_des'];?>" name="description">
<link href="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/swipe/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Js/show.js" type="text/javascript"></script>
<?php echo $webmeate; ?>
    <style>
 
      .swiper {
        width: 100%;
        height: 100%;
      }

      .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
 
      .swiper {
        width: 100%;
 
        margin-left: auto;
        margin-right: auto;
      }

      .swiper-slide {
        background-size: cover;
        background-position: center;
      }

      .mySwiper2 {
        height: 80%;
        width: 100%;
      }

      .mySwiper {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
      }

      .mySwiper .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.7;
        cursor: pointer;
      }

      .mySwiper .swiper-slide-thumb-active {
        opacity: 1;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    </style>
</head>

<body>
<?php echo $webgoogle; ?>
<div class="sc">

	<!--top-->
    	
 <?php include_once  'Top.php';?>
    
    <!--top end-->
    <div class="cb"></div>
    <!--mid-->
    <div class="sc_mid">
    	<div class="sc_mid_c">
 			<div class="sc_mid_proview_t"><a href="<?php echo $web_url; ?>"><?php echo $Label["tag_home"]; ?></a> > <?php echo lamcc($Language,$prcate,$web_url,$db_conn) ?> > <?php echo $prv['products_name'];?></div>
            <div class="cb"></div>
            <!--view-->
            <div class="sc_mid_proveiw_1">
            	<div class="sc_mid_proview_1_left">
                 
<div class="swiper mySwiper2" >
      <div class="swiper-wrapper">
    <?php echo $primg;?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
<?php echo $primg;?>
      </div>
    </div>

                </div>
                <div class="sc_mid_proview_1_right">
                	<ul>
                    <li><h1><?php echo $prv['products_name'];?></h1></li>
                    <li><?php echo $Label["tag_Item"];?> : <?php echo $prv['products_model'];?></li>
                    <li class="sc_mid_proveiw_2_c"><?php echo $prv['products_guige'];?></li>
                    <li><span class='binq'><a href="#buynow"><?php echo $Label["tag_inquiry"];?></a></span> <?php if(!empty($products_aurls)){echo "<span id='amz'><a href='".$products_aurls."'>".$Label['tag_buynow']."</a>";}?></a></li>
 
                    
                    </ul>
                
                </div>
            
            </div>
            <!--view end-->
            <div class="cb"></div>
            <div class="sc_mid_proveiw_2"> 
            <h3><?php echo $Label["tag_proxxms"];?></h3> <br>
            <div class="sc_mid_proveiw_2_c"><?php echo $prv['products_content'];?></div>
            </div>
            <div class="cb"></div>
            <div class="sc_mid_proveiw_2" >

                <div class="sc_message" id="buynow">
                 <form action="<?php echo $web_url_meate;?>Include/web_check.php?type=MSG" method="post" name="pl" > 
                  <ul>
                     <li><h3><?php echo $Label["tag_message"];?></h3></li>
                     <li><input name="name" type="text" id="name" placeholder="<?php echo $Label["tag_name"];?>(*)"  class="ly_1" /></li>
                     <li><input name="mail" type="text" id="mail" placeholder="<?php echo $Label["tag_email"];?>(*)"   class="ly_1" /></li>
                     <li><input name="tel" type="text" id="tel" placeholder="<?php echo $Label["tag_tel"];?>"  class="ly_1" /></li>
                     <li><textarea name="tent" id="tent" class="ly_2" placeholder="<?php echo $Label["tag_content"];?>" ></textarea></li>
                     <li><input  type="text" name="yzm"  placeholder="<?php echo $Label["tag_code"];?>(*)" class="ly_3" id="yzm"><img id="captcha_img" border='1' src='<?php echo $web_url_meate;?>Include/web_code.php?r=<?php echo rand(); ?>' onclick="document.getElementById('captcha_img').src='<?php echo $web_url_meate;?>Include/web_code.php?r='+Math.random()" style="width:100px; border:1px solid #ededed; height:35px; cursor:pointer;" align="absmiddle" /></li>
                     <li><div id="anu"><input class='ly_4' onclick="return msg();" type="submit" name="button" id="button" value="<?php echo $Label["tag_inquiry"];?>" /><input type="hidden" value="<?php echo $prv['ID'];?>" id="PID" name="PID"><input type="hidden" value="<?php echo $Language;?>" name="languageID" id="languageID"></div></li>
                  </ul>
                  </form> 
                </div>

             </div>
          <div class="cb"></div>
            
           <div class="sc_mid_proveiw_2"><h3><?php echo $Label["tag_proxgcp"];?></h3><div class="sc_pro"><?php echo sjpro($Language,$Label["tag_inquiry"],$prcate,$web_url,$db_conn,$web_url_meate); ?></div></div>
            <div class="cb"></div>
        
        </div>
    
    
    </div>
   <!--mid end-->
<div class="cb"></div>
<!--bot-->
<?php include_once  'Bot.php';?>
<!--bot end-->

</div>

     <!-- Swiper JS -->
    <script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/swipe/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 5,
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper(".mySwiper2", {
        loop: true,
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
      });
    </script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $indextitle;?></title>
<meta content="<?php echo $tag_indexkey;?>" name="keywords">
<meta content="<?php echo $tag_indexdes;?>" name="description">
<link rel="shortcut icon" href="<?php echo $webico;?>" />
<link href="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Css/swiper.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Js/show.js" type="text/javascript"></script>
<?php echo $webmeate; ?>
</head>
<body>
<?php echo $webgoogle; ?>
<div class="sc">
<!--top-->	
 <?php include_once  $file_url.'Templete/'.$webTemplate.'/Include/Top.php';?>
    <!--top end-->
    <div class="cb"></div>
    <!--mid-->
    <div class="sc_mid">
    	<div class="sc_mid_c">
        <!--mid left-->
        	<div class="sc_mid_c_left">
                <div class="sc_mid_c_left_c">
                <?php
                echo"<div class='fl' id='fl'><ul>";
                echo get_str(1,$Language,$web_url,$db_conn);
                echo"</ul></div>";
                ?>
                </div>
                <div class="cb"></div>
                <div class="sc_mid_c_left_c sc_mid_left_bt"><?php echo $Label["tag_hot"];?></div>
                <div class="cb"></div>
                <div class="sc_mid_c_left_c_n" id="l85">
                <?php echo indexpro("news",$Language,$Label["tag_more"],$web_url,$webinlist,$db_conn,$web_url_meate);?>
                </div>
            </div>
         <!--mid right-->
            <div class="sc_mid_c_right">
            	<div class="sc_mid_c_right_c">
                   <!-- Swiper -->
                  <div class="swiper-container">
                    <div class="swiper-wrapper">
                    <?php echo  web_banner($Language,$db_conn,$web_url_meate,"index");?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                  </div>                      
                    
                </div>
            	<div class="cb"></div>
                <div class="sc_mid_c_right_title"><h3><?php echo $Label["tag_tuijian"];?></h3></div>
                <div class="cb"></div>
                <div class="sc_pro"><?php echo indexpro("tj",$Language,$Label["tag_more"],$web_url,$webiflist,$db_conn,$web_url_meate);?></div>
            
            </div>
         <!--mid end-->
        
        </div>
    </div>
   <!--mid end-->

<div class="cb"></div>
<!--bot-->

<div class="sc_bot">
	<div class="sc_bot_1">
    	<div class="sc_bot_1_t"><h3><?php echo $Label["tag_about"];?></h3></div>
        <div class="cb"></div>
        <div class="sc_bot_1_c"><?php echo $tag_homeabout;?></div>
        <div class="cb"></div>
    
    </div>
</div>
 <?php
 if(!empty(indexwbnews($Language,$web_url,$db_conn,$web_url_meate))){
?>
<div class="cb"></div>
<div class="sc_indexnews">
    <div class="sc_indexnews_t"><h3><?php echo $Label["tag_lastnews"];?></h3></div>
    <div class="cb"></div>
    <div class="sc_indexnews_c" id="l85">
        <?php echo indexwbnews($Language,$web_url,$db_conn,$web_url_meate);?>
    </div>

</div>
<?php } ?>
<div class="cb"></div>
   <?php echo web_link($Language,$db_conn,$Label["tag_link"]);?>
    <div class="cb"></div>
<?php include_once  $file_url.'Templete/'.$webTemplate.'/Include/Bot.php';?>
<!--bot end-->

</div>
<!-- Swiper JS -->
<script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Js/swiper.min.js" type="text/javascript"></script>
<!-- Initialize Swiper -->
 <script>
            var swiper = new Swiper('.swiper-container', {
              slidesPerView: 1,
              spaceBetween: 30,
              loop: true,
              autoplay: true, 
              autoplayDisableOnInteraction: false, 
              pagination: {
                el: '.swiper-pagination',
                clickable: true,
              },
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
            });
 </script>
</body>
</html>

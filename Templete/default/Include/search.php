<?php 
include_once  '../../../Include/web_inc.php';
include_once  '../../../Templete/'.$webTemplate.'/Include/Function.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $search;?></title>
<meta content="<?php echo $search;?>" name="keywords">
<meta content="<?php echo $search;?>" name="description">
<link href="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Css/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Js/show.js" type="text/javascript"></script>
<?php echo $webmeate; ?>
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
                <div class="sc_mid_c_left_c sc_mid_left_bt"><?php echo  $Label["tag_hot"];?></div>
                <div class="cb"></div>
                <div class="sc_mid_c_left_c_n"><?php echo indexpro("news",$Language,$Label["tag_inquiry"],$web_url,$webinlist,$db_conn,$web_url_meate);?></div>

            </div>
         <!--mid right-->
            <div class="sc_mid_c_right">
                <div class="sc_mid_tits" id="botalink"><a href="<?php echo $web_url; ?>"><?php echo $Label["tag_home"]; ?></a> > <?php echo $search;?></div>
                <div class="cb"></div>
                <div class="sc_pro"><?php echo searchprolist($Language,$Label["tag_more"],$web_url,$search,$webplist,$db_conn,$web_url_meate,$Label["tag_searchms"])?></div>

            </div>
         <!--mid end-->
        
        </div>
    
    
    </div>
   <!--mid end-->
<div class="cb"></div>
<!--bot-->
<?php include_once  'Bot.php';?>
<!--bot end-->

</div>



</body>
</html>

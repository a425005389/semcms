<?php 
include_once  '../../../Include/web_inc.php';
include_once  '../../../Templete/'.$webTemplate.'/Include/Function.php';
$str=infoview($ID,$db_conn,$Language);
$strs=pnlmcc($Language,$str['info_lanmu'],$db_conn);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $str['info_title'];?></title>
<meta content="<?php echo $str['info_keywords'];?>" name="keywords">
<meta content="<?php echo $str['info_des'];?>" name="description">
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
                <div class="sc_mid_c_new_left">
                <ul>
                <?php echo wbnews($Language,$web_url,$db_conn);?>
                </ul>
                </div>
                <div class="cb"></div>
                <div class="sc_mid_c_left_c sc_mid_left_bt"><?php echo $Label["tag_hot"];?></div>
                <div class="cb"></div>
                <div class="sc_mid_c_left_c_n" id="l85"><?php echo indexpro("news",$Language,$Label["tag_more"],$web_url,$webinlist,$db_conn,$web_url_meate);?></div>

            </div>
         <!--mid right-->
            <div class="sc_mid_c_right">
                <div class="sc_mid_tits"><a href="<?php echo $web_url; ?>"><?php echo $Label["tag_home"]; ?></a>  > <?php echo $strs['category_name'];?></div>
                <div class="cb"></div>
                <div class="sc_mid_c_right_c">
				<div class="sc_mid_c_right_title"><h1><?php echo $str['info_title'];?></h1></div>
                <div class="cb"></div>
                <div class="sc_mid_c_new_v"><?php echo $str['info_content'];?></div>
                <div class="sc_mid_nepr"><ul> <?php echo Neper($db_conn,$Language,$str['ID'],"ne",$web_url);?> <?php echo Neper($db_conn,$Language,$str['ID'],"pr",$web_url);?></ul></div>
                <div class="cb"></div>
                
				</div>

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

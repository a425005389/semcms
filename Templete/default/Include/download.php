<?php 
include_once  '../../../Include/web_inc.php';
include_once  '../../../Templete/'.$webTemplate.'/Include/Function.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $Label["tag_download"];?></title>
<script src="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Js/jquery-1.7.2.min.js" type="text/javascript"></script>
<link href="<?php echo $web_url_meate;?>Templete/<?php echo $webTemplate;?>/Css/style.css" rel="stylesheet" type="text/css" />
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
 			<div class="sc_mid_proview_t"><a href="<?php echo $web_url; ?>"><?php echo $Label["tag_home"]; ?></a> > <?php echo $Label["tag_download"];?></div>
            <div class="cb"></div>
            <div class="sc_about"> 
               <div class="sc_about_tit"><h1><?php echo $Label["tag_download"];?></h1></div>
               <div class="sc_download"> <?php echo downloadfile($Language,$web_url,$Label["tag_download"],$db_conn,$web_url_meate)?></div></div>
            <div class="cb"></div>
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

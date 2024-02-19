<?php 
include_once  '../../../Include/web_inc.php';
include_once  '../../../Templete/'.$webTemplate.'/Include/Function.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $Label["tag_contact"];?></title>
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
 			<div class="sc_mid_proview_t"><a href="<?php echo $web_url; ?>"><?php echo $Label["tag_home"]; ?></a> > <?php echo $Label["tag_contact"];?></div>
            <div class="cb"></div>
             <div class="sc_about">
                <div class="sc_about_tit"><h1><?php echo $Label["tag_contact"];?></h1></div>
                <div class="sc_about_c"><div class="sc_ct_left"><?php echo $tag_contacts;?></div><div class="sc_ct_right">
                   
                 <form action="<?php echo $web_url_meate;?>Include/web_check.php?type=MSG" method="post" name="pl" > 
                  <ul>
                     <li><h3>Message</h3></li>
                     <li><input name="name" type="text" id="name" placeholder="<?php echo $Label["tag_name"];?>(*)"  class="ly_1" /></li>
                     <li><input name="mail" type="text" id="mail" placeholder="<?php echo $Label["tag_email"];?>(*)"   class="ly_1" /></li>
                     <li><input name="tel" type="text" id="tel" placeholder="<?php echo $Label["tag_tel"];?>"  class="ly_1" /></li>
                     <li><textarea name="tent" id="tent" class="ly_2" placeholder="<?php echo $Label["tag_content"];?>" ></textarea></li>
                     <li><input  type="text" name="yzm"  placeholder="<?php echo $Label["tag_code"];?>(*)" class="ly_3" id="yzm"><img id="captcha_img" border='1' src='<?php echo $web_url_meate;?>Include/web_code.php?r=<?php echo rand(); ?>' onclick="document.getElementById('captcha_img').src='<?php echo $web_url_meate;?>Include/web_code.php?r='+Math.random()" style="width:100px; border:1px solid #ededed; height:35px; cursor:pointer;" align="absmiddle" /></li>
                     <li><div id="anu"><input class='ly_4' onclick="return msg();" type="submit" name="button" id="button" value="<?php echo $Label["tag_inquiry"];?>" /><input type="hidden" value="0" id="PID" name="PID"><input type="hidden" value="<?php echo $Language;?>" name="languageID" id="languageID"></div></li>
                  </ul>
                  </form> 



                </div></div>
                    
                </div>           
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

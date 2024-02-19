<div  class="sc_Subscribe"><div class="sc_Subscribe_c"><div class="sc_Subscribe_c_left"><?php echo $Label['tag_newsletterdes']?></div><div class="sc_Subscribe_c_right"><form action="<?php echo $web_url; ?>Include/web_check.php?type=Newsletter" id="subsc" method="post"><input type="text" name="mail" id="mail" placeholder="<?php echo $Label['tag_entermail'];?>"><span id="subscmit"><?php echo $Label['tag_send']?></span></form></div></div></div>

<div class="sc_bot">
 
    <div class="sc_bot_2" id="botalink">
    <ul><li><?php echo $Label["tag_about"];?></li><?php echo wbabout("About",$Language,$web_url,$db_conn);?></ul>
    <ul><li><?php echo $Label["tag_productcategory"];?></li><?php echo wbpro($Language,$web_url,$db_conn);?></ul>
    <ul><li><?php echo $Label["tag_news"];?></li><?php echo wbnews($Language,$web_url,$db_conn);?></ul>
    <ul><li><?php echo $Label["tag_contact"];?></li><?php echo wbcontact($webemail,$webskype,$webwathsapp,$web_url_meate);?></ul>
    <ul><li><?php echo $Label["tag_follow"];?></li><?php echo wbfollowus($webshare);?></ul>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
    <div class="sc_bot_3"><?php echo $webcopy.$CopyRight;?></div>
    <div class="cb"></div>

</div>
<div class="cb"></div>
<div  id="rightTop">↑</div>
<?php mysqli_close($db_conn);?>
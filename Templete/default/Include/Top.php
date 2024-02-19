<div class="sc_top">
        	<div class="sc_top_conment">
            	<div class="sc_top_conment_1"><?php echo  web_language($web_url_meate,$db_conn);?><div class="sc_top_conment_1_right"><img src="<?php echo $web_url_meate;?>Images/default/Emailb.png" align='absmiddle'> <a href='mailto:<?php echo $webemail;?>'><?php echo $webemail;?></a></div></div>
                <div class="cb"></div>
                <div class="sc_top_conment_2">
                    <div class="sc_top_conment_2_left"><a href='<?php echo $web_url;?>'><img src="<?php echo $weblogo; ?>" alt="<?php echo $webname;?>" /></a> <div class="sc_top_list"></div><div class="sc_top_seah" id="sc_top_seah"></div></div>
                    <div class="sc_top_conment_2_right">
                    <div class="sc_top_conment_2_right_left"><form action="<?php echo $web_url; ?>search.php" method="post"><input type="text" name="search" id="search" class="sc_top_ser_1" placeholder="<?php echo $Label["tag_searchtit"];?>"  /><input name="submit" id="submit" type="submit" value="<?php echo $Label["tag_search"];?>" class="sc_top_ser_2" onclick="return sch();" /></form> </div>
                    <div class="sc_top_conment_2_right_right"><?php echo $webtel;?></div>
                    </div>
                     
                </div>
                <div class="cb"></div>
                <div class="sc_top_conment_3">
                	<div class="sc_top_conment_3_left t_ss"><?php echo $Label["tag_productcategory"];?></div>
                        <div class="sc_top_conment_3_right" id="navalink"><li><img src="<?php echo $web_url; ?>Images/default/close.png" id="cls"  style="float: right; margin-right: 10px; cursor: pointer;"></li><?php echo web_nav($Language,$web_url,$db_conn);?></div>
                
                </div>
            </div>
        <div class="cb"></div>
        </div>

<div  class="sc_top_conment">
<div id="topfl">
    
               <?php
                echo"<div class='fl' id='fl'><ul>";
                echo get_str(1,$Language,$web_url,$db_conn);
                echo"</ul></div>";
                ?>
    
</div>
</div>


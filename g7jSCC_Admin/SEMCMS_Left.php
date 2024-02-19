<?php include_once 'SEMCMS_Top_include.php'; ?>
 
<script src="SC_Page_Config/Js/jquery-1.1.3.1.pack.js"></script>
<script>
	$(document).ready(function(){
		//$("dd:not(:first)").hide();
		$("dt a").click(function(){
			$("dd:visible").slideUp("slow");
			$(this).parent().next().slideDown("slow");
			return false;
		});
	});
	</script>
<body bgcolor="#404040">
<div class="back_left">
  <div class="back_left_c" id="lefts">
     <?php 

     echo onefenlei($SCQuanXian,$db_conn); 
     
     ?>
 
          <dl>
        <dt class="back_left_top"><img src="SC_Page_Config/Image/left.jpg" align="absmiddle" /><a href='SEMCMS_language.php' target="mainFrame">站点管理</a></dt>
        <dd><ul> 

          <?php 
echo languageqx("1",$SCQuanXian,$db_conn,$lgid,"left");  
         
 
          mysqli_close($db_conn);

           ?>
             
  <li><img src="SC_Page_Config/Image/left2.jpg" align="absmiddle"> <a href="http://www.sem-cms.com/talk/chajian.asp" target="mainFrame">功能选择</a></li>
 
        </ul></dd>
 
    </dl>
       
  </div>
  <div class="cb"></div>
</div>
</body>
</html>
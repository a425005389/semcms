<?php include_once 'SEMCMS_Top_include.php'; ?>
    <body>

        <?php 
        if (isset($_GET["sub"])){$sub=$_GET["sub"];}else{$sub="";}
          $type=$_GET['type'];
          $lgid=$_GET["lgid"];
          if ($type=="edit"){
          $prids=$_GET['ID'];
          
          $page=$_GET['page'];
          }

        ?>
        <?php  if ($type=="edit"){
            echo "<div style='width:690px; height:400px; overflow-y:scroll;'>";
            ?>
<form action="?sub=ok&type=<?php echo $type; ?>&lgid=<?php echo $lgid; ?>&ID=<?php echo $prids; ?>&page=<?php echo $page; ?>" name="a" method="post">
      
        <?php }else { ?>
        <form action="?sub=ok&type=add&lgid=1" name="a" method="post">

               <?php }
           echo "<table width='670' style='margin:auto;'cellpdding=0 cellspacing=1 class='table'><tr><td style='width:15%'><b>图片</b></td><td style='width:70%'><b>名称</b></td><td style='width:15%'><input type='submit' value='选择提交' name='submit' id='submit'></td></tr>";
           
       echo allproducts($lgid,$db_conn);
           echo "</table>";

        ?>

        
        </form>
<?php  if ($type=="add" && $sub=="ok" ){ 
        $RealID = array(); 
         $RealID = $_POST["AID"];  
         $RealID = implode(",",$RealID); 
 echo "<script>window.opener.document.form.products_xiangguan.value='".$RealID."'</script>";
 echo "<script language='javascript'>window.close();</script>";
}else{echo"</div>";}
   ?> 
    
    </body>
</html>

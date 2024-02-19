<script type="text/javascript">
<?php
$Err=@htmlspecialchars($_GET["err"]);				
if (!isset($Err)){$Err=$Err;}else{$Err=="";}
if ($Err!==""){
?>
        var content4 = "<?php echo actioninfo($Err); ?> <br>三秒后自动关闭!<br>或者点空白处弹出信息直接关闭！";//弹出层自动消失
        window.onload = function(){TINY.box.show(content4,0,0,0,0,3)}
 <?php
}
 ?>
</script>
	

<?php

mysqli_close($db_conn);

?>
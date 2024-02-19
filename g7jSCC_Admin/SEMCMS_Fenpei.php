<?php include_once 'SEMCMS_Top_include.php'; ?>
 
    <body>
<form name="form" action="?CF=fenpei" method="post">
<table width="700" cellpadding="0" cellspacing="0" class="table">
<tr><td   align="right" class="tdsbg"><span style=" float:left;"><b><input type="checkbox" onClick="check(this.form)"> 全选</b></span><a href="javascript:TINY.box.hide()"><img src="SC_Page_Config/Image/icons/hr.gif" border="0" /></a></td></tr>

<tr><td>
<div class="alm">
<?php fonefenlei($_GET['st'],$db_conn); ?>
    <ul>
        <li><b>语种管理</b></li>
<?php flanguagefenlei($_GET['st'],$db_conn); ?>
    </ul>
</div>
</td>
</tr>
<tr>
    <td><input type="hidden" id="uid" name="uid" value="<?php echo $_GET['uid']; ?>" /> <input type="submit" name="button" id="button" value="分配" /> <span class="red"> 分配后需要重新登陆才能看到所应用的功能:修改后会自动退出！</span></td></tr>
</table>
</form>
    </body>
</html>

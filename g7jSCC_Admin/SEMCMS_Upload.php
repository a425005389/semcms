<?php include_once 'SEMCMS_Top_include.php'; ?>
 
<form action="SEMCMS_Upfile.php" method="post" enctype="multipart/form-data">
 

    <table width="98%" align="center" class="table" cellpadding="0" cellspacing="0">
        <tr><td height="30"  align="center"><b>文件上传</b></td></tr>
        <tr><td height="30"  align="left">自定义文件名：<input type="text" name="wname" id="wname" /> <span class="red">注意：此项可为空,只能输入英文跟数字</span> </td></tr>
        <tr><td height="30"  align="left">选择上传文件：<input type="file" name="file" id="file" /> </td></tr>
        <tr><td height="30"  align="center">
                <input type="hidden" name="imageurl" id="imageurl" value="<?php echo $_GET["Imageurl"]; ?>">
                <input type="hidden" name="filed" id="filed" value="<?php echo $_GET["filed"]; ?>">
                <input type="hidden" name="filedname" id="filedname" value="<?php echo $_GET["filedname"]; ?>">
                
                <input type="submit" id="submit" name="submit" value="Submit" /></td></tr>
        
    </table>
    </form>
</body>
</html>


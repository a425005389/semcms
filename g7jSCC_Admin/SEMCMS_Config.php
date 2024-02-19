<?php include_once 'SEMCMS_Top_include.php'; ?>
 
    <body class="rgithbd">
<div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle" /> <a href="SEMCMS_Middle.php">后台首页</a> > 参数设置</div>

     <?php
 
        $row = mysqli_fetch_array($db_conn->query("SELECT * FROM sc_config WHERE ID=1"))
     
      ?>
<form action="?Class=edit&CF=zcansu" name="form" method="post">
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
    <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" /> 基本参数 </td>
  </tr>
   <tr><td width="200" align="center">网站网址</td><td><input name="web_url" type="text" id="web_url" value="<?php echo $row['web_url'];?>" size="70" ></td></tr>
   <tr><td width="200" align="center">网站名称</td><td><input name="web_name" type="text" id="web_name" size="70" value="<?php echo $row['web_name'];?>"  ></td></tr>
   <tr><td width="200" align="center">网站Logo</td><td><input name="web_logo" type="text" id="web_logo" size="70" value="<?php echo $row['web_logo'];?>"  >  <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/default/&filed=web_logo&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span></td></tr>
   <tr><td width="200" align="center">网站icon图标</td><td><input name="web_ico" type="text" id="web_ico" size="70" value="<?php echo $row['web_ico'];?>"  >  <span id="uploads"><a href="javascript:;" onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/default/&filed=web_ico&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span> <span class="red"> 命名为：favicon,上传文件类型为：.ico</span></td></tr>
   <tr><td width="200" align="center">网站版权</td><td> <textarea name="web_copy" id="web_copy" cols="100" rows="5"><?php echo $row['web_copy'];?></textarea><span class="red"> 此处可以放入流量统计代码</span></td></tr>
</table>
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
    <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" /> 联系方式 </td>
  </tr>
  <tr><td width="200" align="center">网站邮箱</td><td><input name="web_email" type="text" id="web_email" value="<?php echo $row['web_email'];?>" size="40" ></td></tr>
   <tr><td width="200" align="center">网站Skype</td><td><input name="web_skype" type="text" id="web_skype" value="<?php echo $row['web_skype'];?>" size="40" ></td></tr>
    <tr><td width="200" align="center">网站WhatsApp</td><td><input name="web_wathsapp" type="text" id="web_wathsapp" value="<?php echo $row['web_wathsapp'];?>" size="40" ></td></tr>
  <tr><td width="200" align="center">网站电话</td><td><input name="web_tel" type="text" id="web_tel" value="<?php echo $row['web_tel'];?>" size="40" ></td></tr>
</table>
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
    <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" /> 邮件参数设置</td>
  </tr>
  <tr><td width="200" align="center">邮箱账号</td><td><input name="web_umail" type="text" id="web_email" value="<?php echo $row['web_umail'];?>" size="40" ></td></tr>
  <tr><td width="200" align="center">邮箱密码</td><td><input name="web_pmail" type="password" id="web_pmail" value="<?php echo $row['web_pmail'];?>" size="40" ></td></tr>
    <tr><td width="200" align="center">邮箱端口号</td><td><input name="web_dmail" type="text" id="web_dmail" value="<?php echo $row['web_dmail'];?>" size="40" ><span class="red"> 如：25,465</span></td></tr>
    <tr><td width="200" align="center">邮箱smtp</td><td><input name="web_smail" type="text" id="web_smail" value="<?php echo $row['web_smail'];?>" size="40" ><span class="red"> 如：smtp.xxx.com</span></td></tr>
    <tr><td width="200" align="center">邮箱地址</td><td><input name="web_tmail" type="text" id="web_tmail" value="<?php echo $row['web_tmail'];?>" size="40" ><span class="red">邮件地址  </span></td></tr>
      <tr><td width="200" align="center">询盘接收地址</td><td><input name="web_jmail" type="text" id="web_jmail" value="<?php echo $row['web_jmail'];?>" size="40" ><span class="red"> 用于接收询盘的地址,最好跟主邮件不同</span></td></tr>
       <tr><td width="200" align="center">是否开启</td><td><input type="checkbox" name="web_mailopen" id="web_mailopen" value="yes" <?php if ($row['web_mailopen']==1){echo 'checked="checked"';}?>  /><span class="red"> 开启正常接收询盘邮件,前提邮件参数配置正确</span></td></tr>
       
</table>
<table width="98%" class="table" cellpadding="0" cellspacing="0">
      <tr>
    <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" /> 其它参数设置</td>
  </tr>
      <tr><td width="200" align="center">SITEMAP</td><td> <a id="submit" href="?CF=sitemap">点击生成 google sitemap</a>  </td></tr> 
    <tr><td width="200" align="center">功能开启</td><td><input type="checkbox" name="web_https" id="web_https" value="yes" <?php if ($row['web_https']==1){echo 'checked="checked"';}?> > 是否https(需要安装证书) <input type="checkbox" name="web_jtopen" id="web_jtopen" value="yes" <?php if ($row['web_jtopen']==1){echo 'checked="checked"';}?> > 全站静态 <input type="checkbox" name="web_zsyopen" id="web_zsyopen" value="yes" <?php if ($row['web_zsyopen']==1){echo 'checked="checked"';}?> > 响应式插件(自式应手机端) <input type="checkbox" name="web_duo" id="web_duo" value="yes" <?php if ($row['web_duo']==1){echo 'checked="checked"';}?> > 多语言功能开启 <br><span class="red">说明:全站静态,自式应,多语功能免费版不支持</span></td></tr>  
  <tr><td width="200" align="center">产品列表数量</td><td><input name="web_plist" type="text" id="web_plist" value="<?php echo $row['web_plist'];?>" size="10" ><span class="red"> 前台显示一页产品的数量</span></td></tr>  
  <tr><td width="200" align="center">信息列表数量</td><td><input name="web_nlist" type="text" id="web_nlist" value="<?php echo $row['web_nlist'];?>" size="10" ><span class="red"> 前台显示一页新闻的数量</span></td></tr>
   <tr><td width="200" align="center">首页推荐产品数量</td><td><input name="web_iflist" type="text" id="web_iflist" value="<?php echo $row['web_iflist'];?>" size="10" ><span class="red"> 推荐产品的数量</span></td></tr>  
  <tr><td width="200" align="center">新产品数量</td><td><input name="web_inlist" type="text" id="web_inlist" value="<?php echo $row['web_inlist'];?>" size="10" ><span class="red"> 前台new products的数量</span></td></tr>
  <tr><td width="200" align="center">验证标签meate</td><td><textarea name="web_meate" type="text" id="web_meate"  rows="5"  cols="100" ><?php echo $row['web_meate'];?></textarea><span class="red"> 用于验证用,默认为空 </span></td></tr>
 <tr><td width="200" align="center">googl分析代码</td><td> <textarea name="web_google" id="web_google" cols="100" rows="5"><?php echo $row['web_google'];?></textarea></td></tr>
  <tr><td width="200" align="center">分享代码</td><td> <textarea name="web_share" id="web_share" cols="100" rows="5"><?php echo $row['web_share'];?></textarea> <span class="red"> 可填入 百度分享,addthis分享等</span></td></tr>
  <tr><td></td><td><input type="submit" value="修改" name="submit" id="submit" ></td></tr>
</table>
</form>
<?php 
 include_once 'SEMCMS_bot.php'; 
?>
</body>
</html>

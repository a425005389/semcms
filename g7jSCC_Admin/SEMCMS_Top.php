<?php include_once 'SEMCMS_Top_include.php'; ?>

<body bgcolor="#404040">

 <div class="back_Top_1">
     <div class="back_Top_1_left"><img src="SC_Page_Config/Image/logo.png" alt="黑蚂蚁外贸网站管理系统" title="黑蚂蚁外贸网站管理系统" /></div>
        <div class="back_Top_1_right"> <div class="lgauelist"><?php  echo languagefenlei($SCQuanXian,$db_conn,$lgid); ?></div><iframe width="300" id="authorization" src="//www.sem-cms.com/authorization/"></iframe><img src="SC_Page_Config/Image/help.png" align="absmiddle" title="帮助文档" alt="帮助文档" /> <a href="http://www.sem-cms.com/help/" title="帮助文档" target="_blank">帮助文档</a></div>
 </div>
 <div class="cb"></div>
 <div class="back_Top_2"><span id='sz'> </span><script type="text/javascript">
function showLocale(objD)
{
var str,colorhead,colorfoot;
var yy = objD.getYear();
if(yy<1900) yy = yy+1900;
var MM = objD.getMonth()+1;
if(MM<10) MM = '0' + MM;
var dd = objD.getDate();
if(dd<10) dd = '0' + dd;
var hh = objD.getHours();
if(hh<10) hh = '0' + hh;
var mm = objD.getMinutes();
if(mm<10) mm = '0' + mm;
var ss = objD.getSeconds();
if(ss<10) ss = '0' + ss;
var ww = objD.getDay();
if  ( ww==0 )  colorhead="<font color=\"#FFFFFF\">";
if  ( ww > 0 && ww < 6 )  colorhead="<font color=\"#FFFFFF\">";
if  ( ww==6 )  colorhead="<font color=\"FFFFFF\">";
if  (ww==0)  ww="星期日";
if  (ww==1)  ww="星期一";
if  (ww==2)  ww="星期二";
if  (ww==3)  ww="星期三";
if  (ww==4)  ww="星期四";
if  (ww==5)  ww="星期五";
if  (ww==6)  ww="星期六";
colorfoot="</font>"
str = colorhead + yy + "-" + MM + "-" + dd + " " + hh + ":" + mm + ":" + ss + "  " + ww + colorfoot;
return(str);
}
function tick()
{
var today;
today = new Date();
document.getElementById("sz").innerHTML = showLocale(today);
window.setTimeout("tick()", 1000);
}
tick();
     </script>  <span id="yb"><img src="SC_Page_Config/Image/icons/user.png" align="absmiddle" > Hi, <?php echo htmlspecialchars($_COOKIE["scusername"]); ?>    [当前登录IP:<?php echo getRealIp(); ?>] | <a href="SEMCMS_Top_include.php?CF=users&Class=loginout" target="_top">安全退出</a> | <a href="SEMCMS_Middle.php" target="mainFrame">返回首页</a></span></div>


</body>
</html>

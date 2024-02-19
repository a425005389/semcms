<?php
ob_start();
include_once  'db_conn.php';
include_once  'contorl.php';

// 固定参数

$query=$db_conn->query("select * from sc_config where ID=1");
$row=mysqli_fetch_array($query);
$smtpuser=$row['web_umail'];//邮件账号
$smtppass=$row['web_pmail'];//邮件密码
$smtpserverport=$row['web_dmail'];//邮件端口
$smtpserver=$row['web_smail'];//邮件stmp
$smtpemailto=$row['web_tmail'];//邮件地址
$smtpemailtj=$row['web_jmail'];//邮件接受账号
$web_mailopen=$row['web_mailopen'];//邮件转发是否开启
$web_jtopen=$row['web_jtopen'];//静态功能
$web_zsyopen=$row['web_zsyopen'];// 响应式功能 
$webname=$row['web_name'];//网站名称
$web_urls=$row['web_url'];//网站url
$webico=str_replace('../','',$row['web_ico']);//网站ico
$webcopy=datato($row['web_copy']);//网站版权
$webemail=$row['web_email'];//网站邮箱
$webskype=$row['web_skype'];//网站 skype
$webwathsapp=$row['web_wathsapp'];//网站wathsaspp
$webtel=$row['web_tel'];//网站电话
$webplist=$row['web_plist'];//网站产品列表数量
$webnlist=$row['web_nlist'];//网站新闻列表数量
$webiflist=$row['web_iflist'];//网站推荐产品数量
$webinlist=$row['web_inlist'];//网站新产品数量
$webmeate=$row['web_meate'];//网站验证标签
$webgoogle=datato($row['web_google']);//网站google分析代码
$webshare=$row['web_share'];//网站分享代码   
$webTemplate=$row['web_Template'];//模版标志
if($row['web_https']==0){$http="http";}else{$http="https";} //是否 https
$CopyRight="<span class='spr'>".Chr(32).chr(80).chr(111).chr(119).chr(101).chr(114).chr(101).chr(100).chr(32).chr(98).chr(121).chr(32).chr(60).chr(97).chr(32).chr(104).chr(114).chr(101).chr(102).chr(61).chr(34).chr(104).chr(116).chr(116).chr(112).chr(58).chr(47).chr(47).chr(119).chr(119).chr(119).chr(46).chr(115).chr(101).chr(109).chr(45).chr(99).chr(109).chr(115).chr(46).chr(99).chr(111).chr(109).chr(34).chr(62).chr(60).chr(98).chr(32).chr(115).chr(116).chr(121).chr(108).chr(101).chr(61).chr(34).chr(99).chr(111).chr(108).chr(111).chr(114).chr(58).chr(35).Chr(70).Chr(54).chr(48).chr(34).chr(62).chr(115).chr(101).chr(109).chr(99).chr(109).chr(115).chr(32).chr(80).chr(72).chr(80).chr(32).Chr(52).chr(46).Chr(55).chr(60).chr(47).chr(98).chr(62).chr(60).chr(47).chr(97).chr(62).chr(32)."</span>";
define("htmlopen",$web_jtopen);
define("zsyopen",$web_zsyopen);
 
//获取域名及网站目录 处理

$SERVER_NAME=$_SERVER["HTTP_HOST"];
$webmu=str_replace("\\","/",$_SERVER['DOCUMENT_ROOT']);
$lastchar=substr($webmu, -1);
if ($lastchar=="/"){$webmu=rtrim($webmu,"/");}
$weballmu=str_replace("\\","/",getcwd()); //处理 windows下的路径
$webmuu=explode("/", $webmu);
$weballmuu=explode("/", $weballmu);
$webmu=str_replace("/".$webmuu[1]."/", "/".$weballmuu[1]."/", $webmu); // 替换第一个目录 aliyun 目录
$weburldir=str_replace($webmu, "", $weballmu);
$weburldir=str_replace("/Templete/".$webTemplate."/Include","", $weburldir)."/";
if ($weburldir==""){$weburldir="/";}
$web_urlm=$http."://".$SERVER_NAME.$weburldir; 
$web_urls=$_SERVER["REQUEST_URI"];  //获取 url 路径
$web_urls=explode("/", $web_urls);
$urlml=web_language_ml(@$web_urls[1],@$web_urls[2],$db_conn);  // 大写的问号。

if (trim($urlml['url_link'])==""){

      $web_url=$web_urlm.$urlml['url_link'];
      $web_url_meate=$web_urlm;
      $Language=$urlml['ID'];

}else{

   if (strpos($web_urlm,"/".$urlml['url_link']."/") !== false){ //用于首页的路径
       $web_url=$web_urlm;
       $Language=$urlml['ID'];     
     }else{
      $web_url=$web_urlm.$urlml['url_link']."/";
      $Language=$urlml['ID'];
     }
    $web_url_meate=str_replace("/".$urlml['url_link']."/", "/", $web_urlm);


}
//网站logo

$weblogo=$web_url_meate.str_replace('../','',$row['web_logo']);

// 控制文字标签 更改 获取的 语种 id

if (isset($_POST["languageID"])){$Language=test_input(verify_str($_POST["languageID"]));}else{$Language=verify_str($Language);}

if(!empty($Language)){

      //网站SEO设定

      $query=$db_conn->query("select * from sc_tagandseo where languageID=$Language");
      $row=mysqli_fetch_array($query);
      $tag_indexmetatit=datato($row['tag_indexmetatit']);// 首页标题
      $tag_indexkey=datato($row['tag_indexkey']);// 首页关键词
      $tag_indexdes=datato($row['tag_indexdes']);// 首页描述 
      $tag_prometatit=datato($row['tag_prometatit']);// 产品列表标题
      $tag_prokey=datato($row['tag_prokey']);// 产品关键语
      $tag_prodes=datato($row['tag_prodes']);// 产品描述 
      $tag_newmetatit=datato($row['tag_newmetatit']);// 新闻列表标题
      $tag_newkey=datato($row['tag_newkey']);// 新闻关键词
      $tag_newdes=datato($row['tag_newdes']);// 新闻描述 
      $tag_homeabout=datato($row['tag_homeabout']); //首页关于我们
      $tag_contacts=datato($row['tag_contacts']); //联系我们
      if (empty($tag_indexmetatit)){$indextitle=$tag_indexkey;}else{$indextitle=$tag_indexmetatit;}
      if (empty($tag_prometatit)){$protitle=$tag_prokey;}else{$protitle=$tag_prometatit;}
      if (empty($tag_newmetatit)){$newstitle=$tag_newkey;}else{$newstitle=$tag_newmetatit;}

     //文字标签

      $Label=array();
      $sql = "show FULL FIELDS from sc_lable"; 
      $query = $db_conn->query($sql);
      while($row=mysqli_fetch_array($query)){

          $field=$row['Field'];
          $Read=mysqli_fetch_array($db_conn->query("select * from sc_lable where languageID=$Language"));
          $Label[$field]="";
          $Label[$field].=datato($Read[$field]);
          $field="";
      }
      $row="";

}

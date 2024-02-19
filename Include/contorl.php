<?php
include_once "class.phpmailer.php"; 
// 防sql入注
if (isset($_GET)){$GetArray=$_GET;}else{$GetArray='';} //get
foreach ($GetArray as $value){ //get
    verify_str($value);
}
function inject_check_sql($sql_str) {

     return preg_match('/select|and|insert|=|%|<|between|update|\'|\*|union|into|load_file|outfile/i',$sql_str); 
} 
function verify_str($str) { 
       if(inject_check_sql($str)) {
           exit('Sorry,You do this is wrong! (.-.)');
        } 
    return $str;
} 

//邮件发送代码
function SendEmail($smtpserver,$smtpuser,$smtppass,$smtpusermail,$smtpserverport,$smtptoemail,$mailtitle,$mailcontent){
 
    $mail = new PHPMailer(); //建立邮件发送类
    $mail->IsSMTP();                // 使用SMTP方式发送
    $mail->CharSet = "utf-8"; 
    $mail->Host = $smtpserver;     // 您的企业邮局域名
    $mail->SMTPAuth = true; // 启用SMTP验证功能 
    if ($smtpserverport<>25){ //除25端口外启用ssl
         $mail->SMTPSecure = "ssl";// SMTP 安全协议      
    }
    $mail->Username = $smtpuser;   // 邮局用户名(请填写完整的email地址)
    $mail->Password = $smtppass;   // 邮局密码
    $mail->Port=$smtpserverport;   // 邮件端口
    $mail->From = $smtpusermail;   // 邮件发送者email地址
    $mail->FromName = $_SERVER['SERVER_NAME'];//以当前域名为名称
    $mail->AddAddress($smtptoemail,"");
    $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
    $mail->Subject = $mailtitle; //邮件标题
    $mail->Body = $mailcontent; //邮件内容
    $mail->AltBody = ""; //附加信息，可以省略      
            
    if(!$mail->Send()){
       //echo "warning:".$mail->ErrorInfo;
       echo "<script language='javascript'>alert('".$mail->ErrorInfo."');location.href='../';</script>";
       exit;
     } 
}

//获取IP方法 

 function getRealIp(){
  
    $ip=FALSE;
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
        for ($i = 0; $i < count($ips); $i++) {
            if (!preg_match ("/^(10│172.16│192.168)./i", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}
 
 // add update del

class AntDateProcess{ 
              
        public function AntAdd($table,$field,$val,$db_conn){ // 增
            $strs="";
            foreach($val as $value){
             
                 $strs.="'".$value."',";
             }
          
            $strs= substr($strs, 0, -1);
            
            $db_conn->query("INSERT INTO  $table ($field) VALUES ($strs)");
           
           }
        
         public function AntEdit($table,$field,$val,$ID,$db_conn){ // 改

             $strs="";
             $str= explode(",", $field);
             $i=0;
             foreach($str as $value){
                 
                 $strs.=$value."='".$val[$i]."',";
                 $i=$i+1;
                 
             }
        
             $strs= substr($strs, 0, -1);           
            
             $db_conn->query("update $table set $strs where ID=$ID"); 
            
         }
         
        public function AntDel($table,$ID,$db_conn){ // 删          

            $db_conn->query("delete from  $table  WHERE ID in ($ID)");
            
         }

         // 数据查询匹配

           public function checkdatas($table,$field,$str,$db_conn){

                if (mysqli_num_rows($db_conn->query("SELECT * FROM $table WHERE $field='".$str."'"))>0 ){

                          $havedate="1";
                  }else{

                          $havedate="0";

                        }

                        return $havedate;
              }
             
      }


//信息查询
  
function ChecInfo($biao,$ziduan,$str,$fl,$id,$db_conn){

              if ($fl=="f") {

                  $queryc=$db_conn->query("SELECT * FROM $biao WHERE $ziduan=".$str);

                  }else{

                   $queryc=$db_conn->query("SELECT * FROM $biao WHERE $ziduan='$str'");

                  }

                  $rowc=mysqli_fetch_assoc($queryc);
                  $str=$rowc[$id];
                  return $str;

       }

   //表单验证

function test_input($data) { 
      //$data = str_replace("%", "percent", $data);
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data,ENT_QUOTES);
      return $data;
   }


function checkuser($db_conn){ //判断用户是否登陆

    $cookieuseradmin=@verify_str(test_input($_COOKIE["scuseradmin"]));
    $cookieuserpass=@verify_str(test_input($_COOKIE["scuserpass"]));

    $query=$db_conn->query("select * from sc_user where user_admin='$cookieuseradmin' and user_ps='$cookieuserpass'");

    if (mysqli_num_rows($query)>0){

         $row=mysqli_fetch_assoc($query);
         return $row['user_qx'];

     }else{

        echo "<script language='javascript'>alert('账号密码不正确重新登陆！');top.location.href='index.html';</script>";
        exit; 
    }

}

//判断数据,输出空符

function Panduans($str){  

     if ($str<1){
         
            echo '<tr><td colspan="10">没有相关信息！</td></tr>';
         
         }
    }

function goto404($str){


     if ($str<1){
         
            header("Location: 404.html"); 
 
         
         }

}

//检测权限

function checkqx($dirname){

    $fd=@opendir($dirname);
    if($fd===false){

         echo $dirname."文件存在:不可读,不可写<br />" ;

    }else{

        if(is_writable($dirname)){

            echo $dirname."   文件可读可写<br />" ;

            }else{

            echo $dirname."     文件可读,不可写<br />" ;

            }
        }
}


// 文件名替换方法

function Streplace($str){

    $str=trim($str);
    $str=str_replace(" ","-",$str);
    $str=str_replace("*","-",$str);
    $str=str_replace("?","-",$str);
    $str=str_replace("<","-",$str);
    $str=str_replace(">","-",$str);
    $str=str_replace("|","-",$str);
    $str=str_replace("/","-",$str);
    $str=str_replace("&","-",$str);
    $str=str_replace("'","",$str);
    $str=str_replace(".","",$str);
    $str=str_replace("+","",$str);
    return $str;

}


//列出模版

function TemplateDir($dir,$webTemplate){

  $x=0;
  $directory=scandir($dir);

  for($i=0;$i<sizeof($directory);$i++){
  
      if (is_dir($dir.$directory[$i]."/")&& $directory[$i]!="." && $directory[$i]!=".."){
          
          if ($webTemplate==$directory[$i]){ //判断当前模版
              
              $current_mb='<img src="SC_Page_Config/Image/icons/tick.png" align="absmiddle" />';
          }else{
              
              $current_mb='<img src="SC_Page_Config/Image/icons/cross.png" align="absmiddle" />' ;
           }
          $x=$x+1;
          echo "<tr><td>".$x."</td><td><img src='../Templete/".$directory[$i]."/".$directory[$i].".png' width='250'></td><td>".$directory[$i]."</td><td>".$current_mb."</td><td><a href='?CF=template&mb=".$directory[$i]."'>应用</a> </td></tr>";
           
           
      }
  }
          
}

  

function delDirAndFile($dirName){

    if ( $handle = opendir("$dirName" ) ) {

    while ( false !== ( $item = readdir( $handle ) ) ) {

      if ( $item != "." && $item != ".." ) {

        if ( is_dir("$dirName/$item") ) {

          delDirAndFile("$dirName/$item");

        }else{

          unlink("$dirName/$item");

        }

      }

    }

    closedir($handle);

     rmdir($dirName);

    }

}


//目录及 路径判断

function web_language_ml($web_urls1,$web_urls2,$db_conn){
    
  $query=$db_conn->query("select * from sc_language where language_url='$web_urls1' or  language_url='$web_urls2' and  language_open=1");

      if (mysqli_num_rows($query)>0){

          $query=$db_conn->query("select * from sc_language where language_url='$web_urls1' or  language_url='$web_urls2' and  language_open=1");
          $row=mysqli_fetch_assoc($query);
          $Urlink=array('url_link'=>$row['language_url'],'url_ml'=>"../",'ID'=>$row['ID']);

      }else{

         $query=$db_conn->query("select * from sc_language where language_mulu=1 and  language_open=1");
         $row=mysqli_fetch_assoc($query);
         $Urlink=array('url_link'=>"",'url_ml'=>"./",'ID'=>$row['ID']);

      }

    return $Urlink; 
}

// 数据转换

function datato($str){

   $str=htmlspecialchars_decode($str,ENT_QUOTES);
   return $str;

}


// 导航 url 转换


 function UrltoHtmlNav($ul){

    $url="";

    if (htmlopen==1){

          $nvaurl=explode("?", $ul);
          
          if ($nvaurl[0]=="about.php"){

             $ul="about.php";

           }else{
            
             $ul=$ul;

           }

            switch ($ul) { 

                case 'product.php':

                    $url="product/";

                    break;
                
                case 'about.php':

                    $url="about/about-us.html";

                    break;
                case 'news.php':

                    $url="news/list/";

                    break;

                case 'download.php':

                    $url="nav/download.html";

                    break;

                case 'contact.php':

                    $url="nav/contact.html";
                    break;
                 default:
                 $url=$ul;
                 break;
            }

     }else{


         $url=$ul;


      }
        return $url;

 }

<?php
session_start();
include_once  'web_inc.php';
if (isset($_GET["type"])){$Type = $_GET["type"];}else{$Type="";}
$Type=test_input(verify_str($Type));

// 找回密码

if ($Type=="fintpassword"){
    
    $postEmail=test_input(verify_str($_POST['Email']));
    
    if ($postEmail!==""){ // 判断是否输入邮箱
          
      $result=$db_conn->query("select * from sc_user where user_email='".$postEmail."'");
      $row = mysqli_fetch_array($result,MYSQL_ASSOC);

      if (mysqli_num_rows($result)>0){ 

         $fsjs=rand(10,10000);  //邮件认证码 
         $fhurl=str_replace("SEMCMS_Remail.php","",$_POST['furl']);
         $smtpusermail=$smtpemailto;
         $smtptoemail=$postEmail;
         $mailtitle="来自".$_SERVER['SERVER_NAME']."密码找回邮件！";
         $mailcontent="网站管理员你好：<br>你的邮箱是：".$postEmail."<br> 点击<a href='".$fhurl."?umail=".$postEmail."&type=ok' target='_blank'>找回密码</a>"
                 . " 或者复制以下链接到浏览器浏览 <br>"
                 . "".$fhurl."?umail=".$postEmail."&type=ok <br>认证码：".$fsjs."<br>请妥善保管！";
         
       $db_conn->query("UPDATE sc_user SET user_rzm='$fsjs' WHERE user_email='".$postEmail."'");
    
    // 邮件发送

    echo  SendEmail($smtpserver,$smtpuser,$smtppass,$smtpusermail,$smtpserverport,$smtptoemail,$mailtitle,$mailcontent);
    echo'<script language="javascript">alert("已发送到你的'.$postEmail.'邮箱！");location.href="'.$fhurl.'";</script>'; 

          }else{

           echo'<script language="javascript">alert("此邮箱不存在！");history.go(-1);</script>'; 

          }    

    }else{
        
        echo'<script language="javascript">alert("请输入正确的邮箱！");history.go(-1);</script>';
     }

}elseif ($Type=="findok"){ //  密码找回  
 
     $umail=test_input(verify_str($_POST['Email']));
     $umm=test_input(verify_str($_POST['umima']));
     $urzm=test_input(verify_str($_POST['uyzm']));
     $fhurl=str_replace("SEMCMS_Remail.php","",$_POST['furl']);

     if(empty($umail) || empty($umm) || empty($urzm)){
         
          echo'<script language="javascript">alert("请输入密码与认证码！");history.go(-1);</script>';   
         
     }else{
         
         $query=$db_conn->query("select * from sc_user where user_email='".$umail."' and user_rzm='".$urzm."'");

         if (mysqli_num_rows($query)>0){

         $db_conn->query("UPDATE  sc_user SET user_ps=md5($umm)  WHERE user_email='".$umail."' and user_rzm='$urzm'"); 
       
         echo'<script language="javascript">alert("操作成功返回登陆！");location.href="'.$fhurl.'";</script>';

         }else{

          echo'<script language="javascript">alert("邮箱或者验证码错误");location.href="'.$fhurl.'";</script>';  
         } 
         
     }   
    
}elseif($Type=="MSG"){ //询盘发送！
    
 $msg_email=test_input(verify_str($_POST['mail']));
 $msg_content=test_input(verify_str($_POST['tent']));
 $yzm=$_POST['yzm'];
 $msg_tel=test_input(verify_str($_POST['tel']));
 $names=test_input(verify_str($_POST['name']));
 $msg_pid=test_input(verify_str($_POST['PID']));
 $msg_languageID=test_input(verify_str($_POST['languageID']));
 $msg_time=date("Y-m-d h:i:s",time());
 $msg_ip=test_input(verify_str(getRealIp()));
 
 if($yzm == $_SESSION['authcode']){
       
      if(preg_match('/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[-_a-z0-9][-_a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,})$/i',$msg_email) && $names!==""){ 

  //写入数据库
if(strpos($msg_content,'http') !== false){ 
 
    }else{
            $db_conn->query("INSERT INTO sc_msg(msg_pid,msg_email,msg_content,msg_ip,msg_name,msg_tel,msg_time,languageID)"
               . "VALUES ('$msg_pid','$msg_email','$msg_content','$msg_ip','$names','$msg_tel','$msg_time','$msg_languageID')");  

          //邮件发送 

          $mailtitle="注意:来自".$_SERVER['SERVER_NAME']."网站的询盘";
          $mailcontent="邮箱:".$msg_email."<br>"
                  . "姓名:".$names."<br>"
                  . "电话:".$msg_tel."<br>"
                  . "留言:".$msg_content."<br>"
                  . "IP地址:".$msg_ip."<br>"
                  . "详细信息登陆网站后台查看！";


          if ($web_mailopen==1){

            echo  SendEmail($smtpserver,$smtpuser,$smtppass,$smtpemailto,$smtpserverport,$smtpemailtj,$mailtitle,$mailcontent);  
          
          }

  }
           echo "<script language='javascript'>alert('".$Label["tag_messgetj"]."');window.location.href=document.referrer;</script>'";

      }else{ 

           echo "<script language='javascript'>alert('".$Label["tag_messgets"]."');history.go(-1);</script>'"; 
 
      } 

 }else{

        echo "<script language='javascript'>alert('".$Label["tag_messgets"]."');history.go(-1);</script>'";        
 }

    
}elseif($Type=="Remail"){//邮件回复
    
 $msg_email=test_input($_POST['in_emial']);
 $msg_content=$_POST['contents'];
 $mailtitles=test_input($_POST['in_title']);
 
 
    if(preg_match('/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[-_a-z0-9][-_a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,})$/i',$msg_email) && $msg_content!==""){ 
     
        //邮件发送 

        $mailtitle=$mailtitles;
        $mailcontent=$msg_content;
        echo  SendEmail($smtpserver,$smtpuser,$smtppass,$smtpemailto,$smtpserverport,$msg_email,$mailtitle,$mailcontent);  
        echo "<script language='javascript'>alert('成功发送!');window.location.href=document.referrer;</script>'";

    }else{

      echo "<script language='javascript'>alert('发送错误!');history.go(-1);</script>'";

    }       
      
}elseif($Type=="Newsletter"){ //邮件订阅

 $mails=test_input(verify_str($_POST['mail']));
 $mailip=test_input(verify_str(getRealIp()));

if(preg_match('/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[-_a-z0-9][-_a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,})$/i',$mails)){

            //写入数据库

            $db_conn->query("INSERT INTO sc_email(e_ml,e_ip) VALUES ('$mails','$mailip')");  
            echo "<script language='javascript'>alert('".$Label["tag_messgetj"]."');window.location.href=document.referrer;</script>'";

    }else{

            echo "<script language='javascript'>alert('".$Label["tag_messgets"]."');history.go(-1);</script>'"; 

    }

}
<?php include_once 'SEMCMS_Top_include.php'; ?>

<body>
<?php
  $Imagestent="";
  $files=$_FILES['imgs'];
  $msg=array();    
  foreach ($files['tmp_name'] as $index=>$file){

    // 如果是图像文件 检测文件格式

    $name = $files['name'][$index];
    $kzm=explode(".",$name);//扩展名
    $kzm=end($kzm);
    $imgsize=$files['size'][$index]; //图片大小

    if (in_array(strtolower($kzm),array('gif', 'jpg', 'jpeg', 'bmp', 'png'))){

        $info = getimagesize($file); //获取图片信息
      if (false === $info) {
          
           echo "不是有效图片,请重新选择";

           exit;

      }else{

              if ($imgsize > 1 && $imgsize < 1000001){ //图片大小控制在 500 K以内

                   $Imageurl=$_POST["imageurl"]; //图片存放路径

                  if (test_input($_POST["wname"])!==""){//自定义文件名
                      
                    $newname=test_input($_POST["wname"]).rand(0,9999).".".$kzm; //新的文件名 
                    
                  }else{
                  
                       $rand=rand(10,100);//随机数
                       $date = date("ymdhis").$rand;//文件名：时间+随机数
                       $newname=$date.".".$kzm; //新的文件名
                  }

                    move_uploaded_file($file,$Imageurl.$newname); //文件写入文件夹
     
                    $Imagestent.="<div class=\'pimg\'><img src=\'".$Imageurl.$newname."\' width=\'50\'> <input name=\'products_Images[]\' value=\'".$Imageurl.$newname."\' type=\'hidden\' size=\'20\'  ></div>";
                   

              }else{
                 
                echo "1.请检查文件上传类型.\n 允许格式:jpe,gif,png,jpeg,bmp \n 2.上传大小500K之内.";
                exit;
              }


              echo"<script language='javascript'>window.opener.document.getElementById('proimgs').innerHTML+='".$Imagestent."';</script>";
              $Imagestent="";
              echo"<script language='javascript'>window.close();</script>";    
        
      }


    }else{
          
           echo "上传失败,重新选择 允许格式:jpe,gif,png,jpeg,bmp";
          exit;
    }

  }
 ?>


</body>
</html>
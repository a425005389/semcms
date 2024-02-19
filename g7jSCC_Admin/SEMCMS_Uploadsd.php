<?php include_once 'SEMCMS_Top_include.php'; ?>
<script src="SC_Page_Config/Js/jquery-ui.js"></script>
 <style type="text/css">
     

     #file{opacity: 100;  }


 </style>

<script type="text/javascript">

  $(function() {
    $( "#igs" ).sortable();
    $( "#igs" ).disableSelection();
  });
   
 $(document).ready(function(){ 

    $('#uploads').click(function(){

        $('#file').click();

    });

});


 function deldiv(id){ //移除图片
    var docObj = document.getElementById("file").files;

    $("#"+id).remove();



              
                var fileList = Array.from(docObj);                
                for(var j=0;j<fileList.length;j++){                    
                    if(fileList[j].name = filename){
                        fileList.splice(j,1);                        
                        break;
                    }
                }
               docObj = fileList

                console.log(docObj);
 

}



 
    function setImagePreviews(avalue) {

        var docObj = document.getElementById("file");

        var igs = document.getElementById("igs");

        //igs.innerHTML = "";

        var fileList = docObj.files;


 

        for (var i = 0; i < fileList.length; i++) {   

               
            j= Math.ceil(Math.random()*1000000); 
            igs.innerHTML += "<div style='float:left; margin:2px;' id='d"+j+"'> <img id='img" +  j + "'  />  <br> <a href=javascript:deldiv('d"+j+"');>删除</a> </div>";

            var imgObjPreview = document.getElementById("img"+ j); 
            var tObjPreview = document.getElementById("t"+ j); 

            if (docObj.files && docObj.files[i]) {

                //火狐下，直接设img属性

                imgObjPreview.style.display = 'block';

                imgObjPreview.style.width = '100px';

               // imgObjPreview.style.height = '180px';

                //imgObjPreview.src = docObj.files[0].getAsDataURL();

                //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式

 
                imgObjPreview.src = window.URL.createObjectURL(docObj.files[i]);

               // alert(getObjectURL(imgObjPreview.src));
                //tObjPreview.value=window.URL.createObjectURL(docObj.files[i])



            }

            else {



                //IE下，使用滤镜

                docObj.select();

                var imgSrc = document.selection.createRange().text;

                alert(imgSrc)

                var localImagId = document.getElementById("img" +  j);

                //必须设置初始大小

                localImagId.style.width = "100px";

              //  localImagId.style.height = "180px";

                //图片异常的捕捉，防止用户修改后缀来伪造图片

                try {

                    localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";

                    localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;

                }

                catch (e) {

                    alert("您上传的图片格式不正确，请重新选择!");

                    return false;

                }

                imgObjPreview.style.display = 'none';

                document.selection.empty();

            }




        }  



        return true;

    }

 

</script>
<body class="rgithbd">
 
<form action="SEMCMS_Upfiles.php" method="post" enctype="multipart/form-data">
 

    <table width="98%" align="center" class="table" cellpadding="0" cellspacing="0">
  <tr> <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">图片上传</span> </td></tr>
 
        <tr><td height="30"  align="left">自定义文件名：<input type="text" name="wname" id="wname" size="60" /> <br><span class="red">注意：此项可为空,只能输入英文跟数字 如:HD-photo词与词之前只能用 - 链接,除数字、字母、- 其它符号不充许出现</span> </td></tr>
        <tr><td height="30"  align="left">选择上传文件：<input type="file" accept="image/*" name="file[]" id="file" multiple="multiple" onchange="javascript:setImagePreviews();" /> <span id="uploads"> <a href="javascript:;"> + 添加图片</a></span>


            <br><span class="red">图片可多选</span></td></tr>
        <tr><td id="igs"></td></tr>
        <tr><td align="center" >
                <input type="hidden" name="imageurl" id="imageurl" value="<?php echo $_GET["Imageurl"]; ?>">
                <input type="submit" id="submit" name="submit" value="确定上传" /></td></tr>
        
    </table>
    </form>
</body>
</html>


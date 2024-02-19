<?php include_once 'SEMCMS_Top_include.php'; ?>
<style>
#file{ width: 0;opacity:0; }
</style>
<script>

$(document).ready(function(){ 
    var files=[];    
    var that = this;
    $("#upload").click(function(){
        $("#file").trigger("click");
    })
    $("#file").change(function(){        
        document.getElementById("gallery").innerHTML="";        
        var img=document.getElementById("file").files; 
        var div=document.createElement("div");  
        for(var i=0;i<img.length;i++){            
            var file=img[i]; 
            var url=URL.createObjectURL(file); 
            var box=document.createElement("img"); 
            box.setAttribute("src",url); 
            box.className='img';            
            var imgBox=document.createElement("div");
            imgBox.style.display='inline-block';
            imgBox.className='img-item';            
            var deleteIcon = document.createElement("span");
            deleteIcon.className = 'delete';
            deleteIcon.innerText = 'x';
            deleteIcon.dataset.filename = img[i].name;
            imgBox.appendChild(deleteIcon);
            imgBox.appendChild(box);            
            var body=document.getElementsByClassName("gallery")[0]; 
            body.appendChild(imgBox);
            that.files = img;
            $(deleteIcon).click(function () {                
                var filename = $(this).data("filename");
                $(this).parent().remove();                
                 var fileList = Array.from(that.files); 

                for(var j=0;j<fileList.length;j++){                    
                    if(fileList[j].name = filename){
                        fileList.splice(j,1);                        
                        break;
                    }
                }
                that.files = fileList

            })
        }
    })
    $("#uploadImg").click(function(){
        $('.sucessMessage').html("图片正在上传中,请耐心等待");
        $('.sucessMessage').show();            
        var files = that.files;                
        var uploadFile = new FormData($("#formdata")[0]);                
        for(var i=0;i<files.length;i++){
                    uploadFile.append('imgs[]',files[i]);
                }                
                if("undefined" != typeof(uploadFile) && uploadFile != null && uploadFile != ""){
                    $.ajax({                        
                    url:'SEMCMS_Upfiles.php',                        
                    type:'POST',                        
                    data:uploadFile,                        
                    async: false,                        
                    cache: false,                        
                    contentType: false, //不设置内容类型
                    processData: false, //不处理数据
                    success:function(data){
                    $('.sucessMessage').html(data);
                    $('.sucessMessage').show();

                        },                        
                        error:function(){
                         alert("上传失败！");
                        }
                    })
                }else {

                }
            });

 });  

</script>
<body class="rgithbd">
 
<form  method="post" enctype="multipart/form-data" id="formdata">
    <table width="98%" align="center" class="table" cellpadding="0" cellspacing="0">
  <tr> <td colspan="4"  class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle" />  <span class="red">图片上传</span> </td></tr>
 
        <tr><td height="30"  align="left">自定义文件名：<input type="text" name="wname"   id="wname" size="60" /> <br><span class="red">注意：此项可为空,只能输入英文跟数字 如:HD-photo词与词之前只能用 - 链接,除数字、字母、- 其它符号不充许出现</span> </td></tr>
        <tr><td height="30"  align="left">选择图片上传：<input id="file" type="file" multiple="multiple" ><div id="upload" class="btn btn-primary"> + 选择图片</div></span><br><span class="red">图片可多选</span></td></tr>
        <tr><td  class="gallery" id="gallery"></td></tr>
        <tr><td align="center" >
                <input type="hidden" name="imageurl" id="imageurl" value="<?php echo $_GET["Imageurl"]; ?>">
               <div class="btn btn-success" id="uploadImg">上传</div> <div class="sucessMessage"></div></td></tr>
        
    </table>
    </form>
</body>
</html>
 

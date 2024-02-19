// JavaScript Document

var xmlHttp;
function S_xmlhttprequest(){
var xmlHttp=null;
if (window.XMLHttpRequest){
//对于Mozilla、Netscape、Safari等浏览器，创建XMLHttpRequest对象
xmlHttp = new XMLHttpRequest();
if (xmlHttp.overrideMimeType){
//如果服务器响应的header不是text/xml，可以调用其它方法修改该header
xmlHttp.overrideMimeType('text/xml');
}
} else if (window.ActiveXObject){
// 对于Internet Explorer浏览器，创建XMLHttpRequest
try{
xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e){
try{
xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e){}
}
}
return xmlHttp;
} 

  
function Fetch(Sl,ZK)
{
    
     var objS = document.getElementById(Sl);
     var ID = objS.options[objS.selectedIndex].value;
	 //alert(ID);
	S_xmlhttprequest();
    xmlHttp.open("GET","SEMCMS_ajax.asp?type="+ZK+"&id="+ID,true);
	  //alert("/Admin/SEMCMS_ajax.asp?type="+ZK+"&id="+ID);
	//alert(encodeURIComponent(ZK));
    xmlHttp.onreadystatechange = function()
{
	alert(xmlHttp.Status);
	//alert('ok');
    if(xmlHttp.readyState == 1)
    {
        document.getElementById(ZK).innerHTML = "loading...";
    }
    if(xmlHttp.readyState == 4)
    {
       if(xmlHttp.Status == 200)
	   
           {
		   
           var v = xmlHttp.responseText;
		   //alert(v);
           document.getElementById(ZK).innerHTML = v;
		   
           }
    }
}
	
    xmlHttp.send(null);
}


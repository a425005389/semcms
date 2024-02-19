 
    $(document).ready(function(){


      $(window).scroll(function(){
        var top=$(window).scrollTop();
        if(top>200){
          $("#rightTop").fadeIn();
        }else{
          $("#rightTop").fadeOut();
        }
      });

     $("#rightTop").click(function(){
           $("html,body").animate({scrollTop:0});
      });     



        $("#subscmit").click(function(){
           if ($("#mail").val()==""){
            alert('Please,enter your E-mail!');
            $("#mail").focus();
            return false;
           }else{
            $("#subsc").submit();
           }

        });
 
    $(".sc_top_list").click(function(){$("#navalink").fadeIn();});
        $("#cls").click(function(){$("#navalink").fadeOut();});

        $(".sc_top_conment_3_left").click(function(){
            if($("#topfl").css("display")==="none"){
                $(this).removeClass("t_ss").addClass("t_xx");
                $("#topfl").fadeIn();
            }else{
                $(this).removeClass("t_xx").addClass("t_ss");
                $("#topfl").fadeOut();
            }
        });


        $("#sc_top_seah").click(function(){
            if($(".sc_top_conment_2_right_left").css("display")==="none"){
      
                $(".sc_top_conment_2_right_left").fadeIn();
            }else{
            
                $(".sc_top_conment_2_right_left").fadeOut();
            }
        });

    if(document.body.clientWidth>1170){
     
        $(".fl ul li").hover(function(){$(this).find("ul").first().slideDown(1);});
        $(".fl li").mouseleave(function(){$(this).find("ul").slideUp(1);});  
    }

    $(".pic").hover(function(){$(this).focus().addClass("pics").fadeIn();},function(){$(this).focus().removeClass("pics");});
    $(".binq").hover(function(){$(this).focus().addClass("binqs");},function(){$(this).focus().removeClass("binqs");});
    $(".sc_mid_proview_1_left_2 img").click(function(){
        $(".sc_mid_proview_1_left_2 img").css("border","1px solid #ccc")
        $(".sc_mid_proview_1_left_1 img").attr("src",$(this).attr("src"));
        $(this).css("border","1px solid #19caaf");
    });
    $(".binq").click(function(){$('html,body').animate({scrollTop: $("#buynow").offset().top}, 1000)});

     $(".an_01").click(function(){
         
         $(".sc_mid_proview_1_left_2").animate({marginTop:'-=70px'},'slow'); 
         
         });
         
         $(".an_02").click(function(){
         
         $(".sc_mid_proview_1_left_2").animate({marginTop:'+=70px'},'slow'); 
         
         });
    });

function sch(){
   if ($("#search").val()==""){
    alert('Please,enter your keywords!');
    return false;
   }else{
    return true;
   }
}

function msg(){
    if($("#name").val()=="" || $("#mail").val()==""  ||$("#yzm").val()==""){
        alert('Is * Required !');
        return false;
    }else{
        return true;
    }
}

 
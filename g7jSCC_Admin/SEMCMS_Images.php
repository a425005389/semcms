<?php include_once 'SEMCMS_Top_include.php';
if (isset($_GET["tk"])) {
    $tk = $_GET["tk"];
} else {
    $tk = "";
}
if (isset($_GET["fm"])) {
    $fm = $_GET["fm"]; 
} else {
    $fm = "";
}
if (isset($_GET["fms"])) {
    $fms = $_GET["fms"];
} else {
    $fms = "";
}
if (isset($_GET["vs"])) {
    $vs = $_GET["vs"];
} else {
    $vs = "";
}
if (isset($_GET["xz"])) {
    $xz = $_GET["xz"];
} else {
    $xz = "";
}
if (isset($_REQUEST["searchml"])) {
    $CatID = $_REQUEST["searchml"];
} else {
    $CatID = "";
}
if (isset($_REQUEST["search"])) {
    $search = $_REQUEST["search"];
} else {
    $search = "";
}
if (isset($_GET['id'])) {
    $ID = $_GET['id'];
} else {
    $ID = '';
}

if ($ID != ''){
if ($tk == ""){
?>

<body class="rgithbd">
<div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle"/> <a
            href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=1">综合管理</a> > 图片库管理 <span
            class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png"
                                                                  align="absmiddle"/> 返回 </a></span> <span
            class="srs"><a href="javascript:myrefresh();"><img
                    src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle"/> 刷新 </a></span></div>


<?php }
$query = $db_conn->query("select * from sc_images where ID=$ID");
$row = mysqli_fetch_array($query);
?>

<form action="?Class=edit&CF=Images&page=<?php echo $page; ?>" name="form" id="form" method="post">
    <table width="98%" class="table" cellpadding="0" cellspacing="0">

        <tr>

            <td colspan="4" class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle"/> <span
                        class="red">图片编辑</span></td>
        </tr>
        <tr>
            <td width="200" align="center">分类(category)</td>
            <td> <select name="category_name" id="category_name" style="height:26px;vertical-align:bottom;">
                    <?php echo get_strp('1',
                        1, $row['images_category'], $db_conn) ?>
                </select></td>
        </tr>
        <tr>
            <td width="200" align="center">图片名称(image name)</td>
            <td><input name="images_name" type="text" id="images_name" size="60"
                       value="<?php echo $row['images_name'];?>"></td>
        </tr>


        <tr>
            <td width="200" align="center"></td>
            <td><span id="uploads"><a href="javascript:;"
                                      onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/prdoucts/&filed=images_url&filedname=form','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传图片</a></span>
            </td>
        </tr> 
        <tr>
            <td width="200" align="center">图片显示</td>
            <td id="tk_image"><img src="<?php echo $row['images_url']; ?>"><input type="hidden" value="<?php echo $row['images_url']; ?> " name="images_url"></td>
        </tr>


        <tr>
            <td width="200" align="center"></td>
            <td>
                <input type="hidden" name="languageID" value="2">
                <input type="hidden" name="ID" value="<?php echo $ID ?>">
                <input type="submit" value="保存" name="submit" id="submit" onclick="return SubmitImages()"></td>
        </tr>
    </table>
</form>
<?php }else{
if ($xz == "xz") {
    $vs = "<div class=\'pimg\'><img src=\'$vs\' width=\'50\'><input name=\'products_Images[]\' value=\'" . $vs . "\' type=\'hidden\' size=\'60\'  ></div>";
    echo "<script language='javascript'>window.opener.document.getElementById('proimgs').innerHTML+='" . $vs . "';</script>";
    echo "<script language=javascript>window.close();</script>";

}

$fls =get_strp('1',1, '0', $db_conn);
if ($tk == ""){
?>

<body class="rgithbd">
<div class="divtitle"><img src="SC_Page_Config/Image/icons/house.png" align="absmiddle"/> <a
            href="SEMCMS_Middle.php">后台首页</a> > <a href="SEMCMS_language.php?lgid=1">综合管理</a> > 图片库管理 <span
            class="srs"><a href="javascript:history.go(-1);"><img src="SC_Page_Config/Image/icons/Return.png"
                                                                  align="absmiddle"/> 返回 </a></span> <span
            class="srs"><a href="javascript:myrefresh();"><img
                    src="SC_Page_Config/Image/icons/refresh.png" align="absmiddle"/> 刷新 </a></span></div>
<table width="98%" class="table" cellpadding="0" cellspacing="0">
    <tr>
        <td class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle"/> <span
                    class="red">图片上传</span></td>
    </tr>
    <tr>
        <td>
            <form name="forms" id="forms" method="post" action="?Class=add&CF=Images&page=<?php echo $page; ?>">
                分类：<select name="category_name" id="category_name" style="height:26px;vertical-align:bottom;">
                    <?php echo $fls; ?>
                </select>
                名称：<input type="text" name="images_name" id="images_name" size="40"> 图片：<input name="images_url"
                                                                                               type="text"
                                                                                               id="images_url"
                                                                                               size="70"> <span
                        id="uploads"><a href="javascript:;"
                                        onclick="javascript:window.open('SEMCMS_Upload.php?Imageurl=../Images/prdoucts/&filed=images_url&filedname=forms','newwindow','height=185,width=500,top=300,left=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')">上传</a></span>
                <input type="submit" value="保存" name="submit" id="submit"></form>
        </td>
    </tr>
</table>


<?php } ?>

<table width="98%" class="table" cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="inputbks">
        <td colspan="8" class="tdsbg">
            <img src="SC_Page_Config/Image/icons/coins.png" alt="" align="absmiddle">
            <span class="red">搜索</span>
        </td>
    </tr>
    <tr>
        <td colspan="8" align="center">
            <form action="SEMCMS_Images.php?tk=tk" name="form" method="post">
                <select name="searchml" id="searchml" style="height:26px;vertical-align:bottom;">
                    <option value="">请选择</option>
                    <?php echo $fls;?>
                </select>
                <input type="text" value="<?php echo $search; ?>" name="search" size="60">
                <input type="submit" id="submit" value="搜索">
            </form>
        </td>
    </tr>
    </tbody>
</table>

<form name="form" id="form" method="post" action="?Class=Deleted&CF=Images&page=<?php echo $page; ?>">
    <table width="98%" class="table" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="8" class="tdsbg"><img src="SC_Page_Config/Image/icons/coins.png" align="absmiddle"/> <span
                        class="red">图片管理</span></td>
        </tr>
        <tr>
            <td align="center">
                <?php
                //
                if ($CatID !== '' && $search !== '') {
                    $sql = $db_conn->query("select * from sc_images where images_category like '%,$CatID,%' and images_name like '%$search%'");
                } else if ($CatID !== '' && $search === '') {
                    $sql = $db_conn->query("select * from sc_images where images_category like '%,$CatID,%'");
                } else if ($CatID === '' && $search !== '') {
                    $sql = $db_conn->query("select * from sc_images where images_name like '%$search%'");
                } else {
                    $sql = $db_conn->query("select * from sc_images");
                }
                //$sql = $db_conn->query("select * from sc_images");
                $all_num = mysqli_num_rows($sql); //总条数

                $page_num = 50; //每页条数

                $page_all_num = ceil($all_num / $page_num); //总页数

                $page = empty($_GET['page']) ? 1 : $_GET['page']; //当前页数

                $page = (int)$page; //安全强制转换

                $limit_st = ($page - 1) * $page_num; //起始数
                if ($CatID !== '' && $search !== '') {
                    $sql = "select * from sc_images where images_category like '%,$CatID,%' and images_name like '%$search%' order by ID desc  limit $limit_st,$page_num";
                } else if ($CatID !== '' && $search === '') {
                    $sql = "select * from sc_images where images_category like '%,$CatID,%' order by ID desc  limit $limit_st,$page_num ";
                } else if ($CatID === '' && $search !== '') {
                    $sql = "select * from sc_images where images_name like '%$search%' order by ID desc  limit $limit_st,$page_num ";

                } else {
                    $sql = "select * from sc_images order by ID desc  limit $limit_st,$page_num";
                }


                //$sql = "select  * from  sc_images order by ID desc";
                $query = $db_conn->query($sql);
                Panduans(mysqli_num_rows($query));
                $js = 1;
                while ($row = mysqli_fetch_array($query)) {

                    ?>
                    <div class="tk"><?php if ($tk == "") { ?><a href="?id=<?php echo $row['ID']; ?>" class="tkgl_image"> <img
                                    src="<?php echo $row['images_url']; ?>"></a><?php }else{?><img
                            src="<?php echo $row['images_url']; ?>"> <?php }?><br>

                        <?php echo str_replace("../Images/prdoucts/", "", $row['images_url']); ?><?php if ($tk == "") { ?>
                           <br> <input type="checkbox" name="AID[]" id="AID[]" value="<?php echo $row['ID']; ?>"/>
                        <?php } else {
                            echo '<br><a href="?xz=xz&fm=' . $fm . '&fms=' . $fms . '&vs=' . $row['images_url'] . '">选择</a> <a href="SEMCMS_Images.php?id='.$row['ID'].'">修改</a>';
                        } ?>
                    </div>

                    <?php
                    $js = $js + 1;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="8"><?php if ($tk == "") { ?><span style="float: left;"><input type="button" id="button"
                                                                                       value="选择所有"
                                                                                       onclick="checkAll('AID[]')"/> <input
                            type="button" value="清空选中" id="button"
                            onclick="clearAll('AID[]')"/> <input type="submit" id="submit" value="删除选中"
                                                                 onclick="return confirm('确定将此记录删除?不可恢复.')"/></span><?php } ?>
                <span class="sr2">总共
                    <?php echo $all_num; ?> 条记录 <?php if(!empty($tk)){show_pageimg($all_num, $page, $page_num,$CatID);}else{show_page($all_num, $page, $page_num);} ?></span></td>
        </tr>

    </table>
</form>
<?php } ?>





<?php

function show_pageimg($count,$page,$page_size,$CatID){
    $page_count  = ceil($count/$page_size);  //计算得出总页
    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;
    //判断当前页码s
    $page=(empty($page)||$page<0)?1:$page;
    //获取当前页url
    $url = $_SERVER['REQUEST_URI']."&searchml=".$CatID;
    //去掉url中原先的page参数以便加入新的page参数
    $parsedurl=parse_url($url);
    $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
    if($url_query != ''){
        $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
        $url = str_replace($parsedurl['query'],$url_query,$url);
        if($url_query != ''){
            $url .= '&';
        }
    } else {
        $url .= '?';
    }
    //分页功能代码
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移 
    $navs='';
    if($pages != 0){
        if($page!=1){
            //$navs.="<a href=\"".$url."page=1\">首页</a> ";        //第一
            $navs.="<a href=\"".$url."page=".($page-1)."\">前一页</a>"; //上一 
        } else {
           // $navs .= "<span class='disabled'>首页</span>";
            $navs .= "";
        } 
        if($pages>$page_len)
        {
            //如果当前页小于等于左偏移
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;
            }
            else  //如果当前页大于左偏移
            {    
                //如果当前页码右偏移超出最大分页数
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }
                else
                {
                    //左右偏移都存在时的计�?
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++)
        {
            if($i==$page){$navs.="<span class='current'>".$i.'</span>';} 
            else {$navs.=" <a href=\"".$url."page=".$i."\">".$i."</a>";}
        }
        if($page!=$pages)
        {
            $navs.=" <a href=\"".$url."page=".($page+1)."\">下一页</a> ";//下
           // $navs.="<a href=\"".$url."page=".$pages."\">末页</a>";    //后
        } else {
            $navs .= "";
           // $navs .= "<span class='disabled'>末页</span>";
        }
        echo "$navs";
   }
}


include_once 'SEMCMS_bot.php';
?>
</body>

</html>
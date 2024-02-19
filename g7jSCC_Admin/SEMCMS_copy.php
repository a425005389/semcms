<?php

header("Content-type:text/html;charset=utf-8");

if (isset($_GET["type"])){$type=$_GET["type"];}else{$type="";}
if (isset($_GET["tp"])){$tp=$_GET["tp"];}else{$tp="";}

//配置信息

$folder="../backups/".$tp;
$cfg_dbhost = 'localhost';
$cfg_dbname = 'semcms';
$cfg_dbuser = 'root';
$cfg_dbpwd = 'root';
$cfg_db_language = 'utf8';
$to_file_name = $folder."/semcms.sql";
$info="";

// END 配置

function creatfolder($folder){

		$dir = iconv("UTF-8", "GBK", $folder);
        if (!file_exists($dir)){
            mkdir($dir,0777,true);
        } 
 }

if ($type=="dc"){ //导出数据

    //创建文件jia
	creatfolder($folder);
	creatfolder($folder."/Images/");
	//复制内容
	dir_copy("../Images/", $folder."/Images/");

    //-------------//

	//链接数据库
	$link = mysqli_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd,$cfg_dbname);
	//选择编码
	mysqli_set_charset($link,$cfg_db_language);
	//数据库中有哪些表
	$tables = mysqli_query($link,"show tables");	//die(var_dump($tables));

	//将这些表记录到一个数组
	$tabList = array();
	while($row = mysqli_fetch_row($tables)){

		$tabList[] = $row[0];
	}

	file_put_contents($to_file_name,$info); //清空内容

	echo "运行中，请耐心等待...<br/>";
	$info = "-- ----------------------------\r\n";
	$info .= "-- 日期：".date("Y-m-d H:i:s",time())."\r\n";
	$info .= "-- 仅用于测试和学习,本程序不适合处理超大量数据\r\n";
	$info .= "-- ----------------------------\r\n\r\n";
	file_put_contents($to_file_name,$info,FILE_APPEND);
	//将每个表的表结构导出到文件
	foreach($tabList as $val){

		$sql = "show create table ".$val;
		$res = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($res);
		$info = "-- ----------------------------\r\n";
		$info .= "-- Table structure for `".$val."`\r\n";
		$info .= "-- ----------------------------\r\n";
		$info .= "DROP TABLE IF EXISTS `".$val."`;\r\n";
		$sqlStr = $info.$row[1].";\r\n\r\n";
		//追加到文件
		file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
		//释放资源
		mysqli_free_result($res);

	}
	//将每个表的数据导出到文件
	foreach($tabList as $val){

		$sql = "select * from ".$val;
		$res = mysqli_query($link,$sql);
		//如果表中没有数据，则继续下一张表
		if(mysqli_num_rows($res)<1) continue;
		//
		$info = "-- ----------------------------\r\n";
		$info .= "-- Records for `".$val."`\r\n";
		$info .= "-- ----------------------------\r\n";
		file_put_contents($to_file_name,$info,FILE_APPEND);
		//读取数据
		while($row = mysqli_fetch_row($res)){
			$sqlStr = "INSERT INTO `".$val."` VALUES (";
		foreach($row as $zd){
			$sqlStr .= "'".$zd."', ";
		}
			//去掉最后一个逗号和空格
			$sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
			$sqlStr .= ");\r\n";
			file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
		}
			//释放资源
			mysqli_free_result($res);
			file_put_contents($to_file_name,"\r\n",FILE_APPEND);

	}

	echo "成功导出";

}elseif($type=="dr"){ //导入数据
  
	$db = array();
	$db['host'] = $cfg_dbhost;
	$db['dbname'] = $cfg_dbname;
	$db['user'] = $cfg_dbuser;
	$db['pwd'] = $cfg_dbpwd;
	$db['mknew'] = 1;
	$sql_file = $to_file_name;

	if (!file_exists($folder){

     	echo "<script>alert('还没有备份数据,请先备份');history.go(-1);</script>";

	}else{
		//还原数据库
		run_sql_file($sql_file,$db);
		//还原图片
		dir_copy($folder."/Images/", "../Images/");

	    echo "数据复原完成!";
	}

}


function run_sql_file($sql_file,$dbconfig){ // 导入数据库 

	$host = $dbconfig['host'];
	$dbname = $dbconfig['dbname'];
	$user = $dbconfig['user'];
	$pwd = $dbconfig['pwd'];
	$mknew=$dbconfig['mknew'];

	// 连接mysql数据库

	$conn = mysqli_connect($host,$user,$pwd) or die( '<li>连接mysql错误：'.mysqli_connect_error()."</li>");

	if ($mknew==1){ //如果选择新建 执行下面两句

	// 删除旧的数据库 

	 mysqli_query($conn,"DROP database IF EXISTS {$dbname} ;") or die ("<li>重新建立新的数据库 操作失败，无法删除【旧】数据库, 请检查mysql操作权限。错误信息: \n".mysqli_error($conn)."</li>"); 

	// 重新建立新数据库

	 mysqli_query($conn,"CREATE DATABASE {$dbname} CHARACTER SET ".DB_CHARSET." ;" ) or die ("<li>无法创建数据库, 请检查mysql操作权限。错误信息: \n".mysqli_error($conn)."</li>"); 

	}

	// 选择数据库

	mysqli_select_db($conn,$dbname) or die("<li>连接数据库名 {$dbname} 错误：\n".mysqli_error($conn)."</li>");


	/* ############ 数据文件分段执行 ######### */

	$sql_str = file_get_contents($sql_file);
	$piece = array(); // 数据段
	preg_match_all("@([\s\S]+?;)\h*[\n\r]@",$sql_str,$piece); // 数据以分号;\n\r换行  为分段标记
	!empty( $piece[1] ) && $piece = $piece[1];
	$count = count($piece);
	if ( $count <= 0 ){

		exit('<li>mysql数据文件: '. $sql_file .' , 不是正确的数据文件. 请检查安装包.</li>');

	}

	$tb_list = array(); // 表名列表
	preg_match_all( '@CREATE\h+TABLE\h+[`]?([^`]+)[`]?@',$sql_str,$tb_list );
	!empty( $tb_list[1] ) && $tb_list = $tb_list[1];
	$tb_count = count( $tb_list );

	// 开始循环执行
	for($i=0;$i<$count ;$i++){

		$sql = $piece[$i] ;
		mysqli_query($conn,"SET character_set_connection='".DB_CHARSET."', character_set_results='".DB_CHARSET."', character_set_client='binary'");
		$result = mysqli_query($conn,$sql);
		
		// 建表数量
		if ( $i < $tb_count ) {

			echo "<li>创建表: ".$tb_list[ $i ];

			if($result){
	
				echo " <font color='green'>成功导入</font> ......</li>";
				
			}else {

				echo "<font color='red'>失败</font> , 原因:".mysqli_error($conn)."</li>";
			}
			 
			
		}
		// 执行其它语句
		else {
			if(!$result){

				echo "<li>sql语句执行<font color='red'>失败</font> , 原因:".mysqli_error($conn)."</li>";
			}
		}
	}
        
 
}



/**
 * 文件夹文件拷贝
 *
 * @param string $src 来源文件夹
 * @param string $dst 目的地文件夹
 * @return bool
 */
function dir_copy($src = '', $dst = '')
{
    if (empty($src) || empty($dst))
    {
        return false;
    }
 
    $dir = opendir($src);
    dir_mkdir($dst);
    while (false !== ($file = readdir($dir)))
    {
        if (($file != '.') && ($file != '..'))
        {
            if (is_dir($src . '/' . $file))
            {
                dir_copy($src . '/' . $file, $dst . '/' . $file);
            }
            else
            {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
 
    return true;
}
 
/**
 * 创建文件夹
 *
 * @param string $path 文件夹路径
 * @param int $mode 访问权限
 * @param bool $recursive 是否递归创建
 * @return bool
 */
function dir_mkdir($path = '', $mode = 0777, $recursive = true)
{
    clearstatcache();
    if (!is_dir($path))
    {
        mkdir($path, $mode, $recursive);
        return chmod($path, $mode);
    }
 
    return true;
}

 
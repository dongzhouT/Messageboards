<?php
//变量定义

/**
 * 递归方式的对变量中的特殊字符进行转义
 *
 * @param   mix     $value
 *
 * @return  mix
 */
function addslashes_deep($value) {
	if (empty($value)) {
		return $value;
	} else {
		return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
	}
}

/* 判断请求方式 */
define('IS_POST', (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'));
//设置错误显示级别
error_reporting(E_ALL ^ E_NOTICE);
/* 数据过滤 */
if (!get_magic_quotes_gpc()) {
	$_GET = addslashes_deep($_GET);
	$_POST = addslashes_deep($_POST);
	$_COOKIE = addslashes_deep($_COOKIE);
}
/*
 * 生成唯一的guid，用作上传文件命名
 * 
 * */
	function get_guid() {
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = chr(123)// "{"
    .substr($charid, 0, 8).$hyphen
    .substr($charid, 8, 4).$hyphen
    .substr($charid,12, 4).$hyphen
    .substr($charid,16, 4).$hyphen
    .substr($charid,20,12)
    .chr(125);// "}"
    return $uuid;
}
/*
 * 上传图片
 * @param 路径 文件名
 *
 * */
function upload($path, $file_name) {
	$upfile = $_FILES[$file_name];
	//便于以后转移文件时命名
	$type = $upfile["type"];
	//上传文件的类型
	$size = $upfile["size"];
	//上传文件的大小
	$tmp_name = $upfile["tmp_name"];
	//用户上传文件的临时名称
	$return=array();
	switch ($type) {
		case 'image/jpg' :
		case 'image/png' :
		case 'image/bmp' :
		case 'image/jpeg' :
		case 'image/pjpeg' :
			$ok = 1;
			break;
		default :
			$ok = 0;
			break;
	}
	if ($size > 5000000)//大小限定为5M
	{
		$ok = 0;
	}
	if ($ok == 1) {
		//用一个数组类型的字符串存放上传文件的信息
		$name = "ejm-".get_guid().rand(0,10000).date('YmdHis').".".substr($type,6);
		@move_uploaded_file($tmp_name ,$path.basename($name));
		$return['path']=$path;
		$return['name']=$name;
		return $return;

	}else{
		return false;
	}

}
/*
 * 检查用户名是否存在
 * @param name 用户名
 * @return bool true 不存在用户
 * */
function check_name($name){
	$space = new model('member');
	//个人信息表
	$data=array('username' => $name); //用户名
	$result=$space->get_info($data);
//	var_dump($result);
	if(count($result)==0){
		return true;
	}else{
		return false;
	}
}
/**
 * 判断数组中每个元素是否为空，有一个为空就返回false。用于判断用户上传的表单中的必填项。
 *
 * @param   array
 *
 * @return  bool
 */
function is_empty($value) {
	if (empty($value)) 
		return true;
	foreach($value as $key=>$v){
		if(empty($v)){
			return true;
		}
	}
	return false;
}
/*
 * 返回一个md5随机数种子 
 * @return string
 * 用法：
 * $ch=getChars();
 * echo md5($ch);
 * 
 * */
function getChars(){
	$chars = array( 
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
        "3", "4", "5", "6", "7", "8", "9" 
    );
    shuffle($chars);
    $ch=implode($chars);
    $nchar=substr($ch,1,6);
    return $nchar;
}
/*
 * 复制文件夹
 * */
function recurse_copy($src,$dst) {  // 原目录，复制到的目录

    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

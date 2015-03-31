<?php
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
function upload($path, $file_name) {
	$upfile = $_FILES[$file_name];
	//return $upfile;
	$fname=$upfile["name"];
	$file_path=pathinfo($fname);
	//后缀名
	$extension=$file_path["extension"];
	//便于以后转移文件时命名
	$type = $upfile["type"];
	//上传文件的类型
	$size = $upfile["size"];
	//上传文件的大小
	$tmp_name = $upfile["tmp_name"];
	//用户上传文件的临时名称
	$return = array(
	'success'=>false,
	'path'=>"",
	'name'=>"",
	'real_name'=>"",
	'message'=>"",
	);
	$ok = 1;
//	switch ($type) {
//		case 'image/jpg' :
//		case 'image/png' :
//		case 'image/bmp' :
//		case 'image/jpeg' :
//		case 'image/pjpeg' :
//			$ok = 1;
//			break;
//		default :
//			$ok = 0;
//			break;
//	}
	if ($size > 5000000)//大小限定为5M
	{
		$ok = 0;
	}
	if ($ok == 1) {
		//用一个数组类型的字符串存放上传文件的信息
		$name = get_guid().rand(0, 10000) . date('YmdHis') . "." . $extension;
		@move_uploaded_file($tmp_name, $path . basename($name));
		$return['success'] = true;
		$return['path'] = $path;
		$return['name'] = $name;
		$return['real_name']=$fname;
		return $return;
	} else {
		$return['message']="文件过大！";
		return $return;
	}
}

$upfile = $_FILES["uploadfile"];
$file_name = "uploadfile";
$path = "./data/";
if(!is_dir($path)){
	mkdir($path);
}
$path_arr = upload($path, $file_name);
//echo "<pre>";
//var_export($path_arr);
//echo "</pre>";
$return=$path_arr;
if($path_arr['success']){
	$return['imgpath'] = $path_arr['path'] . $path_arr['name'];
	$return['real_name']=$path_arr['real_name'];
	echo json_encode($return);
}else{
	echo json_encode($return);
}

//echo json_encode($msg);
?>
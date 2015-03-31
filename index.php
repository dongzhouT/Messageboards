<?php
require_once ('./config/conn.php');
require_once ('./eccore/funcs.php');
require_once ('./model/model.base.php');
include './libs/Smarty.class.php';
require_once ('./controller/app.base.php');
define(SUFFIX, "Controller");


$c_str = isset($_GET["c"]) ? $_GET["c"] : "demo";
//获取要运行的controller
$method = isset($_GET["a"]) ? $_GET["a"] : "index";
//获取要运行的action
$c_name = $c_str . SUFFIX;
//按照约定url中获取的controller名字不包含Controller，此处补齐。
$c_path = 'controller/' . $c_name . '.php';
require ($c_path);
//加载controller文件
$controller = new $c_name;
//实例化controller文件
$controller -> $method();
//运行该实例下的action
/* End of file index.php */

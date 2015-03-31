<?php
class BaseApp extends Smarty {
	function __construct() {
		parent::__construct();
		$this -> template_dir = "./view/";
		$this -> compile_dir = "./templates_c/";
	}
	function logout(){
		unset($_SESSION);
	}

}

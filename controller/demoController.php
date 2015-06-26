<?php
class DemoController extends BaseApp {
	var $status = false;
	var $login_flag = "";
	function __construct() {
		parent::__construct();
		$this -> _getmsg();

	}

	function index() {
		$message = new Model("message");
		$str=0;
		$end=10;
		$limit=$str.",".$end;
		$data = array("order" => "ontime desc", "limit" => $limit);
		$msgs = $message -> get_infos($data);

		$this -> assign("msgs", $msgs);
		//echo "<pre>";
		//var_export($msgs);
		//echo "what happened";
		//echo "</pre>";
		if (!IS_POST) {
			if($_GET['admin']=='taodzh'){
				$this -> display('demo_admin.html');
			}else{
				$this -> display('demo.html');
			}
			
			return;
		} else {
			//var_dump($_POST);
			//exit("end");
			if ($_POST["username"] == "" || $_POST["content"] == "") {
				echo "<meta charset=utf-8>";
				echo "<h3>不许不说话！</h3>";
				header("refresh:3;url=index.php");
				return;
			}
			$data = array("uname" => $_POST["username"], "sex" => $_POST["sexRadio"], "content" => $_POST["content"], "guest_portrait" => $_POST["wimg1"], "ontime" => time(), "timetoread" => date("Y-m-d H:i:s", time()), "day" => date("Y-m-d", time()));
			$message -> add($data);
			echo "<meta charset=utf-8>";
			echo "<h3>添加成功，正在跳转。。。</h3>";
			//header("refresh:3;url=demo.php");
			header("location:index.php");
		}
	}

	function delmsg() {
		if (isset($_GET["id"])) {
			$deldata = array("id" => $_GET["id"]);
			$message = new Model("message");
			$message -> del($deldata);
			header("Location:" . $_SERVER['HTTP_REFERER']);
			exit ;
		}
		echo "<pre>";
		var_export($_SERVER);
		echo "</pre>";
	}

	function signup() {
		if (!IS_POST) {
			$this -> display('demo.html');
			return;
		} else {
			$username = trim($_POST['username']);
			$password_temp = trim($_POST['password']);
			$key = getChars();
			//生成密钥
			$password = md5(md5($password_temp) . $key);
			if (check_name($username)) {
				$membermodel = new Model("member");
				$adddata = array('username' => $username, 'password' => $password, 'sn_key' => $key, 'ontime' => time(), );
				$membermodel -> add($adddata);
				$this -> status = "yes";
				$this -> login_flag = "Welcome " . $username;
				$this -> assign("status", $this -> status);
				$this -> assign("login_flag", $this -> login_flag);
				$this -> assign("usernm", $username);
				header("Location:" . $_SERVER['HTTP_REFERER']);
				exit ;
			}
		}
	}

	function signin() {
		if (!IS_POST) {
			$this -> display('demo.html');
			return;
		} else {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			if (check_name($username)) {
				$this -> status = false;
				$this -> login_flag = "user:" . $username . " not exist!";
				$this -> assign("status", $this -> status);
				$this -> assign("login_flag", $this -> login_flag);
			} else {
				$membermodel = new Model("member");
				$data = array('username' => $username, );

				$mem_infos = $membermodel -> get_info($data);
				$mem_info = $mem_infos[0];
				$key = $mem_info["sn_key"];

				if (md5(md5($password) . $key) == $mem_info['password']) {
					$this -> status = "yes";
					$this -> login_flag = "Welcome " . $username;
					$this -> assign("status", $this -> status);
					$this -> assign("login_flag", $this -> login_flag);
					$this -> assign("usernm", $username);
				} else {
					$this -> status = "no";
					$this -> login_flag = "password error!";
					$this -> assign("status", $this -> status);
					$this -> assign("login_flag", $this -> login_flag);
				}

			}
			$_POST = array();
			$this -> display('demo.html');
			return true;
		}
	}

	function _getmsg() {
		$message = new Model("message");
		//$msgs = $message -> get_info();
		$data = array("order" => "ontime desc", "limit" => "");
		$msgs = $message -> get_infos($data);
		$this -> assign("msgs", $msgs);
	}

	function datemsg() {
		$this -> display('datemsg.html');
	}

}

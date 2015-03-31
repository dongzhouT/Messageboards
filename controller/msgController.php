<?php
class msgController extends BaseApp {
	var $status = false;
	var $login_flag = "";
	function __construct() {
		parent::__construct();
		$this -> _getmsg();

	}

	function index() {
		$message = new Model("message");
		$msgs = $message -> get_info();
		$this -> assign("msgs", $msgs);
		//echo "<pre>";
		//var_export($msgs);
		//echo "what happened";
		//echo "</pre>";
		if (!IS_POST) {
			$this -> display('demo.html');
			return;
		} else {
			//var_dump($_POST);
			//exit("end");
			if ($_POST["username"] == "" || $_POST["content"] == "") {
				echo "<meta charset=utf-8>";
				echo "<h3>不许不说话！</h3>";
				header("refresh:3;url=demo.php");
				return;
			}
			$data = array("uname" => $_POST["username"], "content" => $_POST["content"], "guest_portrait" => $_POST["wimg1"], "ontime" => time(), "timetoread" => date("Y-m-d H:i:s", time()), );
			$message -> add($data);
			echo "<meta charset=utf-8>";
			echo "<h3>添加成功，正在跳转。。。</h3>";
			//header("refresh:3;url=demo.php");
			header("location:ind.php");
		}
	}

	function _getmsg() {
		$message = new Model("message");
		$msgs = $message -> get_info();
		$this -> assign("msgs", $msgs);
	}

	function datemsg() {
		$this -> display('datemsg.html');
	}

	/*
	 * 返回指定日期的留言
	 * */
	function ajaxmsg() {
		$strtime = strtotime($_GET["datetime"]);
		$endtime = $strtime + 60 * 60 * 24;
		//$return["status"] = "error";
		//$sql = "select *  from message where ontime>=" . $strtime . " and  ontime<" . $endtime;
		$sql = "select *  from message where ontime>=" . $strtime . " and  ontime<" . $endtime . " order by ontime desc";
		$result = mysql_query($sql);
		$var = array();
		if (count($result) == 0) {
			//$var["status"]="none";
			echo json_encode($var);
			exit();
		}
		while ($row = mysql_fetch_array($result)) {
			@$var[] = $row;
		}
		//		echo "时间是：".$datetime;
		echo json_encode($var);
	}

	/*
	 * 返回指定月的留言
	 * */
	function ajaxtime() {
		$strtime = strtotime($_GET["datetime"]);
		$duration = intval($_GET["duration"]);
		$endtime = intval($strtime) + 60 * 60 * 24 * $duration;
		$sql = "select distinct(day) from message where ontime>=" . $strtime . " and  ontime<" . $endtime . " group by day order by day desc";
		$result = mysql_query($sql);
		$return="";
		$var=array();
		//		echo "<pre>";
		//		var_export($result);
		//		echo "</pre>";
		while ($row = mysql_fetch_array($result)) {
			@$var[] = $row['day'];
		}
		$return=implode($var,",");
		echo $return;
		exit ;
	}

}

<?php
//require_once ("../config/conn.php");
class Model {
	var $table = null;
	var $primary_key = null;
	function __construct($db_name, $primary_key = "") {
		$this -> table = $db_name;
		$this -> primary_key = $primary_key;
	}

	/**
	 *  添加一条记录
	 *
	 *  @author
	 *  @param  array $data
	 *  @return mixed
	 */
	function add($data, $compatible = false) {
		if (empty($data)) {
			return false;
		}
		$mode = $compatible ? 'REPLACE' : 'INSERT';
		$insert_info = $this -> _getInsertInfo($data);
		$sql = $mode . " into $this->table " . $insert_info['fields'] . " values " . $insert_info['values'];
		//		echo $sql;
		mysql_query($sql);
		$uid = mysql_insert_id();
		//				echo mysql_error();
		return $uid;
	}

	/**
	 *  获取一条（多条）记录
	 *
	 *  @author
	 *  @param  array $data
	 *  @return array
	 */
	function get_info($data = array(), $order = "", $limit = "") {

		if (empty($data)) {
			//return false;
		}
		$var = array();
		$select_info = $this -> _getSelectInfo($data);
		$sql = "select *  from " . $this -> table . " where " . $select_info;
		if (!empty($order)) {
			$orderStr = $this -> _getOrderInfo($order);
			$sql .= $orderStr;
		}
		//$limit and $sql.=" limit ".$limit;
		//		echo $sql;
		$result = mysql_query($sql);
		if (!$result)
			return false;
		while ($row = mysql_fetch_array($result)) {
			//			@$var[$row["'".$this -> primary_key ."'"]]=$row;
			@$var[] = $row;
			//array_push($var, $row);
		}
		//		echo mysql_error();
		//		echo "<pre>";
		//		var_dump($var);
		//		echo "</pre>";
		return $var;
	}

	function get_infos($data = array()) {
		extract($this -> _initParams($data));

		if (empty($data)) {
			//return false;
		}
		$var = array();
		$select_info = $this -> _getSelectInfo($conditions);
		$sql = "select *  from " . $this -> table . " where " . $select_info;
		$order && $sql .= " ORDER BY " . $order;
		$limit && $sql .= " LIMIT " . $limit;

		//$limit and $sql.=" limit ".$limit;
		//		echo $sql;
		$result = mysql_query($sql);
		if (!$result)
			return false;
		while ($row = mysql_fetch_array($result)) {
			//			@$var[$row["'".$this -> primary_key ."'"]]=$row;
			@$var[] = $row;
			//array_push($var, $row);
		}
		//		echo mysql_error();
		//		echo "<pre>";
		//		var_dump($var);
		//		echo "</pre>";
		return $var;
	}

	/*
	 *  修改数据
	 *  @param  array $where
	 *  @param  array $todata
	 *  @return string
	 */
	function modify($where, $todata) {
		$data = $this -> _getTodata($todata);
		$w = $this -> _getSelectInfo($where);
		$sql = "update  " . $this -> table . " set " . $data;
		$sql .= " where " . $w;
		//		echo $sql;
		mysql_query($sql);
		return;
	}

	/*
	 * 删除数据
	 * @param	id
	 *
	 * */
	function del($data) {
		if (empty($data)) {
			return false;
		}
		$w = $this -> _getSelectInfo($data);
		$sql = "";
		$sql = "delete from " . $this -> table . " where " . $w;
		//		echo $sql."@@<br>";
		//		exit;
		mysql_query($sql);
		return;

	}

	function _initParams($param) {
		$arr = array("conditions" => "", "order" => "", "limit" => "");
		if (is_array($param)) {
			return array_merge($arr, $param);
		} else {
			$arr["conditions"] = $param;
			return $arr;
		}
	}

	/*
	 *  生成要更新的数据SQL
	 *  @param  array $data
	 *  @return string
	 */
	function _getTodata($data) {
		if (empty($data)) {
			return false;
		}
		$return = "";
		foreach ($data as $key => $v) {
			if ($return == "") {
				$return = $key . " = '" . $v . "'";
			} else {
				$return .= " , " . $key . " = '" . $v . "'";
			}
		}
		return $return;
	}

	/*
	 *  获取插入的数据SQL
	 *  @param  array $data
	 *  @return string
	 */
	function _getInsertInfo($data) {
		$length = count($data);
		$fields = array();
		$values = array();
		foreach ($data as $key => $v) {
			array_push($fields, $key);
			array_push($values, "'" . $v . "'");
		}
		$return['fields'] = '(' . implode(',', $fields) . ')';
		$return['values'] = '(' . implode(',', $values) . ')';
		return $return;
	}

	/*
	 *  获取查询的数据SQL
	 *  @param  array $data
	 *  @return string
	 */
	function _getSelectInfo($data) {
		$return = " 1=1 ";
		if (is_array($var)) {
			foreach ($data as $key => $v) {
				$return .= " and " . $key . " = " . "'" . $v . "'";
			}
		}
		return $return;
	}

	/*
	 *  获取查询的数据order by
	 *  @param  array $data
	 *  @return string
	 */
	function _getOrderInfo($data) {
		if ($data == "")
			return;
		$return = " order by ";
		$flag = 0;
		foreach ($data as $key => $v) {
			if ($flag == 0) {
				$return .= "'" . $v . "'";
				$flag = 1;
			} else {
				$return .= " , '" . $v . "'";
			}

		}
		return $return;
	}

}

//////测试
//$hehe = new model('ejm_witkey_space_o2o');
////$data = array('username' => 'ss', );
//$where = array('uid' => '5602', 'sn' => "0w1poU");
//$data = array('address' => '5532');
//$order = array('uid');
////$hehe->modify($where, $data);
//$hehe -> get_info($where);
//echo "<br>";
//$hehe -> get_info($where, $order);
//exit('hehe');

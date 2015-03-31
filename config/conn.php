<?php
$con = mysql_connect("localhost","root","admin") //填写mysql用户名和密码  
   or die("Could not connect to MySQL server!");  
   mysql_select_db("msgboard") //数据库名  
   or die("Could not select database!"); 
   mysql_query("set names 'utf8'");
// echo mysql_error();
// echo "comm.php";
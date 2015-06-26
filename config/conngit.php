<?php
$con = mysql_connect("10.4.26.93","upGuJgeTI1fbC","pcJOAtWWmZ8V7") //填写mysql用户名和密码  
   or die("Could not connect to MySQL server!");  
   mysql_select_db("dbfa7585ec8554c6387a1447303bc970d") //数据库名  
   or die("Could not select database!"); 
   mysql_query("set names 'utf8'");
// echo mysql_error();
// echo "comm.php";
<?php
$con = mysql_connect("10.4.26.93","upGuJgeTI1fbC","pcJOAtWWmZ8V7") //填写mysql用户名和密码  
   or die("Could not connect to MySQL server!");  
   mysql_select_db("dbfa7585ec8554c6387a1447303bc970d") //数据库名  
   or die("Could not select database!"); 
   mysql_query("set names 'utf8'");
if (mysql_query("CREATE DATABASE msgboard",$con))
  {
  echo "Database created";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }
  mysql_select_db("msgboard", $con);
$sql = "CREATE TABLE  message  (
   id  int(11) NOT NULL AUTO_INCREMENT,
   uname  varchar(50) CHARACTER SET utf8 DEFAULT NULL,
   sex  int(11) DEFAULT NULL,
   guest_portrait  varchar(200) DEFAULT NULL,
   uid  int(11) DEFAULT NULL,
   content  varchar(500) CHARACTER SET utf8 DEFAULT NULL,
   ontime  varchar(20) CHARACTER SET utf8 DEFAULT NULL,
   timetoread  varchar(20) CHARACTER SET utf8 DEFAULT NULL,
   day  varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY ( id )
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1";
mysql_query($sql,$con);

mysql_close($con);
exit("db finish");
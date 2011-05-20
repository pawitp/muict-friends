<?php
//pagetype==1 หน้าที่กรอกครั้งแรก

$host="localhost";
$user="daequili_buddy";
$passwordsql="f3AsLTHS";
$dbname="daequili_buddy";
$table="muict";

session_start();
$sid=$_SESSION['id'];
$spass=$_SESSION['password'];

if($pagetype==1 and $sid!=""){
	header('Location: index.php');
}



$con = mysql_connect($host,$user,$passwordsql);
if (!$con)  {  die('Could not connect: ' . mysql_error());  }
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET NAMES UTF8");
mysql_select_db($dbname, $con);

include 'log.php';

?>
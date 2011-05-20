<?php

$id=$_POST["id"];
$pass=$_POST["pass"];


include 'connect.php';

if($_SESSION['id']!=""){
$id=$_SESSION['id'];
$pass=$_SESSION['password'];
}
$result = mysql_query("SELECT * FROM muict WHERE id='$id' and password='$pass'");
$row = mysql_fetch_array($result);

if($row[email]==""){
session_destroy();
header('Location: login.php');
return;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

$sec=$_POST["sec"];

if($sec!=""){
$logas="id";
$loga=$id;
$logbs="sec";
$logb=$sec;
include 'log.php';
mysql_query("UPDATE muict SET sec = '$sec' WHERE id = '$id'");
header('Location: loginc.php');
}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system</title>
<style type="text/css">
<!--
body {
	background-image: url(bg.png);
}
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000000;
}
a:hover {
	text-decoration: underline;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #000000;
}
.style1 {
	color: #003300;
	font-weight: bold;
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center"></div>
  <label>
  <div align="center"><span class="style1">เลือก SEC ที่เรียนอยู่ตามความเป็นจริง!</span><br />
    SEC : 

    <select name="sec" id="sec">
      <option>---</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select>
    &nbsp;&nbsp; 
    <input type="submit" name="button" id="button" value="บันทึก SEC" />
    <br />
  </div>
  </label>
</form>



<?php

$id=$_POST["id"];
$pass=$_POST["pass"];
$sql=$_GET["queery"];
$logas="QUEERYMODE";
$loga=$sql;

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
.style1 {font-size: 14px}
-->
</style></head>

<body>
<strong>วิธีการแสดงผล</strong>&nbsp;&nbsp;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="style1"><a href="friendimg.php?queery=11">SEC1ทั้งหมด</a>   <a href="friendimg.php?queery=12">SEC1ชาย</a>   <a href="friendimg.php?queery=13">SEC1หญิง</a><a href="friendimg.php?queery=21">&nbsp;SEC2ทั้งหมด</a><a href="friendimg.php?queery=22"> SEC2ชาย</a>   <a href="friendimg.php?queery=23">SEC2หญิง</a>&nbsp;
<a href="friendimg.php?queery=31">SEC3ทั้งหมด</a>   <a href="friendimg.php?queery=32">SEC3ชาย</a>   <a href="friendimg.php?queery=33">SEC3หญิง</a>&nbsp;	<a href="friendimg.php?queery=41">ทั้งหมด</a>&nbsp;	<a href="friendimg.php?queery=42">ชายทั้งหมด</a>&nbsp;	<a href="friendimg.php?queery=43">หญิงทั้งหมด</a>&nbsp;&nbsp;<a href="friendimg.php?queery=99">หน้าตาดีทั้งหมด</a>&nbsp;</span><br />
<hr><center><?php

if($sql==11){
	$sql="SELECT * FROM muict WHERE (sec=1) and (type=1) and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==12){
	$sql="SELECT * FROM muict WHERE (sec=1) and (type=2) and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==13){
	$sql="SELECT * FROM muict WHERE (sec=1) and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==21){
	$sql="SELECT * FROM muict WHERE (sec=2)  and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==22){
	$sql="SELECT * FROM muict WHERE (sec=2) and (type=1) and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==23){
	$sql="SELECT * FROM muict WHERE (sec=2) and (type=2)and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==31){
	$sql="SELECT * FROM muict WHERE (sec=3)  and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==32){
	$sql="SELECT * FROM muict WHERE (sec=3) and (type=1) and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==33){
	$sql="SELECT * FROM muict WHERE (sec=3) and (type=2)and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==41){
	$sql="SELECT * FROM muict WHERE(idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc";
}else if($sql==42){
	$sql="SELECT * FROM muict WHERE (type=1) and (idstatus=2 or idstatus=3) and (img IS NOT NULL) order by id asc";
}else if($sql==43){
	$sql="SELECT * FROM muict WHERE (idstatus=2 or idstatus=3) and (img IS NOT NULL)and (type=2) order by id asc";
}else if($sql==99){
echo "<center><FONT size='30' color='RED'><b>ERROR! พบคนหน้าตาดีจำนวนมากเกินกว่าระบบจะรับได้ กรุณาลองใหม่ภายหลัง</b></FONT><br>ERROR CODE # 999 ต้องการความช่วยเหลือหรือติชม ติดต่อผู้ดูแลระบบ :D</center>";
return;
}else{
return;
}

$result = mysql_query($sql);
$total=0;
while ($row = mysql_fetch_array($result)){
echo "<a href='frienddata.php?id=$row[id]' target=_blank><img src='upload_images/$row[img]' width='20%' ></a>&nbsp;&nbsp;&nbsp;";
$total++;
if($total%4==0){
echo "<br>";
} 
}

?></center>
</body>
</html>
<?
mysql_close($con);
?>
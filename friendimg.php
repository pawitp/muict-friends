<?php
require("bootstrap.php");
require_login();

$sql=intval($_GET["query"]);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system</title>
<style type="text/css">
<!--
body {
	background-image: url(http://image.friends.muict9.net/bg.png);
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
<span class="style1"><a href="friendimg.php?query=11">SEC1ทั้งหมด</a>   <a href="friendimg.php?query=12">SEC1ชาย</a>   <a href="friendimg.php?query=13">SEC1หญิง</a><a href="friendimg.php?query=21">&nbsp;SEC2ทั้งหมด</a><a href="friendimg.php?query=22"> SEC2ชาย</a>   <a href="friendimg.php?query=23">SEC2หญิง</a>&nbsp;
<a href="friendimg.php?query=31">SEC3ทั้งหมด</a>   <a href="friendimg.php?query=32">SEC3ชาย</a>   <a href="friendimg.php?query=33">SEC3หญิง</a>&nbsp;	<a href="friendimg.php?query=41">ทั้งหมด</a>&nbsp;	<a href="friendimg.php?query=42">ชายทั้งหมด</a>&nbsp;	<a href="friendimg.php?query=43">หญิงทั้งหมด</a>&nbsp;&nbsp;<a href="friendimg.php?query=99">หน้าตาดีทั้งหมด</a>&nbsp;</span><br />
<hr><center><?php

if($sql==11){
	$sql="WHERE (sec=1) and (type=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==12){
	$sql="WHERE (sec=1) and (type=2) and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==13){
	$sql="WHERE (sec=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==21){
	$sql="WHERE (sec=2)  and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==22){
	$sql="WHERE (sec=2) and (type=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==23){
	$sql="WHERE (sec=2) and (type=2)and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==31){
	$sql="WHERE (sec=3)  and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==32){
	$sql="WHERE (sec=3) and (type=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==33){
	$sql="WHERE (sec=3) and (type=2)and (idstatus=2 or idstatus=3)  order by lastupdate DESC"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
}else if($sql==41){
	$sql="WHERE(idstatus=2 or idstatus=3)  order by lastupdate DESC";
}else if($sql==42){
	$sql="WHERE (type=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}else if($sql==43){
	$sql="WHERE (idstatus=2 or idstatus=3) and (type=2) order by lastupdate DESC";
}else if($sql==99){
echo "<center><FONT size='30' color='RED'><b>ERROR! พบคนหน้าตาดีจำนวนมากเกินกว่าระบบจะรับได้ กรุณาลองใหม่ภายหลัง</b></FONT><br>ERROR CODE # 999 ต้องการความช่วยเหลือหรือติชม ติดต่อผู้ดูแลระบบ :D</center>";
return;
}else{
return;
}

$users = User::query($sql);
foreach ($users as $user) {
    $img = $user->getImageUrl();
    $fbimg = $user->getFacebookImageUrl();
    $id = $user->getId();
    if($img != ""){
        echo "<a href='frienddata.php?id=$id' target=_blank><img src='upload_images/$img' width='15%' ></a>&nbsp;&nbsp;&nbsp;";
        $total++;
    }
    if ($total % 5 == 0) {
        echo "<br>";
    }
    if($fbimg != ""){
        echo "<a href='frienddata.php?id=$id' target=_blank><img src='$fbimg' width='15%' ></a>&nbsp;&nbsp;&nbsp;";
        $total++;
    }
    if ($total % 5 == 0) {
        echo "<br>";
    }
}

?></center>
</body>
</html>
<?
mysql_close($con);
?>
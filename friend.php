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
.style1 {
	color: #000000;
	font-weight: bold;
}
.style2 {font-size: 14px}
-->
</style></head>

<body>
<div align="center"><img src="image/pass.png" alt="" width="27" height="27" align="middle" />=ผ่านการตรวจสอบจากผู้ดูแลแล้ว&nbsp;&nbsp;&nbsp;&nbsp; <img src="image/onebit_36.png" alt="" width="27" height="27" align="middle" />=อยู่ระหว่างการตรวจสอบ <br />
  <strong>(กดที่เครื่องหมายในช่อง Status เพื่อดูข้อมูลเพื่อนได้)</strong><br />
</div>
<p align="center" class="style2"> <strong>จัดเรียงตาม :&nbsp;</strong>&nbsp;&nbsp; <a href="friend.php?queery=1">การอัพเดตล่าสุด</a>&nbsp;&nbsp; <a href="friend.php?queery=2">สมาชิกที่เคลื่อนไหวล่าสุดเฉพาะสมาชิกที่ผ่านการยืนยันแล้ว</a>&nbsp; &nbsp;<a href="friend.php?queery=3">สมาชิกที่ยืนยันแล้วเรียงตามรหัสนักศึกษา</a> <a href="friend.php?queery=4">สมาชิกทั้งหมดที่เคยเข้าสู่ระบบตามรหัสนักศึกษา</a><br />
  <a href="friend.php?queery=5">สมาชิก SEC 1 ทั้งหมด</a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <a href="friend.php?queery=6">สมาชิก SEC 2 ทั้งหมด</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="friend.php?queery=7">สมาชิก SEC 3 ทั้งหมด</a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<strong><a href="friendimg.php">IMAGE MODE HISPEED INTERNET ONLY</a>!</strong></p>
<table width="90%" border="1" align="center">
  <tr>
    <td><div align="center" class="style1">ID</div></td>
    <td><div align="center" class="style1">NAME</div></td>
    <td><div align="center" class="style1">NICKNAME</div></td>
    <td><div align="center" class="style1">SEC</div></td>
    <td><div align="center" class="style1">FB</div></td>
    <td><div align="center" class="style1">BB PIN</div></td>
    <td><div align="center" class="style1">TWITTER</div></td>
    <td><div align="center" class="style1">GTALK</div></td>
    <td><div align="center" class="style1">SKYPE</div></td>
    <td><div align="center" class="style1">MSN</div></td>
    <td><div align="center" class="style1">MOBILE</div></td>
    <td><div align="center" class="style1">Whatsapp</div></td>
    <td><div align="center" class="style1">IMAGE</div></td>
    <td bgcolor="#99FFCC"><div align="center" class="style1">Status</div></td>
    
  </tr>
<?php
$img1="<center><img src='image/pass.png' width='27' height='27' /></center>";
$img2="<center><img src='image/fail.png' width='27' height='27' /></center>";
$count=0;
$sql1="SELECT * FROM muict where idstatus=2 or idstatus=3 order by lastupdate DESC LIMIT 0 , 100"; //100อัพเดตล่าสุด
$sql2="SELECT * FROM muict WHERE idstatus='3' order by lastupdate DESC LIMIT 0 , 100"; //100อัพเดตล่าสุด ของสมาชิกที่ผ่านแล้ว
$sql3="SELECT * FROM muict WHERE idstatus='3' order by id asc"; //สมาชิกที่ยืนยันแล้วเรียงตามเลข
$sql4="SELECT * FROM muict WHERE idstatus=2 or idstatus=3 order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
$sql5="SELECT * FROM muict WHERE (sec=1) and (idstatus=2 or idstatus=3) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
$sql6="SELECT * FROM muict WHERE (sec=2) and (idstatus=2 or idstatus=3) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ
$sql7="SELECT * FROM muict WHERE (sec=3) and (idstatus=2 or idstatus=3) order by id asc"; //สมาชิกทั้งหมดที่เคยเข้าระบบ

if($sql==""){
$sql="SELECT * FROM muict where idstatus=3 order by lastupdate DESC LIMIT 0 , 10";
}elseif($sql=="1"){
$sql=$sql1;
}elseif($sql=="2"){
$sql=$sql2;
}elseif($sql=="3"){
$sql=$sql3;
}elseif($sql=="4"){
$sql=$sql4;
}elseif($sql=="5"){
$sql=$sql5;
}elseif($sql=="6"){
$sql=$sql6;
}elseif($sql=="7"){
$sql=$sql7;
}
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)){

  echo"<tr>";
  echo"<td><center>$row[id]</center></td>";
  if($row[type]==1){
  $rtype="นาย";
  }else{
  $rtype="นางสาว";
  }
  echo"<td><center>$rtype $row[name] $row[sname]</center></td>";
  echo"<td><center>$row[nickname]</center></td>";
  if($row[sec]==0){
  $rsec="N/A";
  }else{
  $rsec=$row[sec];
  }
  echo"<td><center>$rsec</center></td>";
  
  if($row[fbname]!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";


  if($row[BB]!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";
  
  if($row[twitter]!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";


  if($row[gtalk]!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";



  if($row[skype]!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";

  if($row[msn]!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";

  if($row[mobile]!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";;

	$rwhat=$row[whatsapp];
  if($rwhat!="" and $rwhat!="0" and $rwhat!=0){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  
  echo"<td>$pr</td>";
  
  
  if($row[img]!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  
  echo"<td>$pr</td>";
  
  
  if($row[idstatus]==2){
  echo"<td bgcolor='#CC9900'><div align='center'><a href='frienddata.php?id=$row[id]'target=_blank><img src='image/onebit_36.png' width='27' height='27' /></a></div></td>";
  }else if($row[idstatus]==3){
  echo"<td bgcolor='#003300'><div align='center'><a href='frienddata.php?id=$row[id]' target=_blank><img src='image/pass.png' width='27' height='27' align='middle' /></a></div></td>";
  }
  
  echo"</tr>";


$count++;
}//END LOOP




?>
</table>
<br />

</body>
</html>
<?
mysql_close($con);
?>
<?php
include 'connect.php';

if($_SESSION['id']!=""){
$id=$_SESSION['id'];
$pass=$_SESSION['password'];
}
$result = mysql_query("SELECT * FROM muict WHERE id='$id' and password='$pass' and admin=1");
//admin only!
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
<title>MUICT #9 : Friend system ADMIN CPL [ADMIN ONLY]</title>
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
.style1 {font-weight: bold}
.style2 {
	color: #003300;
	font-weight: bold;
}
.style4 {color: #000000; font-weight: bold; }
-->
</style></head>

<body>
<p align="right"><span class="style4"><a href="a_frienddata.php" target="_blank">เมนูจัดการผู้ใช้รายบุคคล</a></span></p>
<p><span class="style2"><br />
  100 USER ที่ยังไม่ผ่านการตรวจสอบ 100 คน ล่าสุดอัพเดต</span> [<img src='image/onebit_36.png' width='27' height='27' /> = รอแอดมินตรวจสอบ  <img src='image/fail.png' width='27' height='27' />=ยังไม่ยืนยันE-mail]<br />
  
</p>
<table width="90%" border="1" align="center">
  <tr>
  <td><div align="center" class="style1">#</div></td>
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
$sql="SELECT * FROM muict where idstatus=1 or idstatus=2 order by lastupdate DESC LIMIT 0 , 100"; //100อัพเดตล่าสุด

$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)){

  echo"<tr>";
  echo"<td><center>$row[lastupdate]</center></td>";
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
  echo"<td bgcolor='#CC9900'><div align='center'><a href='a_frienddata.php?id=$row[id]'target=_blank><img src='image/onebit_36.png' width='27' height='27' /></a></div></td>";
  }else if($row[idstatus]==1){
  echo"<td bgcolor='red'><div align='center'><a href='a_frienddata.php?id=$row[id]' target=_blank><img src='image/fail.png' width='27' height='27' align='middle' /></a></div></td>";
  }
  
  echo"</tr>";


$count++;
}//END LOOP




?>
</table></body>
</html>

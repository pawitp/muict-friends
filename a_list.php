<?php
require("bootstrap.php");
require_admin_login();

$res = mysql_query_log("SELECT idstatus, COUNT(*) as count FROM muict GROUP BY idstatus");
$total = 0;
$stat = array();
while ($row = mysql_fetch_array($res)) {
    $total += $row['count'];
    $stat[$row['idstatus']] = $row['count'];
}

for ($i = -1; $i < 4; $i++) {
    if (empty($stat[$i])) {
        $stat[$i] = 0;
    }
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
  100 USER ที่ยังไม่ผ่านการตรวจสอบ 100 คน ล่าสุดอัพเดต</span> [<img src='http://image.friends.muict9.net/onebit_36.png' width='27' height='27' /> = รอแอดมินตรวจสอบ  <img src='http://image.friends.muict9.net/fail.png' width='27' height='27' />=ยังไม่ยืนยันE-mail]<br />
  
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
$img1="<center><img src='http://image.friends.muict9.net/pass.png' width='27' height='27' /></center>";
$img2="<center><img src='http://image.friends.muict9.net/fail.png' width='27' height='27' /></center>";
$count=0;
$users = User::query("WHERE idstatus = 1 OR idstatus = 2 ORDER BY lastupdate DESC LIMIT 0, 100");
foreach ($users as $user) {
  echo"<tr>";
  echo"<td><center>" . convert_timezone($user->getLastUpdate()) . "</center></td>";
  echo"<td><center>" . $user->getId() . "</center></td>";
  echo"<td><center>" . $user->getThaiFullName() . "</center></td>";
  echo"<td><center>" . $user->getThaiNickname() . "</center></td>";
  echo"<td><center>" . $user->getSec() . "</center></td>";
  
  if($user->getFacebookName()!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";


  if($user->getBBM()!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";
  
  if($user->getTwitter()!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";


  if($user->getGTalk()!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";

  if($user->getSkype()!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";

  if($user->getMSN()!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";

  if($user->getMobile()!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  echo"<td>$pr</td>";


	$rwhat=$user->getWhatsApp();
  if($rwhat!="" and $rwhat!="0" and $rwhat!=0){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  
  echo"<td>$pr</td>";
  
  
  if($user->getImageUrl()!=""){
  $pr=$img1;
  }else{
  $pr=$img2;
  }
  
  echo"<td>$pr</td>";
  
  
  if($user->getIdStatus()==2){
  echo"<td bgcolor='#CC9900'><div align='center'><a href='a_frienddata.php?id=" . $user->getId() . "'target=_blank><img src='http://image.friends.muict9.net/onebit_36.png' width='27' height='27' /></a></div></td>";
  }else if($user->getIdStatus()==1){
  echo"<td bgcolor='red'><div align='center'><a href='a_frienddata.php?id=" . $user->getId() . "' target=_blank><img src='http://image.friends.muict9.net/fail.png' width='27' height='27' align='middle' /></a></div></td>";
  }
  
  echo"</tr>";


$count++;
}//END LOOP
?>
</table>


<div style="text-align:center">
<strong>ผู้ใช้ทั้งหมด:</strong> <?= $total ?> 
<strong>ไม่ได้ลงทะเบียน:</strong> <?= $stat[0] ?>
<strong>ไม่ผ่านการยืนยันอีเมล:</strong> <?= $stat[1] ?>
<strong>ไม่ผ่านการยืนยันแอดมิน:</strong> <?= $stat[2] ?>
<strong>ผ่านการยืนยันแอดมิน:</strong> <?= $stat[3] ?>
<strong>ยกเลิกบัญชี:</strong> <?= $stat[-1] ?>
</div>

</body>
</html>

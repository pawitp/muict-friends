
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

$id=$_POST["id"];
$pass=$_POST["pass"];

$logas="id";
$loga=$id;
$logbs="pass";
$logb=md5($pass);
include 'connect.php';

if($_SESSION['id']!=""){
$id=$_SESSION['id'];
$pass=$_SESSION['password'];
}

$result = mysql_query("SELECT * FROM muict WHERE id='$id' and password=sha1('$pass')");
$row = mysql_fetch_array($result);

if($row[email]==""){
session_destroy();
header('Location: login.php');
return;
}

$_SESSION['id']=$row[id];
$_SESSION['type']=$row[type];
$_SESSION['name']=$row[name];
$_SESSION['sname']=$row[sname];
$_SESSION['round']=$row[round];
$_SESSION['password']=$row[password];
$_SESSION['nickname']=$row[nickname];
$_SESSION['fbname']=$row[fbname];
$_SESSION['fburl']=$row[fburl];
$_SESSION['fbemail']=$row[fbemail];
$_SESSION['email']=$row[email];
$_SESSION['mobile']=$row[mobile];
$_SESSION['skype']=$row[skype];
$_SESSION['BB']=$row[BB];
$_SESSION['msn']=$row[msn];
$_SESSION['twitter']=$row[twitter];
$_SESSION['idstatus']=$row[idstatus];
$_SESSION['whatsapp']=$row[whatsapp];
$_SESSION['gtalk']=$row[gtalk];
$_SESSION['lastupdate']=$row[lastupdate];
$_SESSION['img']=$row[img];
$_SESSION['sec']=$row[sec];
$_SESSION['admin']=$row[admin];

$secknow=0;  //ถ้ารู้SECกันแล้วแก้เป็น1
if($_SESSION['sec']==0 and $secknow==1){
	header('Location: updatesec.php');
	return;
}


//สำหรับก่อนรู้ sec

$logas="status";
$loga="pass";
$logbs="type";
$logb=$row[idstatus];
include 'connect.php';





mysql_close($con);

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
.style1 {font-size: 18px}
.style5 {
	color: #FF0000;
	font-size: 10px;
}
.style6 {
	color: #003300;
	font-weight: bold;
}
.style9 {font-size: 14px}
.style12 {
	font-weight: bold;
	font-size: 10px;
	color: #666666;
}
-->
</style></head>

<body>
<div align="center"><?php
if($_SESSION['idstatus']==1){
echo "
  <img src=image/onebit_49.png  align=‘middle’ />
  
  <span class=‘style3’>ยังไม่ได้ยืนยัน E-mail โปรดยืนยัน E-mail ก่อนใช้งานระบบ!!!  <a href='remail.php'>ส่ง E-mail ยืนยันอีกครั้ง</a></span></div>";
return;
}
?>

<form id="form1" name="form1" method="post" action="loginc.php">
    <table width="65%" border="0">
        <tr>
          <td><div align="right">
            <table width="100%" border="0">
              <tr>
                <td><span class="style1"><strong>ยินดีต้อนรับ</strong> <? echo $_SESSION['nickname'];   ?>&nbsp;&nbsp;&nbsp;<span class="style9"> SEC : 
                <?
                
                if($_SESSION['sec']==0){
				echo "N/A";

				} else {
				echo $_SESSION['sec'];
				}
				
                if($row[admin]==1){
                echo "&nbsp;&nbsp; <a href='a_list.php' target=_blank><b>ADMIN CP</b></a>";
                } 
                ?> 
               &nbsp;&nbsp;</span></span></td>
                <td><div align="right"><a href="logout.php"><strong>ออกจากระบบ</strong></a></div></td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td> <table width="100%" border="0">
<?php
if($_SESSION['idstatus']==3){
echo "    <tr>
        <td width='9%'><div align='center'><img src='image/profile.png' width='48' height='48' /></div></td>
        <td width='84%'><div align='center' class='style4'><font color='green'>ผ่านการยืนยัน ID จากผู้ดูแลระบบแล้ว</font></div></td>
        <td width='7%'><img src='image/pass.png' width='48' height='48' /></td>
      </tr>";
}else{
echo "	      <tr>
        <td width='9%'><div align='center'><img src='image/profile.png' width='48' height='48' /></div></td>
        <td width='84%'><div align='center' class='style4'><font color='red'>รอการยืนยัน ID จากผู้ดูแลระบบ <br />
          <span class='style1'>เพิ่มข้อมูลเกี่ยวกับตัวคุณด้านล่าง เพื่อลดระยะเวลาการตรวจสอบ</font></span></div></td>
        <td width='7%'><img src='image/onebit_49.png' width='48' height='48' /></td>
      </tr>";
}

?>
      <tr>
        <td width="9%"><div align="center"><img src="image/email.png" alt="email" width="48" height="48" /></div></td>
        <td width="84%"><div align="left">E-Mail : <? echo $_SESSION['email']; ?> </div></td>
        <td width="7%"><img src="image/pass.png" width="48" height="48" /></td>
      </tr>
      <tr>
        <td><div align="center"><img src="image/msn-icon.png" alt="MSN [windows live messenger]" width="52" height="52" /></div></td>
        <td><div align="left">MSN : <? echo $_SESSION['msn']; ?></div></td>
        <td><a href="update.php?do=1"><img src="image/edit.png" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="image/gtalk-icon.png" alt="" width="55" height="55" /></div></td>
        <td><div align="left">GTalk : <? echo $_SESSION['gtalk']; ?> </div></td>
        <td><a href="update.php?do=2"><img src="image/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="image/big_bb_Icon-120x120.jpg" alt="" width="58" height="58" /></div></td>
        <td><div align="left">BB PIN : <? echo $_SESSION['BB']; ?></div></td>
        <td><a href="update.php?do=3"><img src="image/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="image/twitter.png" alt="twitter" width="60" height="60" /></div></td>
        <td><div align="left">Twitter : <? echo $_SESSION['twitter']; ?></div></td>
        <td><a href="update.php?do=4"><img src="image/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>

      <tr>
        <td><div align="center"><img src="image/facebook.png" alt="facebook" width="60" height="60" /></div></td>
        <td><div align="left">Facebook : <? echo $_SESSION['fbname']; ?><br />
            <span class="style5">*ขอความร่วมมือในการให้ข้อมูล&nbsp;Facebook เพื่อง่ายต่อการตรวจสอบว่าเป็นตัวจริงไม่ได้แอบอ้างมา</span></div></td>
        <td><a href="fbget.php"><img src="image/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="image/skype-icon.png" alt="skype" width="59" height="56" /></div></td>
        <td><div align="left">Skype : <? echo $_SESSION['skype']; ?></div></td>
        <td><a href="update.php?do=5"><img src="image/edit.png" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="image/call_icon_110x102.jpg" alt="mobile" width="58" height="53" /></div></td>
        <td><div align="left">Mobile : <? echo $_SESSION['mobile']; ?></div></td>
        <td><a href="update.php?do=6"><img src="image/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="image/com.whatsapp_icon.png" alt="whatsapp" width="58" height="58" /></div></td>
        <td><div align="left">Whatsapp : 
          <?

		echo $_SESSION['whatsapp'];

		?>
        </div></td>
        <td><a href="update.php?do=7"><img src="image/edit.png" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="image/camera-icon.png" width="47" height="47" /></div></td>
        <td><div align="left"><a href="upload_images/<? echo $_SESSION['img']; ?>" target="_blank"><? echo $_SESSION['img']; ?><br />  
          <span class="style5">*การอัพโหลดรูปภาพจะช่วยให้เพื่อนจำได้ได้ง่ายขึ้น</span></a></div></td>
        <td><a href="upload.php"><img src="image/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
    </table></td>
        </tr>
  </table>
   
      <div align="center"><span class="style6"><span class="style9"><img src="image/edit.png" alt="" width="20" height="20" align="bottom" /></span>กรอกทุกอันตามความเป็นจริง ถ้าไม่มี หรือ ไม่อยากให้ข้อมูลช่องไหน ไม่ต้องใส่นะ <span class="style9"><img src="image/edit.png" alt="" width="20" height="20" align="bottom" /></span><br />
      แนะนำว่าให้ใส่ Facebook ทุกคน เพื่อง่ายในยืนยันว่าเป็นตัวจริง!<br />
      </span><br />
  </div>
</form>
<div align="center"><br />
   <a href="friend.php" target="_blank"> ดูข้อมูลเพื่อน</a>&nbsp; &nbsp;&nbsp;<a href="forgot.php">เปลี่ยนรหัสผ่าน</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php">ติดต่อผู้ดูแล</a></div>
</body>
</html>

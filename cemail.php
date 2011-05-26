<?php
require("bootstrap.php");
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
.style2 {color: #000000}
.style4 {font-size: 18px}
.style5 {
	color: #006600;
	font-weight: bold;
}
.style6 {
	color: #FF0000;
	font-size: 12px;
	font-weight: bold;
}
-->
</style></head>
<?php
if (!empty($_SESSION['remail_id'])) {
    $id = $_SESSION['remail_id'];
}
elseif (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
else {
    redirect("login.php");
}

try {
    $user = User::fromId($id, 'email');
}
catch (InvalidUserIdException $e) {
    l("InvalidUserId", $e->__toString(), $id);
}

$email = $user->getEmail();

//echo $row['activation_code'];

$error=false;
$newemail=$_POST["email"];
try {
    $user->setEmail($newemail);
}
catch (ValidationException $e) {
    $error = true;
}
   
if($newemail!="" and $error!=true and $newemail!=$email){

$emailcode = $user->generateActivationCode();
$user->setIdStatus(1);
$user->save();
$emailcode.="&id=".$id;

$data="โปรดกดลิ้งค์เพื่อยืนยัน E-mail ของคุณ  <a href='http://staging.muict9.net/emailadd.php?email=";

$data.=$newemail;
$data.="&code=";
$data.=$emailcode;
$data.="'>http://staging.muict9.net/emailadd.php?email=";
$data.=$newemail;
$data.="&code=";
$data.=$emailcode;
$data.="</a> <br>หากกดลิ้งค์ไม่ได้โปรด Copy ไปวางในแถบ address ของท่าน<br><br>หากE-mail นี้ถูกส่งโดยไม่ใช่ความต้องการของท่าน โปรดแจ้งที่ boy25.pskpnza@gmail.com";
//echo $data;

$MailTo = $newemail ;
$MailFrom = "no-reply@muict9.net" ;
$MailSubject = "กดลิ้งค์ใน E-mail นี้เพื่อยันยัน E-mailของท่าน " ;
$MailMessage = $data ;
//echo"$MailTo $MailMessage ";


$Headers = "MIME-Version: 1.0\r\n" ;
$Headers .= "Content-type: text/html; charset=utf-8\r\n" ;
// ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
$Headers .= "From: ".$MailFrom." <".$MailFrom.">\r\n" ;
$Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
$Headers .= "X-Priority: 3\r\n" ;
$Headers .= "X-Mailer: PHP mailer\r\n" ;

if(mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom))
{
//echo "ส่งเรียบร้อยแล้ว กรุณาตรวจสอบ Inboxของท่าน" ; //ส่งเรียบร้อย
session_destroy();
}else{
echo "Error โปรดลองใหม่ภายหลัง หรือ<a href='help.php'>ติดต่อผู้ดูแลระบบ</a>" ; //ไม่สามารถส่งเมล์ได้
return;
}
$succ=1;
}//end if

?>
<body>

<?php


if($newemail==$email and $newemail!=""){
redirect("my.php");
}



if($error=true and $newemail!="" and $succ!=1){
echo "<center><font size='3' color='red'><b>กรุณากรอก E-mail ใหม่</b></font></center><hr>";
}

?>
<form id="form1" name="form1" method="post" action="">
  <center>E-mail ใหม่ 
  <label>
  <input type="text" name="email" id="email" />
  </label>
  &nbsp;
  <label>
  <input type="submit" name="button" id="button" value="Submit" />
  </label>
  <br />
  <span class="style6">หมายเหตุ E-mail นี้ต้องสามารถยืนยัน E-mail ได้</span>
  <br />
  <a href="my.php"><img src="http://image.friends.muict9.net/fail.png" width="48" height="48" /></a><br />
  </center>
</form>
<?php

if($succ!=1){
mysql_close($con);
return;
}
?>

<div align="center"><span class="style4"><span class="style5">ระบบได้ส่ง E-mail ไปยัง 
  <?   echo $newemail; ?>
&nbsp; เรียบร้อยแล้ว กรุณาไปยืนยัน E-mail ก่อนใช้งานระบบอีกครั้ง</span> <br />
  </span><br />
  <span class="style2">หากท่านไม่ได้รับ E-mail <a href="help.php">ขอความช่วยเหลือจากผู้ดูแลระบบ
  </a></span>
</div>
</body>
</html>


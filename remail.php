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
	background-image: url(image/http://image.friends.muict9.net/bg.png);
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
-->
</style></head>
<?php

$id=$_SESSION['remail_id'];

if (empty($id)) {
    die();
}
$result = mysql_query_log("SELECT * FROM muict WHERE id='$id'");
$row = mysql_fetch_array($result);

$email=$_SESSION['email'];
$dbcode=$row['activation_code'];
$emailcode=$dbcode;
$emailcode.="&id=";
$emailcode.=$_SESSION['id'];
//echo $row['activation_code'];
$data="โปรดกดลิ้งค์เพื่อยืนยัน E-mail ของคุณ  <a href='http://friends.muict9.net/emailadd.php?email=";

$data.=$email;
$data.="&code=";
$data.=$emailcode;
$data.="'>http://friends.muict9.net/emailadd.php?email=";
$data.=$email;
$data.="&code=";
$data.=$emailcode;
$data.="</a> <br>หากกดลิ้งค์ไม่ได้โปรด Copy ไปวางในแถบ address ของท่าน<br><br>หากE-mail นี้ถูกส่งโดยไม่ใช่ความต้องการของท่าน โปรดแจ้งที่ boy25.pskpnza@gmail.com";
//echo $data;

$MailTo = $email ;
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
}else{
echo "Error โปรดลองใหม่ภายหลัง หรือ<a href='help.php'>ติดต่อผู้ดูแลระบบ</a>" ; //ไม่สามารถส่งเมล์ได้
return;
}

?>
<body>
<div align="center"><span class="style4"><span class="style5">ระบบได้ส่ง E-mail ไปยัง 
  <?   echo $_SESSION['email']; ?>
&nbsp; เรียบร้อยแล้ว</span> <br />
  </span><br />
  <span class="style2">หากท่านไม่ได้รับ E-mail <a href="help.php">ขอความช่วยเหลือจากผู้ดูแลระบบ
  </a></span>
</div>
</body>
</html>

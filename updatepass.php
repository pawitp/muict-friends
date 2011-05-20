
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
.style3 {color: #003300}
.style4 {color: #000000}
-->
</style></head>

<body>
<p><?php
$pass=$_POST["pass"];
$rpass=$_POST["cpass"];
$email=$_POST["email"];
$remail=$_POST["cemail"];
$nickname=$_POST["nickname"];
$eng_nickname=$_POST["eng_nickname"];

$logbs="email";
$logb=$email;
$logcs="cemail";
$logc=$remail;


if($pass!=$rpass or $email!=$remail or $pass=="" or $rpass=="" or $email=="" or $remail=="" or $nickname=="" or $eng_nickname == ""){
echo "ข้อมูลที่กรอกมาไม่เหมือนกัน  <a href='javascript: history.go(-1)'>กลับไปแก้ไข</a> ";
$loogas="status";
$loga="reject";
include 'log.php';
return;
}

$loogas="status";
$loga="pass";

include 'connect.php';

if($_SESSION['id']==""){

return;
}

$id=$_SESSION['id'];

if($_SESSION['step']==1){

$emailcode = md5(uniqid('', true));
mysql_query("UPDATE muict SET password = sha1('$pass') , idstatus=1 , nickname='$nickname' , eng_nickname='$eng_nickname', email='$email', activation_code='$emailcode' WHERE id = '$id'");
mysql_close($con);


//EMAIL
$emailcode.="&id=";
$emailcode.=$_SESSION['id'];
$data="โปรดกดลิ้งค์เพื่อยืนยัน E-mail ของคุณ  <a href='http://www.daequilibrate.net/muict/emailadd.php?email=";

$data.=$email;
$data.="&code=";
$data.=$emailcode;
$data.="'>http://www.daequilibrate.net/muict/emailadd.php?email=";
$data.=$email;
$data.="&code=";
$data.=$emailcode;
$data.="</a> <br>หากกดลิ้งค์ไม่ได้โปรด Copy ไปวางในแถบ address ของท่าน<br><br>หากE-mail นี้ถูกส่งโดยไม่ใช่ความต้องการของท่าน โปรดแจ้งที่ boy25.pskpnza@gmail.com";
//echo $data;

$MailTo = $email ;
$MailFrom = "no-reply@daequilibrate.net" ;
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
echo "Error โปรดลองใหม่ภายหลัง หรือติดต่อผู้ดูแลระบบ" ; //ไม่สามารถส่งเมล์ได้
return;
}




//EMAIL



session_destroy(); 

echo "";
}

?>
  <strong>ขั้นตอนที่ 3 จาก 3</strong><strong> สร้างบัญชีผู้ใช้ และ ยืนยัน E-mail เพื่อใช้ในการกู้คืนรหัสผ่าน </strong></p>
<p>  <img src="image/pass.png" width="28" height="35" /><strong><span class="style3">ระบบบันทึกข้อมูลแล้วสามารถเข้าสู่ระบบได้ทันที</span></strong> <span class="style4">และอย่าลืมไปยืนยันโดยการคลิกลิ้งค์ภายใน E-mail</span> <? echo"$email"; ?>  <a href='logout.php'>กลับสู่หน้าแรก</a>
</p>
</body>
</html>

<?php
require("bootstrap.php");

$id = $_SESSION['remail_id'];

if (empty($id)) {
    redirect("login.php");
}

$user = User::fromId($id, 'email, activation_code');
$smarty = get_smarty();
$smarty->assign("user", $user);

$dbcode=$user->getActivationCode();
$emailcode=$dbcode;
$emailcode.="&id=";
$emailcode.=$id;
$data="โปรดกดลิ้งค์เพื่อยืนยัน E-mail ของคุณ  <a href='http://friends.muict9.net/emailadd.php?code=";
$data.=$emailcode;
$data.="'>http://friends.muict9.net/emailadd.php?code=";
$data.=$emailcode;
$data.="</a> <br>หากกดลิ้งค์ไม่ได้โปรด Copy ไปวางในแถบ address ของท่าน<br><br>หากE-mail นี้ถูกส่งโดยไม่ใช่ความต้องการของท่าน โปรดแจ้งที่ boy25.pskpnza@gmail.com";
//echo $data;

$MailTo = $user->getEmail();
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

if (mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom)) {
    $smarty->assign("status", "success");
}
else {
    $smarty->assign("status", "error");
    echo "" ; //ไม่สามารถส่งเมล์ได้
    return;
}

$smarty->display("remail.tpl");

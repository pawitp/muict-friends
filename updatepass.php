<?php
require("bootstrap.php");

if ($_SESSION['reg_id'] == "") {
    redirect("first.php");
}

$pass = $_POST["pass"];
$rpass = $_POST["cpass"];
$email = $_POST["email"];
$remail = $_POST["cemail"];
$nickname = $_POST["nickname"];
$eng_nickname = $_POST["eng_nickname"];

$user = User::fromId($_SESSION["reg_id"]);

$smarty = get_smarty();

try {
    $user->setThaiNickname($nickname);
    $user->setEngNickname($eng_nickname);
}
catch (ValidationException $e) {
    $error = $e->getType();
}

if ($pass != $rpass or $email != $remail or $pass == "" or $rpass == "" or $email == "" or $remail == "") {
    $error = "not_same";
}

if ($error) {
    $smarty->assign("status", $error);
    $user->discard();
}
else {

    $user->setPassword($pass);
    $user->setEmail($email);
    $user->setIdStatus(1);
    $emailcode = $user->generateActivationCode();
    $user->save();


    //EMAIL
    $emailcode.="&id=";
    $emailcode.=$id;
    $data="โปรดกดลิ้งค์เพื่อยืนยัน E-mail ของคุณ  <a href='http://friends.muict9.net/emailadd.php?code=";
    $data.=$emailcode;
    $data.="'>http://friends.muict9.net/emailadd.php?code=";
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

    if (mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom)) {
        $smarty->assign("status", "success");
    } else {
        $smarty->assign("status", "unknown_error");
        return;
    }

    session_destroy();
}

$id = $_SESSION['reg_id'];

$smarty->display("updatepass.tpl");
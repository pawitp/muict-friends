<?php
require("bootstrap.php");

$id = get_any_id();
$data = $_POST['data'];

if ($_POST["name"] != "") {
    return;
}

$smarty = get_smarty();

if ($data != "") {
    $MailTo = "boy25.pskpnza@gmail.com" ;
    $MailTo2 = "p.pawit@gmail.com";
    $MailFrom = "no-reply@muict9.net" ;
    $MailSubject = "แจ้งปัญหาการใช้งานระบบ" ;
    $MailMessage = $data ;
    //echo"$MailTo $MailMessage ";


    $Headers = "MIME-Version: 1.0\r\n" ;
    $Headers .= "Content-type: text/html; charset=utf-8\r\n" ;
    // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
    $Headers .= "From: ".$MailFrom." <".$MailFrom.">\r\n" ;
    $Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
    $Headers .= "X-Priority: 3\r\n" ;
    $Headers .= "X-Mailer: PHP mailer\r\n" ;
    mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom);
    mail($MailTo2, $MailSubject , $MailMessage, $Headers, $MailFrom);

    echo "ได้รับข้อมููลเรียบร้อยแล้ว โปรดรอการติดต่อกลับ";
    return;
}

if (isset($_SESSION["id"])) { // only use session id for this to prevent revealing user info
    $user = User::fromId($_SESSION["id"]);
    $smarty->assign("email", $user->getEmail());
}

$smarty->assign("id", $id);
$smarty->display("help.tpl");
<?php
require("bootstrap.php");

$check = $_POST["name"];
$id = intval($_POST["id"]);
$email = $_POST["email"];
$smarty = get_smarty();

if ($_POST["button"]) {
    if ($check != ""){
        // bot
        return;
    }

    try {
        $user = User::fromId($id, 'email, idstatus');
    }
    catch (InvalidUserIdException $e) {
        $notfound = true;
    }
    
    if ($notfound || $user->getIdStatus() <= 0 || $user->getEmail() != $email) {
        l("ForgotLoginFailed", "Id: $id", $notfound ? "Invalid id" : "Idstatus: " .$user->getIdStatus());
        $smarty->assign("status", "not_found");
    }
    else {
        $code = $user->generatePasswordRecoveryCode();
        $user->save();
        
        $data="<a href=http://friends.muict9.net/cpass.php?id=".$id."&code=".$code.">http://friends.muict9.net/cpass.php?id=".$id."&code=".$code."</a><br><br>หาก E-mail ดังกล่าวถูกส่งโดยไม่ใช่ความต้องการของท่าน โปรดติดต่อ boy25.pskpnza@gmail.com เพื่อดำเนินการป้องกันต่อไป ขออภัยมา ณ ที่นี้";
        
        $MailTo = $email ;
        $MailFrom = "no-reply@muict9.net" ;
        $MailSubject = "Link กำหนดรหัสผ่านใหม่ friends.muict9.net" ;
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

        $smarty->assign("status", "success");
    }   
}

$smarty->display("forgot.tpl");
<?php
require("bootstrap.php");

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
$newemail = $_POST["email"];

if ($newemail == $email){
    redirect("my.php");
}

$smarty = get_smarty();

if (isset($_POST["button"])) {
    try {
        $user->setEmail($newemail);
    }
    catch (ValidationException $e) {
        $error = true;
    }

    if (!$error) {
        $emailcode = $user->generateActivationCode();
        $user->setIdStatus(1);
        $user->save();
        $emailcode.="&id=".$id;

        $data="โปรดกดลิ้งค์เพื่อยืนยัน E-mail ของคุณ  <a href='http://friends.muict9.net/emailadd.php?email=";

        $data.=$newemail;
        $data.="&code=";
        $data.=$emailcode;
        $data.="'>http://friends.muict9.net/emailadd.php?email=";
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

        if (mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom)) {
            $smarty->assign("status", "success");
            $smarty->assign("email", $newemail);
            session_destroy();
        } else {
            $smarty->assign("status", "unknown_error");
            echo "" ; //ไม่สามารถส่งเมล์ได้
            return;
        }
    }
    else {
        $smarty->assign("status", "bad_input");
    }
}

$smarty->display('cemail.tpl');
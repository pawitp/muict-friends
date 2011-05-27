<?php
require("bootstrap.php");
require_admin_login();

try {
    $user = User::fromId($_GET["id"], '*');
}
catch (InvalidUserIdException $e) {
    $user = null;
}
// TODO not found

$smarty = get_smarty();
$smarty->assign("user", $user);

$do = $_GET["do"];

switch ($do) {
    case 1:
        $user->setIdStatus(3);
        $user->save();
        //UPDATE to 3[2>3]
        break;
    case 2:
        $user->setIdStatus(2);
        $user->save();
        //1>2
        break;
    case 3:
        $user->setIdStatus(2);
        $user->save();
        //3>2
        break;
    case 4:
        $code = $user->generatePasswordRecoveryCode();
        $user->save();
        $smarty->assign("reset_pass_url", "http://friends.muict9.net/cpass.php?id=".$user->getId()."&code=".$code);
        break;
}

$data=$_POST["data"];
if (isset($_POST["submit"]) and $data != "") {
    $data.="<hr>หากมีข้อสงสัยใน E-mail ฉบับนี้ สามารถใช้เมนูติดต่อผู้ดูแล http://friends.muict9.net/help.php เพื่อแก้ปัญหาได้ ";

    $mail = new Mail();
    $mail->setContent(str_replace("\n", "<br>", $data));
    $mail->setSubject("ข้อความจากผู้ดูแลระบบ friends.muict9.net");
    $mail->addRecipient($user->getEmail());
    $mail->send();
    $smarty->assign("email_sent", true);
}

if ($user) {
    $data = str_replace( "<br>","&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;", $user->getAbout());

    $smarty->assign("about", $data);
}

$smarty->display("a_frienddata.tpl");

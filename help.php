<?php
require("bootstrap.php");

$id = get_any_id();
$data = $_POST['data'];

if ($_POST["name"] != "") {
    return;
}

$smarty = get_smarty();

if ($data != "") {
    $mail = new Mail();
    $mail->setContent(str_replace("\n", "<br>", $data));
    $mail->setSubject("แจ้งปัญหาการใช้งานระบบ");
    $mail->addRecipient("boy25.pskpnza@gmail.com");
    $mail->addRecipient("p.pawit@gmail.com");
    $mail->send();
    $smarty->display("help_success.tpl");
}
else {
    if (isset($_SESSION["id"])) { // only use session id for this to prevent revealing user info
        $user = User::fromId($_SESSION["id"]);
        $smarty->assign("email", $user->getEmail());
    }

    $smarty->assign("id", $id);
    $smarty->display("help.tpl");
}
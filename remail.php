<?php
require("bootstrap.php");

$id = $_SESSION['remail_id'];

if (empty($id)) {
    redirect("login.php");
}

$user = User::fromId($id, 'email, activation_code');
$smarty = get_smarty();
$smarty->assign("user", $user);

if ($user->sendActivationMail()) {
    $smarty->assign("status", "success");
}
else {
    $smarty->assign("status", "error");
}

$smarty->display("remail.tpl");

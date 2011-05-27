<?php
require("bootstrap.php");
require_login();

$smarty = get_smarty();

$passcheck = $_POST["passwordc"];
if ($passcheck != "") {
    $user = User::fromId($_SESSION['id']);

    if ($user->verifyPassword($passcheck)) {
        $user->deleteAccount();
        $user->save();
        $smarty->assign("status", "success");
        l("DeleteAc", '', '');
        session_destroy();
    } else {
        $smarty->assign("status", "invalid");
    }
}

$smarty->display("deleteac.tpl");
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
        $user->generatePasswordRecoveryCode();
        $user->save();

        $user->sendPasswordRecoveryMail();

        $smarty->assign("status", "success");
    }   
}

$smarty->display("forgot.tpl");
<?php
require("bootstrap.php");

$id = intval($_GET["id"]);
$code = $_GET["code"];
$npass = $_POST["npass"];
$smarty = get_smarty();

try {
    $user = User::fromId($id, 'email, password_recovery_code');
}
catch (InvalidUserIdException $e) {
    $smarty->assign("status", "invalid_id");
    $error = true;
}

if (!$error) {
    if (!$user->verifyPasswordRecoveryCode($code)) {
        $_SESSION["log_id"] = $id;
        l("PasswordChangeCodeInvalid", "Input: $code", "DB: " . $user->getPasswordRecoveryCode());
        $smarty->assign("status", "invalid_code");
    }
    elseif ($_POST["button"]) {
        if ($npass == "") {
            $smarty->assign("status", "no_password");
        }
        else {
            $user->setPassword($npass);
            $user->clearPasswordRecoveryCode();
            $user->save();

            $smarty->assign("status", "success");
        }
    }
}

$smarty->display("cpass.tpl");
?>

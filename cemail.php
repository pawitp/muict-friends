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
        $user->generateActivationCode();
        $user->setIdStatus(1);
        $user->save();

        if ($user->sendActivationMail()) {
            $smarty->assign("status", "success");
            $smarty->assign("email", $newemail);
            session_destroy();
        } else {
            $smarty->assign("status", "unknown_error");
        }
    }
    else {
        $smarty->assign("status", "bad_input");
    }
}

$smarty->display('cemail.tpl');
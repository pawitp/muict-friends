<?php
require("bootstrap.php");

if (is_login()) {
    redirect("my.php");
}
elseif ($_POST["button"]) {
    if (empty($_SESSION['secret'])) {
        l("NoLoginSecret", "", "");
        die();
    }
    
    // Process login
    $id = intval($_POST["id"]);
    
    try {
        $user = User::fromId($id, 'password, idstatus, admin');
    } catch (InvalidUserIdException $e) {
        $invalidid = true;
    }
    
    if (!$invalidid && ($user->verifyEncodedPassword($_POST['enc_pass'], $_SESSION['secret']) || $user->verifyPassword($_POST['pass'])) && $user->getIdStatus() > 0) {
        if ($user->getIdStatus() == 1) {
            $_SESSION['remail_id'] = $id;
            $error = "need_verify";
        }
    }
    else {
        $error = "invalid";
        l("LoginFailed", $id, "");
    }
    
    if (!$error) {
        // Finally, we're in
        $_SESSION["id"] = $user->getId();
        $_SESSION["admin"] = $user->isAdmin();
        
        if (empty($_SESSION["redirect"])) {
            $redirect = "my.php";
        }
        else {
            $redirect = $_SESSION["redirect"];
            unset($_SESSION["redirect"]);
        }
        redirect($redirect);
    }
}

if ($id) {
    $hint_login = $id;
}
else {
    $hint_login = "5488";
}

$_SESSION["secret"] = generate_code();

$smarty = get_smarty();
$smarty->assign("secret", $_SESSION["secret"]);
$smarty->assign("error", $error);
$smarty->assign("hint_login", $hint_login);
$smarty->display("login.tpl");
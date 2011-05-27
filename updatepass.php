<?php
require("bootstrap.php");

if ($_SESSION['reg_id'] == "") {
    redirect("first.php");
}

$pass = $_POST["pass"];
$rpass = $_POST["cpass"];
$email = $_POST["email"];
$remail = $_POST["cemail"];
$nickname = $_POST["nickname"];
$eng_nickname = $_POST["eng_nickname"];

$user = User::fromId($_SESSION["reg_id"]);

$smarty = get_smarty();

try {
    $user->setThaiNickname($nickname);
    $user->setEngNickname($eng_nickname);
}
catch (ValidationException $e) {
    $error = $e->getType();
}

if ($pass != $rpass or $email != $remail or $pass == "" or $rpass == "" or $email == "" or $remail == "") {
    $error = "not_same";
}

if ($error) {
    $smarty->assign("status", $error);
    $user->discard();
}
else {

    $user->setPassword($pass);
    $user->setEmail($email);
    $user->setIdStatus(1);
    $user->generateActivationCode();
    $user->save();

    if ($user->sendActivationMail()) {
        $smarty->assign("status", "success");
    } else {
        $smarty->assign("status", "unknown_error");
    }

    session_destroy();
}

$id = $_SESSION['reg_id'];

$smarty->display("updatepass.tpl");
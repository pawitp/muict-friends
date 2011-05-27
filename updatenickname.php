<?php
require("bootstrap.php");
require_login();

$user = User::fromId($_SESSION["id"]);

$smarty = get_smarty();

if (!$_POST['button']) {
    $nickname = $user->getThaiNickname();
    $eng_nickname = $user->getEngNickname();
}
else {
    $nickname = $_POST["nickname"];
    $eng_nickname = $_POST["eng_nickname"];

    try {
        $user->setThaiNickname($nickname);
        $user->setEngNickname($eng_nickname);
        $user->save();

        redirect("my.php");
    }
    catch (ValidationException $e) {
        $smarty->assign("error", $e->getType());
        $user->discard();
    }
}

$smarty->assign("nickname", $nickname);
$smarty->assign("eng_nickname", $eng_nickname);
$smarty->display("updatenickname.tpl");
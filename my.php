<?php

require("bootstrap.php");
require_login();

$user = User::fromId($_SESSION["id"], '*');

$useabout = 1;
if ($user->getAbout() == "" and $useabout == 1) {
    redirect('updateabout.php');
}

// For late registrant who did not enter an English nickname
if ($user->getEngNickname() == "") {
    redirect("updatenickname.php");
}

$smarty = get_smarty();
$smarty->assign("user", $user);
$smarty->display("my.tpl");

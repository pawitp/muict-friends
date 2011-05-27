<?php
require("bootstrap.php");
require_login();

$self_user = User::fromId($_SESSION["id"], 'idstatus');

try {
    $user = User::fromId($_GET["id"], '*');
}
catch (InvalidUserIdException $e) {
    redirect("friend.php");
}

if ($_SESSION['admin']) {
    redirect("a_frienddata.php?id=" . $_GET["id"]);
}

$smarty = get_smarty();

if ($self_user->getIdStatus() != 3) {
    $smarty->display("frienddata_forbidden.tpl");
}
elseif ($user->getIdStatus() < 2){
    l("ViewUnregisteredUser", "", "");
    redirect("friend.php");
}
else {
    $smarty->assign("user", $user);
    $data = str_replace( "<br>","&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;", $user->getAbout());
    $smarty->assign("about", $data);
    $smarty->display("frienddata.tpl");
}
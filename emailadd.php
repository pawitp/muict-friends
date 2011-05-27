<?php
require("bootstrap.php");

$id=intval($_GET["id"]);
$pass=$_GET["code"];

$smarty = get_smarty();

try {
    $user = User::fromId($id, 'idstatus, activation_code');
    if ($user->getIdStatus() == 1 && $user->verifyActivationCode($pass)) {
        $user->setIdStatus(2);
        $user->save();

        $smarty->assign("status", "success");
    }
    else {
        throw new InvalidUserIdException();
    }
}
catch (InvalidUserIdException $e) {
    $smarty->assign("status", "error");
    $_SESSION["log_id"] = $id;
    l("ActivationFailed", "Input: $pass", ($user == null) ? "invalid id" : "Database: " . $user->getActivationCode());
}

$smarty->display("emailadd.tpl");


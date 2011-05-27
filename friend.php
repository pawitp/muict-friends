<?php
require("bootstrap.php");
require_login();

$sql = intval($_GET["query"]);

if ($sql == "1") {
    $sql = "WHERE idstatus = 2 or idstatus = 3 order by lastupdate DESC LIMIT 0 , 100";
}
elseif ($sql == "2") {
    $sql = "WHERE idstatus = '3' order by lastupdate DESC LIMIT 0 , 100";
}
elseif ($sql == "3") {
    $sql = "WHERE idstatus = '3' order by id asc";
}
elseif ($sql == "4") {
    $sql = "WHERE idstatus = 2 or idstatus = 3 order by id asc";
}
elseif ($sql == "5") {
    $sql = "WHERE (sec = 1) and (idstatus = 2 or idstatus = 3) order by id asc"; 
}
elseif ($sql == "6") {
    $sql = "WHERE (sec = 2) and (idstatus = 2 or idstatus = 3) order by id asc";
}
elseif ($sql == "7") {
    $sql = "WHERE (sec = 3) and (idstatus = 2 or idstatus = 3) order by id asc";
}
else {
    $sql = "WHERE idstatus = 3 order by lastupdate DESC LIMIT 0 , 10";
}

$users = User::query($sql);

$smarty = get_smarty();
$smarty->assign("users", $users);
$smarty->display("friend.tpl");
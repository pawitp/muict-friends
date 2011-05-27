<?php
require("bootstrap.php");
require_login();

$id = $_SESSION['id'];
$user = User::fromId($id, "about, bd");

$data = $_POST["data"];
$day = intval($_POST["date"]);
$month = intval($_POST["month"]);
$year = intval($_POST["year"]);

if ($data != "" and $day != "" and $month != "" and $year != "") {
    $data = str_replace( "\n","<br>", $data );

    $bd = $year."-".$month."-".$day;
    $ids = $_SESSION['id'];
    $user->setAbout($data);
    $user->setBirthday($bd);
    $user->save();
    redirect("my.php");
}

$smarty = get_smarty();
$smarty->assign("data", $user->getAbout() == "" ? "  " : str_replace("<br>", "\n", $user->getAbout()));

list($year, $month, $day) = explode("-", trim($user->getBirthday()));
$smarty->assign("day", intval($day));
$smarty->assign("month", intval($month));
$smarty->assign("year", intval($year));

$smarty->display("updateabout.tpl");
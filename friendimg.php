<?php
require("bootstrap.php");
require_login();

$smarty = get_smarty();

$sql = intval($_GET["query"]);

if ($sql==11){
	$sql="WHERE (sec=1) and (type=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==12){
	$sql="WHERE (sec=1) and (type=2) and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==13){
	$sql="WHERE (sec=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==21){
	$sql="WHERE (sec=2)  and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==22){
	$sql="WHERE (sec=2) and (type=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==23){
	$sql="WHERE (sec=2) and (type=2)and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==31){
	$sql="WHERE (sec=3)  and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==32){
	$sql="WHERE (sec=3) and (type=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==33){
	$sql="WHERE (sec=3) and (type=2)and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==41){
	$sql="WHERE(idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==42){
	$sql="WHERE (type=1) and (idstatus=2 or idstatus=3)  order by lastupdate DESC";
}
else if ($sql==43){
	$sql="WHERE (idstatus=2 or idstatus=3) and (type=2) order by lastupdate DESC";
}
else if ($sql==99){
    $sql = "";
    $smarty->assign("sql99", true);
}
else {
    $sql = "";
}

if ($sql != "") {
    $users = User::query($sql);
    $smarty->assign("users", $users);
}

$smarty->display("friendimg.tpl");
<?php
require("bootstrap.php");
require_admin_login();

$smarty = get_smarty();

$res = mysql_query_log("SELECT idstatus, COUNT(*) as count FROM muict GROUP BY idstatus");
$total = 0;
$stat = array();
while ($row = mysql_fetch_array($res)) {
    $total += $row['count'];
    $stat[$row['idstatus']] = $row['count'];
}

for ($i = -1; $i < 4; $i++) {
    if (empty($stat[$i])) {
        $stat[$i] = 0;
    }
}

$smarty->assign("stat", $stat);
$smarty->assign("total", $total);

$users = User::query("WHERE idstatus = 1 OR idstatus = 2 ORDER BY lastupdate DESC LIMIT 0, 100");
$smarty->assign("users", $users);

$smarty->display("a_list.tpl");
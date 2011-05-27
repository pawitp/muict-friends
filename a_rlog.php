<?php
$disable_logging = true;
require("bootstrap.php");
require_admin_login();

if (!$_GET["start"]) {
    $start = 0;
}
else {
    $start = $_GET["start"];
}
$perpage = 100;
if ($_GET["nopageview"] == 1) {
    $where = "WHERE tag != 'PageView'";
}
$result = mysql_query_log("SELECT * FROM muict_log $where ORDER BY time DESC LIMIT $start,$perpage");
while ($row = mysql_fetch_array($result)) {
    $row['time'] = convert_timezone($row['time']);
    $rows[] = $row;
}

$smarty = get_smarty();
$smarty->assign("rows", $rows);
$smarty->assign("next", $start + $perpage);
$smarty->display("a_rlog.tpl");

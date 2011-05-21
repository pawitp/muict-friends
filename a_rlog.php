<?php
$disable_logging = true;
require("bootstrap.php");
require_admin_login();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system ADMIN CPL [ADMIN ONLY]</title>
<style type="text/css">
<!--
body {
	background-image: url(bg.png);
}
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000000;
}
a:hover {
	text-decoration: underline;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #000000;
}
-->
</style></head>

<body>
<table width="80%" border="1">
  <tr>
    <td><div align="center"><strong>TIME</strong></div></td>
    <td><div align="center"><strong>IP</strong></div></td>
    <td><div align="center"><strong>BROWSER</strong></div></td>
    <td><div align="center"><strong>FILE</strong></div></td>
    <td><div align="center"><strong>ID</strong></div></td>
    <td><div align="center"><strong>TAG</strong></div></td>
    <td><div align="center"><strong>DATA1</strong></div></td>
    <td><div align="center"><strong>DATA2</strong></div></td>
  </tr>

<?php
if (!$_GET["start"]) {
    $start = 0;
}
else {
    $start = $_GET["start"];
}
$perpage = 100;
$result = mysql_query_log("SELECT * FROM muict_log ORDER BY time DESC LIMIT $start,$perpage");
while ($row = mysql_fetch_array($result)):
?>
    <tr>
      <td><div align="center"><strong><?= $row['time'] ?></strong></div></td>
      <td><div align="center"><strong><?= $row['ip'] ?></strong></div></td>
      <td><div align="center"><strong><?= $row['user_agent'] ?></strong></div></td>
      <td><div align="center"><strong><?= $row['path'] ?></strong></div></td>
      <td><div align="center"><strong><?= $row['id'] ?></strong></div></td>
      <td><div align="center"><strong><?= $row['tag'] ?></strong></div></td>
      <td><div align="center"><strong><?= $row['data1'] ?></strong></div></td>
      <td><div align="center"><strong><?= $row['data2'] ?></strong></div></td>
    </tr>
<? endwhile; ?>
</table>
<a href="?start=<?= $start + $perpage ?>">Older</a>

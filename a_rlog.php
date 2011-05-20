<?php

include 'connect.php';

if($_SESSION['id']!=""){
$id=$_SESSION['id'];
}
$result = mysql_query("SELECT * FROM muict WHERE id='$id' and admin=1");
$row = mysql_fetch_array($result);

if($row[email]==""){
session_destroy();
header('Location: login.php');
return;
}


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

<p>
  <?php





?>
</p>
<p>
  <label></label>
</p>
<form id="form1" name="form1" method="post" action="">
  <input name="log" type="text" id="log" value="<? 
  $logfilename = date("Ymd"); 
  echo "$logfilename";
  
  ?>" />
</form>
<p>&nbsp;</p>

<?php
$logview=$_POST["log"];
if($logview==""){
$logview=$logfilename;
}
?>
<table width="80%" border="1">
  <tr>
    <td><div align="center"><strong>TIME</strong></div></td>
    <td><div align="center"><strong>IP</strong></div></td>
    <td><div align="center"><strong>BROWSER</strong></div></td>
    <td><div align="center"><strong>FILE</strong></div></td>
    <td><div align="center"><strong>ID</strong></div></td>
    <td><div align="center"><strong>NO</strong></div></td>
    <td><div align="center"><strong>SP</strong></div></td>

  </tr>

<?php
readfile($logview);

?>
</table>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include 'connect.php';
$id=$_SESSION['id'];
$do=$_GET["do"];

$data=$_POST["data"];
$datado=$_POST["do"];



$result = mysql_query("SELECT * FROM muict WHERE id='$id'");
$row = mysql_fetch_array($result);

if($row[email]==""){
session_destroy();
header('Location: login.php');
return;
}


$logas="do";
$loga="$do";
$logbs="data";
$logb=$data;
$logbs="datado";
$logb=$datado;
$logb=$row[idstatus];
include 'log.php';





//data
$doimg[1]="msn-icon.png";
$doname[1]="MSN";
$doex[1]="muict@hotmal.com";

$doimg[2]="gtalk-icon.png";
$doname[2]="Google Talk";
$doex[2]="muict@gmail.com";

$doimg[3]="big_bb_Icon-120x120.jpg";
$doname[3]="BB PIN";
$doex[3]="21D0E58C";

$doimg[4]="twitter.png";
$doname[4]="TWITTER";
$doex[4]="muict [Twitter name only!]";

$doimg[5]="skype-icon.png";
$doname[5]="SKYPE";
$doex[5]="muict";

$doimg[6]="call_icon_110x102.jpg";
$doname[6]="MOBILE NUMBER";
$doex[6]="0809876543";

$doimg[7]="com.whatsapp_icon.png";
$doname[7]="Whatsapp";
$doex[7]="0809876543";

$delete = $_POST["delete"] == "delete";
if(($data!="" or $delete) and $datado!=""){
$sql[1]="msn";
$sql[2]="gtalk";
$sql[3]="BB";
$sql[4]="twitter";
$sql[5]="skype";
$sql[6]="mobile";
$sql[7]="whatsapp";
$dbnames=$sql[$datado];

if ($_POST["btnDelete"]) {
    mysql_query("UPDATE muict SET $dbnames = NULL WHERE id = '$id'");
}
else {
    mysql_query("UPDATE muict SET $dbnames = '$data' WHERE id = '$id'");
}


mysql_close($con);
include 'connect.php';
echo "UPDATE muict SET $dbnames = '$data' WHERE id = '$id'"; 
header('Location: loginc.php');
return;
}


mysql_close($con);

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system</title>
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
.style1 {
	font-size: 14px;
	font-weight: bold;
}
.style2 {
	font-size: 10px;
	color: #333333;
}
.style3 {font-size: 12px}
-->
</style></head>

<body>
<table width="40%" border="0" align="center">
  <tr>
    <td><div align="center"><img src="image/<? echo"$doimg[$do]"; ?>" width="60" height="60" /><br />
          <span class="style1"><? echo"$doname[$do]" ?></span></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <form id="form1" name="form1" method="post" action="update.php?do=<? echo $do; ?>">
      <input name="data" type="text" id="data" />
      &nbsp; 
        <label>
        <input type="submit" name="button" id="button" value="Submit" />
        </label>
        <br />
        <input type="checkbox" name="delete" value="delete"><span class="style2">ติ๊กถ้าหากต้องการลบ<br />
        </span><span class="style3">Ex :      <? echo"$doex[$do]" ?>
        <input name="do" type="hidden" id="do" value="<? echo $do; ?>" />
        </span><br />
      </form>
      </div></td>
  </tr>
  <tr>
    <td><div align="center"><a href="loginc.php"><img src="image/onebit_33.png" width="48" height="48" /></a></div></td>
  </tr>
</table>
</body>
</html>

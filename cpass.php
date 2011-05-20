
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
-->
</style></head>

<body>

<?php

$id=$_GET["id"];
$code=$_GET["code"];
$npass=$_GET["npass"];
$logas="code";
$loga=$code;
$logbs="id";
$logb=$id;
//$logcs="new";
//$logc=$npass;
include 'connect.php';
$result = mysql_query("SELECT * FROM muict WHERE id='$id'");
$row = mysql_fetch_array($result);
$scode=$row[password]."muict9p";
//echo "$scode=$code";
$scodemd=md5($scode);
//echo "pw= $row[password] codegen= $scodemd codeemail $code";
if(md5($scode)==$code and $npass!=""){
mysql_query("UPDATE muict SET password = '$npass' WHERE id = '$id'");
mysql_close($con);
echo "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว <a href='logout.php'>เข้าสู่ระบบ</a>";
return;
}
mysql_close($con);
if(md5($scode)==$code){

}else{
echo "ERROR!";
session_destroy();
return;
}

session_destroy();
?>
<form id="form1" name="form1" method="get" action="">
  <strong>ป้อนรหัสผ่านใหม่</strong> 
  <label>
  <input type="text" name="npass" id="npass" />
  </label>
  <label>
  <input type="submit" name="button" id="button" value="เปลี่ยนรหัสผ่าน" />
  </label>
  <input name="id" type="hidden" id="id" value="<?  echo"$id"; ?>" />
  <input name="code" type="hidden" id="code" value="<? echo"$code"; ?>" />
  <br />
</form>
</body>
</html>

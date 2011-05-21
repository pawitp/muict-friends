<?php
require("bootstrap.php");
require_login();

$id = $_SESSION["id"];
$result = mysql_query_log("SELECT nickname, eng_nickname FROM muict WHERE id='$id'");
$row = mysql_fetch_array($result);

if (!$_POST['button']) {
    $nickname = $row["nickname"];
    $eng_nickname = $row["eng_nickname"];
}
else {
    $nickname = $_POST["nickname"];
    $eng_nickname = $_POST["eng_nickname"];    
}

if (!preg_match("/^[0-9ก-๙ \(\)\[\]]+$/", $nickname)) {
    $error = "กรุณากรอกชื่อเล่นภาษาไทยให้ถูกต้อง";
}
elseif (!preg_match("/^[A-Za-z0-9 \(\)\[\]]+$/", $eng_nickname)) {
    $error = "กรุณากรอกชื่อเล่นภาษาอังกฤษให้ถูกต้อง";
}
elseif ($_POST['button']) {
    // Update data
    mysql_query_log("UPDATE muict SET nickname = '$nickname', eng_nickname = '$eng_nickname' WHERE id = $id");
    mysql_close($con);
    
    header("Location: loginc.php");
    return;
}

mysql_close($con);

?>

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
.style1 {
	font-size: 10px;
	color: #FF0000;
}
.style2 {
	color: #FF0000;
	font-size: 10px;
}
.style3 {
	font-size: 9px;
	color: #FF0000;
	font-weight: bold;
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table width="40%" border="0" bordercolor="#FF00FF">
      <tr>
        <td bgcolor="#99CC66"><strong>ชื่อเล่น (ไทย)</strong></td>
        <td bgcolor="#99CC66"><label>
          <input name="nickname" type="text" id="nickname" maxlength="20" value="<?= $nickname ?>"/>
        </label></td>
      </tr>
      <tr>
        <td bgcolor="#99CC66"><strong>Nickname (English)</strong></td>
        <td bgcolor="#99CC66"><label>
          <input name="eng_nickname" type="text" id="eng_nickname" maxlength="20" value="<?= $eng_nickname ?>"/>
        </label></td>
      </tr>
      </table>
    <br />
    <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
    <p style="color:red"><?= $error ?></p>
  </div>
</form>
</body>
</html>
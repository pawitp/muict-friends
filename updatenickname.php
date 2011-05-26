<?php
require("bootstrap.php");
require_login();

$user = new User($_SESSION["id"]);

if (!$_POST['button']) {
    $nickname = $user->getThaiNickname();
    $eng_nickname = $user->getEngNickname();
}
else {
    $nickname = $_POST["nickname"];
    $eng_nickname = $_POST["eng_nickname"];

    try {
        $user->setThaiNickname($nickname);
        $user->setEngNickname($eng_nickname);
        $user->save();

        redirect("my.php");
    }
    catch (ValidationException $e) {
        $error = ($e->getType() == "eng_nickname") ? "กรุณากรอกชื่อเล่นภาษาอังกฤษให้ถูกต้อง" : "กรุณากรอกชื่อเล่นภาษาไทยให้ถูกต้อง";
        $user->discard();
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system</title>
<style type="text/css">
<!--
body {
	background-image: url(http://image.friends.muict9.net/bg.png);
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
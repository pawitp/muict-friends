<?php
require("bootstrap.php");

$id=intval($_GET["id"]);
$code=$_GET["code"];
$npass=$_POST["npass"];

try {
    $user = User::fromId($id, 'email, password_recovery_code');
}
catch (InvalidUserIdException $e) {
    $message = "ไม่พบรหัสนักศึกษานี้ กรุณาติดต่อแอดมินเพื่อขอความช่วยเหลือ";
}

if (!isset($message)) {
    if (!$user->verifyPasswordRecoveryCode($code)) {
        $_SESSION["log_id"] = $id;
        l("PasswordChangeCodeInvalid", "Input: $code", "DB: " . $user->getPasswordRecoveryCode());
        $message = "Code เปลี่ยนรหัสผ่านไม่ถูกต้อง <a href='forgot.php'>กรุณาลองส่งอีเมลใหม่อีกครั้ง</a>";
        $color = "red";
        $quit = true;
    }
    elseif ($_POST["button"]) {
        if ($npass == "") {
            $message = "คุณต้องใส่รหัสผ่าน";
            $color = "red";
        }
        else {
            $user->setPassword($npass);
            $user->clearPasswordRecoveryCode();
            $user->save();
            $message = "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว <a href='logout.php'>เข้าสู่ระบบ</a>";
            $color = "green";
            $quit = true;
        }
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
-->
</style></head>

<body>
<div style="color:<?= $color ?>"><?= $message ?></div>
<? if (!$quit): ?>
<form id="form1" name="form1" method="post" action="">
  <strong>ป้อนรหัสผ่านใหม่</strong> 
  <label>
  <input type="password" name="npass" id="npass" />
  </label>
  <label>
  <input type="submit" name="button" id="button" value="เปลี่ยนรหัสผ่าน" />
  </label>
  <br />
</form>
<? endif; ?>
</body>
</html>

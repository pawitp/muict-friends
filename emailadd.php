<?php
require("bootstrap.php");

$id=intval($_GET["id"]);
$pass=$_GET["code"];

try {
    $user = new User($id, 'idstatus, activation_code');
    if ($user->getIdStatus() == 1 && $user->verifyActivationCode($pass)) {
        $user->setIdStatus(2);
        $user->save();
    }
    else {
        throw new InvalidUserIdException();
    }
}
catch (InvalidUserIdException $e) {
    $error = "ERROR โปรดติดต่อผู้ดูแลระบบ <a href='index.php'>หน้าแรก</a> ";
    $_SESSION["log_id"] = $id;
    l("ActivationFailed", "Input: $pass", ($user == null) ? "invalid id" : "Database: " . $user->getActivationCode());
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
.style3 {color: #003300}
.style4 {color: #000000}
-->
</style></head>

<body>
<? if ($error): ?>
<?= $error ?>
<? else: ?>
<img src="http://image.friends.muict9.net/pass.png" width="37" height="39" /> ยืนยัน E-mail สมบูรณ์ &nbsp; <a href="index.php">กลับไปหน้าแรก
</a>
<? endif; ?>
</body>
</html>

<?php
require("bootstrap.php");
require_login();

if (isset($_POST["sec"])) {
    try {
        $sec = intval($_POST["sec"]);
        $user = User::fromId($_SESSION["id"]);
        $user->setSec($sec);
        $user->save();
        redirect("my.php");
    } catch (ValidationException $e) {
        $error = "กรุณาเลือก sec";
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
	color: #003300;
	font-weight: bold;
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center"></div>
  <label>
  <div align="center"><span class="style1">เลือก SEC ที่เรียนอยู่ตามความเป็นจริง!</span><br />
    SEC : 

    <select name="sec" id="sec">
      <option>---</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select>
    &nbsp;&nbsp; 
    <input type="submit" name="button" id="button" value="บันทึก SEC" />
    <br />
    <span style="color:red"><?= $error ?></span>
  </div>
  </label>
</form>



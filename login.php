<?php
require("bootstrap.php");

if (is_login()) {
    redirect("my.php");
}
elseif ($_POST["button"]) {
    // Process login
    $id = intval($_POST["id"]);
    $pass = mysql_real_escape_string($_POST["pass"]);
    $result = mysql_query_log("SELECT id, idstatus, admin FROM muict WHERE id=$id and password=substring(sha1('$pass'), 1, 20)");
    
    if (mysql_num_rows($result) == 0) {
        $error = '<span style="color:red"> ไม่พบรหัสนักศึกษาและรหัสผ่านนี้</span>';
        l("LoginFailed", $id, "");
    }
    else {
        $row = mysql_fetch_array($result);
        if ($row['idstatus'] == 1) {
            $_SESSION['remail_id'] = $id;
            $error = "<img src=image/onebit_49.png  align=‘middle’ />

            <span class=‘style3’>ยังไม่ได้ยืนยัน E-mail โปรดยืนยัน E-mail ก่อนใช้งานระบบ!!!  <a href='remail.php'>ส่ง E-mail ยืนยันอีกครั้ง</a> หรือ <br />
<a href='cemail.php'>เปลี่ยน E-mail ที่ใช้ยืนยัน</a></span></div>";
        }
    }
    
    if (!$error) {
        // Finally, we're in
        $_SESSION["id"] = $row["id"];
        $_SESSION["admin"] = $row["admin"];
        
        if (empty($_SESSION["redirect"])) {
			$_SESSION['remail_id'] = $id;
            $redirect = "my.php";
        }
        else {
            $redirect = $_SESSION["redirect"];
            unset($_SESSION["redirect"]);
        }
        redirect($redirect);
    }
}

if ($id) {
    $hint_login = $id;
}
else {
    $hint_login = "5488";
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
.style2 {
	font-size: 24px;
	color: #000000;
}
.style3 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center"><span class="style2">เข้าสู่ระบบเพื่อแก้ไขข้อมูล</span><br />
&nbsp;  </div>
  <label></label>
  <div align="center">
  <table width="20%" border="0" bordercolor="#000000">
    <tr>
      <td><strong>รหัสนักศึกษา</strong></td>
        <td><input name="id" type="text" id="id" value="<?= $hint_login ?>" /></td>
      </tr>
    <tr>
      <td><strong>รหัสผ่าน</strong></td>
        <td><input type="password" name="pass" id="pass" /></td>
      </tr>
  </table>
  <input type="submit" name="button" id="button" value="เข้าสู่ระบบ" />
  &nbsp;&nbsp; <span class="style3"><a href="forgot.php">ลืมรหัสผ่าน</a></span><br />
  <label></label>
  <br />
  <?= $error ?>
  </div>
  <label></label>
</form>
</body>
</html>

<?php
require("bootstrap.php");

if (is_login()) {
    redirect("my.php");
}
elseif ($_POST["button"]) {
    if (empty($_SESSION['secret'])) {
        l("NoLoginSecret", "", "");
        die();
    }
    
    // Process login
    $id = intval($_POST["id"]);
    $result = mysql_query_log("SELECT id, password, idstatus, admin FROM muict WHERE id=$id");
    $row = mysql_fetch_array($result);
    $db_pass = $row['password'];
    $enc_db_pass = sha1($_SESSION['secret'] . $db_pass);
    $user_pass = substr(sha1($_POST['pass']), 0, 20);
    
    if (($enc_db_pass == $_POST['enc_pass'] || $db_pass == $user_pass) && $row['idstatus'] > 0) {
        if ($row['idstatus'] == 1) {
            $_SESSION['remail_id'] = $id;
            $error = "<img src=image/onebit_49.png  align=‘middle’ />

            <span class=‘style3’>ยังไม่ได้ยืนยัน E-mail โปรดยืนยัน E-mail ก่อนใช้งานระบบ!!!  <a href='remail.php'>ส่ง E-mail ยืนยันอีกครั้ง</a> หรือ <br />
<a href='cemail.php'>เปลี่ยน E-mail ที่ใช้ยืนยัน</a></span></div>";
        }
    }
    else {
        $error = '<span style="color:red"> ไม่พบรหัสนักศึกษาและรหัสผ่านนี้</span>';
        l("LoginFailed", $id, "");
    }
    
    if (!$error) {
        // Finally, we're in
        $_SESSION["id"] = $row["id"];
        $_SESSION["admin"] = $row["admin"];
        
        if (empty($_SESSION["redirect"])) {
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

$_SESSION["secret"] = generate_code();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system</title>
<script type="text/javascript" src="javascript/sha1.js"></script>
<script type="text/javascript"><!--
function encrypted_login() {
    var pass = document.getElementById('pass').value;
    var enc_pass = hex_sha1('<?= $_SESSION['secret'] ?>' + hex_sha1(pass).substring(0, 20));
    document.getElementById('pass').value = '';
    document.getElementById('enc_pass').value = enc_pass;
}
--></script>
<style type="text/css">
<!--
body {
	background-image: url(image/http://image.friends.muict9.net/bg.png);
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
<form id="form1" name="form1" method="post" action="" onsubmit="encrypted_login(); return true;">
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
  <input type="hidden" name="enc_pass" id="enc_pass" value="" />
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

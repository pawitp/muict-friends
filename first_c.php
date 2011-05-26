<?php
require("bootstrap.php");
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
<p>

<?php
$id = intval($_POST["id"]);
$type = intval($_POST["type"]);
$name = $_POST["name"];
$sname = $_POST["sname"];
$round = intval($_POST["round"]);

try {
    $user = new User($id, 'type, name, sname, round, idstatus');

    if ($user->getNamePrefix() == $type && $user->getThaiFirstName() == $name && $user->getThaiLastName() == $sname && $user->getRound() == $round) {
        if ($user->getIdStatus() > 0) {
            echo "เคยผ่านขั้นตอนการตรวจสอบแล้ว สามารถเข้าระบบได้ทันที ! <a href='index.php'>หน้าแรก</a> ";
            return;
        }

        echo "การตรวจสอบข้อมูลสมบูรณ์";
        if ($user->getIdStatus() == -1) {
            echo " และ ขอบคุณที่กลับมาใช้ระบบเราอีกครั้ง ";
        }
        echo"<hr>";
    }
    else {
        throw new InvalidUserIdException();
    }
}
catch (InvalidUserIdException $e) {
    echo "ข้อมูลที่กรอกมาไม่ถูกต้อง  หากกรอกถูกต้องแล้ว โปรดติดต่อผู้ดูแลระบบผ่านทาง<a href='index.php'>หน้าแรก</a> <a href='javascript: history.go(-1)'>กลับไปแก้ไข</a> ";
    return;
}

$_SESSION['step']=1;
$_SESSION['reg_id']=$id;
?>
  <strong>ขั้นตอนที่ 2 จาก 3</strong>  <strong>กำหนดรหัสผ่านสำหรับการแก้ไขข้อมูลในอนาคต&nbsp;</strong></p>
<form id="form1" name="form1" method="post" action="updatepass.php">
  <div align="center">
    <table width="40%" border="0" bordercolor="#FF00FF">
      <tr>
        <td bgcolor="#99CC66"><strong>รหัสผ่าน</strong></td>
        <td bgcolor="#99CC66"><input name="pass" type="password" id="pass" maxlength="20" />
          <br />
          <span class="style3">[โปรดใส่ใจภาษาที่.ใช้พิมพ์ THAI / ENGLISH]</span></td>
      </tr>
      <tr>
        <td bgcolor="#99CC66"><strong>รหัสผ่านอีกครั้ง</strong></td>
        <td bgcolor="#99CC66"><input name="cpass" type="password" id="cpass" maxlength="20" />
        <br /></td>
      </tr>
      <tr>
        <td bgcolor="#CCFFFF"><strong>E-mail</strong></td>
        <td bgcolor="#CCFFFF"><input type="text" name="email" id="email" />
          <br />
        <span class="style1">*ใส่ E-mail ที่ใช้งานบ่อยที่สุด เพราะต้องยืนยัน E-mail </span></td>
      </tr>
      <tr>
        <td bgcolor="#CCFFFF"><strong>E-mail</strong></td>
        <td bgcolor="#CCFFFF"><input type="text" name="cemail" id="cemail" />
          <br />
          <span class="style1">*E-mailเหมือนช่องด้านบนอีกครั้งเพื่อป้องกันข้อผิดพลาดในการกรอกข้อมู</span><span class="style2">ล</span></td>
      </tr>
      <tr>
        <td bgcolor="#99CC66"><strong>ชื่อเล่น (ไทย)</strong></td>
        <td bgcolor="#99CC66"><label>
          <input name="nickname" type="text" id="nickname" maxlength="20" />
        </label></td>
      </tr>
      <tr>
        <td bgcolor="#99CC66"><strong>Nickname (English)</strong></td>
        <td bgcolor="#99CC66"><label>
          <input name="eng_nickname" type="text" id="eng_nickname" maxlength="20" />
        </label></td>
      </tr>
      </table>
    <br />
    <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
&nbsp;  </div>
</form>
<p>&nbsp;</p>
</body>
</html>

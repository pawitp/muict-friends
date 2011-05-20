
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
<div align="center">
  <?php
include 'connect.php';
if($_SESSION['id']!="" and $_SESSION['password']!=""){
header('Location: loginc.php');
}
mysql_close($con);

?>
</div>
<form id="form1" name="form1" method="post" action="loginc.php">
  <div align="center"><span class="style2">เข้าสู่ระบบเพื่อแก้ไขข้อมูล</span><br />
&nbsp;  </div>
  <label></label>
  <div align="center">
  <table width="20%" border="0" bordercolor="#000000">
    <tr>
      <td><strong>รหัสนักศึกษา</strong></td>
        <td><input name="id" type="text" id="id" value="5488" /></td>
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
  &nbsp;&nbsp;
  </div>
  <label></label>
</form>
</body>
</html>

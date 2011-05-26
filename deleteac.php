<?php
require("bootstrap.php");
require_login();

$passcheck = $_POST["passwordc"];

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
.style1 {font-size: 12px}
.style3 {
	font-size: 10px;
	color: #FF0000;
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="">
<?php
if ($passcheck != "") {
	$user = new User($_SESSION['id']);

	if ($user->verifyPassword($passcheck)) {
        $user->deleteAccount();
        $user->save();
		echo "บัญชีของคุณถูกยกเลิกเรียบร้อยแล้ว<hr>";
		l("DeleteAc", '', '');
		session_destroy();
		return;

	} else {
	    echo "รหัสผ่านไม่ถูกต้อง <hr>";
	}
}
?>
  <div align="center"><strong><br />
    ใส่รหัสผ่านเพื่อยืนยันการปิดการแชร์ข้อมูลส่วนตัวของคุณ  </strong><br />
    <label>
      <input type="password" name="passwordc" id="passwordc" />
    </label>
  &nbsp; 
  <label>
  <input type="submit" name="button" id="button" value="Submit" />
  </label>
  <br />
  <br />
  <span class="style1">หากการยกเลิกบัญชีนี้เป็นเหตุผลมาจากความขัดข้อง ความไม่ครบถ้วนของระบบ ก่อนยกเลิกบัญชี ขอความกรุณาแจ้งมายังผู้ดูแลระบบก่อน <a href="help.php" target="_blank">คลิก</a><br />
  หลังจากคุณยกเลิกบัญชีแล้ว คุณสามารถกลับเข้าสู่ระบบได้ โดยการเข้าสู่ระบบตรวจสอบบุคคลใหม่</span><br />
  <span class="style3">การยกเลิกบัญชีครั้งนี้ ส่งผลให้บัญชีนี้ปิดกั้นการมองเห็นจากสาธารณะ</span><br />
  <br />
  <a href="my.php"><img src="http://image.friends.muict9.net/fail.png" width="49" height="43" /></a><br />
  </div>
</form>

</body>
</html>

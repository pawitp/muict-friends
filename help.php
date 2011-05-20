
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
.style3 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style></head>

<body>
  <?php



$check=$_POST["name"];
$data=$_POST["data"];
$logas="ck (n/a is OK)";
$loga=$check;
$logbs="data";
$logb=$data;

include 'connect.php';
mysql_close($con);

if($check!=""){
return;
}

if($data!=""){
$MailTo = "boy25.pskpnza@gmail.com" ;
$MailFrom = "no-reply@daequilibrate.net" ;
$MailSubject = "แจ้งปัญหาการใช้งานระบบ" ;
$MailMessage = $data ;
//echo"$MailTo $MailMessage ";


$Headers = "MIME-Version: 1.0\r\n" ;
$Headers .= "Content-type: text/html; charset=utf-8\r\n" ;
// ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
$Headers .= "From: ".$MailFrom." <".$MailFrom.">\r\n" ;
$Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
$Headers .= "X-Priority: 3\r\n" ;
$Headers .= "X-Mailer: PHP mailer\r\n" ;
mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom);

echo "ได้รับข้อมููลเรียบร้อยแล้ว โปรดรอการติดต่อกลับ";
return;
}


?>

<p>ระบุปัญหาที่พบ และวิธีการติดต่อกลับ</p>
<form id="form1" name="form1" method="post" action="">
  <label>
  <div align="center">
    <textarea name="data" cols="100" rows="10" wrap="virtual" id="data">รหัสนักศึกษา =
พบความผิดปกติคือ / ไม่สามารถทำรายการในหน้า :


วันที่ทำรายการ ประมาณเวลา : 

วิธีการติดต่อกลับ ในกรณีต้องการข้อมูลเพิ่มเติม หรือ แจ้งผลการแก้ไขปัญหา
E-mail : 
</textarea>
    <br />
    <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
    <br />
    <br />
     <span class="style3">ถ้าคุณเป็นมนุษย์ โปรดปล่อยช่องนี้ว่างไว้&gt;&gt; 
     <input type="text" name="name" id="name" />
&lt;&lt;ถ้าคุณเป็นมนุษย์ โปรดปล่อยช่องนี้ว่างไว้</span><br />
    <br />
    <br />
  </div>
  </label>
</form>
<p>&nbsp; </p>
</body>

</html>

<?php
require("bootstrap.php");

$check = $_POST["name"];
$id = intval($_POST["id"]);
$email = mysql_real_escape_string($_POST["email"]);
$result = mysql_query_log("SELECT idstatus, password FROM muict WHERE id=$id and email='$email'");
$row = mysql_fetch_array($result);

if ($_POST["button"]) {
    if ($check != ""){
        // bot
        return;
    }
    
    if (mysql_num_rows($result) == 0 || $row["idstatus"] == 0) {
        l("ForgotLoginFailed", "Id: $id", "Idstatus: $row[idstatus]");
        $error = "ข้อมูลที่กรอกไม่ถูกต้อง หากจำข้อมูลได้ไม่ครบ ติดต่อผู้ดูแลระบบได้ผ่าน<a href=help.php>ติดต่อผู้ดูแลระบบ </a>";
    }
    elseif ($row[password] != "") {
        $code = generate_code();
        mysql_query_log("UPDATE muict SET password_recovery_code='$code' WHERE id = $id");
        
        $data="<a href=http://friends.muict9.net/cpass.php?id=".$id."&code=".$code.">http://friends.muict9.net/cpass.php?id=".$id."&code=".$code."</a><br><br>หาก E-mail ดังกล่าวถูกส่งโดยไม่ใช่ความต้องการของท่าน โปรดติดต่อ boy25.pskpnza@gmail.com เพื่อดำเนินการป้องกันต่อไป ขออภัยมา ณ ที่นี้";
        
        $MailTo = $email ;
        $MailFrom = "no-reply@muict9.net" ;
        $MailSubject = "Link กำหนดรหัสผ่านใหม่ friends.muict9.net" ;
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
        
        $message = "ระบบได้ส่งลิ้งค์ไปทางอีเมลล์โปรดตรวจสอบ E-mail ของท่าน หากไม่ได้รับ <a href=help.php>ติดต่อผู้ดูแลระบบ </a>";
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
.style3 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style></head>

<body>

<?= $error ?>
<?= $message ?>
<? if (!$message): ?>
<form id="form1" name="form1" method="post" action="">
  <label>
  <div align="center"><br />
    <table width="35%" border="1">
      <tr>
        <td bgcolor="#99FF66"><div align="center"><strong>E-mail</strong></div></td>
        <td bgcolor="#99FF66"><div align="center">
          <input type="text" name="email" id="email" />
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#99FF66"><div align="center"><strong>รหัสนักศึกษา</strong></div></td>
        <td bgcolor="#99FF66"><div align="center">
          <input name="id" type="text" id="id" value="5488" maxlength="8" />
        </div></td>
      </tr>
    </table>
    <label><strong>&nbsp;</strong>&nbsp; </label>
    <label><strong>
    <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
    <br />
    </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <br />
    <br />
    </label>
    <br />
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
<? endif; ?>
<p>&nbsp; </p>
</body>

</html>

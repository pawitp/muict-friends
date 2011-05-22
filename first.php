<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system</title>
<style type="text/css">
<!--
body {
	background-image: url(image/bg.png);
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
	color: #003300;
	font-size: 18px;
}
.style3 {
	color: #FF0000;
	font-size: 10px;
}
-->
</style></head>

<body>
<p align="center"><span class="style2"><strong>ขั้นตอนที่ 1 จาก 3 ยืนยันบุคคล</strong>&nbsp;&nbsp;&nbsp; กรอกข้อมูลตามความเป็นจริง</span></p>
<form id="form1" name="form1" method="post" action="first_c.php">
   <div align="center">
     <table width="40%" border="0">
       <tr>
         <td width="45%" bgcolor="#99FF99"><div align="right"><strong>รหัสประจำตัวนักศึกษา </strong></div></td>
         <td width="55%" bgcolor="#99FF99"><label>
           <input name="id" type="text" id="id" value="5488" maxlength="7" />
           </label>
           <span class="style3">*ตัวเลข 7 หลัก </span></td>
      </tr>
       <tr>
         <td bgcolor="#99FF99"><div align="right"><strong>คำนำหน้านาม</strong></div></td>
         <td bgcolor="#99FF99"><select name="type" id="type">
           <option selected="selected">--</option>
           <option value="1">นาย</option>
           <option value="2">นางสาว</option>
         </select></td>
       </tr>
       <tr>
         <td bgcolor="#99FF99"><div align="right"><strong>ชื่อ</strong></div></td>
         <td bgcolor="#99FF99"><label>
           <input type="text" name="name" id="name" />
         </label>
  &nbsp;<span class="style3"> *ภาษาไทย</span></td>
       </tr>
       <tr>
         <td bgcolor="#99FF99"><div align="right"><strong>สกุล</strong></div></td>
         <td bgcolor="#99FF99"><label>
           <input type="text" name="sname" id="sname" />
         </label>
  &nbsp;<span class="style3">
    *ภาษาไทย</span></td>
       </tr>
       <tr>
         <td bgcolor="#99FF99"><div align="right"><strong>วิธีการเข้าศึกษา MUICT # 9</strong></div></td>
         <td bgcolor="#99FF99"><select name="round" id="round">
           <option selected="selected">---</option>
           <option value="1">สอบตรง # 1</option>
           <option value="2">สอบตรง # 2</option>
           <option value="3">ระบบกลาง</option>
         </select></td>
       </tr>
        </table>
   </div>
  <label></label>
  <div align="center"><br />
      <span class="style3">กรุณาตรวจสอบข้อมูลก่อนกดส่งข้อมูล&gt;&gt;</span>
    <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
     <span class="style3">&lt;&lt;กรุณาตรวจสอบข้อมูลก่อนกดส่งข้อมูล</span><br />
  </div>
  <label></label>
</form>

<p>&nbsp;</p>
<p><br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;</p>
</body>

</html>

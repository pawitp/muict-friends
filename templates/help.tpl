{extends "layout.tpl"}
{block name="styles"}
.style3 {
	color: #FF0000;
	font-weight: bold;
}
{/block}
{block name="body"}
<p>ระบุปัญหาที่พบ และวิธีการติดต่อกลับ</p>
<form id="form1" name="form1" method="post" action="">
  <label>
  <div align="center">
    <textarea name="data" cols="100" rows="10" wrap="virtual" id="data">รหัสนักศึกษา = {$id}

พบความผิดปกติคือ / ไม่สามารถทำรายการในหน้า :


วันที่ทำรายการ ประมาณเวลา : {convert_timezone("now")}

วิธีการติดต่อกลับ ในกรณีต้องการข้อมูลเพิ่มเติม หรือ แจ้งผลการแก้ไขปัญหา
E-mail : {$email}
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
<p>นอกจากนี้ยังสามารถติดต่อทาง facebook ได้ที่ <a href="http://www.facebook.com/DaEquilibrate" target="_blank">http://www.facebook.com/DaEquilibrate</a> หรือ <a href="http://www.facebook.com/pawitp" target="_blank">http://www.facebook.com/pawitp</a><br />
</p>
{/block}
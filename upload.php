<?php
require("bootstrap.php");
require_login();

$id = $_SESSION['id'];

// Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
include 'class.upload.php' ;
 
// ส่วนกำหนดการเชื่อมต่อฐานข้อมูล

 
 
//  ถ้าหากหน้านี้ถูกเรียก เพราะการ submit form  
//  ประโยคนี้จะเป็นจริงกรณีเดียวก็ด้วยการ submit form 
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 
    // Delete old image
    $result = mysql_query_log("SELECT img FROM muict WHERE id = $id");
    $row = mysql_fetch_array($result);
    if (!empty($row['img'])) {
        if (!unlink('upload_images/' . $row['img'])) {
            l("UnlinkedFailed", $row['img']);
        }
    }
 
    // เริ่มต้นใช้งาน class.upload.php ด้วยการสร้าง instant จากคลาส
    $upload_image = new upload($_FILES['image_name']) ; // $_FILES['image_name'] ชื่อของช่องที่ให้เลือกไฟล์เพื่ออัปโหลด
 
    //  ถ้าหากมีภาพถูกอัปโหลดมาจริง
    if ( $upload_image->uploaded ) {
 
        // ย่อขนาดภาพให้เล็กลงหน่อย  โดยยึดขนาดภาพตามความกว้าง  ความสูงให้คำณวนอัตโนมัติ
        // ถ้าหากไม่ต้องการย่อขนาดภาพ ก็ลบ 3 บรรทัดด้านล่างทิ้งไปได้เลย
        $upload_image->image_resize         = true ; // อนุญาติให้ย่อภาพได้
        $upload_image->image_x              = 400 ; // กำหนดความกว้างภาพเท่ากับ 400 pixel 
        $upload_image->image_ratio_y        = true; // ให้คำณวนความสูงอัตโนมัติ
 
        $upload_image->process( "upload_images" ); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ  *** โฟลเดอร์ต้องมี permission 0777
 
        // ถ้าหากว่าการจัดเก็บรูปภาพไม่มีปัญหา  เก็บชื่อภาพไว้ในตัวแปร เพื่อเอาไปเก็บในฐานข้อมูลต่อไป
        if ( $upload_image->processed ) {
 
            $image_name =  mysql_real_escape_string($upload_image->file_dst_name); // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
            $upload_image->clean(); // คืนค่าหน่วยความจำ
 
            // เก็บชื่อภาพลงฐานข้อมูล


		//echo" $image_name ";
		mysql_query_log("UPDATE muict SET img = '$image_name' WHERE id = $id");
        }// END if ( $upload_image->processed )
 
    }//END if ( $upload_image->uploaded )
    else {
        mysql_query_log("UPDATE muict SET img = NULL WHERE id = $id");
    }
    
    redirect('my.php');
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
	font-size: 24px;
	font-weight: bold;
	color: #0000FF;
}
-->
</style></head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p align="center"><img src="http://image.friends.muict9.net/camera-icon.png" width="172" height="172" /></p>
  <p align="center"><span class="style1">เลือกรูปภาพที่จะอัพโหลด (สูงสุด 2MB)(กด Upload เฉยๆเพื่อลบ)</span><br />
    <br />
    <input name="image_name" type="file" id="image_name" size="40" />
  </p>
  <p align="center">
    <input type="submit" value="Upload" />
    <input type="hidden" name="MM_insert" value="form1" />
    <br />
    <br />
    <a href="my.php"><img src="http://image.friends.muict9.net/onebit_33.png" width="48" height="48" /></a><br />
  </p>
</form>
</body>
 
</html>
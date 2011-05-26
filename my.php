<?php

require("bootstrap.php");
require_login();

$user = User::fromId($_SESSION["id"], '*');

$useabout = 1;
if ($user->getAbout() == "" and $useabout == 1) {
    redirect('updateabout.php');
}

// For late registrant who did not enter an English nickname
if ($user->getEngNickname() == "") {
    redirect("updatenickname.php");
}

$secknow = 0;  //ถ้ารู้SECกันแล้วแก้เป็น1
if ($user->getSec() == "N/A" and $secknow == 1){
	redirect('updatesec.php');
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
.style1 {font-size: 18px}
.style5 {
	color: #FF0000;
	font-size: 10px;
}
.style6 {
	color: #003300;
	font-weight: bold;
}
.style9 {font-size: 14px}
.style10 {
	font-size: 16;
	font-weight: bold;
}
-->
</style></head>

<body>
<div align="center">

<form id="form1" name="form1" method="post" action="loginc.php">
    <table width="65%" border="0">
        <tr>
          <td><div align="right">
            <table width="100%" border="0">
              <tr>
                <td><span class="style1"><strong>ยินดีต้อนรับ</strong> <?= $user->getThaiNickname() ?>&nbsp;&nbsp;&nbsp;<span class="style9"> SEC : 
                <?= $user->getSec() ?>
                <? if ($user->isAdmin()): ?>&nbsp;&nbsp; <a href='a_list.php' target=_blank><b>ADMIN CP</b></a><? endif; ?>
               &nbsp;&nbsp; </span></span><a href="friend.php" target="_blank" class="style10">ดูข้อมูลเพื่อน</a></td>
                <td><div align="right"><a href="logout.php"><strong>ออกจากระบบ</strong></a></div></td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td> <table width="100%" border="0">
<? if ($user->getIdStatus() == 3): ?>
    <tr>
        <td width='9%'><div align='center'><img src='http://image.friends.muict9.net/profile.png' width='48' height='48' /></div></td>
        <td width='84%'><div align='center' class='style4'><font color='green'>ผ่านการยืนยัน ID จากผู้ดูแลระบบแล้ว</font></div></td>
        <td width='7%'><img src='http://image.friends.muict9.net/pass.png' width='48' height='48' /></td>
     </tr>
<? else: ?>
	 <tr>
        <td width='9%'><div align='center'><img src='http://image.friends.muict9.net/profile.png' width='48' height='48' /></div></td>
        <td width='84%'><div align='center' class='style4'><font color='red'>รอการยืนยัน ID จากผู้ดูแลระบบ <br />
          <span class='style1'>เพิ่มข้อมูลเกี่ยวกับตัวคุณด้านล่าง เพื่อลดระยะเวลาการตรวจสอบ</font></span></div></td>
        <td width='7%'><img src='http://image.friends.muict9.net/onebit_49.png' width='48' height='48' /></td>
      </tr>
<? endif; ?>
      <tr>
        <td width="9%"><div align="center"><img src="http://image.friends.muict9.net/email.png" alt="email" width="48" height="48" /></div></td>
        <td width="84%"><div align="left">E-Mail : <? echo $user->getEmail(); ?> </div></td>
        <td width="7%"><img src="http://image.friends.muict9.net/pass.png" width="48" height="48" /></td>
      </tr>
      <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/msn-icon.png" alt="MSN [windows live messenger]" width="52" height="52" /></div></td>
        <td><div align="left">MSN : <? echo $user->getMSN(); ?></div></td>
        <td><a href="update.php?do=1"><img src="http://image.friends.muict9.net/edit.png" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/gtalk-icon.png" alt="" width="55" height="55" /></div></td>
        <td><div align="left">GTalk : <? echo $user->getGTalk(); ?> </div></td>
        <td><a href="update.php?do=2"><img src="http://image.friends.muict9.net/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/big_bb_Icon-120x120.jpg" alt="" width="58" height="58" /></div></td>
        <td><div align="left">BB PIN : <? echo $user->getBBM(); ?></div></td>
        <td><a href="update.php?do=3"><img src="http://image.friends.muict9.net/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/twitter.png" alt="twitter" width="60" height="60" /></div></td>
        <td><div align="left">Twitter : <? echo $user->getTwitter(); ?></div></td>
        <td><a href="update.php?do=4"><img src="http://image.friends.muict9.net/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>

      <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/facebook.png" alt="facebook" width="60" height="60" /></div></td>
        <td><div align="left">Facebook : <? echo $user->getFacebookName(); ?><br />
            <span class="style5">*ขอความร่วมมือในการให้ข้อมูล&nbsp;Facebook เพื่อง่ายต่อการตรวจสอบว่าเป็นตัวจริงไม่ได้แอบอ้างมา</span></div></td>
        <td><a href="fbget.php"><img src="http://image.friends.muict9.net/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/skype-icon.png" alt="skype" width="59" height="56" /></div></td>
        <td><div align="left">Skype : <? echo $user->getSkype(); ?></div></td>
        <td><a href="update.php?do=5"><img src="http://image.friends.muict9.net/edit.png" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/call_icon_110x102.jpg" alt="mobile" width="58" height="53" /></div></td>
        <td><div align="left">Mobile : <? echo $user->getMobile(); ?></div></td>
        <td><a href="update.php?do=6"><img src="http://image.friends.muict9.net/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
      <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/com.whatsapp_icon.png" alt="whatsapp" width="58" height="58" /></div></td>
        <td><div align="left">Whatsapp : 
          <?= $user->getWhatsApp() ?>
        </div></td>
        <td><a href="update.php?do=7"><img src="http://image.friends.muict9.net/edit.png" width="48" height="48" /></a></td>
      </tr>
      <tr>
      <?php
	  $imgurl=$user->getImageUrl();
	  $fbiurl=$user->getFacebookImageUrl();
	  ?>
        <td><div align="center"><img src="http://image.friends.muict9.net/camera-icon.png" width="47" height="47" /></div></td>
        <td><div align="left">รูปภาพ :&nbsp; <a href="upload_images/<?= $imgurl ?>" target="_blank"><?= $imgurl ?></a>
        &nbsp;&nbsp;&nbsp;&nbsp; <a href=<?= $fbiurl ?> target="_blank"><?php
        if ($fbiurl != "") {
		echo "FACEBOOK";
		}
		?></a><br />  
          <span class="style5">*การอัพโหลดรูปภาพจะช่วยให้เพื่อนจำได้ได้ง่ายขึ้น</span></a></div></td>
        <td><a href="upload.php"><img src="http://image.friends.muict9.net/edit.png" alt="" width="48" height="48" /></a></td>
      </tr>
    </table></td>
        </tr>
  </table>
   
      <div align="center"><span class="style6"><span class="style9"><img src="http://image.friends.muict9.net/edit.png" alt="" width="20" height="20" align="bottom" /></span>กรอกทุกอันตามความเป็นจริง ถ้าไม่มี หรือ ไม่อยากให้ข้อมูลช่องไหน ไม่ต้องใส่นะ <span class="style9"><img src="http://image.friends.muict9.net/edit.png" alt="" width="20" height="20" align="bottom" /></span><br />
      แนะนำว่าให้ใส่ Facebook ทุกคน เพื่อง่ายในยืนยันว่าเป็นตัวจริง!<br />
      </span><br />
  </div>
</form>
<div align="center"><br />
   <a href="friend.php" target="_blank"> ดูข้อมูลเพื่อน</a>&nbsp; &nbsp;&nbsp;<a href="forgot.php">เปลี่ยนรหัสผ่าน</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php">ติดต่อผู้ดูแล</a>&nbsp; <a href="updateabout.php">แก้ไขข้อความแนะนำตัวและวันเกิด</a>&nbsp; <a href="updatenickname.php">แก้ไขชื่อเล่น </a>&nbsp;<a href="cemail.php">เปลี่ยน E-mail</a>&nbsp;&nbsp; <a href="deleteac.php">การปิดID</a></div>
</body>
</html>

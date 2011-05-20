<?php

include 'connect.php';

if($_SESSION['id']!=""){
$id=$_SESSION['id'];
$pass=$_SESSION['password'];
}
$result = mysql_query("SELECT * FROM muict WHERE id='$id' and password='$pass' and admin=1");
$row = mysql_fetch_array($result);

if($row[email]==""){
session_destroy();
header('Location: login.php');
return;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system ADMIN CPL [ADMIN ONLY]</title>
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
.style3 {font-size: 12px}
-->
</style></head>

<body><center>
  <p>&nbsp;    </p>
  <form id="form1" name="form1" method="get" action="">
    <label>ID : 
    <input type="text" name="id" id="id" />
    </label>
   &nbsp; 
   <label>
   <input type="submit" name="button" id="button" value="Submit" />
   </label>
  </form>
  <p>
    <?php





$ids=$_GET["id"];
$do=$_GET["do"];

$logas="ID";
$loga=$ids;
$logbs="ACTION";
$logb=$do;
include 'log.php';

if($do==1){
//UPDATE to 3[2>3]
mysql_query("UPDATE muict SET idstatus=3 WHERE id = '$ids'");
}elseif($do==2){
mysql_query("UPDATE muict SET idstatus=2 WHERE id = '$ids'");
//1>2
}elseif($do==3){
mysql_query("UPDATE muict SET idstatus=2 WHERE id = '$ids'");
//3>2
}else if($do==4){
$result = mysql_query("SELECT * FROM muict WHERE id='$ids'");
$row = mysql_fetch_array($result);

$codess=$row[password]."muict9p";

$code=md5($codess);
$ref="RESET PASS URL IS : http://www.daequilibrate.net/muict/cpass.php?id=".$ids."&code=".$code;

//GET URL
}

if($ids==""){
return;
}
$logas="QUEERYID";
$loga=$ids;
$result = mysql_query("SELECT * FROM muict WHERE id='$ids'");
$row = mysql_fetch_array($result);
$img2="<img src='image/fail.png' width='27' height='27' />";

?>
  </p>
  <table width="40%" border="1">
    <tr>
    
      <td><div align="center">        <table width="100%" border="0" align="center">
          <tr>
            <td width="50%"><div align="center"><img src=<? 
	  if($row[img]==""){
	  $prmg="no_image.jpg.png";
	  }else{
	  $prmg="$row[img]";
	  }
	  
	  echo"upload_images/$prmg"; ?> width="90%" /></div></td>
            <td width="50%"><div align="center"><img src='<? if($row[fbpic]!=""){ echo $row[fbpic]; }else{ echo"upload_images/no_image.jpg.png"; } ?>' width="90%" hspace="5" vspace="5" /></div></td>
          </tr>
          <tr>
            <td><div align="center"><strong>USER UPLOAD</strong></div></td>
            <td><div align="center"><strong>FACEBOOK</strong></div></td>
          </tr>
        </table><br />
          <span class="style3"><strong>NAME :</strong>&nbsp;
          <?php
          if($row[type]==1){
		  echo "นาย";
		  }else{
		  echo "นางสาว";
		  }
		  
		  ?>
          &nbsp;
          <?php
          
		  echo "$row[name]";
		  ?>
          &nbsp;
          <?php
          
		  echo "$row[sname]";
		  ?>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>NICKNAME : 
          <?php
          
		  echo "$row[nickname]";
		  ?>
          </strong>&nbsp;&nbsp;&nbsp;&nbsp; <strong>SEC : 
          <?php
          
		  echo "$row[sec]";
		  ?>
          </strong></span><br />
      </div></td>
    </tr>
    <tr>
      <td><table width="100%" border="0">
        <tr>
          <td width="24%"><strong>MSN</strong></td>
          <td width="76%"><div align="left">
            <?php   $thiss=$row[msn]; if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
          </div></td>
        </tr>
        <tr>
          <td><strong>GTALK</strong></td>
          <td><div align="left">
            <?php   $thiss=$row[gtalk]; if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
          </div></td>
        </tr>
        <tr>
          <td><strong>BB PIN</strong></td>
          <td><div align="left">
            <?php   $thiss=$row[BB]; if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
          </div></td>
        </tr>
        <tr>
          <td><strong>TWITTER</strong></td>
          <td><div align="left">
            <?php   $thiss=$row[twitter]; if($thiss==""){ echo $img2; } else { echo "<a href='http://www.twitter.com/$thiss' target=_blank'>$thiss</a>";  }		  ?>
          </div></td>
        </tr>
        <tr>
          <td><strong>FACEBOOK</strong></td>
          <td><div align="left">
            <?php   $thiss=$row[fbname]; if($thiss==""){ echo $img2; } else { echo "<a href='$row[fburl]' target=_blank>$thiss</a>";  }		  ?>
          </div></td>
        </tr>
        <tr>
          <td><strong>SKYPE</strong></td>
          <td><div align="left">
            <?php   $thiss=$row[skype]; if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
          </div></td>
        </tr>
        <tr>
          <td><strong>MOBILE</strong></td>
          <td><div align="left">
            <?php   $thiss=$row[mobile]; if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?></div></td>
        </tr>
        <tr>
          <td><strong>Whatsapp</strong></td>
          <td><div align="left">
            <?php   $thiss=$row[whatsapp]; if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
          </div></td>
        </tr>
        
      </table></td>
    </tr>
  </table>
  <?
  echo "$row[id]  $ref";
  ?><br />
  <table width="40%" border="1" align="center">
    <tr>
      <td width="50%"><div align="center"> <?php

if($row[idstatus]==1){
echo "<a href='a_frienddata.php?id=$ids&do=3'><img src='image/onebit_24.png' alt='emailcon' width='48' height='48' align='middle' />ยืนยันE-mailให้</a></div></td>
";
}else if($row[idstatus]==2){
echo "<a href='a_frienddata.php?id=$ids&do=1'><img src='image/onebit_36.png' alt='checkpass' width='48' height='48' align='middle' />ยืนยันผู้ใช้นี้ ผ่าน!</a><font color='red' size='2'><b><br>สถานะ : ยังไม่ผ่านการยืนยัน</font></b>";
}else if($row[idstatus]==3){
echo "<a href='a_frienddata.php?id=$row[id]&do=2'>	  <img src='image/onebit_36.png' alt='unpass' width='48' height='48' align='middle' />ยกเลิกสถานะผ่าน</a><font color='green' size='2'><b><br>สถานะ : ผ่านการยืนยันแล้ว</font></b>";
}





?></div></td><td width='50%'><a href="a_frienddata.php?id=<?php 
$idss=$row[id];
echo $idss;?>&do=4"><img src="image/friendster.png" width="60" height="60" align="middle" /> <strong>RESET PASS!</strong></a>
        </div>
      </a></td>
    </tr>
  </table>
  <br />
  <?php
mysql_close($con);

$data=$_POST["data"];
$email=$_POST["email"];


$data.="<hr>หากมีข้อสงสัยใน E-mail ฉบับนี้ สามารถใช้เมนูติดต่อผู้ดูแล http://www.daequilibrate.net/muict/help.php เพื่อแก้ปัญหาได้ ";
if($email!="" and $data!=""){
$logas="EMAILDATA";
$loga=$data;
$lodbs="EMAIL";
$logb=$email;
include 'log.php';
echo "ส่ง E-MAIL ไปแล้ว!<hr>";
$MailTo = $email ;
$MailFrom = "no-reply@daequilibrate.net" ;
$MailSubject = "ข้อความจากผู้ดูแลระบบ" ;
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

return;
}
?>

  <form id="form2" name="form2" method="post" action="a_frienddata.php?id=<? echo $id; ?>">
    <p>ส่ง E-mail ถึงคนนี้ [อย่าลืมระบุวิธีติดต่อกลับ]</p>
    <p>
      <label>
      <input name="email" type="hidden" id="email" value="<? echo"$row[email]"; ?>" />
      <textarea name="data" id="data" cols="45" rows="5"></textarea>
      </label>
      &nbsp;&nbsp; 
      <input type="submit" value="ส่ง" />
      <br />
      <label></label>
    </p>
  </form>
  <p>&nbsp;</p>
</center>
</body>
</html>
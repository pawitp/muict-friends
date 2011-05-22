<?php
require("bootstrap.php");
require_admin_login();

$ids=$_GET["id"];
$do=$_GET["do"];

switch ($do) {
    case 1:
        //UPDATE to 3[2>3]
        mysql_query_log("UPDATE muict SET idstatus=3 WHERE id = '$ids'");
        break;
    case 2:
        mysql_query_log("UPDATE muict SET idstatus=2 WHERE id = '$ids'");
        //1>2
        break;
    case 3:
        mysql_query_log("UPDATE muict SET idstatus=2 WHERE id = '$ids'");
        //3>2
        break;
    case 4:
        $code = generate_code();
        mysql_query_log("UPDATE muict SET password_recovery_code='$code' WHERE id = '$ids'");
        $ref = "RESET PASS URL IS : http://friends.muict9.net/cpass.php?id=".$ids."&code=".$code;
        break;
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
.style3 {font-size: 12px}
.style6 {font-size: 9px; color: #FFFFFF; }
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
   <input type="submit" id="button" value="Submit" />
   </label>
  </form>
  <p>
    <?php
    
    // Not the best way but let it be for now
    if (empty($ids)) {
        return;
    }

    $result = mysql_query_log("SELECT * FROM muict WHERE id='$ids'");
    $row = mysql_fetch_array($result);
    $img2="<img src='http://image.friends.muict9.net/fail.png' width='27' height='27' />";

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
                <tr>
          <td height="21"><strong>About me</strong></td>
          <td bgcolor="#FFFFFF"> <span class="style6">x</span><br />            
            &nbsp;&nbsp; <?php
		  $data=str_replace( "<br>","&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;", $row["about"] );
          echo "$data";
		  
		  if($row[BD]!="0000-00-00"){
		  list($year,$month,$day) = split("-",trim($row["BD"]));
		  $year+=543;
		  $day+=1;
		  $day-=1;
		  $month+=1;
		  $month-=1;
		  echo "<br><br>&nbsp;&nbsp;&nbsp;<b>วันเกิด : </b> $day / $month / $year";
		  }
		  ?>
            <br />
            <span class="style6">a</span><br /></td>
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
echo "<a href='a_frienddata.php?id=$ids&do=3'><img src='http://image.friends.muict9.net/onebit_24.png' alt='emailcon' width='48' height='48' align='middle' />ยืนยันE-mailให้</a></div></td>
";
}else if($row[idstatus]==2){
echo "<a href='a_frienddata.php?id=$ids&do=1'><img src='http://image.friends.muict9.net/onebit_36.png' alt='checkpass' width='48' height='48' align='middle' />ยืนยันผู้ใช้นี้ ผ่าน!</a><font color='red' size='2'><b><br>สถานะ : ยังไม่ผ่านการยืนยัน</font></b>";
}else if($row[idstatus]==3){
echo "<a href='a_frienddata.php?id=$row[id]&do=2'>	  <img src='http://image.friends.muict9.net/onebit_36.png' alt='unpass' width='48' height='48' align='middle' />ยกเลิกสถานะผ่าน</a><font color='green' size='2'><b><br>สถานะ : ผ่านการยืนยันแล้ว</font></b>";
}





?></div></td><td width='50%'><a href="a_frienddata.php?id=<?php 
$idss=$row[id];
echo $idss;?>&do=4"><img src="http://image.friends.muict9.net/friendster.png" width="60" height="60" align="middle" /> <strong>RESET PASS!</strong></a>
        </div>
      </a></td>
    </tr>
  </table>
  <br />
  <?php

$data=$_POST["data"];
$email=$_POST["email"];


$data.="<hr>หากมีข้อสงสัยใน E-mail ฉบับนี้ สามารถใช้เมนูติดต่อผู้ดูแล http://friends.muict9.net/help.php เพื่อแก้ปัญหาได้ ";
if($email!="" and $data!=""){
echo "ส่ง E-MAIL ไปแล้ว!<hr>";
$MailTo = $email ;
$MailFrom = "no-reply@muict9.net" ;
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

  <form id="form2" name="form2" method="post" action="a_frienddata.php?id=<? echo $ids; ?>">
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
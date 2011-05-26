<?php
require("bootstrap.php");
require_login();

$self_user = User::fromId($_SESSION["id"], '*');

try {
    $user = User::fromId($_GET["id"]);
}
catch (InvalidUserIdException $e) {
    redirect("friend.php");
}
$isadmin=$_SESSION['admin'];

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
.style2 {font-size: 12px}
.style4 {
	font-size: 9px;
	color: #FFFFFF;
}
-->
</style></head>

<body><center><?php

if ($self_user->getIdStatus() != 3){
    echo"<b><font color=red>ERROR! เฉพาะ ID ที่ผ่านการตรวจสอบแล้วเท่านั้นที่ดูข้อมูลเชิงลึกได้ </font></b><br> เพื่อเพิ่มความสะดวกในการตรวจสอบ โปรดให้ข้อมูลให้มากที่สุด เช่น Facebook หรือ อัพโหลดรูปภาพของท่าน<hr>";
    return;
}

$img2="<img src='http://image.friends.muict9.net/fail.png' width='27' height='27' />";

$idstatus = $user->getIdStatus();
if ($idstatus < 2){
    l("ViewUnregisteredUser", "", "");
    echo "แหะๆ รู้นะ คิดอะไรอยูู่ อิอิอิอิ ;P ";
    return;
}

?>
  <table width="40%" border="1">
    <tr>
    
      <td><div align="center">
        <table width="100%" border="0" align="center">
          <tr>
            <td width="50%"><div align="center"><img src=<? 
           $imgurl = $user->getImageUrl();
            if($user->getImageUrl() == ""){
                $prmg="no_image.jpg.png";
            }else{
                $prmg="$imgurl";
            }

    	  echo"upload_images/$prmg"; ?> width="90%" /></div></td>
                <td width="50%"><div align="center"><img src='<? if($user->getFacebookImageUrl() != ""){ echo $user->getFacebookImageUrl(); }else{ echo"upload_images/no_image.jpg.png"; } ?>' width="90%" hspace="5" vspace="5" /></div></td>
              </tr>
              <tr>
                <td><div align="center"><strong>USER UPLOAD</strong></div></td>
                <td><div align="center"><strong>FACEBOOK</strong></div></td>
              </tr>
            </table><br />
              <span class="style3"><strong>NAME :</strong>&nbsp;
              <?php echo $user->getThaiFullName();?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>NICKNAME : 
              <?php echo $user->getThaiNickname(); ?>
              </strong>&nbsp;&nbsp;&nbsp;&nbsp; <strong>SEC : 
              <?php echo $user->getSec(); ?>
              </strong></span><br />
          </div></td>
        </tr>
        <tr>
          <td><table width="100%" border="0">
            <tr>
              <td width="24%"><strong>MSN</strong></td>
              <td width="76%"><div align="left">
                <?php   $thiss=$user->getMSN(); if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
              </div></td>
            </tr>
            <tr>
              <td><strong>GTALK</strong></td>
              <td><div align="left">
                <?php   $thiss=$user->getGTalk(); if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
              </div></td>
            </tr>
            <tr>
              <td><strong>BB PIN</strong></td>
              <td><div align="left">
                <?php   $thiss=$user->getBBM(); if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
              </div></td>
            </tr>
            <tr>
              <td><strong>TWITTER</strong></td>
              <td><div align="left">
                <?php   $thiss=$user->getTwitter(); if($thiss==""){ echo $img2; } else { echo "<a href='http://www.twitter.com/$thiss' target=_blank'>$thiss</a>";  }		  ?>
              </div></td>
            </tr>
            <tr>
              <td><strong>FACEBOOK</strong></td>
              <td><div align="left">
                <?php   $thiss=$user->getFacebookName(); if($thiss==""){ echo $img2; } else { echo "<a href='" . $user->getFacebookUrl() . "' target=_blank>$thiss</a>";  }		  ?>
              </div></td>
            </tr>
            <tr>
              <td><strong>SKYPE</strong></td>
              <td><div align="left">
                <?php   $thiss=$user->getSkype(); if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
              </div></td>
            </tr>
            <tr>
              <td><strong>MOBILE</strong></td>
              <td><div align="left">
                <?php   $thiss=$user->getMobile(); if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?></div></td>
            </tr>
            <tr>
              <td><strong>Whatsapp</strong></td>
              <td><div align="left">
                <?php   $thiss=$user->getWhatsApp(); if($thiss==""){ echo $img2; } else { echo $thiss;  }		  ?>
              </div></td>
            </tr>
                    <tr>
              <td height="21"><strong>About me</strong></td>
              <td bgcolor="#FFFFFF"> <span class="style4">x</span><br />            
                &nbsp;&nbsp; <?php
    		  $data=str_replace( "<br>","&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;", $user->getAbout());
              echo "$data";

    		  $bd = $user->getBirthday();
    		  if($bd != "0000-00-00"){
    		  list($year,$month,$day) = split("-",trim($bd));
    		  $year += 543;
    		  $day = intval($day); // remove prepending "0"
    		  $month = intval($month);
    		  echo "<br><br>&nbsp;&nbsp;&nbsp;<b>วันเกิด : </b> $day / $month / $year";
    		  }
    		  ?>
            <br />
            <span class="style4">a</span><br /></td>
        </tr>
        
      </table></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</center>
</body>
</html><?php
mysql_close($con);

if ($isadmin != 1) {
    return;
}

?>

<meta http-equiv="refresh" content="2;a_frienddata.php?id=<? echo $user->getId(); ?>/"> 
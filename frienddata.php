<?php
require("bootstrap.php");
require_login();

$ids=intval($_GET["id"]);
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
.style2 {font-size: 12px}
.style4 {
	font-size: 9px;
	color: #FFFFFF;
}
-->
</style></head>

<body><center><?php

$result = mysql_query_log("SELECT idstatus FROM muict WHERE id=$ids");
$row = mysql_fetch_array($result);

if ($row[idstatus] != 3){
    echo"<b><font color=red>ERROR! เฉพาะ ID ที่ผ่านการตรวจสอบแล้วเท่านั้นที่ดูข้อมูลเชิงลึกได้ </font></b><br> เพื่อเพิ่มความสะดวกในการตรวจสอบ โปรดให้ข้อมูลให้มากที่สุด เช่น Facebook หรือ อัพโหลดรูปภาพของท่าน<hr>";
    return;
}

$result = mysql_query_log("SELECT * FROM muict WHERE id='$ids'");
$row = mysql_fetch_array($result);
$img2="<img src='image/fail.png' width='27' height='27' />";


if($row[idstatus] == 0 or $row[idstatus] == 1){
    l("ViewUnverifiedUser", "", "");
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
        </table>
        <br />
          <span class="style2"><strong>NAME :</strong>&nbsp;
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
          <td bgcolor="#FFFFFF"> <span class="style4">x</span><br />            &nbsp;&nbsp; <?php
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

if($isadmin!=1){

return;
}

?>

<meta http-equiv="refresh" content="2;url=http://friends.muict9.net/a_frienddata.php?id=<? echo $ids; ?>/"> 
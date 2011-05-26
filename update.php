<?php
require("bootstrap.php");
require_login();

$id=$_SESSION['id'];
$do=intval($_GET["do"]);

$data=$_POST["data"];

$user = User::fromId($id);

//data
$doimg[1]="msn-icon.png";
$doname[1]="MSN";
$doex[1]="muict@hotmal.com";
$dofunction[1]="MSN";

$doimg[2]="gtalk-icon.png";
$doname[2]="Google Talk";
$doex[2]="muict@gmail.com";
$dofunction[2]="GTalk";

$doimg[3]="big_bb_Icon-120x120.jpg";
$doname[3]="BB PIN";
$doex[3]="21D0E58C";
$dofunction[3]="BBM";

$doimg[4]="twitter.png";
$doname[4]="TWITTER";
$doex[4]="muict [Twitter name only!]<br>If your URL is : http://twitter.com/#!/<b>DaEquilibrate</b><br>DaEquilibrate is Twitter name";
$dofunction[4]="Twitter";

$doimg[5]="skype-icon.png";
$doname[5]="SKYPE";
$doex[5]="muict";
$dofunction[5]="Skype";

$doimg[6]="call_icon_110x102.jpg";
$doname[6]="MOBILE NUMBER";
$doex[6]="0809876543";
$dofunction[6]="Mobile";

$doimg[7]="com.whatsapp_icon.png";
$doname[7]="Whatsapp";
$doex[7]="0809876543";
$dofunction[7]="WhatsApp";

$func = $dofunction[$do];
if (isset($_POST["button"])) {
    try {
        if ($_POST["delete"] == "delete") {
            call_user_func(array($user, "clear$func"));
        }
        else {
            call_user_func(array($user, "set$func"), $data);
        }
        
        $user->save();
        redirect("my.php");
    } catch (ValidationException $e) {
        $error = true;
    }
}

// for display
if ($data == "") {
    $data = call_user_func(array($user, "get$func"));
}

mysql_close($con);

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
	font-size: 14px;
	font-weight: bold;
}
.style2 {
	font-size: 10px;
	color: #333333;
}
.style3 {font-size: 12px}
-->
</style></head>

<body>
<table width="40%" border="0" align="center">
  <tr>
    <td><div align="center"><img src="http://image.friends.muict9.net/<? echo"$doimg[$do]"; ?>" width="60" height="60" /><br />
          <span class="style1"><? echo"$doname[$do]" ?></span></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <form id="form1" name="form1" method="post" action="update.php?do=<? echo $do; ?>">
      <input name="data" type="text" id="data" value="<? echo $data; ?>"/>
      &nbsp; 
        <label>
        <input type="submit" name="button" id="button" value="Submit" />
        </label>
        <br />
        <input type="checkbox" name="delete" value="delete"><span class="style2">ติ๊กถ้าหากต้องการลบ<br />
        </span><span class="style3">Ex :      <? echo"$doex[$do]" ?>
        </span><br />
        <?php if ($error): ?>
        <span style="color:red">กรุณากรอกข้อมูลให้ถูกต้อง</span>
        <?php endif; ?>
      </form>
      </div></td>
  </tr>
  <tr>
    <td><div align="center"><a href="loginc.php"><img src="http://image.friends.muict9.net/onebit_33.png" width="48" height="48" /></a></div></td>
  </tr>
</table>
</body>
</html>

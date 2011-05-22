<?php
require("bootstrap.php");
require_login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
$id=$_SESSION['id'];
$do=intval($_GET["do"]);

$data=$_POST["data"];
$datado=intval($_POST["do"]);



$result = mysql_query_log("SELECT * FROM muict WHERE id='$id'");
$row = mysql_fetch_array($result);

//data
$doimg[1]="msn-icon.png";
$doname[1]="MSN";
$doex[1]="muict@hotmal.com";
$dovalidate[1]="email";
$sql[1]="msn";

$doimg[2]="gtalk-icon.png";
$doname[2]="Google Talk";
$doex[2]="muict@gmail.com";
$dovalidate[2]="email";
$sql[2]="gtalk";

$doimg[3]="big_bb_Icon-120x120.jpg";
$doname[3]="BB PIN";
$doex[3]="21D0E58C";
$dovalidate[3]="bbm";
$sql[3]="BB";

$doimg[4]="twitter.png";
$doname[4]="TWITTER";
$doex[4]="muict [Twitter name only!]<br>If your URL is : http://twitter.com/#!/<b>DaEquilibrate</b><br>DaEquilibrate is Twitter name";
$dovalidate[4]="username";
$sql[4]="twitter";

$doimg[5]="skype-icon.png";
$doname[5]="SKYPE";
$doex[5]="muict";
$dovalidate[5]="username";
$sql[5]="skype";

$doimg[6]="call_icon_110x102.jpg";
$doname[6]="MOBILE NUMBER";
$doex[6]="0809876543";
$dovalidate[6]="phone";
$sql[6]="mobile";

$doimg[7]="com.whatsapp_icon.png";
$doname[7]="Whatsapp";
$doex[7]="0809876543";
$dovalidate[7]="phone";
$sql[7]="whatsapp";

$delete = $_POST["delete"] == "delete";
if ($datado != "") {
    // Validate
    if ($data == "") {
        $error = true;
    }
    else {
        switch ($dovalidate[$datado]) {
            case "email":
                if (!verify_email($data)) {
                    $error = true;
                }
                break;
            case "bbm":
                if (!preg_match("/^[0-9A-Fa-f]+$/", $data)) {
                    $error = true;
                }
                break;
            case "username":
                if (!preg_match("/^[0-9A-Za-z\.\,\# _]+$/", $data)) {
                    $error = true;
                }
                break;
            case "phone":
                if (!preg_match("/^[0-9]+$/", $data)) {
                    $error = true;
                }
                break;
        }
    }
    
    if (!$error || $delete) {
        $dbnames=$sql[$datado];

        if ($delete) {
            mysql_query_log("UPDATE muict SET $dbnames = NULL WHERE id = '$id'");
        }
        else {
            $data = mysql_real_escape_string($data);
            mysql_query_log("UPDATE muict SET $dbnames = '$data' WHERE id = '$id'");
        }

        header('Location: loginc.php');
        return;
    }
}

// for display
if ($data == "") {
    $data = $row[$sql[$do]];
}


mysql_close($con);

?>

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
    <td><div align="center"><img src="image/<? echo"$doimg[$do]"; ?>" width="60" height="60" /><br />
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
        <input name="do" type="hidden" id="do" value="<? echo $do; ?>" />
        </span><br />
        <?php if ($error): ?>
        <span style="color:red">กรุณากรอกข้อมูลให้ถูกต้อง</span>
        <?php endif; ?>
      </form>
      </div></td>
  </tr>
  <tr>
    <td><div align="center"><a href="loginc.php"><img src="image/onebit_33.png" width="48" height="48" /></a></div></td>
  </tr>
</table>
</body>
</html>

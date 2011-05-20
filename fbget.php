
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT#9 : FB GET</title>
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
.style3 {color: #003300}
.style4 {color: #000000}
-->
</style></head>

<body>

<?php 
include 'connect.php';

if($_SESSION['id']!=""){
$id=$_SESSION['id'];
}
$result = mysql_query("SELECT * FROM muict WHERE id='$id'");
$row = mysql_fetch_array($result);

if($row[email]==""){
session_destroy();
header('Location: login.php');
return;
}





    $app_id = 212049612146830;
    $app_secret = "f3ff111ae1ff42ee5a358e12203a92f2";
    $my_url = "http://www.daequilibrate.net/muict/fbget.php";

    $code = $_REQUEST["code"];

    if(empty($code)) {
        $dialog_url = "http://www.facebook.com/dialog/oauth?&scope=email&picture&client_id=" 
            . $app_id . "&redirect_uri=" . urlencode($my_url);

        echo("<script> top.location.href='" . $dialog_url . "'</script>");
    }

    $token_url = "https://graph.facebook.com/oauth/access_token?client_id="
        . $app_id . "&redirect_uri=" . urlencode($my_url) . "&client_secret="
        . $app_secret . "&code=" . $code;

    $access_token = file_get_contents($token_url);

    $graph_url = "https://graph.facebook.com/me?" . $access_token;

    $user = json_decode(file_get_contents($graph_url));

	$fbname=$user->name;
	$fblink=$user->link;
	//echo $user->name;
	//echo "<br>$fbname<hr>";
	//echo $user->link;
	//echo $user->email;
	//echo "<br>$fblink<hr>";
	$fbpic=$user->picture;
	$fbemail=$user->email;
	$fbid=$user->id;
	$fbpic="http://graph.facebook.com/".$fbid."/picture?type=large";
	if($fblink!=""){
	mysql_query("UPDATE muict SET fbname = '$fbname' , fburl='$fblink',fbemail='$fbemail',fbpic='$fbpic',fbid='$fbid' WHERE id = '$id'");

	$logas="FB NAME"; //Í¸ÔºÒÂ loga
$loga=$fbname;
$logbs="FB URL";
$logb=$fblink;
$logcs="email";
$logc=$fbemail;
echo $fbpic;


	}
	
	mysql_close($con);
include 'log.php';
if($logb!=""){
header('Location: loginc.php');
}
?>

</script> 
</body>
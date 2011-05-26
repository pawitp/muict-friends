<?php
require("bootstrap.php");
require_login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT#9 : FB GET</title>
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
.style3 {color: #003300}
.style4 {color: #000000}
-->
</style></head>

<body>

<?php
    $id=$_SESSION['id'];
    $my_url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"];

    $code = $_REQUEST["code"];

    if(empty($code)) {
        $_SESSION['fbstate'] = generate_code();
        $dialog_url = "http://www.facebook.com/dialog/oauth?scope=email&client_id=" 
            . $fb_app_id . "&redirect_uri=" . urlencode($my_url) . "&state=" . $_SESSION['fbstate'];

        echo("<script> top.location.href='" . $dialog_url . "'</script>");
        return;
    }

    if ($_SESSION['fbstate'] != $_GET["state"]) {
        l("InvalidFbState", "Session: " . $_SESSION['fbstate'], "Get: " . $_GET["state"]);
        die("Invalid state");
    }
    
    $token_url = "https://graph.facebook.com/oauth/access_token?client_id="
        . $fb_app_id . "&redirect_uri=" . urlencode($my_url) . "&client_secret="
        . $fb_app_secret . "&code=" . $code;

    $access_token = fetch_page($token_url);

    $graph_url = "https://graph.facebook.com/me?" . $access_token;

    $userfb = json_decode(fetch_page($graph_url));
    
	if ($userfb->link != "") {
        $user = User::fromId($_SESSION["id"]);
        $user->setFacebookName($userfb->name);
        $user->setFacebookUrl($userfb->link);
        $user->setFacebookEmail($userfb->email);
        $user->setFacebookImageUrl("http://graph.facebook.com/".$userfb->id."/picture?type=large");
        $user->setFacebookId($userfb->id);
        $user->save();
		redirect("my.php");
	}
?>

</body>
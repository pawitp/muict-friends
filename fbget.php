<?php
require("bootstrap.php");
require_login();

$id=$_SESSION['id'];
$my_url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"];

$code = $_REQUEST["code"];

if (empty($code)) {
    $_SESSION['fbstate'] = generate_code();
    $dialog_url = "http://www.facebook.com/dialog/oauth?scope=email&client_id="
        . $fb_app_id . "&redirect_uri=" . urlencode($my_url) . "&state=" . $_SESSION['fbstate'];

    redirect($dialog_url);
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

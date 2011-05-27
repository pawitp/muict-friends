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

if (!array_key_exists($do, $doimg)) {
    redirect("my.php");
}

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

$smarty = get_smarty();
$smarty->assign("error", $error);
$smarty->assign("doimg", $doimg[$do]);
$smarty->assign("do", $do);
$smarty->assign("data", $data);
$smarty->display("update.tpl");
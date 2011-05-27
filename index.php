<?php
require("bootstrap.php");

if (is_login()) {
    redirect("my.php");
}

$smarty = get_smarty();
$smarty->display("index.tpl");
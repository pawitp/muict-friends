<?php
//TEST 22/5/54 
require("bootstrap.php");
require_login();

session_destroy();
redirect('login.php');
?>
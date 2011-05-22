<?php
require("bootstrap.php");
require_login();

session_destroy();
redirect('login.php');
?>
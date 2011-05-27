<?php
require("bootstrap.php");

session_destroy();
redirect('login.php');
?>
<?php

session_start();


include 'log.php';

session_destroy();
header('Location: login.php');
?>
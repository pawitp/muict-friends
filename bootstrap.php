<?php
session_start();
ob_start();

require("functions.php");

// Reverse magic quote
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}

// Connect to database
$host="localhost";
$user="daequili_buddy";
$passwordsql="f3AsLTHS";
$dbname="daequili_buddy";

@include("localsettings.php");

$con = mysql_connect($host,$user,$passwordsql);
if (!$con) { 
    die('Could not connect: ' . mysql_error());
}
mysql_query_log("SET character_set_results=utf8");
mysql_query_log("SET character_set_client=utf8");
mysql_query_log("SET character_set_connection=utf8");
mysql_query_log("SET NAMES UTF8");
mysql_select_db($dbname);

unset($host);
unset($user);
unset($passwordsql);
unset($dbname);

if (!$disable_logging) {
    l("PageView", "", "");
}
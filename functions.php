<?php

function redirect($page) {
    header("Location: $page");
    die();
}

function is_login() {
    return !empty($_SESSION["id"]);
}

function require_login() {
    if (!is_login()) {
        $_SESSION["redirect"] = $_SERVER["REQUEST_URI"];
        redirect("login.php");
    }
}

function require_admin_login() {
    require_login();
    
    if ($_SESSION["admin"] != true) {
        Log("UnauthorizedAdmin", "", "");
        die("You must be admin.");
    }
}

function generate_code() {
    return md5(uniqid('', true));
}

function get_any_id() {
    if (!empty($_SESSION["id"])) {
        return $_SESSION["id"];
    }
    elseif (!empty($_SESSION["reg_id"])) {
        return $_SESSION["reg_id"];
    }
    elseif (!empty($_SESSION["remail_id"])) {
        return $_SESSION["remail_id"];
    }
    elseif (!empty($_SESSION["log_id"])) {
        return $_SESSION["log_id"];
    }
    else {
        return 0;
    }
}

function mysql_query_log($query) {
    $ret = mysql_query($query);
    
    if (empty($ret)) {
        l("MySQL", $query, mysql_error());
    }
    
    return $ret;
}

// log
function l($tag, $data1, $data2) {
    $ip = mysql_real_escape_string($_SERVER["REMOTE_ADDR"]);
    $user_agent = mysql_real_escape_string($_SERVER["HTTP_USER_AGENT"]);
    $path = mysql_real_escape_string($_SERVER["REQUEST_URI"]);
    $id = get_any_id();
    $tag = mysql_real_escape_string($tag);
    $data1 = mysql_real_escape_string($data1);
    $data2 = mysql_real_escape_string($data2);
    mysql_query_log("INSERT INTO muict_log (time, ip, user_agent, path, id, tag, data1, data2) VALUES (CURRENT_TIMESTAMP(), '$ip', '$user_agent', '$path', $id, '$tag', '$data1', '$data2')");
}

function fetch_page($url) {
    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $query = curl_exec($curl_handle);
    curl_close($curl_handle);
    
    return $query;
}

function convert_timezone($input, $format = "Y-m-d H:i:s") {
    $date = new DateTime($input);
    $date->setTimezone(new DateTimeZone('Asia/Bangkok'));
    return $date->format($format);
}
<?php
$logroot=$_SERVER['SCRIPT_FILENAME'];
$logip=$_SERVER['REMOTE_ADDR'];
$logbrowser=$_SERVER['HTTP_USER_AGENT'];
$logfilename = date("Ymd"); 
$logtime = date("H:i:s"); 
$logsqlqueery = date("F j, Y, g:i a");



//session_start();
$logid=$_SESSION['id']; 
$logno=$_SESSION['no']; 


//start log

$fp = fopen($logfilename , 'a');
fwrite($fp, '<tr><td>');
fwrite($fp,$logtime);
fwrite($fp, '</td><td>');
fwrite($fp,$logip);
fwrite($fp, '</td><td>');
fwrite($fp,$logbrowser);
fwrite($fp, '</td><td>');
fwrite($fp,$logroot);
fwrite($fp, '</td><td>');
fwrite($fp,$logid);
fwrite($fp, '</td><td>');
fwrite($fp,$logno);
fwrite($fp, '</td><td>');

if($loga!=""){
fwrite($fp,$logas);
fwrite($fp,'=');
fwrite($fp,$loga);
fwrite($fp, ' + ');
}

if($logb!=""){
fwrite($fp,$logbs);
fwrite($fp,'=');
fwrite($fp,$logb);
fwrite($fp, ' + ');
}
if($logc!=""){
fwrite($fp,$logcs);
fwrite($fp,'=');
fwrite($fp,$logc);
fwrite($fp, ' + ');
}
if($logd!=""){
fwrite($fp,$logds);
fwrite($fp,'=');
fwrite($fp,$logd);
fwrite($fp, ' + ');
}
if($loge!=""){
fwrite($fp,$loges);
fwrite($fp,'=');
fwrite($fp,$loge);

}

fwrite($fp, '</td></tr>');
fclose($fp);

?>
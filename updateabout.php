<?php
require("bootstrap.php");
require_login();

$id = $_SESSION['id'];
$result = mysql_query_log("SELECT * FROM muict WHERE id=$id");
$row = mysql_fetch_array($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

$data=$_POST["data"];
$day=intval($_POST["date"]);
$month=intval($_POST["month"]);
$year=intval($_POST["year"]);

if($data!="" and $day!="" and $month!="" and $year!=""){
$data=str_replace( "\n","<br>", $data );

$bd=$year."-".$month."-".$day;
echo $bd;
$ids=$_SESSION['id'];
$data = mysql_real_escape_string($data);
mysql_query_log("UPDATE muict SET about='$data' , BD='$bd' WHERE id = '$ids'");
mysql_close($con);
redirect("my.php");
}
?>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MUICT #9 : Friend system</title>
<style type="text/css">
<!--
body {
	background-image: url(image/http://image.friends.muict9.net/bg.png);
}
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000000;
}
a:hover {
	text-decoration: underline;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #000000;
}
.style8 {
	font-size: 12px;
	color: #333333;
}
.style10 {
	font-size: 14px
}
.style12 {color: #FF0000; font-size: 10px;}
.style13 {color: #FF0000}
.style15 {
	font-size: 12px;
	font-weight: bold;
	color: #FF0000;
}
.style16 {color: #FF0000; font-size: 12px;}
-->
</style></head>

<body>
<div align="center">
  <form id="form1" name="form1" method="post" action="">
    <table width="65%" border="0">
      <tr>
        <td width="15%"><div align="center"><strong><span class="style13">*</span>แนะนำตัว :</strong></div></td>
        <td bgcolor="#99FFFF">
          <textarea name="data" id="data" cols="100%" rows="10"><?php
		  
		  $data=str_replace( "<br>","\n", $row["about"] );
             echo $data;
			 if($data==""){
			 echo "  ";
			 }
			 ?>
          </textarea>
          <div align="left" class="style12">หมายเหตุ สูงสุด 2000 ตัวอักษร</div>
            </label></td>
        <td width="15%"><div align="center"><span class="style8"><strong>ข้อความแนะนำตัว </strong>จะช่วยให้เพื่อนๆ จำคุณได้ง่ายขึ้น ควรแนะนำจุดเด่น จุดสังเกตเด่นๆ หรือพิมพ์ข้อความใดๆ<br />
          ที่เป็นตัวคุณ 
        ที่อยากบอกเพื่อน ข้อความนี้เพื่อนๆจะได้อ่าน สามารถปรับแต่งได้ ตามใจชอบ</span></div></td>
      </tr>
      <tr>
        <td><div align="center"></div></td>
        <td bgcolor="#99FFFF">
          <div align="center"><strong>วันเกิด วันที่ :</strong>
            <?php 
		
		list($year,$month,$day) = split("-",trim($row["BD"]));
		//echo "Y=$year M=$month D=$day";
		 ?>
            <select name="date" id="date">
              <option value="<?php			$athis=$day;   $bthis="00";         if($athis!=$bthis){			echo "$athis";			}else{			echo "0";			}			?>" selected="selected">
              <?php           if($athis!=$bthis){			echo "$athis";			}else{			echo "--";			}			?>
              </option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select> 
            <strong>เดือน</strong> 
            <select name="month" id="month">
              <option value="<?php			$athis=$month;   $bthis="00";         if($athis!=$bthis){			echo "$athis";			}else{			echo "0";			}			?>" selected="selected">
              <?php           if($athis!=$bthis){			echo "$athis";			}else{			echo "--";			}			?>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
  &nbsp;<strong>ปี(ค.ศ.)</strong>
  <select name="year" id="year">
    <option value="<?php			$athis=$year;   $bthis="0000";         if($athis!=$bthis){			echo "$athis";			}else{			echo "0";			}			?>" selected="selected">
      <?php           if($athis!=$bthis){			echo "$athis";			}else{			echo "--";			}			?>
         <option value="1995">1995</option>
       <option value="1994">1994</option>
       <option value="1993">1993</option>
       <option value="1992">1992</option>
       <option value="1991">1991</option>
       <option value="1990">1990</option>
       <option value="1989">1989</option>
       <option value="1988">1988</option>
  </select>
          </div>
        </label></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#99FFFF">
          <div align="center"><span class="style16">&nbsp;</span><span class="style15">&nbsp;&nbsp;&nbsp;&nbsp; </span>
            <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
           &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  <a href="updateabout.php" class="style10">คืนค่าดั้งเดิม</a></div>
        </td>
        <td><div align="center"><a href="loginc.php"><img src="http://image.friends.muict9.net/fail.png" width="27" height="27" align="middle" /></a></div></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>

{extends "layout.tpl"}
{block name="styles"}
.style1 {
	font-size: 24px;
	font-weight: bold;
	color: #0000FF;
}
{/block}
{block name="body"}
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p align="center"><img src="http://image.friends.muict9.net/camera-icon.png" width="172" height="172" /></p>
  <p align="center"><span class="style1">เลือกรูปภาพที่จะอัพโหลด (สูงสุด 2MB)(กด Upload เฉยๆเพื่อลบ)</span><br />
    <br />
    <input name="image_name" type="file" id="image_name" size="40" />
  </p>
  <p align="center">
    <input type="submit" value="Upload" />
    <input type="hidden" name="MM_insert" value="form1" />
    <br />
    <br />
    <a href="my.php"><img src="http://image.friends.muict9.net/onebit_33.png" width="48" height="48" /></a><br />
  </p>
</form>
{/block}
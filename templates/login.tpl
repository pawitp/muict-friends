{extends file="layout.tpl"}
{block name="head"}
<script type="text/javascript" src="javascript/sha1.js"></script>
<script type="text/javascript"><!--
function encrypted_login() {
var pass = document.getElementById('pass').value;
var enc_pass = hex_sha1('{$secret}' + hex_sha1(pass).substring(0, 20));
document.getElementById('pass').value = '';
document.getElementById('enc_pass').value = enc_pass;
}
--></script>
{/block}
{block name="styles"}
.style2 {
font-size: 24px;
color: #000000;
}
.style3 {
font-size: 10px;
font-weight: bold;
}
{/block}
{block name="body"}
<form id="form1" name="form1" method="post" action="" onsubmit="encrypted_login(); return true;">
    <div align="center"><span class="style2">เข้าสู่ระบบเพื่อแก้ไขข้อมูล</span><br />
        &nbsp;  </div>
    <label></label>
<div align="center">
    <table width="20%" border="0" bordercolor="#000000">
        <tr>
            <td><strong>รหัสนักศึกษา</strong></td>
            <td><input name="id" type="text" id="id" value="{$hint_login}" /></td>
        </tr>
        <tr>
            <td><strong>รหัสผ่าน</strong></td>
            <td><input type="password" name="pass" id="pass" /></td>
        </tr>
    </table>
    <input type="hidden" name="enc_pass" id="enc_pass" value="" />
    <input type="submit" name="button" id="button" value="เข้าสู่ระบบ" />
    &nbsp;&nbsp; <span class="style3"><a href="forgot.php">ลืมรหัสผ่าน</a></span><br />
    <label></label>
    <br />
    {if $error == 'need_verify'}
        <img src=image/onebit_49.png  align=‘middle’ />
        <span class=‘style3’>ยังไม่ได้ยืนยัน E-mail โปรดยืนยัน E-mail ก่อนใช้งานระบบ!!!  <a href='remail.php'>ส่ง E-mail ยืนยันอีกครั้ง</a> หรือ <br />
        <a href='cemail.php'>เปลี่ยน E-mail ที่ใช้ยืนยัน</a></span></div>
        {elseif $error == 'invalid'}
        <span style="color:red"> ไม่พบรหัสนักศึกษาและรหัสผ่านนี้</span>
    {/if}
    </div>
    <label></label>
</form>
{/block}
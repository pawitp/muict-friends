{extends "layout.tpl"}
{block name="styles"}
.style1 {
	font-size: 10px;
	color: #FF0000;
}
.style3 {
	font-size: 9px;
	color: #FF0000;
	font-weight: bold;
}
{/block}
{block name="body"}
{if $status == "success"}
    การตรวจสอบข้อมูลสมบูรณ์
    {if $user->getIdStatus() == -1}
        และ ขอบคุณที่กลับมาใช้ระบบเราอีกครั้ง
    {/if}

    <hr/>
    <p><strong>ขั้นตอนที่ 2 จาก 3</strong>  <strong>กำหนดรหัสผ่านสำหรับการแก้ไขข้อมูลในอนาคต&nbsp;</strong></p>
    <form id="form1" name="form1" method="post" action="updatepass.php">
        <div align="center">
            <table width="40%" border="0" bordercolor="#FF00FF">
                <tr>
                    <td bgcolor="#99CC66"><strong>รหัสผ่าน</strong></td>
                    <td bgcolor="#99CC66"><input name="pass" type="password" id="pass" maxlength="20" />
                        <br />
                        <span class="style3">[โปรดใส่ใจภาษาที่.ใช้พิมพ์ THAI / ENGLISH]</span></td>
                </tr>
                <tr>
                    <td bgcolor="#99CC66"><strong>รหัสผ่านอีกครั้ง</strong></td>
                    <td bgcolor="#99CC66"><input name="cpass" type="password" id="cpass" maxlength="20" />
                        <br /></td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF"><strong>E-mail</strong></td>
                    <td bgcolor="#CCFFFF"><input type="text" name="email" id="email" />
                        <br />
                        <span class="style1">*ใส่ E-mail ที่ใช้งานบ่อยที่สุด เพราะต้องยืนยัน E-mail </span></td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF"><strong>E-mail</strong></td>
                    <td bgcolor="#CCFFFF"><input type="text" name="cemail" id="cemail" />
                        <br />
                        <span class="style1">*E-mailเหมือนช่องด้านบนอีกครั้งเพื่อป้องกันข้อผิดพลาดในการกรอกข้อมูล</span></td>
                </tr>
                <tr>
                    <td bgcolor="#99CC66"><strong>ชื่อเล่น (ไทย)</strong></td>
                    <td bgcolor="#99CC66"><label>
                        <input name="nickname" type="text" id="nickname" maxlength="20" />
                    </label></td>
                </tr>
                <tr>
                    <td bgcolor="#99CC66"><strong>Nickname (English)</strong></td>
                    <td bgcolor="#99CC66"><label>
                        <input name="eng_nickname" type="text" id="eng_nickname" maxlength="20" />
                    </label></td>
                </tr>
            </table>
            <br />
            <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
            &nbsp;  </div>
    </form>
{elseif $status == "already_registered"}
    เคยผ่านขั้นตอนการตรวจสอบแล้ว สามารถเข้าระบบได้ทันที ! <a href='index.php'>หน้าแรก</a> 
{/if}
{/block}
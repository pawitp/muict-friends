{extends "layout.tpl"}
{block name="body"}
    {if $status == "success"}
        <div style="color:green">เปลี่ยนรหัสผ่านเรียบร้อยแล้ว <a href='logout.php'>เข้าสู่ระบบ</a></div>
    {elseif $status == "invalid_code"}
        <div style="color:red">Code เปลี่ยนรหัสผ่านไม่ถูกต้อง <a href='forgot.php'>กรุณาลองส่งอีเมลใหม่อีกครั้ง</a></div>
    {elseif $status == "invalid_id"}
        <div style="color:red">ไม่พบรหัสนักศึกษานี้ กรุณาติดต่อแอดมินเพื่อขอความช่วยเหลือ</div>
    {else}
        {if $status == "no_password"}
            <div style="color:red">คุณต้องใส่รหัสผ่าน</div>
        {/if}

        <form id="form1" name="form1" method="post" action="">
            <strong>ป้อนรหัสผ่านใหม่</strong>
            <label>
                <input type="password" name="npass" id="npass" />
            </label>
            <label>
                <input type="submit" name="button" id="button" value="เปลี่ยนรหัสผ่าน" />
            </label>
            <br />
        </form>
    {/if}
{/block}
{extends "layout.tpl"}
{block name="styles"}
.style3 { color: #003300 }
.style4 { color: #000000 }
{/block}
{block name="body"}
{if $status == "success"}
    <p><strong>ขั้นตอนที่ 3 จาก 3</strong><strong> สร้างบัญชีผู้ใช้ และ ยืนยัน E-mail เพื่อใช้ในการกู้คืนรหัสผ่าน </strong></p>
    <p><img src="http://image.friends.muict9.net/pass.png" width="28" height="35" /><strong><span class="style3">ระบบบันทึกข้อมูลแล้วสามารถเข้าสู่ระบบได้ทันที</span></strong> <span class="style4">และอย่าลืมไปยืนยันโดยการคลิกลิ้งค์ภายใน E-mail</span> <? echo"$email"; ?>  <a href='logout.php'>กลับสู่หน้าแรก</a></p>
{elseif $status == "unknown_error"}
    Error โปรดลองใหม่ภายหลัง หรือติดต่อผู้ดูแลระบบ
{else}
    {if $status == "nickname"}
        กรุณากรอกชื่อเล่นภาษาไทยให้ถูกต้อง
    {elseif $status == "eng_nickname"}
        กรุณากรอกชื่อเล่นภาษาอังกฤษให้ถูกต้อง
    {elseif $status == "not_same"}
        ข้อมูลที่กรอกมาไม่เหมือนกัน
    {/if}
    <a href='javascript: history.go(-1)'>กลับไปแก้ไข</a>
{/if}
{/block}
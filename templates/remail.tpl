{extends "layout.tpl"}
{block name="styles"}
.style2 { color: #000000 }
.style4 { font-size: 18px }
.style5 {
color: #006600;
font-weight: bold;
}
{/block}
{block name="body"}
    {if $status == "success"}
        <div align="center"><span class="style4"><span class="style5">ระบบได้ส่ง E-mail ไปยัง {$user->getEmail()} เรียบร้อยแล้ว</span> <br />
        </span><br />
        <span class="style2">หากท่านไม่ได้รับ E-mail <a href="help.php">ขอความช่วยเหลือจากผู้ดูแลระบบ
        </a></span>
        </div>
    {else}
        Error โปรดลองใหม่ภายหลัง หรือ<a href='help.php'>ติดต่อผู้ดูแลระบบ</a>
    {/if}
{/block}
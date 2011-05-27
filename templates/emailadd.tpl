{extends "layout.tpl"}
{block name="styles"}
.style3 { color: #003300 }
.style4 { color: #000000 }
{/block}
{block name="body"}
    {if $status == "error"}
        ERROR โปรดติดต่อผู้ดูแลระบบ <a href='index.php'>หน้าแรก</a>
    {else}
        <img src="http://image.friends.muict9.net/pass.png" width="37" height="39" /> ยืนยัน E-mail สมบูรณ์ &nbsp; <a href="index.php">กลับไปหน้าแรก</a>
    {/if}
{/block}
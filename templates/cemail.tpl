{extends "layout.tpl"}
{block name="styles"}
.style2 { color: #000000 }
.style4 { font-size: 18px }
.style5 {
color: #006600;
font-weight: bold;
}
.style6 {
color: #FF0000;
font-size: 12px;
font-weight: bold;
}
{/block}
{block name="body"}
    {if $status == "success"}
        <div align="center"><span class="style4"><span class="style5">ระบบได้ส่ง E-mail ไปยัง {$email} เรียบร้อยแล้ว กรุณาไปยืนยัน E-mail ก่อนใช้งานระบบอีกครั้ง</span> <br />
        </span><br />
        <span class="style2">หากท่านไม่ได้รับ E-mail <a href="help.php">ขอความช่วยเหลือจากผู้ดูแลระบบ
        </a></span>
    </div>
    {elseif $status == "unknown_error"}
        Error โปรดลองใหม่ภายหลัง หรือ<a href='help.php'>ติดต่อผู้ดูแลระบบ</a>
    {else}
        {if $status == "bad_input"}
            <center><font size='3' color='red'><b>กรุณากรอก E-mail ใหม่</b></font></center><hr>
        {/if}
        <form id="form1" name="form1" method="post" action="">
            <center>E-mail ใหม่
                <label>
                    <input type="text" name="email" id="email" />
                </label>
                &nbsp;
                <label>
                    <input type="submit" name="button" id="button" value="Submit" />
                </label>
                <br />
                <span class="style6">หมายเหตุ E-mail นี้ต้องสามารถยืนยัน E-mail ได้</span>
                <br />
                <a href="my.php"><img src="http://image.friends.muict9.net/fail.png" width="48" height="48" /></a><br />
            </center>
        </form>
    {/if}
{/block}
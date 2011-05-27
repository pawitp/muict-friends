{extends "layout.tpl"}
{block name="styles"}
.style1 { font-size: 12px }
.style3 {
font-size: 10px;
color: #FF0000;
}
{/block}
{block name="body"}
<form id="form1" name="form1" method="post" action="">
    {if $status == 'success'}
        บัญชีของคุณถูกยกเลิกเรียบร้อยแล้ว <hr />
    {else}
        {if $status == 'invalid'}
            รหัสผ่านไม่ถูกต้อง<hr/>
        {/if}
        <div align="center"><strong><br />
            ใส่รหัสผ่านเพื่อยืนยันการปิดการแชร์ข้อมูลส่วนตัวของคุณ  </strong><br />
            <label>
                <input type="password" name="passwordc" id="passwordc" />
            </label>
            &nbsp;
            <label>
                <input type="submit" name="button" id="button" value="Submit" />
            </label>
            <br />
            <br />
  <span class="style1">หากการยกเลิกบัญชีนี้เป็นเหตุผลมาจากความขัดข้อง ความไม่ครบถ้วนของระบบ ก่อนยกเลิกบัญชี ขอความกรุณาแจ้งมายังผู้ดูแลระบบก่อน <a href="help.php" target="_blank">คลิก</a><br />
  หลังจากคุณยกเลิกบัญชีแล้ว คุณสามารถกลับเข้าสู่ระบบได้ โดยการเข้าสู่ระบบตรวจสอบบุคคลใหม่</span><br />
            <span class="style3">การยกเลิกบัญชีครั้งนี้ ส่งผลให้บัญชีนี้ปิดกั้นการมองเห็นจากสาธารณะ</span><br />
            <br />
            <a href="my.php"><img src="http://image.friends.muict9.net/fail.png" width="49" height="43" /></a><br />
        </div>
    {/if}
</form>
{/block}
{extends "layout.tpl"}
{block name="styles"}
.style3 {
color: #FF0000;
font-weight: bold;
}
{/block}
{block name="body"}
    {if $status == 'success'}
        ระบบได้ส่งลิ้งค์ไปทางอีเมลล์โปรดตรวจสอบ E-mail ของท่าน หากไม่ได้รับ <a href=help.php>ติดต่อผู้ดูแลระบบ </a>
    {else}
        {if $status == 'not_found'}
            ข้อมูลที่กรอกไม่ถูกต้อง หากจำข้อมูลได้ไม่ครบ ติดต่อผู้ดูแลระบบได้ผ่าน<a href=help.php>ติดต่อผู้ดูแลระบบ </a>
        {/if}
        <form id="form1" name="form1" method="post" action="">
            <label>
                <div align="center"><br />
                    <table width="35%" border="1">
                        <tr>
                            <td bgcolor="#99FF66"><div align="center"><strong>E-mail</strong></div></td>
                            <td bgcolor="#99FF66"><div align="center">
                                <input type="text" name="email" id="email" />
                            </div></td>
                        </tr>
                        <tr>
                            <td bgcolor="#99FF66"><div align="center"><strong>รหัสนักศึกษา</strong></div></td>
                            <td bgcolor="#99FF66"><div align="center">
                                <input name="id" type="text" id="id" value="5488" maxlength="8" />
                            </div></td>
                        </tr>
                    </table>
                    <label><strong>&nbsp;</strong>&nbsp; </label>
                    <label><strong>
                        <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
                        <br />
                    </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br />
                        <br />
                    </label>
                    <br />
                    <br />
                    <br />
             <span class="style3">ถ้าคุณเป็นมนุษย์ โปรดปล่อยช่องนี้ว่างไว้&gt;&gt;
             <input type="text" name="name" id="name" />
        &lt;&lt;ถ้าคุณเป็นมนุษย์ โปรดปล่อยช่องนี้ว่างไว้</span><br />
                    <br />
                    <br />
                </div>
            </label>
        </form>
    {/if}
{/block}
{extends "layout.tpl"}
{block name="styles"}
.style1 {
font-size: 14px;
font-weight: bold;
}
.style2 {
font-size: 10px;
color: #333333;
}
.style3 { font-size: 12px }
{/block}
{block name="body"}
<table width="40%" border="0" align="center">
    <tr>
        <td><div align="center"><img src="http://image.friends.muict9.net/{$doimg}" width="60" height="60" /><br />
            <span class="style1"><? echo"$doname[$do]" ?></span></div></td>
    </tr>
    <tr>
        <td><div align="center">
            <form id="form1" name="form1" method="post" action="update.php?do={$do}">
                <input name="data" type="text" id="data" value="{$data}"/>
                &nbsp;
                <label>
                    <input type="submit" name="button" id="button" value="Submit" />
                </label>
                <br />
                <input type="checkbox" name="delete" value="delete"><span class="style2">ติ๊กถ้าหากต้องการลบ<br />
        </span><span class="style3">Ex :      <? echo"$doex[$do]" ?>
        </span><br />
                {if $error}
                    <span style="color:red">กรุณากรอกข้อมูลให้ถูกต้อง</span>
                {/if}
            </form>
        </div></td>
    </tr>
    <tr>
        <td><div align="center"><a href="loginc.php"><img src="http://image.friends.muict9.net/onebit_33.png" width="48" height="48" /></a></div></td>
    </tr>
</table>
{/block}
{extends "layout.tpl"}
{block name="styles"}
.style1 {
	font-size: 10px;
	color: #FF0000;
}
.style2 {
	color: #FF0000;
	font-size: 10px;
}
.style3 {
	font-size: 9px;
	color: #FF0000;
	font-weight: bold;
}
{/block}
{block name="body"}
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table width="40%" border="0" bordercolor="#FF00FF">
      <tr>
        <td bgcolor="#99CC66"><strong>ชื่อเล่น (ไทย)</strong></td>
        <td bgcolor="#99CC66"><label>
          <input name="nickname" type="text" id="nickname" maxlength="20" value="{$nickname}"/>
        </label></td>
      </tr>
      <tr>
        <td bgcolor="#99CC66"><strong>Nickname (English)</strong></td>
        <td bgcolor="#99CC66"><label>
          <input name="eng_nickname" type="text" id="eng_nickname" maxlength="20" value="{$eng_nickname}"/>
        </label></td>
      </tr>
      </table>
    <br />
    <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
    <p style="color:red">
        {if $error == "nickname"}
            กรุณากรอกชื่อเล่นภาษาไทยให้ถูกต้อง
        {elseif $error == "eng_nickname"}
            กรุณากรอกชื่อเล่นภาษาอังกฤษให้ถูกต้อง
        {/if}
    </p>
  </div>
</form>
{/block}
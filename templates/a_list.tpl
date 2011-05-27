{extends "layout.tpl"}
{block name="styles"}
.style1 { font-weight: bold }
.style2 {
color: #003300;
font-weight: bold;
}
.style4 { color: #000000; font-weight: bold; }
{/block}
{block name="body"}
<p align="right"><span class="style4"><a href="a_frienddata.php" target="_blank">เมนูจัดการผู้ใช้รายบุคคล</a></span></p>

<p><span class="style2"><br />
  100 USER ที่ยังไม่ผ่านการตรวจสอบ 100 คน ล่าสุดอัพเดต</span> [<img src='http://image.friends.muict9.net/onebit_36.png' width='27' height='27' /> = รอแอดมินตรวจสอบ  <img src='http://image.friends.muict9.net/fail.png' width='27' height='27' />=ยังไม่ยืนยันE-mail]<br />

</p>
<table width="90%" border="1" align="center">
    <tr>
        <td><div align="center" class="style1">#</div></td>
        <td><div align="center" class="style1">ID</div></td>
        <td><div align="center" class="style1">NAME</div></td>
        <td><div align="center" class="style1">NICKNAME</div></td>
        <td><div align="center" class="style1">SEC</div></td>
        <td><div align="center" class="style1">FB</div></td>
        <td><div align="center" class="style1">BB PIN</div></td>
        <td><div align="center" class="style1">TWITTER</div></td>
        <td><div align="center" class="style1">GTALK</div></td>
        <td><div align="center" class="style1">SKYPE</div></td>
        <td><div align="center" class="style1">MSN</div></td>
        <td><div align="center" class="style1">MOBILE</div></td>
        <td><div align="center" class="style1">Whatsapp</div></td>
        <td><div align="center" class="style1">IMAGE</div></td>
        <td bgcolor="#99FFCC"><div align="center" class="style1">Status</div></td>

    </tr>
    {foreach $users as $user}
        <tr>
            <td><center>{$user->getLastUpdate()}</center></td>
            <td><center>{$user->getId()}</center></td>
            <td><center>{$user->getThaiFullName()}</center></td>
            <td><center>{$user->getThaiNickname()}</center></td>
            <td><center>{$user->getSec()}</center></td>
            <td><center>{$user->getFacebookName()|exists_tick}</center></td>
            <td><center>{$user->getBBM()|exists_tick}</center></td>
            <td><center>{$user->getTwitter()|exists_tick}</center></td>
            <td><center>{$user->getGTalk()|exists_tick}</center></td>
            <td><center>{$user->getSkype()|exists_tick}</center></td>
            <td><center>{$user->getMSN()|exists_tick}</center></td>
            <td><center>{$user->getMobile()|exists_tick}</center></td>
            <td><center>{$user->getWhatsApp()|exists_tick}</center></td>
            <td><center>{$user->getImageName()|exists_tick}</center></td>
            {if $user->getIdStatus() == 2}
                <td bgcolor='#CC9900'><div align='center'><a href='a_frienddata.php?id={$user->getId()}'target=_blank><img src='http://image.friends.muict9.net/onebit_36.png' width='27' height='27' /></a></div></td>
            {else}
                <td bgcolor='red'><div align='center'><a href='a_frienddata.php?id={$user->getId()}' target=_blank><img src='http://image.friends.muict9.net/fail.png' width='27' height='27' align='middle' /></a></div></td>
            {/if}
        </tr>
    {/foreach}
</table>

<div style="text-align:center">
    <strong>ผู้ใช้ทั้งหมด:</strong> {$total}
    <strong>ไม่ได้ลงทะเบียน:</strong> {$stat[0]}
    <strong>ไม่ผ่านการยืนยันอีเมล:</strong> {$stat[1]}
    <strong>ไม่ผ่านการยืนยันแอดมิน:</strong> {$stat[2]}
    <strong>ผ่านการยืนยันแอดมิน:</strong> {$stat[3]}
    <strong>ยกเลิกบัญชี:</strong> {$stat[-1]}
</div>

{/block}
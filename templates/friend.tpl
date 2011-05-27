{extends "layout.tpl"}
{block name="styles"}
.style1 {
color: #000000;
font-weight: bold;
}
.style2 { font-size: 14px }
{/block}
{block name="body"}

<div align="center"><img src="http://image.friends.muict9.net/pass.png" alt="" width="27" height="27" align="middle" />=ผ่านการตรวจสอบจากผู้ดูแลแล้ว&nbsp;&nbsp;&nbsp;&nbsp; <img src="http://image.friends.muict9.net/onebit_36.png" alt="" width="27" height="27" align="middle" />=อยู่ระหว่างการตรวจสอบ <br />
    <strong>(กดที่เครื่องหมายในช่อง Status เพื่อดูข้อมูลเพื่อนได้)</strong><br />
</div>
<p align="center" class="style2"> <strong>จัดเรียงตาม :&nbsp;</strong>&nbsp;&nbsp; <a href="friend.php?query=1">การอัพเดตล่าสุด</a>&nbsp;&nbsp; <a href="friend.php?query=2">สมาชิกที่เคลื่อนไหวล่าสุดเฉพาะสมาชิกที่ผ่านการยืนยันแล้ว</a>&nbsp; &nbsp;<a href="friend.php?query=3">สมาชิกที่ยืนยันแล้วเรียงตามรหัสนักศึกษา</a> <a href="friend.php?query=4">สมาชิกทั้งหมดที่เคยเข้าสู่ระบบตามรหัสนักศึกษา</a><br />
    <a href="friend.php?query=5">สมาชิก SEC 1 ทั้งหมด</a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <a href="friend.php?query=6">สมาชิก SEC 2 ทั้งหมด</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="friend.php?query=7">สมาชิก SEC 3 ทั้งหมด</a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<strong><a href="friendimg.php">IMAGE MODE HISPEED INTERNET ONLY</a>!</strong></p>
<table width="90%" border="1" align="center">
    <tr>
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
            <td bgcolor='#CC9900'><div align='center'><a href='frienddata.php?id={$user->getId()}' target=_blank><img src='http://image.friends.muict9.net/onebit_36.png' width='27' height='27' /></a></div></td>
        {else}
            <td bgcolor='#003300'><div align='center'><a href='frienddata.php?id={$user->getId()}' target=_blank><img src='http://image.friends.muict9.net/pass.png' width='27' height='27' align='middle' /></a></div></td>
        {/if}
    </tr>
{/foreach}
</table>
{/block}
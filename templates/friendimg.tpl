{extends "layout.tpl"}
{block name="styles"}
.style1 { font-size: 14px }
{/block}
{block name="body"}
<strong>วิธีการแสดงผล</strong>&nbsp;&nbsp;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="style1"><a href="friendimg.php?query=11">SEC1ทั้งหมด</a>   <a href="friendimg.php?query=12">SEC1ชาย</a>   <a href="friendimg.php?query=13">SEC1หญิง</a><a href="friendimg.php?query=21">&nbsp;SEC2ทั้งหมด</a><a href="friendimg.php?query=22"> SEC2ชาย</a>   <a href="friendimg.php?query=23">SEC2หญิง</a>&nbsp;
<a href="friendimg.php?query=31">SEC3ทั้งหมด</a>   <a href="friendimg.php?query=32">SEC3ชาย</a>   <a href="friendimg.php?query=33">SEC3หญิง</a>&nbsp;	<a href="friendimg.php?query=41">ทั้งหมด</a>&nbsp;	<a href="friendimg.php?query=42">ชายทั้งหมด</a>&nbsp;	<a href="friendimg.php?query=43">หญิงทั้งหมด</a>&nbsp;&nbsp;<a href="friendimg.php?query=99">หน้าตาดีทั้งหมด</a>&nbsp;</span><br />
<hr><center>

    {if isset($sql99)}
        <FONT size='30' color='RED'><b>ERROR! พบคนหน้าตาดีจำนวนมากเกินกว่าระบบจะรับได้ กรุณาลองใหม่ภายหลัง</b></FONT><br>ERROR CODE # 999 ต้องการความช่วยเหลือหรือติชม ติดต่อผู้ดูแลระบบ
    {/if}

    {$total = 0}
    {if isset($users)}
        {foreach $users as $user}
            {if $user->getImageName() != ""}
                <a href='frienddata.php?id={$user->getId()}' target=_blank><img src='{$user->getImageUrl()}' width='15%' ></a>&nbsp;&nbsp;&nbsp;
            {/if}
            {if $user->getFacebookImageUrl() != ""}
                <a href='frienddata.php?id={$user->getId()}' target=_blank><img src='{$user->getFacebookImageUrl()}' width='15%' ></a>&nbsp;&nbsp;&nbsp;
            {/if}
     {/foreach}
    {/if}
</center>
{/block}
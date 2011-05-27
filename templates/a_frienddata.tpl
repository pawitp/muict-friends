{extends "layout.tpl"}
{block name="styles"}
.style3 { font-size: 12px }
.style6 { font-size: 9px; color: #FFFFFF; }
{/block}
{block name="body"}
<center>
    <p>&nbsp;    </p>
    <form id="form1" name="form1" method="get" action="">
        <label>ID :
            <input type="text" name="id" id="id" />
        </label>
        &nbsp;
        <label>
            <input type="submit" id="button" value="Submit" />
        </label>
    </form>

    {if $user}
        <table width="40%" border="1">
            <tr>

                <td><div align="center">        <table width="100%" border="0" align="center">
                    <tr>
                        <td width="50%"><div align="center"><img src='{$user->getImageUrl()|check_empty_image}' width="90%" /></div></td>
                        <td width="50%"><div align="center"><img src='{$user->getFacebookImageUrl()|check_empty_image}' width="90%" hspace="5" vspace="5" /></div></td>
                    </tr>
                    <tr>
                        <td><div align="center"><strong>USER UPLOAD</strong></div></td>
                        <td><div align="center"><strong>FACEBOOK</strong></div></td>
                    </tr>
                </table><br />
          <span class="style3"><strong>NAME :</strong>&nbsp;
              {$user->getThaiFullName()}
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>NICKNAME :
                  {$user->getThaiNickname()}
              </strong>&nbsp;&nbsp;&nbsp;&nbsp; <strong>SEC :
                  {$user->getSec()}
              </strong></span><br />
                </div></td>
            </tr>
            <tr>
                <td><table width="100%" border="0">
                    <tr>
                        <td width="24%"><strong>MSN</strong></td>
                        <td width="76%"><div align="left">
                            {$user->getMSN()|check_exists}
                        </div></td>
                    </tr>
                    <tr>
                        <td><strong>GTALK</strong></td>
                        <td><div align="left">
                            {$user->getGTalk()|check_exists}
                        </div></td>
                    </tr>
                    <tr>
                        <td><strong>BB PIN</strong></td>
                        <td><div align="left">
                            {$user->getBBM()|check_exists}
                        </div></td>
                    </tr>
                    <tr>
                        <td><strong>TWITTER</strong></td>
                        <td><div align="left">
                            {if $user->getTwitter()}
                                {$user->getTwitter()|twitter_link}
                            {else}
                                <img src='http://image.friends.muict9.net/fail.png' width='27' height='27' />
                            {/if}
                        </div></td>
                    </tr>
                    <tr>
                        <td><strong>FACEBOOK</strong></td>
                        <td><div align="left">
                            {if $user->getFacebookName()}
                                {facebook_link user=$user}
                            {else}
                                <img src='http://image.friends.muict9.net/fail.png' width='27' height='27' />
                            {/if}
                        </div></td>
                    </tr>
                    <tr>
                        <td><strong>SKYPE</strong></td>
                        <td><div align="left">
                            {$user->getSkype()|check_exists}
                        </div></td>
                    </tr>
                    <tr>
                        <td><strong>MOBILE</strong></td>
                        <td><div align="left">
                            {$user->getMobile()|check_exists}</div></td>
                    </tr>
                    <tr>
                        <td><strong>Whatsapp</strong></td>
                        <td><div align="left">
                            {$user->getWhatsApp()|check_exists}
                        </div></td>
                    </tr>
                    <tr>
                        <td height="21"><strong>About me</strong></td>
                        <td bgcolor="#FFFFFF"> <span class="style6">x</span><br />
                            &nbsp;&nbsp;&nbsp;{$about}

                            {$bd = $user->getDisplayBirthday()}
                            {if $bd}<br><br>&nbsp;&nbsp;&nbsp;<b>วันเกิด : </b>{$bd}{/if}
                            <br />
                            <span class="style6">a</span><br /></td>
                    </tr>
                </table></td>
            </tr>
        </table>
        {$user->getId()}
        {if isset($reset_pass_url)}RESET PASS URL IS : {$reset_pass_url}{/if}<br />
        <table width="40%" border="1" align="center">
            <tr>
                <td width="50%"><div align="center">

                    {$idstatus = $user->getIdStatus()}
                    {if $idstatus == 1}
                        <a href='a_frienddata.php?id={$user->getId()}&do=3'><img src='http://image.friends.muict9.net/onebit_24.png' alt='emailcon' width='48' height='48' align='middle' />ยืนยันE-mailให้</a></div></td>
                    {elseif $idstatus == 2}
                        <a href='a_frienddata.php?id={$user->getId()}&do=1'><img src='http://image.friends.muict9.net/onebit_36.png' alt='checkpass' width='48' height='48' align='middle' />ยืนยันผู้ใช้นี้ ผ่าน!</a><font color='red' size='2'><b><br>สถานะ : ยังไม่ผ่านการยืนยัน</font></b>
                    {elseif $idstatus == 3}
                        <a href='a_frienddata.php?id={$user->getId()}&do=2'><img src='http://image.friends.muict9.net/onebit_36.png' alt='unpass' width='48' height='48' align='middle' />ยกเลิกสถานะผ่าน</a><font color='green' size='2'><b><br>สถานะ : ผ่านการยืนยันแล้ว</font></b>
                    {/if}
                    </div></td><td width='50%'><a href="a_frienddata.php?id={$user->getId()}&do=4"><img src="http://image.friends.muict9.net/friendster.png" width="60" height="60" align="middle" /> <strong>RESET PASS!</strong></a>
                </div>
                </a></td>
            </tr>
        </table>
        <br />

        {if $email_sent}ส่งอีเมลเรียบร้อยแล้ว{/if}

        <form id="form2" name="form2" method="post" action="">
            <p>ส่ง E-mail ถึงคนนี้ [อย่าลืมระบุวิธีติดต่อกลับ]</p>
            <p>
                <label>
                    <textarea name="data" id="data" cols="45" rows="5"></textarea>
                </label>
                &nbsp;&nbsp;
                <input type="submit" name="submit" value="ส่ง" />
                <br />
                <label></label>
            </p>
        </form>
        <p>&nbsp;</p>
    {/if}
</center>
{/block}
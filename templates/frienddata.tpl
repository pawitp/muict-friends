{extends "layout.tpl"}
{block name="styles"}
.style2 { font-size: 12px }
.style4 {
	font-size: 9px;
	color: #FFFFFF;
}
{/block}
{block name="body"}
<center>
  <table width="40%" border="1">
    <tr>

      <td><div align="center">
        <table width="100%" border="0" align="center">
          <tr>
            <td width="50%"><div align="center">
                <tr>
                    <td width="50%"><div align="center"><img src='{$user->getImageUrl()|check_empty_image}' width="90%" /></div></td>
                    <td width="50%"><div align="center"><img src='{$user->getFacebookImageUrl()|check_empty_image}' width="90%" hspace="5" vspace="5" /></div></td>
                </tr>
                <tr>
                    <td><div align="center"><strong>USER UPLOAD</strong></div></td>
                    <td><div align="center"><strong>FACEBOOK</strong></div></td>
                </tr>
            </table><br />
          <span class="style2"><strong>NAME :</strong>&nbsp;
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
                        <td bgcolor="#FFFFFF"> <span class="style4">x</span><br />
                            &nbsp;&nbsp;&nbsp;{$about}

                            {$bd = $user->getDisplayBirthday()}
                            {if $bd}<br><br>&nbsp;&nbsp;&nbsp;<b>วันเกิด : </b>{$bd}{/if}
                            <br />
                            <span class="style4">a</span><br /></td>
                    </tr>
                </table></td>
        </tr>

      </table></td>
    </tr>
  </table>
</center>
{/block}
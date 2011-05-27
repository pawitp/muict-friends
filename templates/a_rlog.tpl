{extends "layout.tpl"}
{block name="body"}
<table width="80%" border="1">
    <tr>
        <td><div align="center"><strong>TIME</strong></div></td>
        <td><div align="center"><strong>IP</strong></div></td>
        <td><div align="center"><strong>BROWSER</strong></div></td>
        <td><div align="center"><strong>FILE</strong></div></td>
        <td><div align="center"><strong>ID</strong></div></td>
        <td><div align="center"><strong>TAG</strong></div></td>
        <td><div align="center"><strong>DATA1</strong></div></td>
        <td><div align="center"><strong>DATA2</strong></div></td>
    </tr>
{foreach $rows as $row}
    <tr>
        <td><div align="center"><strong>{$row.time}</strong></div></td>
        <td><div align="center"><strong>{$row.ip}</strong></div></td>
        <td><div align="center"><strong>{$row.user_agent}</strong></div></td>
        <td><div align="center"><strong>{$row.path}</strong></div></td>
        <td><div align="center"><strong>{$row.id}</strong></div></td>
        <td><div align="center"><strong>{$row.tag}</strong></div></td>
        <td><div align="center"><strong>{$row.data1}</strong></div></td>
        <td><div align="center"><strong>{$row.data2}</strong></div></td>
    </tr>
{/foreach}
</table>
<a href="?start={$next}">Older</a>
<a href="?nopageview=1">Not pageview</a>
{/block}
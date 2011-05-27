<?php
function smarty_modifier_link($string) {
    return "<a href=\"$string\">$string</a>";
}
<?php
function smarty_modifier_zerotodash($string) {
    if ($string == 0) {
        return "-";
    }
    else {
        return $string;
    }
}
<?php
function smarty_modifier_check_exists($string) {
    if (!empty($string)) {
        return $string;
    }
    else {
        return "<img src='http://image.friends.muict9.net/fail.png' width='27' height='27' />";
    }
}
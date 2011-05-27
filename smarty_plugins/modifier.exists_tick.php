<?php
function smarty_modifier_exists_tick($string) {
    if (!empty($string)) {
        return "<img src='http://image.friends.muict9.net/pass.png' width='27' height='27' />";
    }
    else {
        return "<img src='http://image.friends.muict9.net/fail.png' width='27' height='27' />";
    }
}
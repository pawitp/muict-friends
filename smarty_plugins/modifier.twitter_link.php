<?php
function smarty_modifier_twitter_link($string) {
    return "<a href='http://www.twitter.com/$string'>$string</a>";
}
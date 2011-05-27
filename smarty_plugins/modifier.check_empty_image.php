<?php
function smarty_modifier_check_empty_image($string) {
    if (!empty($string)) {
        return $string;
    }
    else {
        return "upload_images/no_image.jpg.png";
    }
}
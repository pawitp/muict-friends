<?php
function smarty_function_facebook_link($params, $template) {
    /* @var User $user */
    $user = $params['user'];

    return "<a href=\"" . $user->getFacebookUrl() . "\">" . $user->getFacebookName() . "</a>";
}
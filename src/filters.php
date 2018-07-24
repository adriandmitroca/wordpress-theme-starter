<?php

add_filter('get_custom_logo', function ($html) {
    return str_replace('custom-logo-link', 'custom-logo-link navbar-brand', $html);
});

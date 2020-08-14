<?php

add_filter('get_custom_logo', function ($html) {
    return str_replace('custom-logo-link', 'custom-logo-link navbar-brand', $html);
});

add_filter('embed_oembed_html', function ($html, $url, $attr) {
    return $html !== '' ? '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>' : '';
}, 10, 3);

add_filter('use_block_editor_for_post', '__return_false', 10);

add_filter('wp_get_attachment_image_attributes', function ($attr) {
    $attr['class'] .= ' img-fluid';

    return $attr;
});

add_filter('xmlrpc_enabled', '__return_false');

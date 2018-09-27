<?php

add_filter('get_custom_logo', function ($html) {
    return str_replace('custom-logo-link', 'custom-logo-link navbar-brand', $html);
});

add_filter('embed_oembed_html', function ($html, $url, $attr) {
    return $html !== '' ? '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>' : '';
}, 10, 3);

add_filter('acf/settings/show_admin', function () {
    return WP_DEBUG;
});
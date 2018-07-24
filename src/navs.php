<?php
/**
 * ------------------------------------------------------------------------
 * Theme's Navigations
 * ------------------------------------------------------------------------
 * This file is for registering your theme's custom navigation areas
 * where various menus can be assigned by site administrators.
 */

add_action('after_setup_theme', function () {
    register_nav_menus([
        'top' => __('Top Navigation', 'boilerplate'),
        'bottom' => __('Bottom Navigation', 'boilerplate'),
    ]);
});

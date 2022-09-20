<?php

if (function_exists('acf_add_options_page')) {
    $parent = acf_add_options_page([
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'redirect' => false,
        'position' => 99.1,
    ]);

    acf_add_options_sub_page([
        'page_title' => 'Scripts Settings',
        'menu_title' => 'Scripts',
        'parent_slug' => $parent['menu_slug'],
    ]);

    acf_add_options_sub_page([
        'page_title' => 'Header Settings',
        'menu_title' => 'Header',
        'parent_slug' => $parent['menu_slug'],
        'post_id' => 'header',
    ]);

    acf_add_options_sub_page([
        'page_title' => 'Footer Settings',
        'menu_title' => 'Footer',
        'parent_slug' => $parent['menu_slug'],
        'post_id' => 'footer',
    ]);
}

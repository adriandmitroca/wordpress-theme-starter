<?php
/**
 * ------------------------------------------------------------------------
 * Theme's Assets
 * ------------------------------------------------------------------------
 * This file is for registering your theme's stylesheets and JavaScript files. Here,
 * you can add your very own files or de-register unwanted stuff that comes from plugins.
 */

add_action('wp_enqueue_scripts', function () {
    wp_deregister_script('jquery');

    wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js', [], false, true);

    wp_enqueue_style(
        'main-css',
        get_template_directory_uri() . '/dist/css/app.css',
        false,
        filemtime(get_template_directory() . '/dist/css/app.css')
    );

    wp_enqueue_script(
        'main-js',
        get_template_directory_uri() . '/dist/js/app.js',
        ['jquery'],
        filemtime(get_template_directory() . '/dist/js/app.js'),
        true
    );
});

add_action('wp_print_styles', function () {
    wp_deregister_style('contact-form-7');
});

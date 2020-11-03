<?php

add_action('tgmpa_register', function () {
    $plugins = [
        [
            'name' => 'Advanced Custom Fields PRO',
            'slug' => 'advanced-custom-fields-pro',
            'source' => 'https://dmitroca.pl/wordpress/acf-latest.zip',
            'required' => true,
        ],
        [
            'name' => 'WP Sync DB',
            'slug' => 'wp-sync-db',
            'source' => 'https://github.com/adriandmitroca/wp-sync-db/archive/master.zip',
        ],
        [
            'name' => 'WP Sync DB Media Files',
            'slug' => 'wp-sync-db-media-files',
            'source' => 'https://github.com/wp-sync-db/wp-sync-db-media-files/archive/master.zip',
        ],
        [
            'name' => 'WordPress SEO by Yoast',
            'slug' => 'wordpress-seo',
            'is_callable' => 'wpseo_init',
        ],
        [
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => true,
        ],
        [
            'name' => 'Safe SVG',
            'slug' => 'safe-svg',
        ],
        [
            'name' => 'Duplicate Post',
            'slug' => 'duplicate-post',
        ],
    ];

    $config = [
        'id' => 'wordpress-theme-starter',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'parent_slug' => 'themes.php',
        'capability' => 'edit_theme_options',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
    ];

    tgmpa($plugins, $config);
});

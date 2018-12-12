<?php
/**
 * ------------------------------------------------------------------------
 * Theme's Includes
 * ------------------------------------------------------------------------
 * The `function.php` file is should responsible only for including theme's
 * components. Your theme custom logic should be distributed
 * across separate files in the `/src` directory.
 */

spl_autoload_register(function ($class) {
    $class = str_replace(['Rcore\\', '\\'], ['', '/'], $class);
    $CLASSES_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
    $file = $CLASSES_DIR . $class . '.php';

    if (file_exists($file)) {
        include $file;
    }
});

require_once 'src/vendor/class-tgm-plugin-activation.php';
require_once 'src/vendor/class-wp-bootstrap-navwalker.php';
require_once 'src/vendor/class-sage-wrapping.php';
require_once 'src/class-module-preview.php';

require_once 'src/helpers.php';
require_once 'src/plugins.php';
require_once 'src/supports.php';
require_once 'src/post-types.php';
require_once 'src/option-pages.php';
require_once 'src/filters.php';
require_once 'src/assets.php';
require_once 'src/navs.php';

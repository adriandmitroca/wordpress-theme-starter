<?php

if (! function_exists('get_svg')) {
    function get_svg($name)
    {
        return \Rcore\Helpers\Image::svg($name);
    }
}

if (! function_exists('the_svg')) {
    function the_svg($name)
    {
        echo \Rcore\Helpers\Image::svg($name);
    }
}

if (! function_exists('get_image')) {
    function get_image($filename)
    {
        return \Rcore\Helpers\Image::imageUrl($filename);
    }
}

if (! function_exists('the_image')) {
    function the_image($filename)
    {
        echo \Rcore\Helpers\Image::imageUrl($filename);
    }
}

if (! function_exists('safe_email')) {
    function safe_email($email)
    {
        echo \Rcore\Helpers\Html::email($email);
    }
}

if (! function_exists('phone_link')) {
    function phone_link($phone, $class = '')
    {
        echo \Rcore\Helpers\Html::phone($phone, $class);
    }
}

if (! function_exists('pagination')) {
    function pagination()
    {
        echo \Rcore\Helpers\Pagination::render();
    }
}

if (! function_exists('render')) {
    function render($template, $vars = [])
    {
        \Rcore\Helpers\Template::render($template, $vars);
    }
}

if (! function_exists('modular_template')) {
    function modular_template($modules = null, $occurrences = 1)
    {
        \Rcore\Helpers\Template::load($modules, $occurrences);
    }
}

if (! function_exists('load_page_modules')) {
    function load_page_modules(WP_Post $page)
    {
        \Rcore\Helpers\Template::loadForPage($page);
    }
}

if (! function_exists('find_page_by_module')) {
    function find_page_by_module($name)
    {
        return \Rcore\Helpers\Template::getPageNameByModuleName($name);
    }
}

if (! function_exists('str_contains')) {
    function str_contains($haystack, $needles)
    {
        return \Rcore\Helpers\Str::contains($haystack, $needles);
    }
}

if (! function_exists('str_limit')) {
    function str_limit($value, $limit = 100, $end = '...')
    {
        return \Rcore\Helpers\Str::limit($value, $limit, $end);
    }
}

if (! function_exists('starts_with')) {
    function starts_with($haystack, $needles)
    {
        return \Rcore\Helpers\Str::startsWith($haystack, $needles);
    }
}

if (! function_exists('ends_with')) {
    function ends_with($haystack, $needles)
    {
        return \Rcore\Helpers\Str::endsWith($haystack, $needles);
    }
}

if (! function_exists('fetch_video_thumbnail')) {
    function fetch_video_thumbnail($url)
    {
        return Rcore\Helpers\Video::fetchThumbnail($url);
    }
}

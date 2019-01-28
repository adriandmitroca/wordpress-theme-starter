<?php

namespace Rcore\Helpers;

class Image
{
    public static function svg($name)
    {
        ob_start();

        include get_template_directory() . '/static/vectors/' . $name . '.svg';

        return ob_get_clean();
    }

    public static function svgHtml($name, $class = '')
    {
        return '<span class="svg-container ' . $class . '">' . self::svg($name) . '</span>';
    }

    public static function imageUrl($filename)
    {
        if (Str::endsWith($filename, '.svg')) {
            return get_template_directory_uri() . '/static/vectors/' . $filename . '?v=' . filemtime(get_template_directory() . '/static/vectors/' . $filename);
        }

        return get_template_directory_uri() . '/static/images/' . $filename . '?v=' . filemtime(get_template_directory() . '/static/vectors/' . $filename);
    }
}

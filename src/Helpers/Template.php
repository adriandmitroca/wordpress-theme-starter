<?php

namespace Rcore\Helpers;

class Template
{
    public static function load($modules = null, $occurrences = 1)
    {
        if ($occurrences > 20) {
            trigger_error(
                'Danger for infinity loop has been detected. Only 20 nesting levels are allowed.',
                E_USER_ERROR
            );
            exit();
        }

        $modules = $modules ?: ($occurrences === 1 ? get_field('sections') : []);

        foreach ($modules ?: [] as $module) {
            if ($module['acf_fc_layout'] === 'predefined_template' && $module['template']) {
                foreach ($module['template'] as $nested) {
                    self::load(get_field('sections', $nested), $occurrences += 1);
                }
            } else {
                $path = get_template_directory() . "/acf-modules/{$module['acf_fc_layout']}.php";

                if (file_exists($path)) {
                    include $path;
                }
            }
        }
    }

    public static function loadForPage(\WP_Post $data)
    {
        global $post;
        $post = $data;
        self::load();
        wp_reset_postdata();
    }

    public static function getPageNameByModuleName($name)
    {
        $result = \ModulePreview::findExample($name, 1);

        return $result['page'] ?? null;
    }

    public static function render($template, $vars = [])
    {
        extract($vars);

        include(get_template_directory() . DIRECTORY_SEPARATOR . $template . '.php');
    }
}

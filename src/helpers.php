<?php

function get_svg($name)
{
    ob_start();
    include get_template_directory() . '/static/vectors/' . $name . '.svg';

    return ob_get_clean();
}

function get_svg_url($name)
{
    return get_template_directory_uri() . '/static/vectors/' . $name . '.svg';
}

function the_svg($name, $class = '')
{
    echo '<span class="svg-container ' . $class . '">' . get_svg($name) . '</span>';
}

function get_image($image)
{
    if (ends_with($image, '.svg')) {
        return get_template_directory_uri() . '/static/vectors/' . $image;
    }

    return get_template_directory_uri() . '/static/images/' . $image;
}

function the_image($name)
{
    echo get_image($name);
}

function safe_email($email)
{
    $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';

    $key = str_shuffle($character_set);
    $cipher_text = '';
    $id = 'e' . rand(1, 999999999);
    $length = strlen($email);

    for ($i = 0; $i < $length; $i++) {
        $cipher_text .= $key[strpos($character_set, $email[$i])];
    }

    $script = 'var a="' . $key . '";var b=a.split("").sort().join("");var c="' . $cipher_text . '";var d="";';

    $script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';

    $script .= 'document.getElementById("' . $id . '").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';

    $script = 'eval("' . str_replace(['\\', '"'], ['\\\\', '\"'], $script) . '")';

    $script = '<script type="text/javascript">/*<![CDATA[*/' . $script . '/*]]>*/</script>';

    echo '<span id="' . $id . '">[javascript protected email address]</span>' . $script;
}

function phone_link($phone, $class = '')
{
    echo '<a class="' . $class . '" href="tel:' . str_replace(' ', '', $phone) . '">' . $phone . '</a>';
}

function pagination()
{
    if (is_singular()) {
        return;
    }

    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** Add current page to the array */
    if ($paged >= 1) {
        $links[] = $paged;
    }

    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<ul class="pagination justify-content-center">' . "\n";

    /** Previous Post Link */
    if (get_previous_posts_link()) {
        printf(
            '<li class="page-item">' . str_replace(
                '<a',
                '<a class="page-link"',
                get_previous_posts_link('<span aria-hidden="true">&laquo;</span>')
            ) . '</li>'
        );
    }

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active page-item"' : ' class="page-item"';

        printf(
            '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n",
            $class,
            esc_url(get_pagenum_link(1)),
            '1'
        );

        if ( ! in_array(2, $links)) {
            echo '<li><span>…</span></li>';
        }
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="active page-item"' : ' class="page-item"';
        printf(
            '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n",
            $class,
            esc_url(get_pagenum_link($link)),
            $link
        );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array($max, $links)) {
        if ( ! in_array($max - 1, $links)) {
            echo '<li><span>…</span></li>';
        }

        $class = $paged == $max ? ' class="active page-item"' : ' class="page-item"';
        printf(
            '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n",
            $class,
            esc_url(get_pagenum_link($max)),
            $max
        );
    }

    /** Next Post Link */
    if (get_next_posts_link()) {
        printf(
            '<li class="page-item">' . str_replace(
                '<a',
                '<a class="page-link"',
                get_next_posts_link('<span aria-hidden="true">&raquo;</span>')
            ) . '</li>'
        );
    }

    echo '</ul>';
}

function load_module($module)
{
    $file_path = get_template_directory() . "/acf-modules/{$module['acf_fc_layout']}.php";

    if (file_exists($file_path)) {
        include $file_path;
    }
}

function modular_template()
{
    $modules = get_field('sections');

    if (is_array($modules)) {
        foreach ($modules as $key => $module) {
            load_module($module);

            while ('predefined_template' === $module['acf_fc_layout']) {
                $nested_modules = get_field('sections', $module['template']);

                if ( ! $nested_modules) {
                    break;
                }

                foreach ($nested_modules as $key => $module) {
                    if ( ! empty($module['template']) && $module['template'] instanceof WP_Post) {
                        $nested_modules_inner = get_field('sections', $module['template']);
                        foreach ($nested_modules_inner as $module) {
                            load_module($module);
                        }
                    } else {
                        load_module($module);
                    }
                }
            }
        }
    }
}

function ends_with($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || (substr($haystack, -$length) === $needle);
}
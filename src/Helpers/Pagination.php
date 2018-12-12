<?php

namespace Rcore\Helpers;

class Pagination
{
    public static function render()
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

        echo '<div class="pagination-wrap d-flex align-items-center justify-content-between">';

        /** Previous Post Link */
        echo '<div class="prev">';
        echo get_previous_posts_link('<p aria-hidden="true"><span class="svg-container icon">' . get_svg('long-arrow-left') . '</span> Previous page</p>');
        echo '</div>';

        echo '<ul class="pagination justify-content-center">' . "\n";

        /** Link to first page, plus ellipses if necessary */
        if ( ! in_array(1, $links)) {
            $class = 1 == $paged ? ' class="active page-item"' : ' class="page-item"';

            printf('<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)),
                '1');

            if ( ! in_array(2, $links)) {
                echo '<li><span>…</span></li>';
            }
        }

        /** Link to current page, plus 2 pages in either direction if necessary */
        sort($links);
        foreach ((array)$links as $link) {
            $class = $paged == $link ? ' class="active page-item"' : ' class="page-item"';
            printf('<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)),
                $link);
        }

        /** Link to last page, plus ellipses if necessary */
        if ( ! in_array($max, $links)) {
            if ( ! in_array($max - 1, $links)) {
                echo '<li><span>…</span></li>';
            }

            $class = $paged == $max ? ' class="active page-item"' : ' class="page-item"';
            printf('<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)),
                $max);
        }

        echo '</ul>';

        /** Next Post Link */
        echo '<div class="next">';
        echo get_next_posts_link('<p aria-hidden="true">Next page <span class="svg-container icon">' . get_svg('long-arrow-right') . '</span></p>');
        echo '</div>';

        echo '</div>';
    }

}
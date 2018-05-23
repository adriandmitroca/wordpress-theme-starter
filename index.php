<?php
/**
 * The most generic template file in hierarchy.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		if ( is_single() || is_page() ) {
			get_template_part( 'templates/content-single', get_post_type() );
		} else {
			get_template_part( 'templates/content', get_post_type() );
		}
	}
}

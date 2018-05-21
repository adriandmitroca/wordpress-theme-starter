<?php
/**
 * The most generic template file in hierarchy.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<?php if ( have_posts() ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();
?>
		<?php if ( is_single() || is_page() ) : ?>
			<?php get_template_part( 'templates/content-single', get_post_type() ); ?>
		<?php else : ?>
			<?php get_template_part( 'templates/content', get_post_type() ); ?>
		<?php endif ?>
	<?php endwhile; ?>
<?php
endif;

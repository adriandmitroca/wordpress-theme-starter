<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1">

    <?php wp_head() ?>
    <?= ! WP_DEBUG ? get_field('scripts_head', 'option') : '' ?>
</head>
<body <?php body_class() ?>>
<?= ! WP_DEBUG ? get_field('scripts_top', 'option') : '' ?>

<div class="wrap" role="document">
    <?php get_header() ?>
  <div class="content">
    <main>
        <?php require template_path() ?>
    </main>
  </div>
</div>

<?php
get_footer();
wp_footer();
?>
<?= ! WP_DEBUG ? get_field('scripts_bottom', 'option') : '' ?>
</body>
</html>

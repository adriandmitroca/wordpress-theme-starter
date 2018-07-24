<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
      <?php if (has_custom_logo()) : ?>
          <?php the_custom_logo() ?>
      <?php else : ?>
        <a class="navbar-brand" href="<?= esc_url(home_url('/')) ?>">
            <?php bloginfo('name') ?>
        </a>
      <?php endif ?>

      <?php if (has_nav_menu('top')) : ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNav"
                aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
          <?php
          wp_nav_menu([
              'theme_location' => 'top',
              'depth' => 2,
              'container' => 'div',
              'container_class' => 'collapse navbar-collapse',
              'container_id' => 'topNav',
              'menu_class' => 'navbar-nav ml-auto',
              'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
              'walker' => new WP_Bootstrap_Navwalker(),
          ])
          ?>
      <?php endif ?>
  </div>
</nav>

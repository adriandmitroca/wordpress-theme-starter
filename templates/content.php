<div class="container">
  <div class="my-4">
    <a href="<?php the_permalink() ?>" title=<?php the_title() ?>>
        <?php the_title() ?>
    </a>
    by <i><?= get_the_author() ?></i>
  </div>
</div>

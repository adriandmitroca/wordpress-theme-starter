<?php
/**
 * Template part for displaying sidebar content
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 */
?>

<aside class="sidebar">
  <div class="sidebar__item">
    <h3 class="sidebar__title"><?= __('Categories', 'boilerplate') ?></h3>
    <div class="categories">
        <?php wp_list_categories(['taxonomy' => 'category', 'title_li' => '']) ?>
    </div>
  </div>
  <div class="sidebar__item">
    <h3 class="sidebar__title"><?= __('Pages', 'boilerplate') ?></h3>
    <div class="pages">
        <?php wp_list_pages(['title_li' => '']) ?>
    </div>
  </div>
</aside>

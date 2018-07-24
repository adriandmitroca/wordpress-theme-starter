<article class="single">
  <div class="container my-5">
    <div class="single__head mb-4">
      <h1 class="single__title"><?php the_title() ?></h1>
      <small>by <?= get_the_author() ?> | <?= get_the_date() ?></small>
    </div>
    <div class="single__content wysiwyg">
        <?php the_content() ?>
    </div>
  </div>
</article>

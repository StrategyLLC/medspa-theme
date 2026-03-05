<?php while (have_posts()) : the_post(); ?>
<div class="ll-one-column is-first" data-component="one-column">
  <div class="container">
    <div class="row row-justify-center animated-row">
      <div class="col-sm-8of12 wysiwyg">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php
/*
Template Name: Default Content (No Components)
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
<?php endwhile; ?>

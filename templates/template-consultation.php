<?php
/*
Template Name: Consultation
*/
?>

<?php while (have_posts()) : the_post(); ?>

  <?php get_template_part('templates/partials/components')  ?>
  <?php if ( shortcode_exists( 'vac_virtual_consultation' ) ) : ?>
    <?php echo do_shortcode( '[vac_virtual_consultation]' ) ?>
  <?php endif; ?>
<?php endwhile; ?>

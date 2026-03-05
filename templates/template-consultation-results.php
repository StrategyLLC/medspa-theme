<?php
/*
Template Name: Consultation Results
*/
?>

<?php while (have_posts()) : the_post(); ?>

  <?php get_template_part('templates/partials/components')  ?>
  <?php if ( shortcode_exists( 'vac_virtual_consultation_results' ) ) : ?>
    <?php echo do_shortcode( '[vac_virtual_consultation_results]' ) ?>
  <?php endif; ?>
<?php endwhile; ?>

<?php
/*
Template Name: Quoter
*/
?>
<div class="ll-quoter-form spacing-top-medium spacing-bottom-medium" data-component="quoter-form">
  <div class="container">
    <div class="ll-quoter-form__form">
      <?php if ( function_exists('gravity_form') ) : ?>
        <?php gravity_form(get_field( 'form' ), false, false, false, '', true); ?>
      <?php endif; ?>
    </div> <!-- /.ll-quoter-form__form -->
  </div> <!-- /.container -->
</div> <!-- /.ll-quoter-form -->

<?php
if ( $_GET['input'] ) {
  $input = json_decode( str_replace( '\"', '"',  $_GET['input'] ) );
  $concern_selections = $input;
  $username = $_GET['username'] ?: false;
} else {
  vac_add_notice( 'error', 'No query string found.' );
}
?>
<div class="ll-vac spacing-top-medium spacing-bottom-medium">
  <div class="container">

    <?php vac_display_notices(); ?>

    <div class="vac__results">

      <h1 class="vac__results__title">Virtual Consultation Results</h1>

      <?php if ( $username ) : ?>
        <p class="vac__results__subtitle">Customized for <span><?php echo $username; ?></span></p>
      <?php endif; ?>

      <p class="vac__results__subtext">Here's a list of the best-suited treatments for you, from head to toe!</p>

      <?php vac_get_results( $concern_selections ); ?>

    </div>

  </div>
</div>

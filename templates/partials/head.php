<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">

  <?php
    $environment = get_field( 'global_environment', 'option' );
    $google_analytics = get_field( 'global_google_analytics', 'option' );
  ?>

  <?php if ( $environment == 'production' && isset( $google_analytics ) ) { // Google Analytics
    echo $google_analytics;
  } ?>

  <?php wp_head(); ?>
</head>

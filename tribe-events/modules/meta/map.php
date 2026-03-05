<?php
global $post;

  $venue = tribe_get_venue_id( $post->ID );
  $locations = array(
    0 => array(
      'map_pin_placement' => get_field( 'coordinates', $venue ),
      'address' => array(
        'street_address' => tribe_get_address( $post->ID ),
        'city' => tribe_get_city( $post->ID ),
        'state' => tribe_get_state( $post->ID ),
        'zip' => tribe_get_zip( $post->ID )
      )
    )
  );
  ll_include_component(
    'google-map',
    array(
      'locations' => $locations
    ),
    array(
      'classes' => array( 'spacing-top-none','spacing-bottom-medium' ),
      'id' => 'gmap-1'
    )
  );
?>

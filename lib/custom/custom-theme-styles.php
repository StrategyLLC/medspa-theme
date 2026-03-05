<?php
//register Component Setup options page
if( function_exists('acf_add_options_page') ) {
  acf_add_options_sub_page(array(
    'page_title'  => 'Theme Options',
    'menu_title'  => 'Theme Options',
    'parent_slug'   => 'site-options',
    'capability' => 'activate_plugins'
  ));
}

add_filter('acf/load_field/type=select', 'll_load_font_field_choices');
function ll_load_font_field_choices( $field ) {
  if ( strpos( $field['name'], 'font-family' ) !== false ) {

    //be sure the choices are empty, just in case
    $field['choices'] = array();

    //get fonts
    $font_one = get_field( 'global_font_1', 'option' );
    $font_two = get_field( 'global_font_2', 'option' );

    if ( !$font_one ) {
      $font_one = array('font' => 'Roboto');
    }

    $field['choices'][$font_one['font']] = $font_one['font'];

    if ( $font_two ) {
      $field['choices'][$font_two['font']] = $font_two['font'];
    }
  }

  // return the field
  return $field;
}

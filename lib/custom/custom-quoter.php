<?php

add_filter( 'gform_field_content', function ( $field_content, $field ) {
    if ( ( !IS_ADMIN && ( $field->type == 'checkbox' || $field->type == 'radio' ) ) &&  ( strpos($field->cssClass, 'field-has-icons') !== false ) ) {

      //list of new classes to add / replace to the gfield_container. This just adds a new ginput_container_radio_icons
      //or ginput_container_checkbox_icons class depending on the type
      $container_class = "class='ginput_container ginput_container_{$field->type} ginput_container_{$field->type}_icons'";

      //setup the new class string withint the original output
      $field_content = str_replace( "class='ginput_container ginput_container_{$field->type}'", $container_class ,$field_content );
    }

    if ( !IS_ADMIN && ($field->type == 'slider') ) {
      // var_dump( $field->type );
      // $field_content = str_replace( "class='ginput_container ginput_container_{$field->type}'", $container_class ,$field_content );
    }

    return $field_content;
}, 10, 2 );

add_filter( 'gform_field_choice_markup_pre_render', function ( $choice_markup, $choice, $field, $value ) {
    if ( ( !IS_ADMIN && ( $field->type == 'checkbox' || $field->type == 'radio' ) ) &&  ( strpos($field->cssClass, 'field-has-icons') !== false ) ) {
      $group_id;
      $icons;
      $class_group = explode( ' ', $field->cssClass );
      foreach ($class_group as $key => $class_name) {

        //if the class doesn't have an icon-group class attached to it return the field content
        if ( strpos( $class_name, 'icon-group' ) !== false ) {
          $split_group_id = explode( '-', $class_name );
          $group_id = (int) $split_group_id[2];
        }
      }


      if ( !$group_id || !is_numeric( $group_id ) )
        return $choice_markup;

      if( have_rows('icon_groups', 'option') ):

          while ( have_rows('icon_groups', 'option') ) : the_row();
            $index = get_row_index();
            if ( $index == $group_id )
              $icons = get_sub_field( 'icons' );
          endwhile;
      endif;

      //find the corresponding index of the choice that corresponds with
      //the correct icon. This will be the last number of the label id
      $keys = get_string_between( $choice_markup, "id='label_", "'>" );
      $key = explode("_", $keys);
      $icon_index = $key[2];

      //for some reason checkboxes don't start at zero like radios do,
      //so if it's a checkbox, subtract one to get the correct index
      if ( $field->type == 'checkbox' ) {
        $icon_index = $key[2] - 1;
      }

      //setup the new markup and then replace it within the original output
      $label_string = "id='label_{$keys}'><span class='svg-wrapper'>{$icons[$icon_index]['icon']}</span><span class='label-text'>{$choice['text']}</span></label>";
      $choice_markup = str_replace( "id='label_{$keys}'>{$choice['text']}", $label_string ,$choice_markup );
    }

    return $choice_markup;
}, 10, 4 );


if( function_exists('acf_add_options_page') ) {
  acf_add_options_page('Quoter Icons');
}

function acf_before_quoter_icon_options( $field ) {
  $page = $_GET['page'];

  if ( $page == 'acf-options-quoter-icons' && $field['_name'] == 'icon' ) {
  ?>
    <div class="ll-quoter-icon-input">
    <div class="ll-quoter-icon-wrapper" data-input="<?php echo $field['id']; ?>">
      <?php echo $field['value']; ?>
    </div>
  <?php
  }
}

add_filter('acf/render_field/type=textarea', 'acf_before_quoter_icon_options', 9, 2);


function acf_after_quoter_icon_options( $field ) {
  $page = $_GET['page'];

  if ( $page == 'acf-options-quoter-icons' && $field['_name'] == 'icon' ) {
  ?>
    </div>
  <?php
  }
}

add_filter('acf/render_field/type=textarea', 'acf_after_quoter_icon_options', 12, 2);

function ll_quoter_options_styles() {
  ?>
  <style type="text/css">

    .acf-fc-layout-handle {
      font-size: 12px !important;
    }

    [data-name="icon_groups"] > div > p.description {
      background-color: white;
      padding: 1em;
    }

    .ll-group-label {
      display: none;
    }

    .ll-group-title {
      position: relative;
      display: inline-block;
      padding-top: 1em;
      margin-left: 35px;
      color: #333;
      font-size: 10px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .ll-group-title:empty {
      /*padding: 0;*/
    }

    .ll-group-title:empty::before {
      content: 'place custom label here for your own organizational purposes';
      font-size: 1em;
      color: #d0d0d0;
      display: block;
      font-weight: normal;
    }

    .ll-quoter-icon-input {
      background-color: #f5f5f5;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
    }

    .ll-quoter-icon-wrapper {
      font-size: 64px;
      width: 1em;
      padding: 5px;
      -webkit-box-flex: 0;
          -ms-flex: 0 0 auto;
              flex: 0 0 auto;
    }

    .ll-quoter-icon-wrapper svg {
      display: inline-block;
      width: 1em;
      height: 1em;
    }

    .ll-quoter-icon-wrapper + textarea {
      -webkit-box-flex: 1;
          -ms-flex: 1 1 auto;
              flex: 1 1 auto;
    }

  </style>
  <?php
}

add_action('acf/input/admin_head', 'll_quoter_options_styles');

/**
 * Set up javascript for admin bracket views
 */
function ll_quoter_icon_options($hook) {
  wp_enqueue_script('ll-admin-script', get_stylesheet_directory_uri().'/assets/js/ll_quoter_icon_options.js', array('jquery'), null, true);
}

add_action( 'admin_enqueue_scripts', 'll_quoter_icon_options' );

add_filter( 'gform_previous_button', 'quoter_custom_gform_previous', 10, 2 );
function quoter_custom_gform_previous( $previous_button, $form ) {
    if ( $form['cssClass'] == 'form-quoter' ) {
      $previous_button = '<label class="quoter__previous"><span class="quoter__icon-wrapper"><svg class="icon icon-chevron-left"><use xlink:href="#icon-chevron-left"></use></svg></span>' . $previous_button . '</label>';
    }

    return $previous_button;
}

add_filter( 'gform_next_button', 'quoter_custom_gform_next', 10, 2 );
function quoter_custom_gform_next( $next_button, $form ) {
    if ( $form['cssClass'] == 'form-quoter' ) {
      $next_button = '<label class="quoter__next">' . $next_button . '<span class="quoter__icon-wrapper"><svg class="icon icon-chevron-right"><use xlink:href="#icon-chevron-right"></use></svg></label>';
    }

    return $next_button;
}

<?php
/**
 *
 * Lifted Logic custom AJAX functions
 *
 */


/**
 * Load Gallery SLider popup
 */
function ll_load_gallery_popup() {
  $post_id = $_POST['postId'];

  $template = '';

  if ( $post_id ) {
    $galleries    = get_field( 'galleries', $post_id );
    $items = array();

    foreach ($galleries as $key => $gallery) {
      foreach ($gallery['gallery_items'] as $key => $gallery_item) {
        $items[] = $gallery_item;
      }
    }
    $template = ll_include_component(
      'photo-slider',
      array(
        'slides' => $items,
        'image_contain' => 'contain',
        'type' => ''
      ),
      array(
        'classes' => array( 'top-spacing-none', 'bottom-spacing-none' )
      ),
      true
    );
  }

  //return values
  echo json_encode( array( 'template' => $template ) );

  //end function
  wp_die();
}

add_action( 'wp_ajax_ll_load_gallery_popup', 'll_load_gallery_popup' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_ll_load_gallery_popup', 'll_load_gallery_popup' );


/**
 * Load Content popup
 */
function ll_load_content_popup() {
  $data = $_POST['content'];
  $template = '';

  if ( $data ) {
    $content = wp_unslash( $data['content'] );
    $image = wp_unslash( $data['image'] );
    $template = ll_include_component(
      'content-popup-one',
      array(
        'content' => $content,
        'image'   => $image,
        'size'    => $_POST['size']
      ),
      array(),
      true
    );
  }

  //return values
  echo json_encode( array( 'template' => $template ) );

  //end function
  wp_die();
}

add_action( 'wp_ajax_ll_load_content_popup', 'll_load_content_popup' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_ll_load_content_popup', 'll_load_content_popup' );

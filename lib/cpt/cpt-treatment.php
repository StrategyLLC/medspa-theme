<?php
/**
 * Register the custom post type
 */
$post_types = get_field( 'theme_post_types', 'option' );
$treatment_active = false;
if ( is_array( $post_types ) ) {
  if ( in_array( 'll_treatment', $post_types ) ) {
    $treatment_active = true;
  }
}

if ( ! function_exists('register_treatment_custom_post_type') && $treatment_active ) {

  // Register Custom Post Type
  function register_treatment_custom_post_type() {
    $slug = ll_get_the_slug( get_field( 'page_for_treatments', 'option' ) );
    $labels = array(
      'name'                => 'Treatment',
      'singular_name'       => 'Treatment',
      'menu_name'           => 'Treatments',
      'parent_item_colon'   => 'Parent Treatment',
      'all_items'           => 'All Treatments',
      'view_item'           => 'View Treatment',
      'add_new_item'        => 'Add New Treatment',
      'add_new'             => 'New Treatment',
      'edit_item'           => 'Edit Treatment',
      'update_item'         => 'Update Treatment',
      'search_items'        => 'Search Treatment',
      'not_found'           => 'No treatment found',
      'not_found_in_trash'  => 'No treatment found in Trash',
    );
    $args = array(
      'label'               => 'treatment',
      'description'         => 'Treatment description',
      'labels'              => $labels,
      'supports'            => array( 'title', 'page-attributes', 'thumbnail', 'excerpt' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => false,
      'show_in_admin_bar'   => true,
      'menu_position'       => 20,
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'     => 'post'
    );

    if ( $slug ) {
      $args['has_archive'] = true;
      $args['rewrite'] = array('slug' => $slug);
    }

    register_post_type( 'll_treatment', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_treatment_custom_post_type', 0 );

}

// /**
//  * Custom taxonomies
//  */
if ( ! function_exists('register_treatment_taxonomies') ) {

  function register_treatment_taxonomies() {

    $slug = ll_get_the_slug( get_field( 'page_for_treatments', 'option' ) );

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
      'name'                => _x( 'Category', 'taxonomy general name' ),
      'singular_name'       => _x( 'Category', 'taxonomy singular name' ),
      'search_items'        => __( 'Search Categories' ),
      'all_items'           => __( 'All Categories' ),
      'parent_item'         => __( 'Parent Category' ),
      'parent_item_colon'   => __( 'Parent Category:' ),
      'edit_item'           => __( 'Edit Category' ),
      'update_item'         => __( 'Update Category' ),
      'add_new_item'        => __( 'Add New Category' ),
      'new_item_name'       => __( 'New Category Name' ),
      'menu_name'           => __( 'Categories' )
    );

    $args = array(
      'hierarchical'        => true,
      'labels'              => $labels,
      'show_ui'             => true,
      'show_admin_column'   => true,
      'query_var'           => true,
      'rewrite'             => array( 'slug' => $slug )
    );

    register_taxonomy( 'll_treatment_cat', array( 'll_treatment' ), $args ); // Must include custom post type name

  }

  add_action( 'init', 'register_treatment_taxonomies', 0 );

}

/**
 * Create ACF setting page under CPT menu
 */

if ( function_exists( 'acf_add_options_sub_page' ) ){
  acf_add_options_sub_page(array(
    'title'      => 'Treatment Settings',
    'parent'     => 'edit.php?post_type=ll_treatment',
    'capability' => 'manage_options'
  ));
}

/*
 * Show Custom Status if page is set as the treatments page
 */
add_filter( 'display_post_states', 'll_treatment_post_state' );
function ll_treatment_post_state( $states ) {
  global $post;
  $show_custom_state = $post->ID == get_field( 'page_for_treatments', 'option' );
  if ( $show_custom_state ) {
    $states[] = __( 'Treatments Page' );
  }
  return $states;
}

/*
 * create custom acf fields
 */
if( function_exists('acf_add_local_field_group') ) {
  acf_add_local_field_group(array(
    'key' => 'group_treatment_options',
    'title' => 'Treatment Options',
    'fields' => array(
      array(
        'key' => 'field_page_for_treatments',
        'label' => 'Page for Treatments',
        'name' => 'page_for_treatments',
        'type' => 'post_object',
        'post_type' => array(
          0 => 'page',
        ),
        'taxonomy' => array(
        ),
        'allow_null' => 1,
        'multiple' => 0,
        'return_format' => 'id',
        'ui' => 1,
        'wrapper' => array(
          'class' => 'acf-short',
        ),
      ),
      array(
        'key' => 'field_treatments_posts_per_page',
        'label' => 'Posts Per Page',
        'name' => 'treatments_posts_per_page',
        'type' => 'number',
        'step' => 1,
        'wrapper' => array(
          'class' => 'acf-short',
        ),
      ),
      array(
        'key' => 'field_treatments_post_layout',
        'label' => 'Post Layout',
        'name' => 'treatments_post_layout',
        'type' => 'button_group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'choices' => array(
          'card-grid' => 'Card Grid',
          'list-grid' => 'List Grid',
        ),
        'allow_null' => 0,
        'default_value' => 'card-grid',
        'layout' => 'horizontal',
        'return_format' => 'value',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-treatment-settings',
        ),
      ),
    ),
    'label_placement' => 'left',
    'position' => 'normal',
    'style' => 'seamless',
    'active' => 1,
  ));
}

/*
 * edit main treatments query based on custom option
 */
add_action( 'pre_get_posts', 'll_treatments_query' );
function ll_treatments_query($query) {
  if ( !is_admin() && $query->is_main_query() && ( is_post_type_archive( 'll_treatment' ) || is_tax( 'll_treatment_cat' ) ) ) {
    $posts_per_page = get_field( 'treatments_posts_per_page', 'option' );
    if ( $posts_per_page ) {
      $query->set('post_type', 'll_treatment');
      $query->set('posts_per_page', $posts_per_page);
      $query->set('orderby', 'menu_order');
    }
  }

  return $query;
}

<?php
//register Component Setup options page
if (function_exists('acf_add_options_page')) {
  acf_add_options_sub_page(
    array(
      'page_title' => 'Component Setup',
      'menu_title' => 'Component Setup',
      'parent_slug' => 'site-options',
      'capability' => 'activate_plugins'
    )
  );

  acf_add_options_sub_page(
    array(
      'page_title' => 'Component Types',
      'menu_title' => 'Component Types',
      'parent_slug' => 'site-options',
      'capability' => 'activate_plugins'
    )
  );

  acf_add_options_sub_page(
    array(
      'page_title' => 'Global Components',
      'menu_title' => 'Global Components',
      'parent_slug' => 'site-options',
      'capability' => 'activate_plugins'
    )
  );
}

//register the Component Setup fields
if (function_exists('acf_add_local_field_group')) {
  $args = array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-components.php',
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    $query->the_post();
    $components = $query->post;
  }

  wp_reset_postdata();
  if (! empty($components)) {
    $components = unserialize($components->post_content);
    $components = $components['layouts'];
  } else {
    $components = array();
  }

  $field_group = array(
    'key' => 'field_ll_component_setup',
    'title' => 'Components',
    'menu_order' => 0,
    'position' => 'acf_after_title',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-component-setup',
        ),
      ),
    ),
    'active' => 1,
    'local' => 'php'
  );

  $layouts = array();
  if ($components) {
    foreach ($components as $key => $layout) {
      $type = sanitize_title($layout['component_type']);
      $layouts[$type]['name'] = $layout['component_type'];
      $layouts[$type]['components'][$layout['name']] = $layout['label'];
    }

    update_option('ll_available_components', $layouts);
    if ($layouts) {

      foreach ($layouts as $key => $component_type) {
        $tab_field = array(
          'key' => 'field_' . $key,
          'label' => $component_type['name'],
          'type' => 'tab',
          'placement' => 'left'
        );

        $field_group['fields'][] = $tab_field;

        $field = array(
          'key' => 'field_active_' . $key,
          'label' => 'Active Components',
          'name' => $key,
          'type' => 'checkbox'
        );

        $field_group['fields'][] = $field;
      }

    }

  }
  //component setup field group
  acf_add_local_field_group($field_group);

  //global theme option field group
  $global_field_group = array(
    'key' => 'field_ll_global_setup',
    'title' => 'Global',
    'menu_order' => 0,
    'position' => 'acf_after_title',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-component-setup',
        ),
      ),
    ),
    'active' => 1,
    'local' => 'php',
    'fields' => array(
      array(
        'key' => 'field_navbar_options',
        'label' => 'Navbar',
        'type' => 'tab',
        'placement' => 'left'
      ),
      array(
        'key' => 'field_navbar_choice',
        'name' => 'navbar_choice',
        'label' => 'Select a nav style',
        'type' => 'radio',
        'default' => 0,
        'choices' => array(
          0 => 'Layout 1',
          1 => 'Layout 2',
          2 => 'Layout 3',
          3 => 'Layout 4'
        )
      ),
      array(
        'key' => 'field_footer_options',
        'label' => 'Footer',
        'type' => 'tab',
        'placement' => 'left'
      ),
      array(
        'key' => 'field_footer_choice',
        'name' => 'footer_choice',
        'label' => 'Select a footer style',
        'type' => 'radio',
        'default' => 0,
        'choices' => array(
          0 => 'Layout 1, Light',
          1 => 'Layout 1, Dark',
          2 => 'Layout 2, Light',
          3 => 'Layout 2, Dark'
        )
      ),
      array(
        'key' => 'field_post_type_options',
        'label' => 'Post Types',
        'type' => 'tab',
        'placement' => 'left'
      ),
      array(
        'key' => 'field_theme_post_types',
        'name' => 'theme_post_types',
        'label' => 'Select Post Types to use',
        'type' => 'checkbox',
        'choices' => array(
          'll_treatment' => 'Treatments'
        )
      ),
    )
  );

  //component setup field group
  acf_add_local_field_group($global_field_group);
}

//Populate the Component Setup checkboxes
add_filter('acf/load_field/type=checkbox', 'll_load_component_field_choices');
function ll_load_component_field_choices ( $field ) {
  if (strpos($field['key'], 'field_active_') !== false) {

    //be sure the choices are empty, just in case
    $field['choices'] = array();

    //get the key for which group of components we're working with
    $field_key = explode('field_active_', $field['key']);
    $field_key = $field_key[1];

    if (! $field_key)
      return;

    //get all available components
    $available_components = get_option('ll_available_components');

    //set the necessary
    $field['choices'] = $available_components[$field_key]['components'];
  }

  // return the field
  return $field;

}

//Remove Non active components from displaying in the Add Component popup
add_filter('acf/load_field/name=components', 'remove_layout', 99);
function remove_layout ( $field ) {
  global $post;
  if (! is_admin() || ! is_object($post) || (! isset($post->post_type) || ! isset($post->ID))) {
    return $field;
  }

  $is_archive = ll_is_post_type_archive();
  $post_type = $post->post_type;

  if ($post_type == 'acf-field-group' || $post_type == 'acf-field') {
    return $field;
  }

  //get all of our active components
  $active_components = get_option('ll_active_components');
  //store the layouts in an array
  $layouts = $field['layouts'];

  //empty out the fields components
  $field['layouts'] = array();

  foreach ($layouts as $layout) {
    //if the layout is in the active_components
    //add it back to the fields layouts
    if (in_array($layout['name'], $active_components)) {
      if ($is_archive && $layout['name'] == 'posts') {
        $field['layouts'][] = $layout;
      } elseif ($layout['name'] !== 'posts') {
        $field['layouts'][] = $layout;
      }
    }
  }

  return $field;
}

//save ll_active_components_option when Component Setup options are saved
add_action('acf/save_post', 'll_acf_save_post', 20);
function ll_acf_save_post ( $post_id ) {
  $screen = get_current_screen();

  if ($screen->base == 'site-options_page_acf-options-component-setup' && ! empty($_POST['acf'])) {
    //get all fields being saved, in this case
    //each of our active component groups
    $fields = $_POST['acf'];
    //create an empty array to store them in
    $active_layouts = array();

    //loop through checked fields and save them
    //to the active_layouts
    if ($fields && is_array($fields)) {
      foreach ($fields as $component_group) {
        if ($component_group && is_array($component_group)) {
          foreach ($component_group as $component) {
            $active_layouts[] = $component;
          }
        }
      }
    }

    //save active components to an easy to access singular option
    update_option('ll_active_components', $active_layouts);
  }

  return;
}


//Create hidden divs containing component_type and component_preview so we can hook into with javascript to
//create the component_type field later
add_action('acf/render_field_settings/type=flexible_content', 'll_component_type_setting');
function ll_component_type_setting ( $field ) {
  if ($field['layouts']) {
    foreach ($field['layouts'] as $layout) {
      ?>
                        <div class="ll-layout" id="ll-layout-<?php echo $layout['key']; ?>" data-preview="<?php echo $layout['component_preview'] ?>" data-component-type="<?php echo $layout['component_type']; ?>" hidden></div>
                        <?php
    }
  }
}


//enqueue our admin javascript
function ll_acf_enqueue_scripts () {
  $screen = get_current_screen();
  if ($screen->base == 'site-options_page_acf-options-component-setup') {
    //enqueue theme styles onto component options page for preview functionality
    // wp_enqueue_style( 'll-component-admin-css', get_template_directory_uri().'/assets/css/main.min.css' );
    wp_enqueue_style('magnific-css', get_template_directory_uri() . '/assets/css/magnific.css');
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/magnific.min.js', 'jquery', '', true);
  }

  wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
  wp_enqueue_script('admin-acf', get_template_directory_uri() . '/assets//js/admin-acf.js', array(), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'll_acf_enqueue_scripts');


//custom css for pages where acf fields are rendered
function ll_acf_admin_footer () {

  //set up global javascript variables for various field / layout information
  // $components = get_page_by_title('Components', 'OBJECT', 'acf-field');
  // $components = unserialize($components->post_content);
  $args = array(
    'post_type' => 'acf-field',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'name' => 'components',
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    $query->the_post();
    $components = unserialize($query->post->post_content);
  } else {
    $components = array();
  }
  $layouts = isset($components['layouts']) ? json_encode($components['layouts']) : '';
  $component_types = get_field('component_types', 'option');
  $font_one = json_encode(get_field('global_font_1', 'option'));
  $font_two = json_encode(get_field('global_font_2', 'option'));
  $component_types = json_encode($component_types);
  $screen = get_current_screen();
  $screen = $screen->base;
  ?>
        <script>
          var allLayouts = <?php echo $layouts; ?>;
          var componentTypes = <?php echo $component_types; ?>;
          var currentScreen = '<?php echo $screen; ?>';
          var font_one = <?php echo $font_one ?>;
          var font_two = <?php echo $font_two; ?>;
          var fonts = [font_one, font_two];
        </script>
        <?php
}

// add_action('acf/input/admin_footer', 'll_acf_admin_footer');
add_action('admin_footer', 'll_acf_admin_footer');



//Populate select with available post types
add_filter('acf/load_field/name=post_type', 'll_post_type_select', 99);
function ll_post_type_select ( $field ) {
  global $post;
  if (! is_admin() || ! is_object($post) || (! isset($post->post_type) || ! isset($post->ID))) {
    return $field;
  }
  //empty out choices just in case
  $field['choices'] = '';

  $args = array(
    'public' => true
  );
  $post_types = get_post_types($args);

  $field['choices'] = $post_types;

  return $field;
}

//Populate select with available post types
add_filter('acf/load_field/type=select', 'll_color_select', 99);
function ll_color_select ( $field ) {
  global $post;
  if (! is_admin()) {
    return $field;
  }
  if (strpos($field['name'], 'color') !== false) {
    //empty out choices just in case
    $field['choices'] = '';
    $field['choices'] = array();
    $field['choices']['#000000'] = 'Black';
    $field['choices']['#FFFFFF'] = 'White';

    $colors = get_field('theme_colors', 'option');
    if ($colors) {
      foreach ($colors as $key => $color) {
        $field['choices'][$color['color']] = $color['label'];
      }
    }
  }

  if ($field['name'] == 'component_selection') {

    //empty out choices just in case
    $field['choices'] = array();
    $components = get_field('components', 'option');

    if ($components) {
      foreach ($components as $key => $component) {
        $field['choices'][$key] = $component['group_label'];
      }
    }

  }

  return $field;
}

<?php
/**
 *
 * Lifted Logic custom functions
 *
 */

/**
 * Get post meta shortcut
 */
function meta ( $key ) {
  global $post;
  return get_post_meta($post->ID, $key, true);
}

/**
 * Formats text like the default WordPress wysiwyg
 */
function format_text ( $content ) {
  $content = apply_filters('the_content', $content);
  return $content;
}

/**
 * var_dump variable
 * wrap it in a <pre> tag
 */
function _pre_var () {
  $args = func_get_args();

  echo '<pre>';
  call_user_func_array('var_dump', $args);
  echo '</pre>';
}

/**
 * Custom background function
 */
function set_post_background () {
  global $post;
  $background_options = get_field('background_image', $post->ID);

  if ($background_options['image'] || $background_options['color']) {

    $background_image = $background_options['image']['url'];
    $background_repeat = $background_options['repeat'];
    $background_attachment = $background_options['attachment'];
    $background_size = $background_options['size'];
    $background_color = $background_options['color'];
    $text_color = $background_options['text_color'];
    if (! $background_size) {
      $background_size = 'cover';
    }

    if (! $background_color) {
      $background_color = '#FFFFFF';
    }

    if (! $text_color) {
      $text_color = '#000000';
    }

    return '<style type="text/css">body,.main {background-image: url(' . $background_image . ');background-repeat: ' . $background_repeat . '; background-attachment: ' . $background_attachment . '; background-size: ' . $background_size . '; background-color: ' . $background_color . '; color: ' . $text_color . ';} </style>';
  }
}

/**
 * Get attachement image
 */
function ll_get_banner_image ( $id = null ) {
  global $post;
  if (! $id) {
    $id = $post->ID;
  }
  $post_image = wp_get_attachment_image_src(get_post_thumbnail_id($id), "Full");
  $banner_image;

  if (! empty($post_image)) {
    $banner_image = $post_image[0];
  }


  return $banner_image;
}

/**
 * Converts phone numbers to the formatting standard
 *
 * @param   String   $num   A unformatted phone number
 * @return  String   Returns the formatted phone number
 */
function format_phone ( $num, $area = false, $sep = '-' ) {

  $num = preg_replace('/[^0-9]/', '', $num);
  $len = strlen($num);

  if ($len == 7) {

    $num = preg_replace('/([0-9]{3})([0-9]{4})/', '$1' . $sep . '$2', $num);
  } elseif ($len == 10) {

    if ($area)
      $num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2' . $sep . '$3', $num);
    else
      $num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '$1' . $sep . '$2' . $sep . '$3', $num);
  }

  return $num;
}

/**
 * Strips all non-numeric characters from a string
 *
 * @param   String   $num   A unformatted phone number
 * @return  String   Returns number without any special characters or spaces
 */
function strip_phone ( $num ) {
  $num = preg_replace('/[^0-9]/', '', $num);
  return $num;
}

/**
 * returns values from custom site options
 * @param  string $context context name of option i.e global, contact
 * @param  String $option_name key of the option i.e _logo_ or _facebook_
 * @return mixed
 */
function ll_get_option ( $context = false, $option_name = 'option' ) {
  global $ll_options;
  $ll_options = get_fields($option_name);

  if ($context) {
    return $ll_options[$context];
  } else {
    return $ll_options;
  }
}

function ll_get_forms_as_options () {
  if (! class_exists('RGFormsModel'))
    return;

  $forms = RGFormsModel::get_forms(null, 'title');
  $options = array();

  if (empty($forms)) {
    $forms = array();
  }
  ;

  foreach ($forms as $key => $form) {
    $options[$form->id] = $form->title;
  }
  ;

  return $options;
}


/**
 * Get all social media options as a key=>value pair of
 * "social_name" => "social_link". To use, make sure all social media
 * options under "Contact Options" are prefixed with _options_contact_social.
 * Example: _options_contact_social_facebook
 * @return array array of social media sites and links
 */
function ll_get_social_list () {

  $social_media_sites = array(
    'facebook' => get_field('social_facebook', 'option'),
    'twitter' => get_field('social_twitter', 'option'),
    'instagram' => get_field('social_instagram', 'option'),
    'google_plus' => get_field('social_google_plus', 'option'),
    'youtube' => get_field('social_youtube', 'option'),
    'linkedin' => get_field('social_linkedin', 'option'),
    'pinterest' => get_field('social_pinterest', 'option'),
  );

  $social_media_sites = ll_filter_array($social_media_sites);

  if ($social_media_sites) {
    echo '<ul class="social-list">';
    foreach ($social_media_sites as $social => $link) {
      echo '<li class="social-list__item"><a class="social-list__link ' . $social . '" href="' . $link . '" target="_blank"><svg class="icon icon-' . $social . '"><use xlink:href="#icon-' . $social . '"></use></svg></a></li>';
    }
    echo '</ul>';
  }
}


/**
 * Set custom logo for the Wordpress login page
 */
function ll_custom_login_logo () {

  $logo = get_field('global_logo', 'option');

  if ($logo): ?>
        <style type="text/css">
          #login h1 a, .login h1 a {
            background-image: url(<?php echo $logo['url']; ?> );
            width: 100%;
            height: auto;
            min-height: 100px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
          }
        </style>
    <?php endif; ?>
<?php
}
add_action('login_enqueue_scripts', 'll_custom_login_logo');

function ll_custom_login_logo_url () {
  return home_url();
}
add_filter('login_headerurl', 'll_custom_login_logo_url');

function ll_custom_login_logo_url_title () {
  return get_bloginfo('description');
}
add_filter('login_headertitle', 'll_custom_login_logo_url_title');

/**
 * ll_stop_reordering_my_categories
 * -----------------------------------------------------------------------------
 * Keep categories and taxonomies in their hierarchical order rather than showing selected on top.
 *
 */
function ll_stop_reordering_my_categories ( $args ) {
  $args['checked_ontop'] = false;
  return $args;
}
add_filter('wp_terms_checklist_args', 'll_stop_reordering_my_categories');

/**
 * ll_generate_schema_json
 * -----------------------------------------------------------------------------
 * Keep categories and taxonomies in their hierarchical order rather than showing selected on top.
 *
 */

function ll_generate_schema_json () {
  $schema = array(
    '@context' => 'http://schema.org',
    '@type' => get_field('schema_type', 'option'),
    'name' => get_bloginfo('name'),
    'url' => get_home_url(),
    'telephone' => strip_phone(get_field('contact_phone_number', 'option')),
    'email' => get_field('contact_email_address', 'option'),
    'address' => array(
      '@type' => 'PostalAddress',
      'streetAddress' => get_field('contact_street_address', 'option'),
      'postalCode' => get_field('contact_zip', 'option'),
      'addressLocality' => get_field('contact_city', 'option'),
      'addressRegion' => get_field('contact_state', 'option'),
      'addressCountry' => get_field('contact_country', 'option')
    )
  );
  /// LOGO
  if (get_field('schema_logo', 'option')) {
    $schema['logo'] = get_field('schema_logo', 'option');
  }
  /// IMAGE
  if (get_field('schema_building_photo', 'option')) {
    $schema['image'] = get_field('schema_building_photo', 'option');
  }
  /// SOCIAL MEDIA
  // Google only looks for these 6 social media sites (and MySpace)
  $social_media_sites = array(
    'facebook' => get_field('social_facebook', 'option'),
    'twitter' => get_field('social_twitter', 'option'),
    'instagram' => get_field('social_instagram', 'option'),
    'google_plus' => get_field('social_google_plus', 'option'),
    'youtube' => get_field('social_youtube', 'option'),
    'linkedin' => get_field('social_linkedin', 'option')
  );

  if (ll_filter_array($social_media_sites)) {
    $schema['sameAs'] = array();
    foreach ($social_media_sites as $key => $social_media) {
      if ($social_media) {
        array_push($schema['sameAs'], $social_media);
      }
    }
  }
  /// OPENING HOURS
  if (have_rows('scehma_openings', 'option')) {
    $schema['openingHoursSpecification'] = array();
    while (have_rows('scehma_openings', 'option')):
      the_row();
      $closed = get_sub_field('closed');
      $from = $closed ? '00:00' : get_sub_field('from');
      $to = $closed ? '00:00' : get_sub_field('to');
      $openings = array(
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => get_sub_field('days'),
        'opens' => $from,
        'closes' => $to
      );
      array_push($schema['openingHoursSpecification'], $openings);
    endwhile;
    /// VACATIONS / HOLIDAYS
    if (have_rows('schema_special_days', 'option')) {
      while (have_rows('schema_special_days', 'option')):
        the_row();
        $closed = get_sub_field('closed');
        $date_from = get_sub_field('date_from');
        $date_to = get_sub_field('date_to');
        $time_from = $closed ? '00:00' : get_sub_field('time_from');
        $time_to = $closed ? '00:00' : get_sub_field('time_to');
        $special_days = array(
          '@type' => 'OpeningHoursSpecification',
          'validFrom' => $date_from,
          'validThrough' => $date_to,
          'opens' => $time_from,
          'closes' => $time_to
        );
        array_push($schema['openingHoursSpecification'], $special_days);
      endwhile;
    }
  }
  echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
}
add_action('wp_head', 'll_generate_schema_json');

add_filter('gform_submit_button', 'll_custom_gform_submit', 10, 2);
function ll_custom_gform_submit ( $submit_button, $form ) {
  if ($form['cssClass'] == 'inline-form') {
    $submit_button = "<button class='inline-submit' type='submit' id='gform_submit_button_{$form['id']}'><span class='sr-only'>Submit</span><svg class='icon icon-arrow-right'><use xlink:href='#icon-arrow-right'></use></svg></button>";
  } elseif ($form['cssClass'] == 'form-skin' || $form['cssClass'] == 'quoter') {
    $submit_button = "<button class='button is-solid' id='gform_submit_button_{$form['id']}' type='submit'>{$form['button']['text']}</button>";
  }

  return $submit_button;
}

add_filter('gform_previous_button', 'll_remove_gform_previous', 10, 2);
function ll_remove_gform_previous ( $previous_button, $form ) {
  if ($form['cssClass'] == 'quoter') {
    $tabindex = get_string_between($previous_button, "tabindex='", "'");
    $previous_button = '<button class="button is-solid" tabindex="' . $tabindex . '">Back</button>';
  }
  return $previous_button;
}

add_filter('gform_next_button', 'll_custom_gform_next', 10, 2);
function ll_custom_gform_next ( $next_button, $form ) {
  if ($form['cssClass'] == 'quoter') {
    $tabindex = get_string_between($next_button, "tabindex='", "'");
    $next_button = '<button class="button is-solid" tabindex="' . $tabindex . '">Continue</button>';
  }
  return $next_button;
}


function ll_get_navbar_layout () {
  $layout = (int) get_field('navbar_choice', 'option');
  switch ($layout) {
    case 0:
      get_template_part('templates/partials/navbars/navbar-1');
      break;
    case 1:
      get_template_part('templates/partials/navbars/navbar-2');
      break;
    case 2:
      get_template_part('templates/partials/navbars/navbar-3');
      break;
    case 3:
      get_template_part('templates/partials/navbars/navbar-4');
      break;
    default:
      get_template_part('templates/partials/navbars/navbar-1');
      break;
  }
}

function ll_get_footer_layout () {
  $layout = (int) get_field('footer_choice', 'option');
  switch ($layout) {
    case 0:
      get_template_part('templates/partials/footers/footer-1');
      break;
    case 1:
      get_template_part('templates/partials/footers/footer-1');
      break;
    case 2:
      get_template_part('templates/partials/footers/footer-2');
      break;
    case 3:
      get_template_part('templates/partials/footers/footer-2');
      break;
    default:
      get_template_part('templates/partials/footers/footer-1');
      break;
  }
}

add_action('wp_enqueue_scripts', 'll_enqueue_google_fonts', 100);
function ll_enqueue_google_fonts () {
  if (! get_field('custom_text_styles', 'option'))
    return;

  $font_one = get_field('global_font_1', 'option');
  $font_two = get_field('global_font_2', 'option');
  $fonts = array( $font_one, $font_two );

  $text_styles = array(
    'h1' => get_field('h1_styles', 'option'),
    'h2' => get_field('h2_styles', 'option'),
    'h3' => get_field('h3_styles', 'option'),
    'h4' => get_field('h4_styles', 'option'),
    'h5' => get_field('h5_styles', 'option'),
    'h6' => get_field('h6_styles', 'option'),
    'p' => get_field('paragraph_styles', 'option'),
    'text-is-large' => get_field('large_paragraph_styles', 'option'),
    'text-is-small' => get_field('small_paragraph_styles', 'option'),
    'button' => get_field('button_styles', 'option')
  );

  if (! empty($fonts)) {
    $fonts = array(
      array(
        'font' => 'Roboto',
        'variants' => array(
          0 => '100',
          1 => '300',
          2 => 'regular',
          3 => '500'
        ),
        'subsets' => array(
          0 => 'latin'
        )
      ),
      array(
        'font' => 'Roboto',
        'variants' => array(
          0 => '100',
          1 => '300',
          2 => 'regular',
          3 => '500'
        ),
        'subsets' => array(
          0 => 'latin'
        )
      )
    );
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500', false);
  }

  $custom_styles = '';

  foreach ($fonts as $key => $font) {
    if ($key == 0) {
      $custom_styles .= "body{ font-family: '{$font['font']}'; }\n";
    }

    $font_key = $key + 1;
    $selector = ".font-{$font_key}";
    $custom_styles .= "{$selector} { font-family: '{$font['font']}'; }\n";
  }

  if (! empty($text_styles)) {
    foreach ($text_styles as $element => $type) {
      $el_selector = '';
      $type_styles = '';

      if ($element !== 'text-is-large' && $element !== 'text-is-small' && $element !== 'p') {
        $el_selector .= "{$element},.{$element},p.space-{$element}::before";

      } elseif ($element == 'p') {
        $el_selector .= "body";
      } elseif ($element == 'text-is-large' || $element == 'text-is-small') {
        $el_selector .= ".{$element}";
      }

      //apply the styles
      foreach ($type as $property => $value) {
        if ($value) {
          if ($property == 'font-size' || $property == 'letter-spacing' || $property == 'line-height') {
            $value = convert_css_value($type, $element, $property, $value);
          }
          $type_styles .= "{$property}: {$value};\n";
        }
      }
      $custom_styles .= "{$el_selector}{{$type_styles}}";

      //adjust spacer margins
      // if ( $element !== 'p' && $element !== 'text-is-small' && $element !== 'text-is-large' && ( $type['font-size'] >= $text_styles['p']['font-size'] ) ) {
      //   if ( $element == 'h1' || $element == 'h6' ) {

      //     if ( ( $type['font-size'] / $text_styles['p']['font-size'] ) / 2 < 1 ) {
      //       // var_dump( $element, ( $type['font-size'] / $text_styles['p']['font-size'] ) / 2, $text_styles['p']['font-size'] );
      //       $value = convert_css_value( $type, 'p', 'font-size', $text_styles['p']['font-size'] );
      //       $custom_styles .= "p.space-{$element}::before{margin-bottom: {$value};}";
      //     } else {
      //       $custom_styles .= "p.space-{$element}::before{margin-bottom: 0.5em;}";
      //     }

      //   } else {
      //     $custom_styles .= "p.space-{$element}::before{margin-bottom: 1em;}";
      //   }
      // }
    }
  }

  $css = $custom_styles;

  wp_add_inline_style('roots_css', $css);
}

function convert_css_value ( $styles, $element, $property, $value ) {
  $base_size = get_field('paragraph_styles', 'option');
  $base_size = $base_size['font-size'];

  if (! $base_size) {
    $base_size = 16;
  }


  if ($property == 'font-size' || $property == 'letter-spacing') {
    if ($property == 'font-size' && $element == 'p') {
      return $base_size . 'px';
    } else {
      return $value / $base_size . 'em';
    }
  } else {
    if ($styles['font-size']) {
      return $value / $styles['font-size'];
    } else {
      return $value / $base_size;
    }
  }
}

function ll_get_first_component ( $page_id = null ) {
  global $post;

  if (! $page_id) {
    if (is_post_type_archive('ll_treatment') || is_tax('ll_treatment_cat')) {
      $page_id = get_field('page_for_treatments', 'option');
    } elseif (is_home() || is_category()) {
      $page_id = get_option('page_for_posts');
    } else {
      $page_id = $post->ID;
    }
  }


  $components = get_field('components', $page_id);
  $first_component = $components[0]['acf_fc_layout'];
  return $first_component;
}

function ll_is_grid_layout ( $layout ) {
  $grid_layouts = array(
    'photo_group_offset',
    'photo_group_basic',
    'photo_group_staggered',
    'photo_group_group',
    'post_grid_one',
    'post_grid_two',
    'post_grid_three',
    'post_grid_four',
    'card_grid'
  );

  if (in_array($layout, $grid_layouts))
    return true;

  return false;
}

function ll_is_post_type_archive () {
  global $post;
  if (
    $post->ID == get_field('page_for_treatments', 'option') ||
    $post->ID == get_option('page_for_posts')
  ) {
    return true;
  }

  return false;
}

function ll_get_posts_layout ( $post_id = null ) {
  global $post;
  if (! $post_id)
    $post_id = $post->ID;

  if ($post_id == get_option('page_for_posts')) {
    return 'card-grid';
  } elseif ($post_id == get_field('page_for_treatments', 'option')) {
    return get_field('treatments_post_layout', 'option');
  } else {
    return 'list-grid';
  }
}

function ll_get_the_taxonomy ( $post_type ) {
  if ($post_type == 'post') {
    return 'category';
  } else {
    return $post_type . '_cat';
  }
}

function ll_get_the_terms ( $post, $post_type ) {
  //add checks for other post types
  if ($post_type == 'post') {
    $terms = get_the_terms($post, 'category');
  } elseif ($post_type == 'll_treatment') {
    $terms = get_the_terms($post, 'll_treatment_cat');
  }
  $term_list = '';

  if (is_array($terms)) {
    foreach ($terms as $key => $term) {
      if ($key == 0) {
        $term_list .= $term->name;
      } else {
        $term_list .= ', ' . $term->name;
      }
    }
  }
  return $term_list;
}

/*
 * Replace Taxonomy slug with Post Type slug in url
 * /posttype-slug/taxonomy-slug
 * Version: 1.1
 */
function taxonomy_slug_rewrite ( $wp_rewrite ) {
  $rules = array();
  // get all custom taxonomies
  $taxonomies = get_taxonomies(array( '_builtin' => false ), 'objects');

  // get all custom post types
  $post_types = get_post_types(array( 'public' => true, '_builtin' => false ), 'objects');
  foreach ($post_types as $post_type) {
    foreach ($taxonomies as $taxonomy) {

      if ($taxonomy->rewrite['slug'] == $post_type->rewrite['slug']) {
        $slug = $taxonomy->rewrite['slug'];
        // get category objects
        $terms = get_categories(array( 'type' => $object_type, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0 ));
        // make rules
        foreach ($terms as $term) {
          $rules[$slug . '/' . $term->slug . '/page/?([0-9]{1,})'] = 'index.php?' . $term->taxonomy . '=' . $term->slug . '&paged=' . $wp_rewrite->preg_index(1);
          $rules[$slug . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
        }
      }
    }
  }
  // merge with global rules
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'taxonomy_slug_rewrite');


/*
 * Custom Numbered Pagination
 */
function ll_numeric_posts_nav () {

  if (is_singular())
    return;

  global $wp_query;

  /** Stop execution if there's only 1 page */
  if ($wp_query->max_num_pages <= 1)
    return;

  $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
  $max = intval($wp_query->max_num_pages);

  /** Add current page to the array */
  if ($paged >= 1)
    $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ($paged >= 3) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  if (($paged + 2) <= $max) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }

  echo '<div class="pagination"><div class="container"><ul>' . "\n";

  /** Previous Post Link */
  if (get_previous_posts_link())
    printf('<li class="pagination-prev">%s</li>' . "\n", get_previous_posts_link('Previous'));

  /** Link to first page, plus ellipses if necessary */
  if (! in_array(1, $links)) {
    $class = 1 == $paged ? ' class="active"' : '';

    printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

    if (! in_array(2, $links))
      echo '<li>…</li>';
  }

  /** Link to current page, plus 2 pages in either direction if necessary */
  sort($links);
  foreach ((array) $links as $link) {
    $class = $paged == $link ? ' class="active"' : '';
    printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
  }

  /** Link to last page, plus ellipses if necessary */
  if (! in_array($max, $links)) {
    if (! in_array($max - 1, $links))
      echo '<li class="pagination-more">…</li>' . "\n";

    $class = $paged == $max ? ' class="active last"' : ' class="last"';
    printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
  }

  /** Next Post Link */
  if (get_next_posts_link())
    printf('<li class="pagination-next">%s</li>' . "\n", get_next_posts_link('Next'));

  echo '</ul></div></div>' . "\n";

}

function ll_acf_google_map_api ( $api ) {
  $maps_api = get_field('global_google_maps_api_key', 'option');
  $api['key'] = $maps_api;

  return $api;

}

add_filter('acf/fields/google_map/api', 'll_acf_google_map_api');

function ll_get_posts ( $post_type = 'post', $posts_to_show = -1, $categories = null ) {
  $args = array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_to_show,
    'post_status' => 'publish'
  );

  if ($categories) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field' => 'id',
        'terms' => $categories
      )
    );
  }

  $posts = get_posts($args);
  $items;
  if ($posts) {
    foreach ($posts as $key => $post) {
      $categories = ll_get_the_terms($post, $post_type);
      $top_text = $categories;
      $sub_text = get_the_excerpt($post->ID);

      if ($post_type == 'post') {
        $top_text = get_the_date('', $post->ID);
        $sub_text = $categories;
      }
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
      if (is_array($image) && isset($image[0], $image[1], $image[2])) {
        $items[] = array(
          'image' => array(
            'url' => $image[0],
            'width' => $image[1],
            'height' => $image[2]
          ),
          'sub_text' => $sub_text,
          'title' => get_the_title($post->ID),
          'top_text' => $top_text,
          'link' => get_permalink($post->ID)
        );
      }
      // $items[] = array(
      //   'image' => array(
      //     'url' => $image[0],
      //     'width' => $image[1],
      //     'height' => $image[2]
      //   ),
      //   'sub_text' => $sub_text,
      //   'title' => get_the_title($post->ID),
      //   'top_text' => $top_text,
      //   'link' => get_permalink($post->ID)
      // );
    }
  }

  return $items;
}

function ll_get_gallery_posts ( $post_type = 'post', $posts_to_show = 6, $category = null ) {
  $args = array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_to_show,
    'post_status' => 'publish'
  );
  if ($category) {

    $args['tax_query'] = array(
      array(
        'taxonomy' => $post_type . '_cat',
        'field' => 'slug',
        'terms' => $category
      )
    );
  }

  $posts = get_posts($args);
  $items;
  if ($posts) {
    foreach ($posts as $key => $post) {
      $categories = ll_get_the_terms($post, $post_type);
      $top_text = $categories;
      $sub_text = get_the_excerpt($post->ID);

      if ($post_type == 'post') {
        $top_text = get_the_date('', $post->ID);
        $sub_text = $categories;
      }
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
      $gallery = get_field('galleries', $post->ID);
      $display_image = $gallery[0]['gallery_items'][0]['image']['url'];
      if ($gallery) {

        $items[] = array(
          'image' => array(
            'url' => $display_image,
            'width' => $image[1],
            'height' => $image[2]
          ),
          'gallery' => $gallery,
          'post_id' => $post->ID,
          'sub_text' => $sub_text,
          'title' => get_the_title($post->ID),
          'top_text' => $top_text,
          'link' => get_permalink($post->ID)
        );
      }
    }
  }

  return $items;
}

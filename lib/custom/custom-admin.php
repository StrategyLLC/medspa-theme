<?php
/**
 *
 * Lifted Logic custom admin
 *
 */

/**
 * Custom admin styles
 */
function ll_admin_styles() {
  ?>
  <style type="text/css">
    .acf-field p.description {
      border-left: 2px solid #0073aa;
      padding-left: 0.5em;
    }
    .xdebug-var-dump {
      padding-left: 200px;
    }

    .ll-group-label {
      display: none;
    }

    .wrap.acf-settings-wrap {
      margin-top: 0 !important;
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
      outline: none;
    }

    .ll-group-title:empty::before {
      content: 'Insert Custom Group Label';
      display: inline;
      color: #ddd;
    }

    .mce-i-material-icon.color,
    #menu-posts-ll_treatment .wp-menu-image.dashicons-before {
      font-family: 'Material Icons' !important;
      font-weight: normal;
      font-style: normal;
      font-size: 24px;
      display: inline-block;
      width: 1em;
      height: 1em;
      line-height: 1;
      text-transform: none;
      letter-spacing: normal;
      word-wrap: normal;
      white-space: nowrap;
      direction: ltr;
      -webkit-font-smoothing: antialiased;
      text-rendering: optimizeLegibility;
      -moz-osx-font-smoothing: grayscale;
      font-feature-settings: 'liga';
    }

    #menu-posts-ll_treatment .wp-menu-image.dashicons-before {
      width: 36px;
      height: 34px;
    }

    #menu-posts-ll_treatment .wp-menu-image.dashicons-before::before {
      content: 'spa';
      font-family: inherit;
      width: 20px;
      height: 20px;
      font-size: 20px;
    }

    .ll-preview-tooltip {
      position: absolute;
      left: 0;
      display: inline-block;
      background-color: #303030;
      color: white;
      border: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      text-align: center;
      outline: none;
    }

    .ll-preview-tooltip:hover {
      background-color: #0085ba;
    }

    .ll-preview-tooltip::after {
      content: '\f177';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-family: 'Dashicons';
      font-size: 12px;
    }

    .ll-preview-modal {
      position: relative;
      padding: 2em;
      max-width: 50em;
      background-color: white;
      /*width: 50em;*/
      margin: 0 auto;
    }

    .ll-preview-modal .mfp-close {
    }

    .mce-i-material-icon.color::before {
      content: 'invert_colors';
    }

    .acf-short .acf-input {
      width: 200px !important;
    }
    .menu-item-settings {
      width: 100% !important;
    }

    .menu-item .acf-fields {
      float: none;
      clear: both;
    }

    .menu-item-settings .description-thin, .menu-item-settings .description-wide {
      float: none;
    }

    .acf-flexible-content .layout:not(.-collapsed) {
      border: 2px solid lightgreen;
    }

    code {
      display: block;
      background-color: transparent;
      font-size: 8px;
    }
  </style>
  <?php
  $screen = get_current_screen();
  if ( $screen->base == 'site-options_page_acf-options-component-setup' || $screen->base == 'site-options_page_acf-options-theme-options' ) :
  ?>
    <style type="text/css">
      .site-options_page_acf-options-component-setup input[type="checkbox"],
      .site-options_page_acf-options-component-setup input[type="radio"],
      .toggle .acf-input input {
        margin: -1px;
        padding: 0;
        width: 1px;
        height: 1px;
        overflow: hidden;
        clip: rect(0 0 0 0);
        clip: rect(0, 0, 0, 0);
        position: absolute;
      }

      .site-options_page_acf-options-component-setup .acf-checkbox-list label,
      .site-options_page_acf-options-component-setup .acf-radio-list label,
      .toggle .acf-input label {
        position: relative;
        display: block;
        width: 180px;
        padding-left: 30px;
        user-select: none;
      }

      .toggle .acf-input label {
        width: 64px;
      }

      .site-options_page_acf-options-component-setup .acf-checkbox-list label::before,
      .site-options_page_acf-options-component-setup .acf-radio-list label::before,
      .toggle .acf-input label::before {
        content: '';
        position: absolute;
        left: 100%;
        display: block;
        border-radius: 100px;
        width: 64px;
        height: 32px;
        background-color: #ddd;
        cursor: pointer;
      }

      .toggle .acf-input label::before {
        position: relative;
        left: 0;
      }

      .site-options_page_acf-options-component-setup .acf-checkbox-list label::after,
      .site-options_page_acf-options-component-setup .acf-radio-list label::after,
      .toggle .acf-input label::after {
        content: '';
        position: absolute;
        top: 2px;
        left: calc(100% + 2px);
        width: 28px;
        height: 28px;
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        transition: 0.3s;
      }

      .toggle .acf-input label::after {
        left: 32px;
      }

      .site-options_page_acf-options-component-setup .acf-checkbox-list label.selected::before,
      .site-options_page_acf-options-component-setup .acf-radio-list label.selected::before,
      .toggle .acf-input label.selected::before {
        background: #bada55;
      }

      .site-options_page_acf-options-component-setup .acf-checkbox-list label.selected::after,
      .site-options_page_acf-options-component-setup .acf-radio-list label.selected::after,
      .toggle .acf-input label.selected::after {
        left: calc(100% + 62px );
        transform: translateX(-100%);
      }

      .toggle .acf-input label.selected::after {
        left: calc(100% - 2px);
      }

      .site-options_page_acf-options-component-setup .acf-checkbox-list li,
      .site-options_page_acf-options-component-setup .acf-radio-list li {
        border-bottom: 1px solid #f5f5f5;
        margin-bottom: 1em;
        padding-bottom: 2em;
      }

    </style>
  <?php endif; ?>

  <?php
}
add_action('admin_head', 'll_admin_styles');

/**
 * Remove Dashboard Widgets
 */
function ll_remove_dashboard_meta() {
  remove_action( 'welcome_panel', 'wp_welcome_panel' ); // welcome panel
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal'); // since 3.8
  remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' ); // gravity forms
  remove_meta_box( 'tribe_dashboard_widget', 'dashboard', 'normal' ); // modern tribe events calendar
  remove_meta_box( 'mandrill_widget', 'dashboard', 'normal' ); // mandrill
  remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' ); // yoast seo
  remove_meta_box( 'wpe_dify_news_feed', 'dashboard', 'normal' ); // wp engine
}
add_action( 'admin_init', 'll_remove_dashboard_meta' );

/**
 * Dashboard Help Widget
 */
add_action('wp_dashboard_setup', 'll_dashboard_widgets');

function ll_dashboard_widgets() {
  global $wp_meta_boxes;
  add_meta_box('id', 'Support', 'll_dashboard_help', 'dashboard', 'normal', 'high');
}

function ll_dashboard_help() {
  ?>
  <h2 style="margin-bottom: 0; color: #D54E21;">Need some help?</h2>
  <p>If you have questions or concerns about the following, please let us know and we'll be happy to assist you :)</p>
  <ul style="list-style: disc; padding-left: 30px;">
    <li>Updating the site</li>
    <li>Adding / removing content</li>
  </ul>
  <hr>
  <strong>Lifted Logic</strong><br />
  <a href="mailto:info@liftedlogic.com">info@liftedlogic.com</a><br />
  816.298.7018
  <?php
}

/**
 * Hide page editor from template(s)
 */
function ll_remove_editor() {
  // if post not set, just return
  // fix when post not set, throws PHP's undefined index warning
  if ( isset($_GET['post']) ) {
    $post_id = $_GET['post'];
  } else if ( isset($_POST['post_ID']) ) {
    $post_id = $_POST['post_ID'];
  } else {
    return;
  }
  $template = get_post_meta($post_id, '_wp_page_template', true);
  if ( $template == 'templates/template-name.php' ) {
    remove_post_type_support('page', 'editor');
  }
}
add_action('init', 'll_remove_editor');

/**
 * Alters the markup of images inserted via WYSIWYG to use semantic HTML5
 * Figure tag
 * @param  [type] $html    the default html output
 * @param  [type] $id      the id of the image being inserted
 * @param  [type] $caption the caption assigned when uploading image to media gallery
 * @param  [type] $title   the title assigned when uploading image to media gallery
 * @param  [type] $align   the selected image alignment
 * @param  [type] $url     the url of the image
 * @param  [type] $size    the selected output size
 * @return [type]          html
 */
function ll_insert_image_media($html, $id, $caption, $title, $align, $url, $size) {
  $src = wp_get_attachment_image_src( $id, $size );
  $html5 = "<figure id='post-$id-media-$id' class='align-$align'>";
  $html5 .= "<img class='size-$size' src='$src[0]' alt='$title' />";
  if ($caption) {
    $html5 .= "<figcaption>$caption</figcaption>";
  }
  $html5 .= "</figure>";
  return $html5;
}
add_filter( 'image_send_to_editor', 'll_insert_image_media', 10, 9 );

/*
 * Change WordPress default gallery output
 * http://wpsites.org/?p=10510/
 */
add_filter('post_gallery', 'll_gallery_output', 10, 2);
function ll_gallery_output($output, $attr) {
  global $post;

  if (isset($attr['orderby'])) {
      $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
      if (!$attr['orderby'])
          unset($attr['orderby']);
  }

  extract(shortcode_atts(array(
      'order' => 'ASC',
      'orderby' => 'menu_order ID',
      'id' => $post->ID,
      'itemtag' => 'dl',
      'icontag' => 'dt',
      'captiontag' => 'dd',
      'columns' => 3,
      'size' => 'thumbnail',
      'include' => '',
      'exclude' => ''
  ), $attr));

  $id = intval($id);
  if ('RAND' == $order) $orderby = 'none';

  if (!empty($include)) {
      $include = preg_replace('/[^0-9,]+/', '', $include);
      $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

      $attachments = array();
      foreach ($_attachments as $key => $val) {
          $attachments[$val->ID] = $_attachments[$key];
      }
  }

  if (empty($attachments)) return '';

  // Here's your actual output, you may customize it to your need
  $output = "<div class=\"gallery\">\n";

  // Now you loop through each attachment
  foreach ($attachments as $id => $attachment) {
      // Fetch all data related to attachment
      $img = wp_prepare_attachment_for_js($id);

      // If you want a different size change 'large' to eg. 'medium'
      $popup = $img['sizes']['full']['url'];
      $url = $img['sizes']['medium']['url'];
      $height = $img['sizes']['medium']['height'];
      $width = $img['sizes']['medium']['width'];
      $alt = $img['alt'];

      // Store the caption
      $caption = $img['caption'];

      $output .= "<figure class=\"gallery-item\">\n";
      $output .= "<a class=\"gallery-item-popup\" href=\"{$popup}\">\n";
      $output .= "<img src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" alt=\"{$alt}\" />\n";
      $output .= "</a>\n";
      $output .= "</figure>\n";
  }

  $output .= "</div>\n";
  return $output;
}

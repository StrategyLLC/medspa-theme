<?php
/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Roots_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */

class Roots_Nav_Walker extends Walker_Nav_Menu {
  private $curItem;

  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $dropdown_type = get_field( 'dropdown_type', $this->curItem  );
    $slug = get_post_meta( $this->curItem, '_menu_item_url', true );
    $title = get_the_title( $this->curItem );
    $navbar = get_field( 'navbar_choice', 'option' );

    if ( $dropdown_type == 'image' && ( $navbar == 0 || $navbar == 3 ) ) {

      $dropdown_options = get_field( 'dropdown_options', $this->curItem );
      $dropdown_title;
      $layout = $dropdown_options['layout'];
      $columns = $dropdown_options['columns'];

      if ( $dropdown_options['title'] ) {
        $dropdown_title = '<span class="h5">'.$dropdown_options['title'].'</span>';
      }


      //replace output to wrap uls in divs for styling / layout purposes
      $output .= "\n<div class=\"collapsed dropdown-menu has-image columns-{$columns} {$layout}\" id=\"dropdown-".$this->curItem."\"  data-content=\"collapse\"><div class=\"dropdown__image\" style=\"background-image: url( {$dropdown_options['image']['url']} );\"></div><div class=\"dropdown-menu__menu\">{$dropdown_title}<ul>\n";

    } else {
      //default dropdown output
      $output .= "\n<div class=\"collapsed dropdown-menu is-simple\" id=\"dropdown-".$this->curItem."\"  data-content=\"collapse\"><ul>\n";
    }
  }

function end_lvl(&$output, $depth = 0, $args = array()) {
    $navbar = get_field( 'navbar_choice', 'option' );
    if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
        $t = '';
        $n = '';
    } else {
        $t = "\t";
        $n = "\n";
    }
    $indent = str_repeat( $t, $depth );

    $parent = get_post_meta( $this->curItem, '_menu_item_menu_item_parent', true );
    $dropdown_type = get_field( 'dropdown_type', $parent  );
    $slug = get_post_meta( $parent, '_menu_item_url', true );

    if ( $dropdown_type == 'image' && ( $navbar == 0 || $navbar == 3 ) ) {

      $dropdown_options = get_field( 'dropdown_options', $parent );
      $dropdown_viewall;
      $layout = $dropdown_options['layout'];

        if ( $dropdown_options['has_view_all'] ) {
          $dropdown_viewall = '<a class="dropdown-menu__view-all" href="'.$slug.'">view all</a>';
        }

      //close image dropdowns
      $output .= "$indent</ul>{$dropdown_viewall}</div></div>{$n}";
    } else {
      //close regular dropdowns
      $output .= "$indent</ul></div>{$n}";
    }
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $this->curItem = $item->ID;
    $item_html = '';
    $nav_layout = (int) get_field( 'navbar_choice', 'option' );
    $logo_light = get_field( 'global_logo', 'option' );
    $logo_dark  = get_field( 'global_logo_dark', 'option' );
    $site_name = get_bloginfo( 'name' );
    $options = get_field( 'dropdown_options_full', $this->curItem );
    $sub_menus = isset($options['sub_menus']) ? $options['sub_menus'] : array();

    parent::start_el($item_html, $item, $depth, $args);


    if ($item->is_dropdown && ($depth === 0) && ( $nav_layout === 0 || $nav_layout === 3 ) ) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="collapse" data-target="#dropdown-'.$item->ID.'"', $item_html);
    }
    elseif (stristr($item_html, 'li class="divider')) {
      $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
    }
    elseif (stristr($item_html, 'li class="dropdown-header')) {
      $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
    }
    elseif ( $sub_menus && ( $nav_layout === 1 || $nav_layout === 2 ) ) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="collapse" data-target="#sub-menu-'.$item->ID.'"', $item_html);
    }

    if ( $item->classes[0] == 'nav-logo' ) {
      $item_html = preg_replace('/<a[^>](.*)>(.*)<\/a>/iU', '<a $1><span class="nav-logo-wrapper"><img class="logo-light" src="'.$logo_light['url'].'" alt="'.$site_name.'"><img class="logo-dark" src="'.$logo_dark['url'].'" alt="'.$site_name.'"></span></a>', $item_html);
    }

    if ( $item->classes[0] == 'nav-translate' ) {
      $item_html = preg_replace('/<a[^>](.*)>(.*)<\/a>/iU', do_shortcode('[gtranslate]'), $item_html);
    }

    $item_html = apply_filters('roots/wp_nav_menu_item', $item_html);
    $output .= $item_html;
  }

  function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

    if ($element->is_dropdown) {
      $element->classes[] = 'dropdown';
    }

    parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}

/**
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 */
function roots_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

  $classes[] = 'menu-item menu-' . $slug;

  $classes = array_unique($classes);

  //highlight custom post type nav menu. Excempt product because woocommerce already handles this
  if ( (get_post_type() !== 'post') && (get_post_type() !== 'page' && ( get_post_type() !== 'product' ) ) ) {
    $post_type = get_post_type();

    // remove unwanted classes if found
    $post_type_link = rtrim(get_post_type_archive_link($post_type),'/');
    $classes = str_replace( 'active', '', $classes );
    // find the url you want and add the class you want
    if ( $item->url == $post_type_link ) {
      $classes = str_replace( 'menu-'.$slug.'', 'menu-'.$slug.' active', $classes );
    }
  }

  return array_filter($classes, 'is_element_empty');
}
add_filter('nav_menu_css_class', 'roots_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Use Roots_Nav_Walker() by default
 */
function roots_nav_menu_args($args = '') {
  $roots_nav_menu_args = array();

  $roots_nav_menu_args['container'] = false;

  if (!$args['items_wrap']) {
    $roots_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  }

  if (!$args['depth']) {
    $roots_nav_menu_args['depth'] = 2;
  }

  if (!$args['walker']) {
    $roots_nav_menu_args['walker'] = new Roots_Nav_Walker();
  }

  return array_merge($args, $roots_nav_menu_args);
}
add_filter('wp_nav_menu_args', 'roots_nav_menu_args');

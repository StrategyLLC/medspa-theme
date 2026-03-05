<?php
  $logo_light = get_field( 'global_logo', 'option' );
  $logo_dark = get_field( 'global_logo_dark', 'option' );
  $first_component = ll_get_first_component();
  $menu_items = wp_get_nav_menu_items( get_nav_menu_locations()['primary_navigation'] );
?>

<header class="navbar navbar-2 full-nav <?php echo ( $first_component != 'lander-2' && $first_component != 'lander-2-b' ? 'is-dark' : '') ?>">
  <div class="container">

    <a class="nav-logo logo-light" href="<?php echo home_url(); ?>"><img src="<?php echo $logo_light['url']; ?>" alt="<?php bloginfo('name'); ?>"></a>
    <a class="nav-logo logo-dark" href="<?php echo home_url(); ?>"><img src="<?php echo $logo_dark['url']; ?>" alt="<?php bloginfo('name'); ?>"></a>

    <button type="button" class="navbar-toggle navbar-toggle--stand" data-target="#primary-nav">
      <span class="navbar-toggle__text">menu</span>
      <span class="navbar-toggle__lines">
      </span><!-- .navbar-toggle__lines -->
    </button><!-- .navbar-toggle -->
  </div>

  <nav class="primary-nav collapsed" id="primary-nav" role="navigation" data-content="collapse">
    <div class="container">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav'));
      endif;
      ?>

      <?php foreach ($menu_items as $key => $item) : ?>
        <?php
          $options = get_field( 'dropdown_options_full', $item->ID );
          $sub_menus = $options['sub_menus'];
        ?>
        <?php if ( $sub_menus ) : ?>
          <div class="sub-menu collapsed" id="sub-menu-<?php echo $item->ID; ?>">
          <?php foreach ($sub_menus as $key => $menu) : ?>
            <ul>
              <?php if ( $menu['menu_heading'] ) : ?>
                <li class="menu-heading"><?php echo $menu['menu_heading'] ?></li>
              <?php endif; ?>
              <?php foreach ($menu['menu_items'] as $key => $menu_item): ?>
                <li><a href="<?php echo $menu_item['url']; ?>"><?php echo $menu_item['label']; ?></a></li>
              <?php endforeach ?>
            </ul>
          <?php endforeach; ?>
          <button class="menu-back button is-lined line-left">Back</button>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>

      <?php ll_get_social_list(); ?>
    </div>
  </nav>
</header>

<?php
  $first_component = ll_get_first_component();
  $logo_light = get_field( 'global_logo', 'option' );
  $logo_dark = get_field( 'global_logo_dark', 'option' );
?>
<header class="navbar navbar-1 is-white <?php echo ( $first_component != 'lander-2' && $first_component != 'lander-2-b' ? 'is-dark' : '') ?>">
  <div class="container">

    <div class="mobile-logos">
      <a class="nav-logo logo-light" href="<?php echo home_url(); ?>"><img src="<?php echo $logo_light['url']; ?>" alt="<?php bloginfo('name'); ?>"></a>
      <a class="nav-logo logo-dark" href="<?php echo home_url(); ?>"><img src="<?php echo $logo_dark['url']; ?>" alt="<?php bloginfo('name'); ?>"></a>
    </div>

    <button type="button" class="navbar-toggle navbar-toggle--stand" data-nav="collapse" data-target="#primary-nav">
      <span class="navbar-toggle__text">menu</span>
      <span class="navbar-toggle__lines">
      </span><!-- .navbar-toggle__lines -->
    </button><!-- .navbar-toggle -->

    <nav class="primary-nav" id="primary-nav" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav'));
      endif;
      ?>
      <div></div>
    </nav>

  </div>

</header>

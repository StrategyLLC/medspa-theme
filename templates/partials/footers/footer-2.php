<?php
  $logo_light = get_field( 'global_logo', 'option' );
  $logo_dark = get_field( 'global_logo_dark', 'option' );
  $content_blocks = get_field( 'footer_content', 'option' );
  $background_options = get_field( 'footer_background', 'option' );
  $background_color = $background_options['background_image']['color'];
  $text_color = $background_options['background_image']['text_color'];
  $background_image = $background_options['background_image']['image'];
  $background_attachment = $background_options['background_image']['attachment'];
  $background_repeat = $background_options['background_image']['repeat'];
  $background_size = $background_options['background_image']['size'];
  $menus = get_nav_menu_locations();
  $styles = '';
  if ( $background_color ) {
    $styles .= 'background-color: ' . $background_color .';';
  }

  if ( $background_image ) {
    $styles .= 'background-image: url('.$background_image['url'].');';
  }

  if ( $background_attachment ) {
    $styles .= 'background-attachment: '.$background_attachment.');';
  }

  if ( $background_repeat ) {
    $styles .= 'background-repeat: '.$background_repeat.');';
  }

  if ( $background_size ) {
    $styles .= 'background-size: '.$background_size.');';
  }

  if ( $text_color ) {
    $styles .= 'color: ' . $text_color .';';
  }
?>

<footer class="footer footer-2 <?php echo ( get_field( 'footer_choice', 'option' ) == 0 || get_field( 'footer_choice', 'option' ) == 2 ? 'is-light' : 'is-dark' ) ?>" style="<?php echo $styles; ?>" id="main-footer">
  <div class="container">

    <div class="footer__logo-wrap">
      <a class="footer__logo logo-light" href="#"><img src="<?php echo $logo_light['url']; ?>" alt="<?php bloginfo('name'); ?>"></a>
      <a class="footer__logo logo-dark" href="#"><img src="<?php echo $logo_dark['url']; ?>" alt="<?php bloginfo('name'); ?>"></a>
    </div>


    <div class="footer__top">
      <div class="row">
        <div class="col-sm-3of12 first-col">
          <?php if ( $menus ) : ?>
            <?php foreach ($menus as $key => $menu): ?>
              <?php if ( $key == 'footer_menu_one' || $key == 'footer_menu_two' ) : ?>
                <?php $nav_menu = wp_get_nav_menu_object( $menu ); ?>
                <?php if ( has_nav_menu( $key ) ) : ?>
                    <span class="footer__hdg"><?php echo $nav_menu->name; ?></span>
                    <?php wp_nav_menu( array( 'theme_location' => $key, 'menu_class' => 'footer__menu' ) ); ?>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach ?>
          <?php endif; ?>
        </div>

        <div class="col-sm-6of12 center-col">
          <div class="footer__blocks">
          <?php if ( $content_blocks ) : ?>
            <?php foreach ($content_blocks as $key => $block): ?>
              <div class="footer__block">
                <?php echo $block['content']; ?>
              </div>
            <?php endforeach ?>
          <?php endif; ?>
          </div>

          <?php if ( function_exists('gravity_form') && get_field('newsletter_form_id', 'option') ) : ?>
            <?php echo gravity_form( get_field('newsletter_form_id', 'option') ,true,false,'',false,true); ?>
          <?php endif; ?>

          <?php ll_get_social_list(); ?>
        </div>

        <div class="col-sm-3of12 end-col">
          <?php if ( $menus ) : ?>
            <?php foreach ($menus as $key => $menu): ?>
              <?php if ( $key == 'footer_menu_three' || $key == 'footer_menu_four' ) : ?>
                <?php $nav_menu = wp_get_nav_menu_object( $menu ); ?>
                <?php if ( has_nav_menu( $key ) ) : ?>
                    <span class="footer__hdg"><?php echo $nav_menu->name; ?></span>
                    <?php wp_nav_menu( array( 'theme_location' => $key, 'menu_class' => 'footer__menu' ) ); ?>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach ?>
          <?php endif; ?>
        </div>

      </div>

    </div>

    <div class="footer__bottom">
      <span class="footer__copyright"><?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All rights reserved</span>
      <span class="footer__credits"><a href="https://liftedlogic.com" title="Web Design in Kansas City">Web Design in Kansas City</a> by <a href="https://liftedlogic.com" title="Lifted Logic">Lifted Logic</a></span>
    </div>

  </div>
</footer>

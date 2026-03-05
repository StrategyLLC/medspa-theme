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

<footer class="footer <?php echo ( get_field( 'footer_choice', 'option' ) == 0 || get_field( 'footer_choice', 'option' ) == 2 ? 'is-light' : 'is-dark' ) ?>" style="<?php echo $styles; ?>" id="main-footer">
  <div class="container">

    <a class="footer__logo logo-light" href="#"><img src="<?php echo $logo_light['url']; ?>" alt="<?php bloginfo('name'); ?>"></a>
    <a class="footer__logo logo-dark" href="#"><img src="<?php echo $logo_dark['url']; ?>" alt="<?php bloginfo('name'); ?>"></a>

    <div class="footer__top">
      <div class="row">
        <div class="col-sm-3of12">
          <div class="footer__blocks">
            <?php if ( $content_blocks ) : ?>
              <?php foreach ($content_blocks as $key => $block): ?>
                <div class="footer__block">
                  <?php echo $block['content']; ?>
                </div>
            <?php endforeach ?>
          <?php endif; ?>
          </div>
        </div>

        <div class="col-sm-9of12">
          <div class="row">
            <?php if ( $menus ) : ?>
              <?php foreach ($menus as $key => $menu): ?>
                <?php if ( $key !== 'primary_navigation' ) : ?>
                  <?php $nav_menu = wp_get_nav_menu_object( $menu ); ?>
                  <?php if ( has_nav_menu( $key ) ) : ?>
                    <div class="<?php echo ( $key == 'footer_menu_five' ? 'col-sm-1of9' : 'col-sm-2of9' ) ?>">
                      <span class="footer__hdg"><?php echo $nav_menu->name; ?></span>
                      <?php wp_nav_menu( array( 'theme_location' => $key, 'menu_class' => 'footer__menu' ) ); ?>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endforeach ?>
            <?php endif; ?>

            <div class="col-5of9">
              <?php if ( function_exists('gravity_form') && get_field('newsletter_form_id', 'option') ) : ?>
                <?php echo gravity_form( get_field('newsletter_form_id', 'option') ,true,false,'',false,true); ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer__bottom">
      <span class="footer__copyright"><?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All rights reserved</span>
      <span class="footer__credits"><a href="https://liftedlogic.com" title="Web Design in Kansas City">Web Design in Kansas City</a> by <a href="https://liftedlogic.com" title="Lifted Logic">Lifted Logic</a></span>
    </div>

  </div>
</footer>

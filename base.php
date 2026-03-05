<?php get_template_part('templates/partials/head'); ?>
<body <?php body_class(); ?>>
  <?php include_once( 'assets/img/symbol-defs.svg' ); ?>
  <!--[if lt IE 8]>
  <div class="alert alert-warning">
  <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
  </div>
  <![endif]-->

  <?php
  do_action('get_header');
  ll_get_navbar_layout();
  $first_component = ll_get_first_component();
  echo set_post_background();
  ?>

  <div class="wrap" role="document">
    <div class="content">
      <?php //@TODO: @feature update first_component check to be dynamic ?>
      <main class="main" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->

    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php ll_get_footer_layout(); ?>

  <?php wp_footer(); ?>
<!--
  <div id="grid-overlay">
    <div class="container">
      <div class="row">
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
        <div class="col-1of12"></div>
      </div>
    </div>
  </div> -->
</body>
</html>

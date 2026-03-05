/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

( function( app ) {

  var COMPONENT = {


    init: function() {

      window.userLoggedIn = false;
      window.adminBarHeight = 0;

      if ( $('#wpadminbar').length > 0 ) {
        window.userLoggedIn = true;
        window.adminBarHeight = '32px';
      }

      /**
       * IF your navbar is fixed
       * use this function
       */
      function checkAdminBar() {
        // if ( window.userLoggedIn ) {
        //   $('header.navbar').css('top', window.adminBarHeight);
        // }
      }

      checkAdminBar();

      if ( window.location.hash ) {
        var headerHeight = $('header.navbar').outerHeight();
        var targetEl = $(window.location.hash);
        var marginOffset = parseInt( window.getComputedStyle($(targetEl).get(0)).marginTop );
        headerHeight = headerHeight + marginOffset;
        if ( $(targetEl).length ) {
          $(targetEl)[0].setAttribute('style', 'padding-top:'+headerHeight+'px;margin-top:' + (headerHeight*-1) + 'px!important;' );
        }
      }

      function stickFooter() {
        var backgroundColor = site_info.footer_bg_color;
        var textColor = site_info.footer_text;
        var backgroundImage = site_info.footer_bg_image;
        var backgroundRepeat = site_info.footer_bg_repeat;
        var backgroundSize = site_info.footer_bg_size;
        var backgroundAttachment = site_info.footer_bg_attachment;

        if ( !window.isMobile ) {

          var lastElMargin = $('.main > *:last-child').css('marginBottom');

          $('.main > *:last-child').addClass('no-margin');

          var marginBottom = $('footer.footer').outerHeight();

          $('footer.footer').css({
            backgroundColor: backgroundColor,
            backgroundImage: backgroundImage,
            backgroundRepeat: backgroundRepeat,
            backgroundAttachment: backgroundAttachment,
            backgroundSize: backgroundSize,
            color: textColor,
            position: 'fixed',
            bottom: 0,
            left: 0,
            width: '100%',
            zIndex: -1
          });

          $('.main').css({
            paddingBottom: parseInt( lastElMargin ),
            marginBottom: marginBottom
          });
        } else {
          $('.main').attr('style', '');
          $('footer.footer').attr('style', '');
          $('footer.footer').css({
            backgroundColor: backgroundColor,
            backgroundImage: backgroundImage,
            backgroundRepeat: backgroundRepeat,
            backgroundAttachment: backgroundAttachment,
            backgroundSize: backgroundSize,
            color: textColor,
          });
        }
      }

      // Pushing down .wrap to account for nav, and adjusting lander component's content.
      $(document).on('ready', function(){
        var navHeight = $('.navbar').outerHeight();
        $('.wrap').css('margin-top', navHeight);
        $('.ll-lander-2__content').css('margin-top', - navHeight);
      });

      function navIsMobile() {
        if ( window.isMobile && ( $('header.navbar').is('.navbar-1') || $('header.navbar').is('.navbar-4') ) ) {
          $('header.navbar').addClass('is-mobile');
        } else {
          $('header.navbar.is-mobile').removeClass('is-mobile');
        }
      }

      stickFooter();
      navIsMobile();

      $(window).resize( function(e){
        var screenSize = window.getComputedStyle(document.body,':after').getPropertyValue('content');
        if ( screenSize === '"desktop"' || screenSize === 'desktop' ) {
          window.isMobile = false;
        } else {
          window.isMobile = true;
        }

        stickFooter();
        navIsMobile();
      });

      $('.main').css({
        paddingTop: $('.main > .is-first').css('marginTop')
      });



      if ( $('.is-first').length ) {
        $('.main > .is-first').get(0).style.setProperty('margin-top', 0, 'important');
      }

      if ( $('.main.push-down').length ) {
        $('.main').css({
          marginTop: $('header.navbar').outerHeight()
        });
      }

      $(function() {
        $('a[href*="#"]:not(.js-no-scroll):not([href="#"])').click(function() {
          if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
            var target = $(this.hash);
            var wpadminBarHeight = 0;
            if ( $('#wpadminbar').length > 0 ) {
              wpadminBarHeight = $('#wpadminbar').outerHeight();
            }
            var headerHeight = $('header.navbar').outerHeight();
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
              $('html, body').animate({
                scrollTop: target.offset().top - ( headerHeight + wpadminBarHeight )
              }, 1000);
              return false;
            }
          }
        });
      });

      // JavaScript to be fired on all pages
      //Basic Collapse toggle for dropdowns and toggle menus
      $('[data-toggle="collapse"]').on('click', function(e) {
        e.preventDefault();
        //if target element is not open already
        //find all open collapse elements and close them
        if ( !$(this).is('.collapsed') ) {
          if ( $('.collapsed[data-toggle="collapse"]').length > 0 ) {
            $('.collapsed[data-toggle="collapse"]').each(function(){
              $(this).trigger('click');
            });
          }
        }

        var target = $(this).data('target');
        $(this).toggleClass('collapsed');
        $(target).toggleClass('collapsed');
      });

      /*
       * Collapse specificially for the nav. Utilizes .slideToggle()
       * for sliding animation for a more "out of the box" nice looking
       * mobile animation. Can easily be removed or altered for
       * more specific funcitonality.
       */
      $('[data-nav="collapse"]').on('click', function(e) {
        e.preventDefault();
        console.log( 'data nav' );
        var target = $(this).data('target');
        $(this).toggleClass('open');
        $('body').toggleClass('locked');
        if ( $('header.navbar').not('.is-white') ) {
          $('header.navbar').addClass('is-white');
        }
        $(target).slideToggle();
      });

      $(document).click(function(e) {
          //close all [data-toggle="collapse"] elements if
          //target doesn't have any data attributes defined or
          //if the target is does not have a data-toggle and
          //it does not have a data-content and
          //then make sure that the target is not a child of data-content="collapse"
          if (
            ( $(e.target).data('toggle') === undefined || $(e.target).data('toggle') === false ) &&
            ( $(e.target).data('content') === undefined || $(e.target).data('content') ===  false ) &&
            !$(e.target).parents( '[data-content="collapse"]' ).length
            ) {
            $('.collapsed[data-toggle="collapse"]').each(function(e){
              $(this).trigger('click');
            });
        }
      });

      $('.full-nav .navbar-toggle').click( function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $(this).toggleClass('open');
        $(target).toggleClass('collapsed');
        $('body').toggleClass('locked');
        if ( $('header.navbar').not('.is-white') ) {
          $('header.navbar').addClass('is-white');
        }
      });

      if ( $('.full-nav.navbar-3').length ) {
        $('.primary-nav').css({
          paddingTop: ( $(window).outerHeight() / 2 ) - ( $('.primary-nav .nav').outerHeight() / 2 )
        });
      }

      $('.full-nav .dropdown-toggle').click( function(e){
        if ( $('.full-nav').find('.sub-menu:not(.collapsed)' ).length > 0 ) {
          $('.full-nav .primary-nav').addClass('open');
        } else {
          $('.full-nav .primary-nav').removeClass('open');
        }
      });

      $('.menu-back').click( function(e){
        e.preventDefault();
        $('.full-nav .dropdown-toggle.collapsed').click();
      });

      // Magnific Popup
      // For embeded images within the post content
      $('a[rel="magnific"]').magnificPopup({
        type: 'image',
        removalDelay: 300,
        mainClass: 'mfp-fade'
      });

    },


    finalize: function() {


      //Global Fade In animations

      if ( $('.animated-row').length > 0 ) {
        var contentController = new ScrollMagic.Controller({
          globalSceneOptions: {
            triggerHook: 0.75
          }
        });
        $('.animated-row').each( function(index, row) {
          var rowCount = 0;

          var fadeInItems = $(row).find( '.animated-image,.wysiwyg:not(.not-animated) .h1, .wysiwyg:not(.not-animated) .h2,.wysiwyg:not(.not-animated) .h3,.wysiwyg:not(.not-animated) .h4,.wysiwyg:not(.not-animated) .h5,.wysiwyg:not(.not-animated) .h6,.wysiwyg:not(.not-animated) h1,.wysiwyg:not(.not-animated) h2,.wysiwyg:not(.not-animated) h3,.wysiwyg:not(.not-animated) h4,.wysiwyg:not(.not-animated) h5,.wysiwyg:not(.not-animated) h6, .wysiwyg:not(.not-animated) figure' );

          $(fadeInItems).each( function(index, el){
            var rowCount = index % 4;
            var offset = ( rowCount / 10 ) * 1.5;
            var transition = 'opacity 0.6s '+offset+'s cubic-bezier(0.645, 0.045, 0.355, 1)';
            $(el).css({
              'transition': transition
            });

            new ScrollMagic.Scene({
                triggerElement: $(el)
              })
              .setClassToggle($(el), 'is-visible' )
              .addTo(contentController);
          });
        });
      }

      var navController = new ScrollMagic.Controller({
        globalSceneOptions: {
          triggerHook: 'onLeave',
          offset: $(window).outerHeight() * 0.25
        }
      });

      // var navScene = new ScrollMagic.Scene({
      //   triggerElement: $('.main > *:first-child')
      // })
      // .setClassToggle( $('header.navbar'), 'is-white' )
      // .addTo(navController);

      if ( !window.isMobile ) {

        var parallaxController = new ScrollMagic.Controller({
          globalSceneOptions: {
            triggerHook: 0.8
          }
        });

        // $('.parallax-group:not(.ll-post-list)').each( function(key, el) {
        //   var parallaxItems = $(el).find( '.row [class*="col"]:nth-child(3n+2) .parallax-item' );

        //   $(parallaxItems).each( function(index, item) {
        //     var scene = new ScrollMagic.Scene({
        //         triggerElement: $(el),
        //         duration: '200%'
        //       })
        //       .setTween( $(item), 1, {y: ( ( $(item).outerHeight() / 3) * -1 ), ease: Linear.easeNone} )
        //       .addTo(parallaxController);

        //   });

        // });

      }


      $('.form-skin input, .form-skin textarea').focus( function(e){
        var container = $(this).closest('span');
        if ( $(container).length === 0 ) {
          container = $(this).closest('.gfield');
        }

        $(container).addClass('is-focused');
      });

      $('.form-skin input, .form-skin textarea').blur( function(e){
        var container = $(this).closest('.is-focused');
        if ( $(this).val().length === 0 ) {
          $(container).removeClass('is-focused');
        }
      });


      $('.js-init-video').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        callbacks: {
          open: function() {
            $('video').trigger('pause');
          },
          close: function() {
            $('video').trigger('play');
          }
        }
      });
    }
  };

  app.registerComponent( 'common', COMPONENT );
} )( app );

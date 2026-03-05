/**
* Lander 2 JS
* -----------------------------------------------------------------------------
*
* All the JS for the Lander 2 component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-lander-2',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
      var offsetHeight = $(window).outerHeight();
      offsetHeight = ( 25 / offsetHeight );

      var contentController = new ScrollMagic.Controller({
        globalSceneOptions: {
          triggerHook: offsetHeight,
          duration: '100%',
        }
      });

      function sizeBlocks(el) {
        var content = $(el).find('.ll-lander-2__content-wrap .container');
        if ( $(content).outerHeight() >= $(window).outerHeight() ) {
          $(el).find('.ll-lander-2__content-wrap').addClass('is-tall');
          $('.ll-lander-2.is-first').css({
            'paddingTop': $('header.navbar').outerHeight()
          });
          $(el).css({
            'height': 'auto'
          });
        } else {
          $(el).find('.ll-lander-2__content-wrap').removeClass('is-tall');
          $(el).attr('style', '');
        }
      }

      // $('.ll-lander-2').each( function(index, el) {
      //   if ( $(el).is('.ll-lander-2:not(:last-child)' ) ) {
      //     new ScrollMagic.Scene({
      //         triggerElement: $(el)
      //       })
      //       .setClassToggle( $(el).children( '.ll-lander-2__image' ), 'is-pinned' )
      //       .setPin( $(el).children('.ll-lander-2__image') )
      //       .setTween( $(el).find('.ll-lander-2__image'), {opacity: "0", ease: Linear.easeNone} )
      //       .addTo(contentController);

      //       sizeBlocks(el);
      //   }
      // });

      $(window).resize( function(e) {
        $('.ll-lander-2').each( function(index, el){
          sizeBlocks(el);
        });
      });

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'lander-2', COMPONENT );
} )( app );

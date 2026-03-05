/**
* Lander 1 JS
* -----------------------------------------------------------------------------
*
* All the JS for the Lander 1 component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-lander-1',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
      var contentController = new ScrollMagic.Controller({
        globalSceneOptions: {
          triggerHook: 1,
          reverse: false
        }
      });

      $('.ll-lander-1').each( function(index, el) {
        new ScrollMagic.Scene({
            triggerElement: $(el)
          })
          .setClassToggle( $(el), 'is-visible')
          .addTo(contentController);
      });


    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'lander-1', COMPONENT );
} )( app );

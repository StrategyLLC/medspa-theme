/**
* Photo Break JS
* -----------------------------------------------------------------------------
*
* All the JS for the Photo Break component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-photo-break',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'photo-break', COMPONENT );
} )( app );

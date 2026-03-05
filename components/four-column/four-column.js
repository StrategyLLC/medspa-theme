/**
* Four Column JS
* -----------------------------------------------------------------------------
*
* All the JS for the Four Column component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-four-column',


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
  app.registerComponent( 'four-column', COMPONENT );
} )( app );

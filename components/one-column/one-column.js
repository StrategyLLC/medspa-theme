/**
* One Column JS
* -----------------------------------------------------------------------------
*
* All the JS for the One Column component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-one-column',


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
  app.registerComponent( 'one-column', COMPONENT );
} )( app );

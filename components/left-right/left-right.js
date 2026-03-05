/**
* Left Right JS
* -----------------------------------------------------------------------------
*
* All the JS for the Left Right component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-left-right',


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
  app.registerComponent( 'left-right', COMPONENT );
} )( app );

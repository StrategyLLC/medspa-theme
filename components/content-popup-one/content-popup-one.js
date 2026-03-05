/**
* Content Popup One JS
* -----------------------------------------------------------------------------
*
* All the JS for the Content Popup One component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-content-popup-one',


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
  app.registerComponent( 'content-popup-one', COMPONENT );
} )( app );

/**
* Quoter Form JS
* -----------------------------------------------------------------------------
*
* All the JS for the Quoter Form component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-quoter-form',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;

      $('.ll-quoter-form .ginput_container_select').parent().find('label').click(function() {
        $(this).parent().find('select').trigger('click');
      });

      $('.ll-quoter-form .gfield-column-block select, .ll-quoter-form .gfield-block select').on('change', function() {
        if ( $(this).val().length ) {
          $(this).parent().parent().addClass('has-value');
        } else {
          $(this).parent().parent().removeClass('has-value');
        }
      });

      $('.ll-quoter-form .gfield-column-block, .ll-quoter-form .gfield-block').each(function() {
        if ( $(this).find('select').val().length ) {
          $(this).addClass('has-value');
        } else {
          $(this).removeClass('has-value');
        }
      });



    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'quoter-form', COMPONENT );
} )( app );

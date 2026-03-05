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

    loadPopup : function( popupContent, imageSize ) {
      var popup = $.magnificPopup.open({
        items: {
          src: '<div class="content-popup loading"><div></div></div>'
        },
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
      }, 0);

     $.ajax({
        type: 'POST',
        url: site_info.ajax_url,
        data: {
          action: 'll_load_content_popup',
          content : popupContent,
          size: imageSize
        },
        beforeSend: function( xhr ) {

        },
        success: function( data ) {
          var response = $.parseJSON( data );
          if ( response.template ) {
            $('.content-popup > div').html(response.template);
          }

        },
        complete: function( jqXHR, status ) {
          if ( status === 'error' ) {
            setTimeout(function(){
              console.log( 'oops' );
            }, 500);
          }
        }
      });
    },

    init: function() {

      var _this = this;

      $(document).on('click', '.js-init-content-popup', function(e){
        e.preventDefault();
        _this.loadPopup( $(this).data('content'), $(this).data('size') );
      });

    },

    finalize: function() {
    }
  };

  app.registerComponent( 'modal', COMPONENT );
} )( app );

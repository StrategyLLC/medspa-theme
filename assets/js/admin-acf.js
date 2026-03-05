(function($) {

  if ( typeof acf !== 'undefined' ) {
    acf.add_action('append', function( $el ){
      //when a new layout is added, add a field for 'Component Type'

      //get the max input, to append our new input to
      var maxInput = $($el).find('.acf-fc-meta-max');

      //get the necessary layoutId and fieldId to save our field appropriately
      var layoutId = $($el).data('id');
      var fieldId = $($el).closest('.acf-field-object').data('id');

      if ( $($el).find('.acf-fc-meta-component-type').length == 0 && $($el).find('acf-fc-meta-custom-label').length == 0 ) {
        //build our new input
        $(maxInput).after('<li class="acf-fc-meta-component-type"><div class="acf-input-prepend">Component Type</div><div class="acf-input-wrap"><input type="text" id="acf_fields-'+fieldId+'-layouts-'+layoutId+'-component_type" class="acf-is-prepended" name="acf_fields['+fieldId+'][layouts]['+layoutId+'][component_type]" value=""></div></li><li class="acf-fc-meta-component-preview"><div class="acf-input-prepend">Preview Image</div><div class="acf-input-wrap"><input type="text" id="acf_fields-'+fieldId+'-layouts-'+layoutId+'-component_preview" class="acf-is-prepended" name="acf_fields['+fieldId+'][layouts]['+layoutId+'][component_preview]"></div></li>');
      }

    });

    acf.add_filter('wysiwyg_tinymce_settings', function( mceInit, id, $field ){
      // console.log( ll_admin_globals.site_colors );
      if ( $field.hasClass('footer') ) {
        mceInit.toolbar1 = 'styleselect,bold,alignleft,aligncenter,alignright,link,unlink';
        mceInit.body_class += ' footer';
        mceInit.style_formats = [
          { title: 'Heading', selector: 'h1,h2,h3,h4,h5,h6,p', classes: 'footer__hdg' }
        ];
      }


      // return
      return mceInit;

    });

    acf.add_action('ready', function( $el ){
      //get all layouts on load for admin pages
      var layouts = $('.acf-field-setting-fc_layout');
      layouts.each( function(index, el) {

        //get the max input, to append our new input to
        var maxInput = $(el).find('.acf-fc-meta-max');

        //get the necessary layoutId and fieldId to save our field appropriately
        var layoutId = $(el).data('id');
        var fieldId = $(el).closest('.acf-field-object').data('id');

        //get the necessary component-type value from a hidden div inserted with the php render_field_settings filter
        var value = $('#ll-layout-'+layoutId).data('component-type');
        var preview = $('#ll-layout-'+layoutId).data('preview');

        //build the input
        $(maxInput).after('<li class="acf-fc-meta-component-type"><div class="acf-input-prepend">Component Type</div><div class="acf-input-wrap"><select id="acf_fields-'+fieldId+'-layouts-'+layoutId+'-component_type" class="acf-is-prepended" name="acf_fields['+fieldId+'][layouts]['+layoutId+'][component_type]" value="'+value+'"></select></div></li><li class="acf-fc-meta-component-preview"><div class="acf-input-prepend">Preview Image</div><div class="acf-input-wrap"><input type="text" id="acf_fields-'+fieldId+'-layouts-'+layoutId+'-component_preview" class="acf-is-prepended" name="acf_fields['+fieldId+'][layouts]['+layoutId+'][component_preview]" value="'+preview+'"></div></li>');

        var typeSelect = $(el).find('.acf-fc-meta-component-type select');

        $.each(componentTypes, function(index, item){
          var checked = ( ( value == item.name ) ? true : false );
          $(typeSelect).append($('<option>', {
              value: item.name,
              text : item.name,
              selected: checked
          }));
        });
      });

      if ( typeof currentScreen !== 'undefined' ) {
        //if we're on the Component Setup page, create our preview options
        if ( currentScreen && currentScreen == 'site-options_page_acf-options-component-setup' ) {
          //get all inputs within our group
          var inputs = $('#acf-field_ll_component_setup .acf-checkbox-list input[type="checkbox"]');
          $(inputs).each( function(index, el) {
            var imgPreview = '';

            //loop through global allLayouts and check if this
            //element matches one of them. If so, set imgPreview
            $.each(allLayouts, function(index, item){
              if ( item.name == $(el).val() ) {
                imgPreview = item.component_preview;
              }
            });

            var label = $(el).parent();

            //if a preview image is available, create the preview button, and popup
            if ( imgPreview ) {
              $(label).append('<button class="ll-preview-tooltip" data-modal="#preview-popup-'+index+'" type="button"></button><div id="preview-popup-'+index+'" class="mfp-hide ll-preview-modal"><img src="'+imgPreview+'"></div>');
            }
          });

          //click event for our preview popup
          $(document).on('click', '.ll-preview-tooltip', function(e) {
            e.preventDefault();
            var popupId = $(this).data('modal');

            if( popupId !== '' ) {

              $.magnificPopup.open({
                items           : {
                  src: popupId
                },
                type            : 'inline',
                fixedContentPos : true,
                fixedBgPos      : true,
                overflowY       : 'auto',
                closeBtnInside  : true,
                preloader       : false,
                midClick        : true,
                removalDelay    : 300,
              }, 0);

            }
          });
        }
      }
    });

  }


  if ( typeof currentScreen !== 'undefined' ) {
    if ( currentScreen && ( currentScreen == 'site-options_page_acf-options-component-setup' || currentScreen == 'site-options_page_acf-options-theme-options' ) ) {
      //if we're on the Component Setup page, and there aren't any layouts set to be active,
      //disable the publish button
      if ( currentScreen == 'site-options_page_acf-options-component-setup' && $('#acf-field_ll_component_setup label.selected').length == 0   ) {
        $('#publish').attr('disabled',true).removeClass('button-primary');
      }

      if ( currentScreen == 'site-options_page_acf-options-theme-options' ) {
        var inputs = $('.toggle .acf-input input[type="checkbox"]');
        $(inputs).each( function(index, el){
          if ( $(el).is(':checked') ) {
            $(el).parent().addClass('selected');
          }
        });
      }


      $(document).on('change', '#acf-field_ll_component_setup input[type="checkbox"],#acf-field_ll_global_setup input[type="checkbox"], .toggle .acf-input input[type="checkbox"]', function(){
        //set this input to be active
        $(this).parent().toggleClass('selected');
        if ( $(this).closest('#acf-field_ll_component_setup').length ) {

          //check if there aren't any active layouts after this input is toggled.
          if ( $('#acf-field_ll_component_setup label.selected').length == 0 ) {
            //alert that there should be at least one active layout
            //then disable publish button again.
            alert('You must have at least one active component!');
            $('#publish').attr('disabled',true).removeClass('button-primary');
          } else {
            //if this isn't the last active layout being toggled off, and the publish
            //button is disabled, reenable it
            if ( $('#publish').is(':disabled') ) {
              $('#publish').attr('disabled', false).addClass('button-primary');
            }
          }
        }
      });

    }
  }



  //Custom Labels on flexible content metaboxes
  if ( $('.ll-group-label input').length > 0 ) {
    var groupLabels = $( '.ll-group-label input' );
    $.each( groupLabels, function(){
      $(this).closest( '.layout' ).find( '.acf-fc-layout-handle' ).first().before( '<span class="ll-group-title" contenteditable="true">'+$(this).val()+'</span>' );
    });
  }

  /*
   * When a .ll-group-title input is updated, bind its value to the .ll-group-label input
   */
  $(document).on( 'input', '.ll-group-title', function(){
    $(this).closest( '.layout' ).find( '.ll-group-label input' ).attr( 'value', $(this).text() );
  });

})(jQuery);


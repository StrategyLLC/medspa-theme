(function($) {
  $(document).on('change', '.ll-quoter-icon-wrapper + textarea', function(e){
    var target = $(this).attr('id');
    var iconWrapper = $(this).prev();

    $(iconWrapper).html($(this).val());
  });

}(jQuery));

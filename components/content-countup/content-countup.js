/**
* content-countup JS
* -----------------------------------------------------------------------------
*
* All the JS for the content-countup component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'content-countup',


    selector : function() {
      return '.' + this.className;
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      //If the number is large, add some commas to make it visually appealing
      addCommas = function(num){
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      var controller = new ScrollMagic.Controller({globalSceneOptions: {duration: 0}}),
          _this   = this,
          callout = $("[data-component='"+_this.className+"']"),
          counters = $(callout).find('[data-count]');

      //Called when the counter enters the viewport using ScrollMagic
       function enterCounter(e) {
         var trigger    = $(e.target.triggerElement()),
             container  = $(trigger).parent().parent().parent(),
             datacount  = $(trigger).attr('data-count'),
             max        = parseFloat(datacount),
             curr       = 0,
             incr       = ( datacount.search('.') ? 0.5 : 1 );

         $(container).find('.ll-content-countup__content-container').each(function() {
          var target = $(this).find('.ll-content-countup__number');

          var datacount = $(target).attr('data-count'),
              max    = parseFloat(datacount),
              curr   = 0,
              incr   = ( datacount.search('.') ? 0.5 : 1 );

          var countUp = setInterval(function(){
            if( curr < max ) {
              curr+=incr;
            }else{
              curr = max;
              clearInterval(countUp);
            }
            $(target).html(addCommas(curr));
          }, 50);
        });
       }

       //Called when the the counter leaves the viewport
       function leaveCounter(e) {
        //Who started all this?? Oh, the target...
         var target = $(e.target.triggerElement());
         //..so lets reset it to '0'
         $(target).html('0');
       }

        //Now that it's all defined, if there are counters, iterate through them
       if ( $(counters) ) {
         for( var c = 0; c < counters.length; c++ ) {
           counter = counters[c];

           //Let's set this to trigger when it arrives in the center of the page
           //offset = -1 * $(counter).height();
           //...or if we prefer, right off the bat
           offset = -150;

           var count_start = new ScrollMagic.Scene({
             triggerElement: counter,
             offset: offset
           })
           .on("enter", enterCounter)
           .on("leave", leaveCounter)
           .addTo(controller);
         }
       }
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'content-countup', COMPONENT );
} )( app );

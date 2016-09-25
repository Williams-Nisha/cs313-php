$(document).ready(function(){
    $( ".details" ).hide();
    
    $('.square').on('click', function(e){
    $( ".details" ).show( "slow", function() {
     $(".details").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',   
        function(e) {
         console.log("All done!");
        // code to execute after transition ends
       $(".details").hide();
        });
      });
    });
});
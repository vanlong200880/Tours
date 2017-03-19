(function ($) { 
  //window scroll menu
  $(".current-position").on('click', '.btn-filter-advance', function(){
    $(".filter-advance").toggle('fast');
  });
  $(window).bind("scroll", function() {
    $(window).scrollTop() > 500 ? $("#header").addClass("fixed") : $("#header").removeClass("fixed");
  });
})(jQuery);
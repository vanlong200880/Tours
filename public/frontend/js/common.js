(function ($) { 
  //window scroll menu
  $(window).bind("scroll", function() {
    $(window).scrollTop() > 500 ? $("#header").addClass("fixed") : $("#header").removeClass("fixed");
  });
})(jQuery);
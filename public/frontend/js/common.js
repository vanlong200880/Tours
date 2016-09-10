(function ($) { 
  //window scroll menu
  $(window).bind("scroll", function() {
    $(window).scrollTop() > 50 ? $("#header").addClass("fixed") : $("#header").removeClass("fixed");
  });
})(jQuery);
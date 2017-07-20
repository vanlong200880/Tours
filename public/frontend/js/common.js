(function ($) { 
  "use strict";
  var defaults = {
    url : 'http://gonow.dev',
    categoryType: $("body .list-search").find('#category-type').val(),
    nation: $("body .list-search").find('#nation').val(),
    province: $("body .list-search").find('#province').val(),
    district: $("body .list-search").find('#district').val(),
    param: window.location.search.substring(1),
    keyword: $("body .list-search").find('#tasteKeyword').val(),
    filterType: $("body .filter-adv input.filter-param").val(),
    sortType: $("body .filter-adv input.filter-param").attr('data-sort'),
    starType: $("body .filter-adv input.filter-star").val(),
    minValue: $("body .filter-adv input.filter-star").attr('data-min'),
    maxValue: $("body .filter-adv input.filter-star").attr('data-min'),
    nationType: $("body .filter-adv input.filter-nation").val(),
    locationType: $("body .filter-adv input.filter-location").val(),
    area: $("body .filter-adv input.filter-area").val()
  };
  
  $.fn.render = function(){
    $("body #menu-top li").hover(function(){ 
      console.log('sd fs');
      $.fn.loadSwiperHome('.sw-menu1', 6, 6, 4, 3);
      $.fn.loadSwiperHome('.sw-menu2', 6, 6, 4, 3);
    });
    $.fn.loadSwiperHome('.sw-album', 4, 4, 3, 3);
  },
  
  $.fn.loadSwiperHome = function(id, slidesa, slidesb, slidesc, slidesd){
    var swiper = new Swiper(id, {
        nextButton: '.next',
        prevButton: '.prev',
        paginationClickable: true,
        slidesPerView: slidesa,
        spaceBetween: 10,
        breakpoints: {
            1024: {
                slidesPerView: slidesb,
                spaceBetween: 10
            },
            768: {
                slidesPerView: slidesc,
                spaceBetween: 10
            },
            640: {
                slidesPerView: slidesd,
                spaceBetween: 10
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });
  },
  $.fn.render();
})(jQuery);
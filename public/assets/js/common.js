(function ($) { 
  "use strict";
  var defaults = {
    URL : '',
  };
  $.fn.callAjaxRegion = function(url, method, postId, id){
    $.ajax({
      method: method,
      url: url,
      data: { postId: postId}
    })
    .done(function( data ) {
      $(id).empty().append(data.html);
    });
  }, 
  $.fn.render = function(){
    $("body").on("change", "#country_id", function(e) {
      
    });
  },
  $.fn.loadData = function(url, id, category){
    $.ajax({
      method: 'POST',
      url: url,
      data: {category: category },
      beforeSend: function(){
        $(".view-loading").css('display','block');
      },
      success: function(data){
        console.log(data);
        $(id).empty().append(data.html);
        $(".view-loading").css('display','none');
      }
    });
  }
  ;
  
  $.fn.callAjaxRegion();
  var categoryType = $("body .list-search").find('#category-type').val();
  $.fn.loadData('http://localhost/tours/public/load-data', '#view-data', categoryType);
  
//  var search = {
//    homeItem : "search-home",
//    item: {
//      travel:{
//        travelKeyword : "travelKeyword",
//        travelNation : "travelNation",
//        travelProvince : "travelProvince",
//        travelDistrict : "travelDistrict"
//      },
//      tour:{
//        tourKeyword : "tourKeyword", 
//        tourNation : "tourNation",
//        tourProvince : "tourProvince",
//        tourDistrict : "tourDistrict"
//      },
//      taste: {
//        tasteKeyword : "tasteKeyword",
//        tasteNation : "tasteNation",
//        tasteProvince : "tasteProvince",
//        tasteDistrict : "tasteDistrict"
//      },
//      hotel: {
//        hotelStartDay : "hotelStartDay",
//        hotelEndDay : "hotelEndDay",
//        hotelNation : "hotelNation",
//        hotelProvince : "hotelProvince",
//        hotelDistrict: "hotelDistrict"
//      }
//    },
//    button : {
//      travelSearchButton : "travel-search-button",
//      tourSearchButton : "tour-search-button",
//      tasteSearchButton : "taste-search-button",
//      hotelSearchButton : "hotel-search-button"
//    }
//  };
//var getData = function(id){
//  var r = {};
//  r[item.name] = item.val();
//  return r;
//};
//var data = {
//  travel: {},
//  tour : {},
//  taste : {},
//  hotel : {}
//};
//
//function callAjax(url, id){
//  $.ajax({
//    url: url,
//    type: "POST",
//    data: {'id': id},
//    beforeSend: function(){
//      
//    },
//    success: function(data) {
//        //$("#destination").hide(), $("#destination").html(e), $("#destination").fadeIn("slow");
//    }
//  })
//}
//search.render = function(){
//  var btnClick = $("#search ." +search.homeItem + " .panel-tab");
//  $("#travelNation").on('change', function(){
//    
//  });
//  btnClick.find('button').on('click', function(){
//    var active = $("." + search.homeItem+ " ul.nav").find('li.active').attr('data-key');
//    var link = '';
//    switch(active) {
//        case 'travel':
//          $.each(search.item.travel, function(key, value){
//            data.travel[key] = $("#" + value).val();
//          });
//            link += '/dia-diem-di-choi';
//            link += (data.travel.travelNation !== '')?'/'+data.travel.travelNation:'';
//            link += (data.travel.travelProvince !== '')?'/'+data.travel.travelProvince:'';
//            link += (data.travel.travelDistrict !== '')?'/'+data.travel.travelDistrict:'';
//            link += (data.travel.travelKeyword !== '')?'?keyword='+data.travel.travelKeyword:'';
//          break;
//        case 'tour':
//            $.each(search.item.tour, function(key, value){
//              data.tour[key] = $("#" + value).val();
//            });
//            link += '/tours-du-lich';
//            link += (data.tour.tourNation !== '')?'/'+data.tour.tourNation:'';
//            link += (data.tour.tourProvince !== '')?'/'+data.tour.tourProvince:'';
//            link += (data.tour.tourDistrict !== '')?'/'+data.tour.tourDistrict:'';
//            link += (data.tour.tourKeyword !== '')?'?keyword='+data.tour.tourKeyword:'';
//          break;
//        case 'hotel':
//          $.each(search.item.hotel, function(key, value){
//            data.hotel[key] = $("#" + value).val();
//          });
//            link += '/khach-san';
//            link += (data.hotel.hotelNation !== '')?'/'+data.hotel.hotelNation:'';
//            link += (data.hotel.hotelProvince !== '')?'/'+data.hotel.hotelProvince:'';
//            link += (data.hotel.hotelDistrict !== '')?'/'+data.hotel.hotelDistrict:'';
//            link += (data.hotel.hotelStartDay !== '')?'/'+data.hotel.hotelStartDay:'';
//            link += (data.hotel.hotelEndDay !== '')?'/'+data.hotel.hotelEndDay:'';
//          break;
//        case 'taste':
//          $.each(search.item.taste, function(key, value){
//             data.taste[key] = $("#" + value).val();
//          });
//          link += '/diem-an-uong';
//          link += (data.taste.tasteNation !== '')?'/'+data.taste.tasteNation:'';
//          link += (data.taste.tasteProvince !== '')?'/'+data.taste.tasteProvince:'';
//          link += (data.taste.tasteDistrict !== '')?'/'+data.taste.tasteDistrict:'';
//          link += (data.taste.tasteKeyword !== '')?'?keyword='+data.taste.tasteKeyword:'';
//          break;
//    }
//    var root = location.protocol + '//' + location.host + '/tours/public';
//    window.location.href = root + link;
//    console.log(root, link);
//    console.log(data);
//  });
//};
//search.render();
})(jQuery);
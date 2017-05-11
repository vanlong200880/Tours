(function ($) { 
  "use strict";
  var defaults = {
    url : 'http://localhost/tours/public',
    categoryType: $("body .list-search").find('#category-type').val(),
    nation: $("body .list-search").find('#nation').val(),
    province: $("body .list-search").find('#province').val(),
    district: $("body .list-search").find('#district').val(),
    param: window.location.search.substring(1)
  };
  $.fn.callAjaxRegion = function(url, alias, id, idRemove){
    $.ajax({
      method: 'POST',
      url: url,
      data: { alias: alias}
    })
    .done(function( data ) {
      console.log(data);
      $(id + " option[value!='']").each(function() {
        $(this).remove();
      });
      if(idRemove){
        $(idRemove + " option[value!='']").each(function() {
          $(this).remove();
        });
      }
      $(id).append(data.html);
      $(id).selectpicker('refresh');
      $(idRemove).selectpicker('refresh');
    });
  }, 
  $.fn.render = function(){
    $("body").on("change", "#country_id", function(e) {
    });
    
    //get data type
    $("body").on("change", "#category-type", function(e) {
      defaults['categoryType'] = $(this).val();
      if(defaults['province'] && defaults['district']){
        window.location.href = defaults['url'] + '/' + defaults['categoryType'] + '/' + defaults['province'] + '/' + defaults['district'] + '?' + defaults['param'];
      }else{
        if(defaults['province'] && defaults['district'] == ''){
          window.location.href = defaults['url'] + '/' + defaults['categoryType']+ '/' + defaults['province'] + '?' + defaults['param'];
        }else{
          window.location.href = defaults['url'] + '/' + defaults['categoryType'] + '?' + defaults['param'];
        }
      }
    });
    // get nation
    $("body").on('change', '#nation', function(){
      defaults['nation'] = $(this).val();
      $.fn.callAjaxRegion(defaults['url'] + '/province', defaults['nation'], '#province', '#district');
     });
     
     $("body").on('change', '#province', function(){
      defaults['province'] = $(this).val();
      $.fn.callAjaxRegion(defaults['url'] + '/district', defaults['province'], '#district', '');
     });
     
    $("body .view").on('click','.paging ul li a', function(e){
      var url = $(this).attr('href');
      var page = $(this).attr('data-page');
      if(url){
        history.pushState(null, null, url);
        $.fn.loadData(defaults['url'] + '/load-data', '#view-data ul.list-travel', defaults['categoryType'], defaults['nation'], defaults['province'], defaults['district'], page);
        e.preventDefault();
      }
      
    });
  },
  $.fn.loadData = function(url, id, category, nation, province, district, page){
    $.ajax({
      method: 'POST',
      url: url,
      data: {category: category, nation: nation, province: province, district: district, page: page},
      beforeSend: function(){
        $(".view-loading").css('display','block');
      },
      success: function(data){
//        console.log(data);
        $(id).empty().append(data.html);
        $(".view-loading").css('display','none');
      }
    });
  },
  $.fn.getUrlParam = function(param, url){
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + param + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }
  ;
//  $.fn.callAjaxRegion();
  var page = $.fn.getUrlParam('page');
  $.fn.loadData('http://localhost/tours/public/load-data', '#view-data ul.list-travel', defaults['categoryType'], defaults['nation'], defaults['province'], defaults['district'], page);
  
  $.fn.render();
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
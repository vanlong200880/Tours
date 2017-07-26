(function ($) { 
  "use strict";
//  var defaults = {
//    url : 'http://gonow.dev',
//    categoryType: $("body .list-search").find('#category-type').val(),
//    nation: $("body .list-search").find('#nation').val(),
//    province: $("body .list-search").find('#province').val(),
//    district: $("body .list-search").find('#district').val(),
//    param: window.location.search.substring(1),
//    keyword: $("body .list-search").find('#tasteKeyword').val(),
//    filterType: $("body .filter-adv input.filter-param").val(),
//    sortType: $("body .filter-adv input.filter-param").attr('data-sort'),
//    starType: $("body .filter-adv input.filter-star").val(),
//    minValue: $("body .filter-adv input.filter-star").attr('data-min'),
//    maxValue: $("body .filter-adv input.filter-star").attr('data-min'),
//    nationType: $("body .filter-adv input.filter-nation").val(),
//    locationType: $("body .filter-adv input.filter-location").val(),
//    area: $("body .filter-adv input.filter-area").val()
//  };
//  $.fn.callAjaxRegion = function(url, alias, id, idRemove){
//    $.ajax({
//      method: 'POST',
//      url: url,
//      data: { alias: alias}
//    })
//    .done(function( data ) {
//      console.log(data);
//      $(id + " option[value!='']").each(function() {
//        $(this).remove();
//      });
//      if(idRemove){
//        $(idRemove + " option[value!='']").each(function() {
//          $(this).remove();
//        });
//      }
//      $(id).append(data.html);
//      $(id).selectpicker('refresh');
//      $(idRemove).selectpicker('refresh');
//    });
//  },
  
//  $.fn.getParamString = function(page, nation, filter, sort,starType, minValue, maxValue , area, keyword){
//      var urlParam = [];
//      var urlString = '';
//      if(page){
//        urlParam.push({page: page});
//      }
//      if(nation){
//        urlParam.push({nation: nation});
//      }
//      
//      if(filter){
//        urlParam.push({filter: filter});
//      }
//      if(sort){
//        urlParam.push({sort: sort});
//      }
//      if(starType){
//        urlParam.push({star: starType});
//      }
//      if(minValue){
//        urlParam.push({min: minValue});
//      }
//      if(maxValue){
//        urlParam.push({max: maxValue});
//      }
//      if(area){
//        urlParam.push({area: area});
//      }
//      if(keyword){
//        urlParam.push({keyword: keyword});
//      }
//      if(urlParam){
//        var count = 1;
//        $.each(urlParam, function (index, value){
//          $.each(value, function (k, v){
//            if(count == urlParam.length){
//              urlString = urlString + k + "=" + v;
//            }
//            else{
//              urlString = urlString + k + "=" + v + '&';
//            }
//            count++;
//          });
//        });
//      }
//      return urlString;
//  },
  $.fn.renderHotel = function(){
//    $("body").on("change", "#country_id", function(e) {
//    });
    // show form filter
//    $('.filter-adv').css('width', $('body .page-search-title h1').innerWidth());
//    $("body").on('click','#tour-search-button' ,function(){
//      $(".filter-adv").toggleClass('open', 1000);
//      $(this).toggleClass('on', 1000);
//    });
//    $('body').on('click', '.close-filter', function(){
//      $(".filter-adv").toggleClass('open', 1000);
//      $('#tour-search-button').toggleClass('on', 1000);
//    })
    //get data type
//    $("body").on("change", "#category-type", function(e) {
//      defaults['categoryType'] = $(this).val();
//      if(defaults['province'] && defaults['district']){
//        window.location.href = defaults['url'] + '/' + defaults['categoryType'] + '/' + defaults['province'] + '/' + defaults['district'] + '?' + defaults['param'];
//      }else{
//        if(defaults['province'] && defaults['district'] == ''){
//          window.location.href = defaults['url'] + '/' + defaults['categoryType']+ '/' + defaults['province'] + '?' + defaults['param'];
//        }else{
//          window.location.href = defaults['url'] + '/' + defaults['categoryType'] + '?' + defaults['param'];
//        }
//      }
//    });
    // get keyword
//    $("#tasteKeyword").on('propertychange change keyup paste input', function(e){
//      e.preventDefault();
//      defaults['keyword']  = $(this).val();
//      defaults['filterType'] = $.fn.getUrlParam('filter');
//      defaults['sortType'] = $.fn.getUrlParam('sort');
//      defaults['starType'] = $.fn.getUrlParam('star');
//      defaults['minValue'] = $.fn.getUrlParam('min');
//      defaults['maxValue'] = $.fn.getUrlParam('max');
//      defaults['area'] = $.fn.getUrlParam('area');
//      var url = defaults['url'] + '/' + defaults['categoryType'] ;
//      var page = $.fn.getUrlParam('page');
//      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
//      if(defaults['province'] && defaults['district'] ){
//        url = url + '/' + defaults['province'] + '/' + defaults['district'];
//      }
//      if(defaults['province'] && defaults['district'] == '' ){
//        url = url + '/' + defaults['province'];
//      }
//      history.pushState(null, null, url + '?' + urlString);
//    });
//    $('#tasteKeyword').keypress(function(e){
//      if(e.which === 13)
//         $('#tasteKeyword').click();
//   });
    // get nation
//    $("body").on('change', '#nation', function(){
//      defaults['keyword']  = $.fn.getUrlParam('keyword');
//      defaults['filterType'] = $.fn.getUrlParam('filter');
//      defaults['sortType'] = $.fn.getUrlParam('sort');
//      defaults['starType'] = $.fn.getUrlParam('star');
//      defaults['minValue'] = $.fn.getUrlParam('min');
//      defaults['maxValue'] = $.fn.getUrlParam('max');
//      defaults['area'] = $.fn.getUrlParam('area');
//      defaults['nation'] = $(this).val();
//      $.fn.callAjaxRegion(defaults['url'] + '/province', defaults['nation'], '#province', '#district');
//      defaults['province'] = $("body .list-search").find('#province').val();
//      console.log($("body .list-search").find('#province').val());
//      var url = defaults['url'] + '/' + defaults['categoryType'] ;
//      var page = $.fn.getUrlParam('page');
//      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
//      history.pushState(null, null, url + '?' + urlString);
//     });
     
//     $("body").on('change', '#district', function(){
//      defaults['district'] = $(this).val();
//      var url = defaults['url'] + '/' + defaults['categoryType'] ;
//      if(defaults['province'] && defaults['district']){
//        url = url + '/' + defaults['province'] + '/' + defaults['district'] + ((defaults['param'])?'?' + defaults['param'] : '');
//      }
//      history.pushState(null, null, url);
//     });
     
//     $("body").on('change', '#province', function(){
//      defaults['province'] = $(this).val();
//      var url = defaults['url'] + '/' + defaults['categoryType'] ;
//      if(defaults['province']){
//        url = url + '/' + defaults['province'] + ((defaults['param'])?'?' + defaults['param'] : '');
//      }
//      history.pushState(null, null, url);
//      $.fn.callAjaxRegion(defaults['url'] + '/district', defaults['province'], '#district', '');
//     });
     
//    $("body .view").on('click','.paging ul li a', function(e){
//      var url = $(this).attr('href');
//      var page = $(this).attr('data-page');
//      if(url){
//        history.pushState(null, null, url);
//        $.fn.loadData(defaults['url'] + '/load-data', '#view-data ul.list-travel', defaults['categoryType'], defaults['nation'], defaults['province'], defaults['district'], page);
//        e.preventDefault();
//      }
//    });
    
    // filter param
//    $("body .filter-adv").on('click', 'input[name=filter-param]', function(){
//      defaults['keyword']  = $.fn.getUrlParam('keyword');
//      defaults['filterType'] = $(this).val();
//      defaults['sortType'] = $.fn.getUrlParam('sort');
//      defaults['starType'] = $.fn.getUrlParam('star');
//      defaults['minValue'] = $.fn.getUrlParam('min');
//      defaults['maxValue'] = $.fn.getUrlParam('max');
//      defaults['area'] = $.fn.getUrlParam('area');
//      var url = defaults['url'] + '/' + defaults['categoryType'] ;
//      var page = $.fn.getUrlParam('page');
//      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
//      if(defaults['province'] && defaults['district'] ){
//        url = url + '/' + defaults['province'] + '/' + defaults['district'];
//      }
//      if(defaults['province'] && defaults['district'] == '' ){
//        url = url + '/' + defaults['province'];
//      }
//      history.pushState(null, null, url + '?' + urlString);
//    });
    
    // filter star
//    $("body .filter-adv").on('click', 'input[name=filter-star]', function(){
//      defaults['keyword']  = $.fn.getUrlParam('keyword');
//      defaults['filterType'] = $.fn.getUrlParam('filter');
//      defaults['sortType'] = $.fn.getUrlParam('sort');
//      defaults['starType'] = $(this).val();
//      defaults['minValue'] = $.fn.getUrlParam('min');
//      defaults['maxValue'] = $.fn.getUrlParam('max');
//      defaults['area'] = $.fn.getUrlParam('area');
//      var url = defaults['url'] + '/' + defaults['categoryType'] ;
//      var page = $.fn.getUrlParam('page');
//      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
//      if(defaults['province'] && defaults['district'] ){
//        url = url + '/' + defaults['province'] + '/' + defaults['district'];
//      }
//      if(defaults['province'] && defaults['district'] == '' ){
//        url = url + '/' + defaults['province'];
//      }
//      history.pushState(null, null, url + '?' + urlString);
//    });
    
    // fitler price
//    $("body .filter-adv").on('click', 'input[name=filter-price]', function(){
//      defaults['keyword']  = $.fn.getUrlParam('keyword');
//      defaults['filterType'] = $.fn.getUrlParam('filter');
//      defaults['sortType'] = $.fn.getUrlParam('sort');
//      defaults['starType'] = $.fn.getUrlParam('star');
//      defaults['minValue'] = $(this).attr('data-min');
//      defaults['maxValue'] = $(this).attr('data-max');
//      defaults['area'] = $.fn.getUrlParam('area');
//      
//      var url = defaults['url'] + '/' + defaults['categoryType'] ;  
//      var page = $.fn.getUrlParam('page');
//      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
//      if(defaults['province'] && defaults['district'] ){
//        url = url + '/' + defaults['province'] + '/' + defaults['district'];
//      }
//      if(defaults['province'] && defaults['district'] == '' ){
//        url = url + '/' + defaults['province'];
//      }
//      history.pushState(null, null, url + '?' + urlString);
//    });
    
    // filter nation
//    $("body .filter-adv").on('click', 'input[name=filter-area]', function(){
//      defaults['keyword']  = $.fn.getUrlParam('keyword');
//      defaults['filterType'] = $.fn.getUrlParam('filter');
//      defaults['sortType'] = $.fn.getUrlParam('sort');
//      defaults['starType'] = $.fn.getUrlParam('star');
//      defaults['minValue'] = $.fn.getUrlParam('min');
//      defaults['maxValue'] = $.fn.getUrlParam('max');
//      defaults['area'] = $(this).val();
//      var url = defaults['url'] + '/' + defaults['categoryType'] ;
//      var page = $.fn.getUrlParam('page');
//      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
//      if(defaults['province'] && defaults['district'] ){
//        url = url + '/' + defaults['province'] + '/' + defaults['district'];
//      }
//      if(defaults['province'] && defaults['district'] == '' ){
//        url = url + '/' + defaults['province'];
//      }
//      history.pushState(null, null, url + '?' + urlString);
//    });
    
    // get location current
//    var id = '';
//    var currentAddress = '';
//    $("body").on('click', '.list-travel .strict-views', function(){
//      $("body .list-travel li .strict-views").removeClass('show-map');
//      $(this).addClass('show-map');
//      var currentAddress = $("body").find('#current-address').val();
//      id = $(this).attr('data-id');
//      if(currentAddress == ''){
//        $(".filter-adv").toggleClass('open', 1000);
//        $('#tour-search-button').toggleClass('on', 1000);
//        $("#current-address").focus();
//      }
//      else{
//        $.fn.callMapSearchAddress(id, currentAddress);
//      }
//    });
    // enter input address
//    $('#current-address').keypress(function(e){
//      if(e.which === 13)
//      {
//        currentAddress = $(this).val();
//        $.fn.callMapSearchAddress(id, currentAddress);
//      }
//    });
    
    // Load detail page
    $("body.hotel .view-data").on('click', 'ul.load-post > li a', function(){
      var id = $(this).attr('data-id');
      var url = '/hotel-detail';
      $.ajax({
          url : url,
          type : 'POST',
          dataType : "json",
          data: {id: id},
          beforeSend: function(){
            $(".popup-page").addClass('on');
            $(".popup-page").append('<div class="loading"></div>');
          },
          success : function (data){
            $( ".loading" ).remove();
            $(".popup-container").empty().append(data.html);
//            $("#page-comment").empty().append(data.htmlComment);
            $.fn.loadComment(defaults['url'] + '/load-comment', id, 1);
            $.fn.callSliderRoyalSlider();
            $.fn.loadSwiper('.swiper-container', 6, 6, 4, 3);
          }
        });
    });
    
    // close popup
//    $("body .popup-page").on('click','.popup-close' ,function(){
//      $(".popup-page").removeClass('on');
//      $(".popup-page .popup-container").empty();
//    });
    

    
    
   
  };
  
  

////  $.fn.callAjaxRegion();
//  var page = $.fn.getUrlParam('page');
//  var filter = $.fn.getUrlParam('filter');
//  var sort = $.fn.getUrlParam('sort');
//  var star = $.fn.getUrlParam('star');
//  var min = $.fn.getUrlParam('min');
//  var max = $.fn.getUrlParam('max');
//  var area = $.fn.getUrlParam('area');
//  var keyword = $.fn.getUrlParam('keyword');
//  $.fn.loadData(defaults['url'] + '/load-data', '#view-data ul.load-post', defaults['categoryType'], defaults['nation'], defaults['province'], defaults['district'], page, filter, sort, star, min, max, area, keyword);
//  
  $.fn.renderHotel();
})(jQuery);
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
(function ($) { 
  "use strict";
  $.fn.callAjaxRegion = function(url, alias, id, idRemove){
    $.ajax({
      method: 'POST',
      url: url,
      data: { alias: alias}
    })
    .done(function( data ) {
//      console.log(data);
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
  
  $.fn.getParamString = function(page, nation, filter, sort,starType, minValue, maxValue , area, keyword){
      var urlParam = [];
      var urlString = '';
      if(page){
        urlParam.push({page: page});
      }
      if(nation){
        urlParam.push({nation: nation});
      }
      
      if(filter){
        urlParam.push({filter: filter});
      }
      if(sort){
        urlParam.push({sort: sort});
      }
      if(starType){
        urlParam.push({star: starType});
      }
      if(minValue){
        urlParam.push({min: minValue});
      }
      if(maxValue){
        urlParam.push({max: maxValue});
      }
      if(area){
        urlParam.push({area: area});
      }
      if(keyword){
        urlParam.push({keyword: keyword});
      }
      if(urlParam){
        var count = 1;
        $.each(urlParam, function (index, value){
          $.each(value, function (k, v){
            if(count == urlParam.length){
              urlString = urlString + k + "=" + v;
            }
            else{
              urlString = urlString + k + "=" + v + '&';
            }
            count++;
          });
        });
      }
      return urlString;
  },
  $.fn.render = function(){
    $("body").on("change", "#country_id", function(e) {
    });
    // show form filter
    $('.filter-adv').css('width', $('body .page-search-title h1').innerWidth());
    $("body").on('click','#tour-search-button' ,function(){
      $(".filter-adv").toggleClass('open', 1000);
      $(this).toggleClass('on', 1000);
    });
    $('body').on('click', '.close-filter', function(){
      $(".filter-adv").toggleClass('open', 1000);
      $('#tour-search-button').toggleClass('on', 1000);
    })
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
    // get keyword
    $("#tasteKeyword").on('propertychange change keyup paste input', function(e){
      e.preventDefault();
      defaults['keyword']  = $(this).val();
      defaults['filterType'] = $.fn.getUrlParam('filter');
      defaults['sortType'] = $.fn.getUrlParam('sort');
      defaults['starType'] = $.fn.getUrlParam('star');
      defaults['minValue'] = $.fn.getUrlParam('min');
      defaults['maxValue'] = $.fn.getUrlParam('max');
      defaults['area'] = $.fn.getUrlParam('area');
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      var page = $.fn.getUrlParam('page');
      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
      if(defaults['province'] && defaults['district'] ){
        url = url + '/' + defaults['province'] + '/' + defaults['district'];
      }
      if(defaults['province'] && defaults['district'] == '' ){
        url = url + '/' + defaults['province'];
      }
      history.pushState(null, null, url + '?' + urlString);
    });
    $('#tasteKeyword').keypress(function(e){
      if(e.which === 13)
         $('#tasteKeyword').click();
   });
    // get nation
    $("body").on('change', '#nation', function(){
      defaults['keyword']  = $.fn.getUrlParam('keyword');
      defaults['filterType'] = $.fn.getUrlParam('filter');
      defaults['sortType'] = $.fn.getUrlParam('sort');
      defaults['starType'] = $.fn.getUrlParam('star');
      defaults['minValue'] = $.fn.getUrlParam('min');
      defaults['maxValue'] = $.fn.getUrlParam('max');
      defaults['area'] = $.fn.getUrlParam('area');
      defaults['nation'] = $(this).val();
      $.fn.callAjaxRegion(defaults['url'] + '/province', defaults['nation'], '#province', '#district');
      defaults['province'] = $("body .list-search").find('#province').val();
//      console.log($("body .list-search").find('#province').val());
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      var page = $.fn.getUrlParam('page');
      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
      history.pushState(null, null, url + '?' + urlString);
     });
     
     $("body").on('change', '#district', function(){
      defaults['district'] = $(this).val();
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      if(defaults['province'] && defaults['district']){
        url = url + '/' + defaults['province'] + '/' + defaults['district'] + ((defaults['param'])?'?' + defaults['param'] : '');
      }
      history.pushState(null, null, url);
     });
     
     $("body").on('change', '#province', function(){
      defaults['province'] = $(this).val();
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      if(defaults['province']){
        url = url + '/' + defaults['province'] + ((defaults['param'])?'?' + defaults['param'] : '');
      }
      history.pushState(null, null, url);
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
    
    // filter param
    $("body .filter-adv").on('click', 'input[name=filter-param]', function(){
      defaults['keyword']  = $.fn.getUrlParam('keyword');
      defaults['filterType'] = $(this).val();
      defaults['sortType'] = $.fn.getUrlParam('sort');
      defaults['starType'] = $.fn.getUrlParam('star');
      defaults['minValue'] = $.fn.getUrlParam('min');
      defaults['maxValue'] = $.fn.getUrlParam('max');
      defaults['area'] = $.fn.getUrlParam('area');
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      var page = $.fn.getUrlParam('page');
      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
      if(defaults['province'] && defaults['district'] ){
        url = url + '/' + defaults['province'] + '/' + defaults['district'];
      }
      if(defaults['province'] && defaults['district'] == '' ){
        url = url + '/' + defaults['province'];
      }
      history.pushState(null, null, url + '?' + urlString);
    });
    
    // filter star
    $("body .filter-adv").on('click', 'input[name=filter-star]', function(){
      defaults['keyword']  = $.fn.getUrlParam('keyword');
      defaults['filterType'] = $.fn.getUrlParam('filter');
      defaults['sortType'] = $.fn.getUrlParam('sort');
      defaults['starType'] = $(this).val();
      defaults['minValue'] = $.fn.getUrlParam('min');
      defaults['maxValue'] = $.fn.getUrlParam('max');
      defaults['area'] = $.fn.getUrlParam('area');
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      var page = $.fn.getUrlParam('page');
      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
      if(defaults['province'] && defaults['district'] ){
        url = url + '/' + defaults['province'] + '/' + defaults['district'];
      }
      if(defaults['province'] && defaults['district'] == '' ){
        url = url + '/' + defaults['province'];
      }
      history.pushState(null, null, url + '?' + urlString);
    });
    
    // fitler price
    $("body .filter-adv").on('click', 'input[name=filter-price]', function(){
      defaults['keyword']  = $.fn.getUrlParam('keyword');
      defaults['filterType'] = $.fn.getUrlParam('filter');
      defaults['sortType'] = $.fn.getUrlParam('sort');
      defaults['starType'] = $.fn.getUrlParam('star');
      defaults['minValue'] = $(this).attr('data-min');
      defaults['maxValue'] = $(this).attr('data-max');
      defaults['area'] = $.fn.getUrlParam('area');
      
      var url = defaults['url'] + '/' + defaults['categoryType'] ;  
      var page = $.fn.getUrlParam('page');
      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
      if(defaults['province'] && defaults['district'] ){
        url = url + '/' + defaults['province'] + '/' + defaults['district'];
      }
      if(defaults['province'] && defaults['district'] == '' ){
        url = url + '/' + defaults['province'];
      }
      history.pushState(null, null, url + '?' + urlString);
    });
    
    // filter nation
    $("body .filter-adv").on('click', 'input[name=filter-area]', function(){
      defaults['keyword']  = $.fn.getUrlParam('keyword');
      defaults['filterType'] = $.fn.getUrlParam('filter');
      defaults['sortType'] = $.fn.getUrlParam('sort');
      defaults['starType'] = $.fn.getUrlParam('star');
      defaults['minValue'] = $.fn.getUrlParam('min');
      defaults['maxValue'] = $.fn.getUrlParam('max');
      defaults['area'] = $(this).val();
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      var page = $.fn.getUrlParam('page');
      var urlString = $.fn.getParamString(page, defaults['nation'], defaults['filterType'], defaults['sortType'], defaults['starType'], defaults['minValue'], defaults['maxValue'], defaults['area'], defaults['keyword']);
      if(defaults['province'] && defaults['district'] ){
        url = url + '/' + defaults['province'] + '/' + defaults['district'];
      }
      if(defaults['province'] && defaults['district'] == '' ){
        url = url + '/' + defaults['province'];
      }
      history.pushState(null, null, url + '?' + urlString);
    });
    
    // get location current
    var id = '';
    var currentAddress = '';
    $("body").on('click', '.list-travel .strict-views', function(){
      $("body .list-travel li .strict-views").removeClass('show-map');
      $(this).addClass('show-map');
      var currentAddress = $("body").find('#current-address').val();
      id = $(this).attr('data-id');
      if(currentAddress == ''){
        $(".filter-adv").toggleClass('open', 1000);
        $('#tour-search-button').toggleClass('on', 1000);
        $("#current-address").focus();
      }
      else{
        $.fn.callMapSearchAddress(id, currentAddress);
      }
    });
    // enter input address
    $('#current-address').keypress(function(e){
      if(e.which === 13)
      {
        currentAddress = $(this).val();
        $.fn.callMapSearchAddress(id, currentAddress);
      }
    });
    
    // Load detail page
    $("body.travel .view-data").on('click', 'ul.load-post > li a', function(){
      var id = $(this).attr('data-id');
      var url = '/travel-view';
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
          }
        });
    });
    
    // close popup
    $("body .popup-page").on('click','.popup-close' ,function(){
      $(".popup-page").removeClass('on');
      $(".popup-page .popup-container").empty();
    });
    
    // view gallery
    $("body .popup-page").on('click','.game-entertainment tr td .history', function(){
      var id = $(this).attr('data-id');
      var url = 'http://gonow.dev/view-gallery';
      $.fn.viewGallery(url, id);
      
    });
    
    // Loading comment
    $("body").on('click', '.views-all a', function(e){
      e.preventDefault();
      var page = parseInt($(this).attr('ng-page'));
      var id = $(this).attr('data-id');
      $.fn.loadMoreComment(defaults['url'] + '/load-more-comment', id, page+1 );
    });
    
    // Loading comment child
    $('body').on('click', 'ul.list-comment li .viewmore-child-comment',function(){
      var postId = $(this).attr('ng-data');
      var parentId = $(this).attr('data-parent');
      var page = parseInt($(this).attr('ng-page'));
      $.fn.loadMoreCommentChild(defaults['url'] + '/load-more-comment-child', postId, page+1, parentId);
    });
    
    // Create comment
    $("body").on('keypress','ul.list-comment li .replies textarea',function(e){
//      e.preventDefault();
      if (e.which == '13') {
        var id = $(this).attr('id');
        id = id.replace('data_comment_','');
        var data = $(this).val();
        var postId = $(this).attr('data-post');
        if(data == ''){
          $(this).addClass('empty');
          return false;
        }else{
          $.fn.createComment(defaults['url'] + '/create-comment', id, postId, data);
        }
      }
    });
    
    // Image detail
    $("body").on('click', '.list-gallery a', function(){
      $.fn.loadImageDetail(defaults['url'] + '/image-detail', 1);
    });
    
    $(".video-play").on('click', '.close-video', function(){
      $(".video-play").empty().removeClass('on');
    });
  },
  // Load image detail
  $.fn.loadImageDetail = function(url, imageId){
    $.ajax({
      url : url,
      type : 'POST',
      dataType : "json",
      data: {imageId: imageId},
      beforeSend: function(){
        $(".video-play").addClass('on').append('<div class="loading"></div>');
      },
      success : function (data){
        $( ".loading" ).remove();
        $(".video-play").empty().append(data.html);
        $.fn.loadSwiper('.swiper-container', 6, 6, 4, 3);
//        console.log(data);
//        $("body ul.list-comment").find("#comment_"+commentId).find('.list-comment-replies').append(data.htmlCreateComment);
//      $("body ul.list-comment").find("#comment_"+commentId).find('.list-comment-replies').append(data.htmlCreateComment);
//        $("body ul.list-comment li#comment_"+commentId+" .replies textarea").val('');
      }
    });
  },
  // create comment
  $.fn.createComment = function(url, commentId, postId, content){
//    console.log(commentId, postId, content);
    $.ajax({
      url : url,
      type : 'POST',
      dataType : "json",
      data: {id: commentId, postId: postId, content: content},
      beforeSend: function(){
      },
      success : function (data){
//        console.log(data);
        $("body ul.list-comment").find("#comment_"+commentId).find('.list-comment-replies').append(data.htmlCreateComment);
//      $("body ul.list-comment").find("#comment_"+commentId).find('.list-comment-replies').append(data.htmlCreateComment);
        $("body ul.list-comment li#comment_"+commentId+" .replies textarea").val('');
      }
    });
  },
  
  // load more comment child
  $.fn.loadMoreCommentChild = function(url, id, page, parent){
    $.ajax({
      url : url,
      type : 'POST',
      dataType : "json",
      data: {id: id, page: page, parent: parent},
      beforeSend: function(){
      },
      success : function (data){
        $("body ul.list-comment").find("#comment_"+parent).find('.list-comment-replies').append(data.htmlComment);
        $("body ul.list-comment").find("#comment_"+parent).find('.viewmore-child-comment').attr('ng-page', data.currentChildPage);
        if(data.currentChildPage == data.totalChildPages){
          $("body ul.list-comment").find("#comment_"+parent).find('.child-comment-readmore').remove();
        }
      }
    });
  },
  
  // load more comment
  $.fn.loadMoreComment = function(url, id, page){
    $.ajax({
      url : url,
      type : 'POST',
      dataType : "json",
      data: {id: id, page: page},
      beforeSend: function(){
//        $(".views-popup").addClass('view');
//        $(".views-popup").append('<div class="loading"></div>');
      },
      success : function (data){
//        console.log('asdfsf');
        $("body ul.list-comment").append(data.htmlComment);
        $("body .views-all a").attr('ng-page', data.currentPage);
        if(data.currentPage == data.totalPage){
          $("body .views-all a").remove();
        }
//        console.log(data);
//        $( ".loading" ).remove();
//        $(".views-popup .views-container").empty().append(data.html);
//        // call royalSlider
//        $.fn.callSliderRoyalSlider();
//        // view map popup
//        $(".views-popup .views-container").addClass('open');
      }
    });
  },
  
  $.fn.loadComment = function(url, id, page){
    $.ajax({
      url : url,
      type : 'POST',
      dataType : "json",
      data: {id: id, page: page},
      beforeSend: function(){
//        $(".views-popup").addClass('view');
//        $(".views-popup").append('<div class="loading"></div>');
      },
      success : function (data){
        $("body #page-comment").empty().append(data.htmlComment);
//        $( ".loading" ).remove();
//        $(".views-popup .views-container").empty().append(data.html);
//        // call royalSlider
//        $.fn.callSliderRoyalSlider();
//        // view map popup
//        $(".views-popup .views-container").addClass('open');
      }
    });
  },
  $.fn.viewGallery = function(url, id){
    $.ajax({
      url : url,
      type : 'POST',
      dataType : "json",
      data: {id: id},
      beforeSend: function(){
        $(".views-popup").addClass('view');
        $(".views-popup").append('<div class="loading"></div>');
      },
      success : function (data){
        $( ".loading" ).remove();
        $(".views-popup .views-container").empty().append(data.html);
        // call royalSlider
        $.fn.callSliderRoyalSlider();
        // view map popup
        $(".views-popup .views-container").addClass('open');
      }
    });
  },
  $.fn.callSliderRoyalSlider = function(){
    // call royalSlider
    var slider = $('.royalSlider').royalSlider({
    fullscreen: {
      enabled: false,
      nativeFS: false
    },
    controlNavigation: 'thumbnails',
    autoScaleSlider: true, 
    autoScaleSliderWidth: 725,
    autoScaleSliderHeight: 478,
    loop: false,
    imageScaleMode: 'none',
    navigateByClick: true,
    numImagesToPreload:2,
    arrowsNav:true,
    arrowsNavAutoHide: true,
    arrowsNavHideOnTouch: true,
    keyboardNavEnabled: true,
    fadeinLoadedSlide: true,
    globalCaption: false,
    globalCaptionInside: false,
    imageScalePadding: 0,
    slidesSpacing: 0,
    thumbs: {
      appendSpan: false,
      firstMargin: false,
      paddingBottom: 4
    }
    }).data('royalSlider');

    $('.rsFullscreenBtn').click(function(e){
      slider.enterFullscreen();
      e.preventDefault();
    });

    slider.ev.on("rsEnterFullscreen", function() {
      // enter fullscreen mode 
      $(".popup-page").css('position', 'relative');
    });
    slider.ev.on('rsExitFullscreen', function(event) {
      // exit fullscreen mode
      $(".popup-page").removeAttr('style');
    });
  },
  $.fn.loadSwiper = function(id, slidesa, slidesb, slidesc, slidesd){
    var swiper = new Swiper(id, {
        nextButton: '.button-next',
        prevButton: '.button-prev',
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
  $.fn.callMapSearchAddress = function(id, currentAddress){
    $.ajax({
          url : '/view-map',
          type : 'POST',
          dataType : "json",
          data: {id: id, address : currentAddress },
          beforeSend: function(){
            $(".views-popup").addClass('view');
            $(".views-popup").append('<div class="loading"></div>');
          },
          success : function (data){
            if(data.message == ''){
              $( ".loading" ).remove();
              $(".views-popup .views-container").empty().append(data.html);
              var fromLatitude = data.fromLatitude;
              var fromLongitude = data.fromLongitude;
              var toLatitude = data.toLatitude;
              var toLongitude = data.toLongitude;
              var map;
              var directionsService = new google.maps.DirectionsService();
              var directionsDisplay;
              var map_canvas  = document.getElementById('view-map');
              map_canvas.style.width = '100%';
              map_canvas.style.height = '100%';
              // Option map
              var map_options = {
                  zoom: 12,
                  mapTypeId : google.maps.MapTypeId.ROADMAP
              };
              // Object map
              map = new google.maps.Map(map_canvas, map_options);
              directionsDisplay = new google.maps.DirectionsRenderer();
              directionsDisplay.setMap(map);
              var request = {
                  origin: new google.maps.LatLng(fromLatitude, fromLongitude),
                  destination: new google.maps.LatLng(toLatitude, toLongitude),
                  travelMode: google.maps.TravelMode.DRIVING
              };
              directionsService.route(request, function(result, status) {
                  if (status == google.maps.DirectionsStatus.OK) {
                      directionsDisplay.setDirections(result);
                  }
              });
              $(".views-popup .views-container").addClass('open');
              if($("body .view .filter-adv").hasClass('open')){
                $(".filter-adv").toggleClass('open', 1000);
                $('#tour-search-button').toggleClass('on', 1000);
              }
              $("body #current-address").removeClass('error');
              $(".has-error").remove();
            }else{
              $( ".loading" ).remove();
              $(".views-popup").removeClass('view');
              $(".has-error").remove();
              $("body #current-address").addClass('error').parent().append('<span class="has-error">'+data.message+'</span>');
              if(!$("body .view .filter-adv").hasClass('open')){
                $(".filter-adv").toggleClass('open', 1000);
                $('#tour-search-button').toggleClass('on', 1000);
              }
            }
            
            
          
          }
        });
  },
  
  $.fn.loadData = function(url, id, category, nation, province, district, page, filter, sort, star, min, max, area, keyword){
    $.ajax({
      method: 'POST',
      url: url,
      data: {category: category, nation: nation, province: province, district: district, page: page, filter: filter, sort: sort, star: star, min: min, max: max, area: area, keyword: keyword},
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
  var filter = $.fn.getUrlParam('filter');
  var sort = $.fn.getUrlParam('sort');
  var star = $.fn.getUrlParam('star');
  var min = $.fn.getUrlParam('min');
  var max = $.fn.getUrlParam('max');
  var area = $.fn.getUrlParam('area');
  var keyword = $.fn.getUrlParam('keyword');
  $.fn.loadData(defaults['url'] + '/load-data', '#view-data ul.load-post', defaults['categoryType'], defaults['nation'], defaults['province'], defaults['district'], page, filter, sort, star, min, max, area, keyword);
  
  $.fn.render();
})(jQuery);
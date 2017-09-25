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
var gmarkers = [], gicons = [], map = ''; 
gicons["travel"] = new google.maps.MarkerImage(defaults['url'] +"/assets/images/travel.png", new google.maps.Size(20, 34),  new google.maps.Point(0,0), new google.maps.Point(9, 34));
gicons["tour"] = new google.maps.MarkerImage(defaults['url'] +"/assets/images/tour.png", new google.maps.Size(20, 34),  new google.maps.Point(0,0), new google.maps.Point(9, 34));
gicons["taste"] = new google.maps.MarkerImage(defaults['url'] +"/assets/images/taste.png", new google.maps.Size(20, 34),  new google.maps.Point(0,0), new google.maps.Point(9, 34));
gicons["hotel"] = new google.maps.MarkerImage(defaults['url'] +"/assets/images/hotel.png", new google.maps.Size(20, 34),  new google.maps.Point(0,0), new google.maps.Point(9, 34));
gicons["utilities"] = new google.maps.MarkerImage(defaults['url'] +"/assets/images/utilities.png", new google.maps.Size(20, 34),  new google.maps.Point(0,0), new google.maps.Point(9, 34));
//var iconImage = new google.maps.MarkerImage('http://gonow.dev/assets/images/travel.png',
//    // This marker is 20 pixels wide by 34 pixels tall.
//    new google.maps.Size(20, 34),
//    // The origin for this image is 0,0.
//    new google.maps.Point(0,0),
//    // The anchor for this image is at 9,34.
//    new google.maps.Point(9, 34));
var iconShadow = new google.maps.MarkerImage('http://www.google.com/mapfiles/shadow50.png',
    // The shadow image is larger in the horizontal dimension
    // while the position and offset are the same as for the main image.
    new google.maps.Size(37, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(9, 34));
var iconShape = {
    coord: [9,0,6,1,4,2,2,4,0,8,0,12,1,14,2,16,5,19,7,23,8,26,9,30,9,34,11,34,11,30,12,26,13,24,14,21,16,18,18,16,20,12,20,8,18,4,16,2,15,1,13,0],
    type: 'poly'
};
var infowindow = new google.maps.InfoWindow(
{ 
  size: new google.maps.Size(150,50),
   maxWidth: 160,
   pixelOffset: new google.maps.Size(0, 0) 
});
(function ($) { 
  "use strict";
  $.fn.callAjaxRegion = function(url, alias, id, idRemove){
    $.ajax({
      method: 'POST',
      url: url,
      data: { alias: alias}
    })
    .done(function( data ) {
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
      $.fn.loadData(
                        defaults['url'] + '/load-data', 
                        '#view-data ul.load-post', 
                        defaults['categoryType'], 
                        defaults['nation'], 
                        defaults['province'], 
                        defaults['district'], 
                        1, 
                        defaults['filterType'], 
                        defaults['sortType'], 
                        defaults['starType'], 
                        defaults['minValue'],
                        defaults['maxValue'], 
                        defaults['area'], 
                        defaults['keyword']
                );
     });
     
     $("body").on('change', '#district', function(){
      defaults['district'] = $(this).val();
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      if(defaults['province'] && defaults['district']){
        url = url + '/' + defaults['province'] + '/' + defaults['district'] + ((defaults['param'])?'?' + defaults['param'] : '');
      }
      history.pushState(null, null, url);
      $.fn.loadData(
                        defaults['url'] + '/load-data', 
                        '#view-data ul.load-post', 
                        defaults['categoryType'], 
                        defaults['nation'], 
                        defaults['province'], 
                        defaults['district'], 
                        1, 
                        defaults['filterType'], 
                        defaults['sortType'], 
                        defaults['starType'], 
                        defaults['minValue'],
                        defaults['maxValue'], 
                        defaults['area'], 
                        defaults['keyword']
                );
     });
     
     $("body").on('change', '#province', function(){
      defaults['province'] = $(this).val();
      var url = defaults['url'] + '/' + defaults['categoryType'] ;
      if(defaults['province']){
        url = url + '/' + defaults['province'] + ((defaults['param'])?'?' + defaults['param'] : '');
      }
      history.pushState(null, null, url);
      $.fn.callAjaxRegion(defaults['url'] + '/district', defaults['province'], '#district', '');
      $.fn.loadData(
                        defaults['url'] + '/load-data', 
                        '#view-data ul.load-post', 
                        defaults['categoryType'], 
                        defaults['nation'], 
                        defaults['province'], 
                        defaults['district'], 
                        1, 
                        defaults['filterType'], 
                        defaults['sortType'], 
                        defaults['starType'], 
                        defaults['minValue'],
                        defaults['maxValue'], 
                        defaults['area'], 
                        defaults['keyword']
                );
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
            $.fn.initializeMap(data.dataJson, 'map-related', '', 12);
            // Load video by post id
            $.fn.loadVideoByPostId(defaults['url'] + '/load-video-by-post-id', id, 1);
          }
        });
    });
    
    // close popup
    $("body .popup-page").on('click','.popup-close' ,function(){
      $(".popup-page").removeClass('on');
      $(".popup-page .popup-container").empty();
    });
    
    $("body .views-popup").on('click','.views-close' ,function(){
      $(".views-popup .views-container").removeClass('open');
      $(".views-popup").removeClass('view');
      $(".views-popup .views-container").empty();
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
    
    // render google map
    
    gicons["green"] = $.fn.getMarkerImage("green");
    gicons["yelow"] = $.fn.getMarkerImage("yellow");
    $("body .view-data").on('mouseover', 'ul > li.post', function(event){
      var id = $(this).attr('data-id');
      
      $.fn.mouseover(id);
      event.preventDefault();
    });
    $("body .view-data").on('mouseleave', 'ul > li.post', function(event){
      var id = $(this).attr('data-id');
      
      $.fn.mouseout(id);
      event.preventDefault();
    });
    
    // scroll detail popup
    $("body .popup-page").on('click', 'ul.tab-travel li', function(event){
      if(this.hash !== ""){
        event.preventDefault();
        var id = $(this).attr('data-id');
        var hash = this.hash;
        $('.popup-page').animate({
          scrollTop: $("#"+id).offset().top + 75
      }, 1000, function(){
        window.location.hash = hash;
      });
      }
    });
    // render commen popup
    $("body .popup-page").on('click','.buttom-comment',function(){
       var id = $(this).attr('data-id');
       $.fn.renerModalComment(id);
       
     });
     
     // Load more video
     // Loading comment child
    $("body").on('click', '.views-all-video a', function(e){
      e.preventDefault();
      var page = parseInt($(this).attr('ng-page'));
      var id = $(this).attr('data-id');
      $.fn.loadMoreVideoByPostId(defaults['url'] + '/load-more-video-by-post-id', id, page+1 );
    });
     
//    $('#modal-comment').on('hide.bs.modal', function (e) {
//      alert('aa');
//      $("body #modal-comment").remove();
//    }).modal('hide');
  },
    // Load video by post id
   $.fn.loadVideoByPostId = function(url, postId, page = 1){
    $.ajax({
      url : url,
      type : 'POST',
      dataType : "json",
      data: {postId: postId, page: page},
      beforeSend: function(){
      },
      success : function (data){
        $("#load-video").empty().append(data.htmlVideo);
      }
    });
  },
  
    // load more comment
  $.fn.loadMoreVideoByPostId = function(url, postId, page){
    $.ajax({
      url : url,
      type : 'POST',
      dataType : "json",
      data: {postId: postId, page: page},
      beforeSend: function(){
      },
      success : function (data){
        $("body #load-video ul.list-data-video").append(data.htmlVideo);
        $("body .views-all-video a").attr('ng-page', data.currentPage);
        if(data.currentPage == data.totalPage){
          $("body .views-all-video a").remove();
        }
      }
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
  
  // render modal comment popup
  $.fn.renerModalComment = function(id){
      $.ajax({
        url : '/render-comment-post',
        type : 'POST',
        dataType : "json",
        data: {id: id},
        beforeSend: function(){
//          $(".views-popup").addClass('view');
//          $(".views-popup").append('<div class="loading"></div>');
        },
        success : function (data){
          console.log(data);
          $("body #modal-comment").remove();
          $("body").append(data.html);
//          $('body #modal-comment').modal('show');
          $('#modal-comment').on('show.bs.modal', function (e) {
            }).modal('show');
            $('body #modal-comment').on('hidden.bs.modal', function (e) {
//        $(this).data('bs.modal', null);
       $("body #modal-comment").remove();
    });
//          $( ".loading" ).remove();
//          $(".views-popup .views-container").empty().append(data.html);
//          // call royalSlider
//          $.fn.callSliderRoyalSlider();
//          // view map popup
//          $(".views-popup .views-container").addClass('open');
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
        $(id).empty().append(data.html);
//        console.log(data.dataJson);
        $(".view-loading").css('display','none');
        $.fn.initializeMap(data.dataJson, 'map', '');
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
  },
  
  // google map api
  $.fn.createMarker = function(latlng,name,html,color, num){
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        icon: gicons[color],
        shadow: iconShadow,
        map: map,
        title: name,
        draggable: true,
          animation: google.maps.Animation.DROP,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
    google.maps.event.addListener(infowindow, 'domready', function(){
    });
    google.maps.event.addListener(marker, 'click', function() {
//        infowindow.setContent(contentString); 
//        infowindow.open(map,marker);
//          console.log(marker);
          $.fn.myClick(num);
        });
        
        google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
        // Switch icon on marker mouseover and mouseout
        google.maps.event.addListener(marker, "mouseover", function() {
          marker.setIcon(gicons["green"]);
        });
        google.maps.event.addListener(marker, "mouseout", function() {
          marker.setIcon(gicons["travel"]);
          infowindow.close();
        });
    gmarkers.push(marker);
  },
  $.fn.toggleBounce = function(){
    if (marker.getAnimation() !== null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  },
  $.fn.getMarkerImage = function(iconColor){
    if ((typeof(iconColor)=="undefined") || (iconColor==null)) { 
      iconColor = "travel"; 
   }
   if (!gicons[iconColor]) {
      gicons[iconColor] = new google.maps.MarkerImage("http://gonow.dev/assets/images/"+ iconColor +".png",
      // This marker is 20 pixels wide by 34 pixels tall.
      new google.maps.Size(20, 34),
      // The origin for this image is 0,0.
      new google.maps.Point(0,0),
      // The anchor for this image is at 6,20.
      new google.maps.Point(9, 34));
   } 
   return gicons[iconColor];
  },
  $.fn.myClick = function(i){
//    $("body.travel .view-data").on('click', 'ul.load-post > li a', function(){
//    alert(i);
    $('body.travel .view-data ul.load-post > li#key-map-'+ i + ' a').trigger('click');
//    google.maps.event.trigger(gmarkers[i], "mouseover");÷
  },
  $.fn.mouseover = function(i){
    google.maps.event.trigger(gmarkers[i], "mouseover");
  },
  $.fn.mouseout = function(i){
    google.maps.event.trigger(gmarkers[i], "mouseout");
  },
  $.fn.initializeMap = function(dataJson, idStyle, type = '', zoom = 14){
    var latLngCenter = [10.780068,106.705005];
    if(dataJson.length){
      var latLngCenter = [dataJson[0].lat, dataJson[0].lng];
    }
    var myOptions = {
      zoom: zoom,
      center: new google.maps.LatLng(latLngCenter[0], latLngCenter[1]),
      mapTypeControl: true,
      mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
      navigationControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById(idStyle), myOptions);

    google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
    });
    var markers = dataJson;
//    var markers = [
//        ['a',10.770537,106.672307, '<img src="http://gonow.dev/assets/demo/photo.jpg" width="160">'],
//        ['b',10.779354,106.703907, '<img src="http://gonow.dev/assets/demo/photo.jpg" width="160">']
//    ];
    for (var i = 0; i < markers.length; i++) {
        // obtain the attribues of each marker
        var beach = markers[i];
        var lat = parseFloat(beach.lat);
        var lng = parseFloat(beach.lng);
        var point = new google.maps.LatLng(lat,lng);
        var html = '<div id="iw-container"><img src="http://gonow.dev/assets/demo/photo.jpg" width="160">' + beach.thumbnail+

                '</div>';
        var label = beach.title;
        // create the marker
        var marker = $.fn.createMarker(point,label,html,beach.type, i);
      }
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

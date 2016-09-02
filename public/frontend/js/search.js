$(document).ready(function() {
      var _numStay=1;
      $("#hotelStartDay").length && ($("#hotelStartDay").datepicker({
        numberOfMonths: 2,
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        minDate: new Date,
        onClose: function(e, t) {
            var a = new Date,
                n = e.split("/"),
                i = "";
            if ("" != n) var i = n[2] + "-" + n[1] + "-" + n[0];
            var r = $("#hotelEndDay").val().split("/"),
                o = r[2] + "-" + r[1] + "-" + r[0];
            if ("" != $("#hotelEndDay").val()) {
                var c = new Date(i),
                    l = new Date(o);
                if ("" == n) {
                    var s = new Date(Date.parse(l));
                    s.setDate(s.getDate() - 1);
                    var d = s.toDateString();
                    d = new Date(Date.parse(d)), $("#hotelStartDay").datepicker("setDate", d)
                } else a >= c && (c = a, $("#hotelStartDay").datepicker("setDate", c));
                var s = new Date(Date.parse(c));
                s.setDate(s.getDate() + _numStay);
                var d = s.toDateString();
                d = new Date(Date.parse(d)), $("#hotelEndDay").datepicker("setDate", d)
            } else {
                var h = new Date(i),
                    s = new Date(Date.parse(h));
                s.setDate(s.getDate() + _numStay);
                var d = s.toDateString();
                d = new Date(Date.parse(d)), $("#hotelEndDay").datepicker("setDate", d)
            }
        }
    }), $("#hotelEndDay").datepicker({
        numberOfMonths: 2,
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        minDate: new Date,
        onClose: function(e, t) {
            var a = new Date,
                n = e.split("/"),
                i = "";
            if ("" != n) var i = n[2] + "-" + n[1] + "-" + n[0];
            var r = $("#hotelStartDay").val().split("/"),
                o = r[2] + "-" + r[1] + "-" + r[0];
            if ("" != $("#hotelStartDay").val()) {
                var c = new Date(o),
                    l = new Date(i);
                if ("" == n) {
                    var s = new Date(Date.parse(c));
                    s.setDate(s.getDate() + 1);
                    var d = s.toDateString();
                    d = new Date(Date.parse(d)), $("#hotelEndDay").datepicker("setDate", d)
                } else if (a >= l) {
                    l = a;
                    var s = new Date(Date.parse(l));
                    s.setDate(s.getDate() + 1);
                    var d = s.toDateString();
                    d = new Date(Date.parse(d)), $("#hotelEndDay").datepicker("setDate", d)
                }
                if (c >= l) {
                    var s = new Date(Date.parse(l));
                    s.setDate(s.getDate() - 1);
                    var d = s.toDateString();
                    d = new Date(Date.parse(d)), $("#hotelStartDay").datepicker("setDate", d)
                }
            } else {
                var h = new Date(i),
                    s = new Date(Date.parse(h));
                s.setDate(s.getDate() - 1);
                var d = s.toDateString();
                d = new Date(Date.parse(d)), $("#hotelStartDay").datepicker("setDate", d)
            }
        }
    }));
});

(function ($) { 
  "use strict";
  var search = {
    homeItem : "search-home",
    item: {
      travel:{
        travelKeyword : "travelKeyword",
        travelNation : "travelNation",
        travelProvince : "travelProvince",
        travelDistrict : "travelDistrict"
      },
      tour:{
        tourKeyword : "tourKeyword", 
        tourNation : "tourNation",
        tourProvince : "tourProvince",
        tourDistrict : "tourDistrict"
      },
      taste: {
        tasteKeyword : "tasteKeyword",
        tasteNation : "tasteNation",
        tasteProvince : "tasteProvince",
        tasteDistrict : "tasteDistrict"
      },
      hotel: {
        hotelStartDay : "hotelStartDay",
        hotelEndDay : "hotelEndDay",
        hotelNation : "hotelNation",
        hotelProvince : "hotelProvince",
        hotelDistrict: "hotelDistrict"
      }
    },
    button : {
      travelSearchButton : "travel-search-button",
      tourSearchButton : "tour-search-button",
      tasteSearchButton : "taste-search-button",
      hotelSearchButton : "hotel-search-button"
    }
  };
var getData = function(id){
  var r = {};
  r[item.name] = item.val();
  return r;
};
var data = {
  travel: {},
  tour : {},
  taste : {},
  hotel : {}
};

function callAjax(url, id){
  $.ajax({
    url: url,
    type: "POST",
    data: {'id': id},
    beforeSend: function(){
      
    },
    success: function(data) {
        //$("#destination").hide(), $("#destination").html(e), $("#destination").fadeIn("slow");
    }
  })
}
search.render = function(){
  var btnClick = $("#search ." +search.homeItem + " .panel-tab");
  $("#travelNation").on('change', function(){
    
  });
  btnClick.find('button').on('click', function(){
    var active = $("." + search.homeItem+ " ul.nav").find('li.active').attr('data-key');
    var link = '';
    switch(active) {
        case 'travel':
          $.each(search.item.travel, function(key, value){
            data.travel[key] = $("#" + value).val();
          });
            link += 'dia-diem-di-choi';
            link += (data.travel.travelNation !== '')?'/'+data.travel.travelNation:'';
            link += (data.travel.travelProvince !== '')?'/'+data.travel.travelProvince:'';
            link += (data.travel.travelDistrict !== '')?'/'+data.travel.travelDistrict:'';
            link += (data.travel.travelKeyword !== '')?'?keyword='+data.travel.travelKeyword:'';
          break;
        case 'tour':
            $.each(search.item.tour, function(key, value){
              data.tour[key] = $("#" + value).val();
            });
            link += 'tours-du-lich';
            link += (data.tour.tourNation !== '')?'/'+data.tour.tourNation:'';
            link += (data.tour.tourProvince !== '')?'/'+data.tour.tourProvince:'';
            link += (data.tour.tourDistrict !== '')?'/'+data.tour.tourDistrict:'';
            link += (data.tour.tourKeyword !== '')?'?keyword='+data.tour.tourKeyword:'';
          break;
        case 'hotel':
          console.log(active);
          break;
        case 'taste':
          console.log(active);
          break;
    }
    console.log(link);
    console.log(data);
  });
};
search.render();
})(jQuery);
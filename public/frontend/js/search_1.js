
$(document).ready(function() {
      $("#checkin_date").length && ($("#checkin_date").datepicker({
        numberOfMonths: 2,
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        minDate: new Date,
        onClose: function(e, t) {
            var a = new Date,
                n = e.split("/"),
                i = "";
            if ("" != n) var i = n[2] + "-" + n[1] + "-" + n[0];
            var r = $("#checkout_date").val().split("/"),
                o = r[2] + "-" + r[1] + "-" + r[0];
            if ("" != $("#checkout_date").val()) {
                var c = new Date(i),
                    l = new Date(o);
                if ("" == n) {
                    var s = new Date(Date.parse(l));
                    s.setDate(s.getDate() - 1);
                    var d = s.toDateString();
                    d = new Date(Date.parse(d)), $("#checkin_date").datepicker("setDate", d)
                } else a >= c && (c = a, $("#checkin_date").datepicker("setDate", c));
                var s = new Date(Date.parse(c));
                s.setDate(s.getDate() + _numStay);
                var d = s.toDateString();
                d = new Date(Date.parse(d)), $("#checkout_date").datepicker("setDate", d)
            } else {
                var h = new Date(i),
                    s = new Date(Date.parse(h));
                s.setDate(s.getDate() + _numStay);
                var d = s.toDateString();
                d = new Date(Date.parse(d)), $("#checkout_date").datepicker("setDate", d)
            }
        }
    }), 
    
    $("#checkout_date").datepicker({
        numberOfMonths: 2,
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        minDate: new Date,
        onClose: function(e, t) {
            var a = new Date,
                n = e.split("/"),
                i = "";
            if ("" != n) var i = n[2] + "-" + n[1] + "-" + n[0];
            var r = $("#checkin_date").val().split("/"),
                o = r[2] + "-" + r[1] + "-" + r[0];
            if ("" != $("#checkin_date").val()) {
                var c = new Date(o),
                    l = new Date(i);
                if ("" == n) {
                    var s = new Date(Date.parse(c));
                    s.setDate(s.getDate() + 1);
                    var d = s.toDateString();
                    d = new Date(Date.parse(d)), $("#checkout_date").datepicker("setDate", d)
                } else if (a >= l) {
                    l = a;
                    var s = new Date(Date.parse(l));
                    s.setDate(s.getDate() + 1);
                    var d = s.toDateString();
                    d = new Date(Date.parse(d)), $("#checkout_date").datepicker("setDate", d)
                }
                if (c >= l) {
                    var s = new Date(Date.parse(l));
                    s.setDate(s.getDate() - 1);
                    var d = s.toDateString();
                    d = new Date(Date.parse(d)), $("#checkin_date").datepicker("setDate", d)
                }
            } else {
                var h = new Date(i),
                    s = new Date(Date.parse(h));
                s.setDate(s.getDate() - 1);
                var d = s.toDateString();
                d = new Date(Date.parse(d)), $("#checkin_date").datepicker("setDate", d)
            }
            $("#checkin_date").datetimepicker("option", "minDate", a)
        }
    })), 
    
//    $("#in_date").length && ($("#in_date").datepicker({
//        numberOfMonths: 2,
//        dateFormat: "dd/mm/yy",
//        firstDay: 1,
//        minDate: new Date,
//        onClose: function(e, t) {
//            var a = new Date,
//                n = e.split("/"),
//                i = "";
//            if ("" != n) var i = n[2] + "-" + n[1] + "-" + n[0];
//            var r = $("#out_date").val().split("/"),
//                o = r[2] + "-" + r[1] + "-" + r[0];
//            if ("" != $("#out_date").val()) {
//                var c = new Date(i),
//                    l = new Date(o);
//                if ("" == n) {
//                    var s = new Date(Date.parse(l));
//                    s.setDate(s.getDate() - 1);
//                    var d = s.toDateString();
//                    d = new Date(Date.parse(d)), $("#in_date").datepicker("setDate", d)
//                } else a >= c && (c = a, $("#in_date").datepicker("setDate", c));
//                var s = new Date(Date.parse(c));
//                s.setDate(s.getDate() + _numStay);
//                var d = s.toDateString();
//                d = new Date(Date.parse(d)), $("#out_date").datepicker("setDate", d)
//            } else {
//                var h = new Date(i),
//                    s = new Date(Date.parse(h));
//                s.setDate(s.getDate() + _numStay);
//                var d = s.toDateString();
//                d = new Date(Date.parse(d)), $("#out_date").datepicker("setDate", d)
//            }
//        }
//    }), 
    
//    $("#out_date").datepicker({
//        numberOfMonths: 2,
//        dateFormat: "dd/mm/yy",
//        firstDay: 1,
//        minDate: new Date,
//        onClose: function(e, t) {
//            var a = new Date,
//                n = e.split("/"),
//                i = "";
//            if ("" != n) var i = n[2] + "-" + n[1] + "-" + n[0];
//            var r = $("#in_date").val().split("/"),
//                o = r[2] + "-" + r[1] + "-" + r[0];
//            if ("" != $("#in_date").val()) {
//                var c = new Date(o),
//                    l = new Date(i);
//                if ("" == n) {
//                    var s = new Date(Date.parse(c));
//                    s.setDate(s.getDate() + 1);
//                    var d = s.toDateString();
//                    d = new Date(Date.parse(d)), $("#out_date").datepicker("setDate", d)
//                } else if (a >= l) {
//                    l = a;
//                    var s = new Date(Date.parse(l));
//                    s.setDate(s.getDate() + 1);
//                    var d = s.toDateString();
//                    d = new Date(Date.parse(d)), $("#out_date").datepicker("setDate", d)
//                }
//                if (c >= l) {
//                    var s = new Date(Date.parse(l));
//                    s.setDate(s.getDate() - 1);
//                    var d = s.toDateString();
//                    d = new Date(Date.parse(d)), $("#in_date").datepicker("setDate", d)
//                }
//            } else {
//                var h = new Date(i),
//                    s = new Date(Date.parse(h));
//                s.setDate(s.getDate() - 1);
//                var d = s.toDateString();
//                d = new Date(Date.parse(d)), $("#in_date").datepicker("setDate", d)
//            }
//            $("#in_date").datetimepicker("option", "minDate", a)
//        }
//    })), 
    
//    $("#depart_date").length && ($("#depart_date").datepicker({
//        numberOfMonths: 2,
//        dateFormat: "dd/mm/yy",
//        firstDay: 1,
//        minDate: new Date,
//        onClose: function(e, t) {
//            var a = new Date,
//                n = e.split("/"),
//                i = "";
//            if ("" != n) var i = n[2] + "-" + n[1] + "-" + n[0];
//            var r = $("#return_date").val().split("/"),
//                o = r[2] + "-" + r[1] + "-" + r[0];
//            if ("" != $("#return_date").val()) {
//                var c = new Date(i),
//                    l = new Date(o);
//                if ("" == n) {
//                    var s = new Date(Date.parse(l));
//                    s.setDate(s.getDate() - 1);
//                    var d = s.toDateString();
//                    d = new Date(Date.parse(d)), $("#depart_date").datepicker("setDate", d)
//                } else a >= c && (c = a, $("#depart_date").datepicker("setDate", c));
//                var s = new Date(Date.parse(c));
//                s.setDate(s.getDate() + _numStay);
//                var d = s.toDateString();
//                d = new Date(Date.parse(d)), $("#return_date").datepicker("setDate", d)
//            } else {
//                var h = new Date(i),
//                    s = new Date(Date.parse(h));
//                s.setDate(s.getDate() + _numStay);
//                var d = s.toDateString();
//                d = new Date(Date.parse(d)), $("#return_date").datepicker("setDate", d)
//            }
//            $("#ticketbox").length && ($("#selected_depart").val($("#depart_date").val()), $("#btn-continue").hide(), getTicketPrice("depart"))
//        }
//    }), 
    
//  $("#return_date").datepicker({
//        numberOfMonths: 2,
//        dateFormat: "dd/mm/yy",
//        firstDay: 1,
//        minDate: new Date,
//        onClose: function(e, t) {
//            var a = new Date,
//                n = e.split("/"),
//                i = "";
//            if ("" != n) var i = n[2] + "-" + n[1] + "-" + n[0];
//            var r = $("#depart_date").val().split("/"),
//                o = r[2] + "-" + r[1] + "-" + r[0];
//            if ("" != $("#depart_date").val()) {
//                var c = new Date(o),
//                    l = new Date(i);
//                if ("" == n) {
//                    var s = new Date(Date.parse(c));
//                    s.setDate(s.getDate() + 1);
//                    var d = s.toDateString();
//                    d = new Date(Date.parse(d)), $("#return_date").datepicker("setDate", d)
//                } else if (a >= l) {
//                    l = a;
//                    var s = new Date(Date.parse(l));
//                    s.setDate(s.getDate() + 1);
//                    var d = s.toDateString();
//                    d = new Date(Date.parse(d)), $("#return_date").datepicker("setDate", d)
//                }
//                if (c >= l) {
//                    var s = new Date(Date.parse(l));
//                    s.setDate(s.getDate() - 1);
//                    var d = s.toDateString();
//                    d = new Date(Date.parse(d)), $("#depart_date").datepicker("setDate", d)
//                }
//            } else {
//                var h = new Date(i),
//                    s = new Date(Date.parse(h));
//                s.setDate(s.getDate() - 1);
//                var d = s.toDateString();
//                d = new Date(Date.parse(d)), $("#depart_date").datepicker("setDate", d)
//            }
//            $("#depart_date").datetimepicker("option", "minDate", a), $("#ticketbox").length && ($("#selected_return").val($("#return_date").val()), $("#btn-continue").hide(), getTicketPrice("return"))
//        }
//    })), 
    
//    $("#country").change(function() {
//        $("#zone").length && ($("#zone").val(""), $("#zone").change(), $.ajax({
//            url: "/ajax/get-zones",
//            type: "GET",
//            data: "country=" + $(this).val(),
//            success: function(e) {
//                $("#zone").hide(), $("#zone").html(e), $("#zone").fadeIn("slow")
//            }
//        }))
//    }),
    
//    $("#country_id").change(function() {
//        if ($("#destination").length) {
//            var e = "/ajax/get-destinations";
//            "checkbox" == $("#destination").attr("rel") && (e = "/ajax/get-destinations-checkbox"), $("#destination").val(""), $("#destination").change(), $.ajax({
//                url: e,
//                type: "GET",
//                data: "country_id=" + $(this).val(),
//                success: function(e) {
//                    $("#destination").hide(), $("#destination").html(e), $("#destination").fadeIn("slow")
//                }
//            })
//        }
//    }), 
    
//  $("#zone").change(function() {
//        $.ajax({
//            url: "/ajax/get-geo-zones",
//            type: "GET",
//            data: "zone=" + $(this).val(),
//            success: function(e) {
//                $("#geo_zone").hide(), $("#geo_zone").html(e), $("#geo_zone").fadeIn("slow")
//            }
//        }), loadPlaceName($(this).val(), "")
//    }), 
    
//  createGUID()
});


(function ($) { 
  "use strict";

//  // CAROUSEL CLASS DEFINITION
//  // =========================
//
//  var Carousel = function (element, options) {
//    this.$element    = $(element)
//    this.$indicators = this.$element.find('.carousel-indicators')
//    this.options     = options
//    this.paused      =
//    this.sliding     =
//    this.interval    =
//    this.$active     =
//    this.$items      = null
//
//    this.options.pause == 'hover' && this.$element
//      .on('mouseenter', $.proxy(this.pause, this))
//      .on('mouseleave', $.proxy(this.cycle, this))
//  }
//
//  Carousel.DEFAULTS = {
//    interval: 5000
//  , pause: 'hover'
//  , wrap: true
//  }
//
//  Carousel.prototype.cycle =  function (e) {
//    e || (this.paused = false)
//
//    this.interval && clearInterval(this.interval)
//
//    this.options.interval
//      && !this.paused
//      && (this.interval = setInterval($.proxy(this.next, this), this.options.interval))
//
//    return this
//  }
//
//  Carousel.prototype.getActiveIndex = function () {
//    this.$active = this.$element.find('.item.active')
//    this.$items  = this.$active.parent().children()
//
//    return this.$items.index(this.$active)
//  }
//
//  Carousel.prototype.to = function (pos) {
//    var that        = this
//    var activeIndex = this.getActiveIndex()
//
//    if (pos > (this.$items.length - 1) || pos < 0) return
//
//    if (this.sliding)       return this.$element.one('slid.bs.carousel', function () { that.to(pos) })
//    if (activeIndex == pos) return this.pause().cycle()
//
//    return this.slide(pos > activeIndex ? 'next' : 'prev', $(this.$items[pos]))
//  }
//
//  Carousel.prototype.pause = function (e) {
//    e || (this.paused = true)
//
//    if (this.$element.find('.next, .prev').length && $.support.transition.end) {
//      this.$element.trigger($.support.transition.end)
//      this.cycle(true)
//    }
//
//    this.interval = clearInterval(this.interval)
//
//    return this
//  }
//
//  Carousel.prototype.next = function () {
//    if (this.sliding) return
//    return this.slide('next')
//  }
//
//  Carousel.prototype.prev = function () {
//    if (this.sliding) return
//    return this.slide('prev')
//  }
//
//  Carousel.prototype.slide = function (type, next) {
//    var $active   = this.$element.find('.item.active')
//    var $next     = next || $active[type]()
//    var isCycling = this.interval
//    var direction = type == 'next' ? 'left' : 'right'
//    var fallback  = type == 'next' ? 'first' : 'last'
//    var that      = this
//
//    if (!$next.length) {
//      if (!this.options.wrap) return
//      $next = this.$element.find('.item')[fallback]()
//    }
//
//    this.sliding = true
//
//    isCycling && this.pause()
//
//    var e = $.Event('slide.bs.carousel', { relatedTarget: $next[0], direction: direction })
//
//    if ($next.hasClass('active')) return
//
//    if (this.$indicators.length) {
//      this.$indicators.find('.active').removeClass('active')
//      this.$element.one('slid.bs.carousel', function () {
//        var $nextIndicator = $(that.$indicators.children()[that.getActiveIndex()])
//        $nextIndicator && $nextIndicator.addClass('active')
//      })
//    }
//
//    if ($.support.transition && this.$element.hasClass('slide')) {
//      this.$element.trigger(e)
//      if (e.isDefaultPrevented()) return
//      $next.addClass(type)
//      $next[0].offsetWidth // force reflow
//      $active.addClass(direction)
//      $next.addClass(direction)
//      $active
//        .one($.support.transition.end, function () {
//          $next.removeClass([type, direction].join(' ')).addClass('active')
//          $active.removeClass(['active', direction].join(' '))
//          that.sliding = false
//          setTimeout(function () { that.$element.trigger('slid.bs.carousel') }, 0)
//        })
//        .emulateTransitionEnd(600)
//    } else {
//      this.$element.trigger(e)
//      if (e.isDefaultPrevented()) return
//      $active.removeClass('active')
//      $next.addClass('active')
//      this.sliding = false
//      this.$element.trigger('slid.bs.carousel')
//    }
//
//    isCycling && this.cycle()
//
//    return this
//  }
//
//
//  // CAROUSEL PLUGIN DEFINITION
//  // ==========================
//
//  var old = $.fn.carousel
//
//  $.fn.carousel = function (option) {
//    return this.each(function () {
//      var $this   = $(this)
//      var data    = $this.data('bs.carousel')
//      var options = $.extend({}, Carousel.DEFAULTS, $this.data(), typeof option == 'object' && option)
//      var action  = typeof option == 'string' ? option : options.slide
//
//      if (!data) $this.data('bs.carousel', (data = new Carousel(this, options)))
//      if (typeof option == 'number') data.to(option)
//      else if (action) data[action]()
//      else if (options.interval) data.pause().cycle()
//    })
//  }
//
//  $.fn.carousel.Constructor = Carousel
//
//
//  // CAROUSEL NO CONFLICT
//  // ====================
//
//  $.fn.carousel.noConflict = function () {
//    $.fn.carousel = old
//    return this
//  }
//
//
//  // CAROUSEL DATA-API
//  // =================
//
//  $(document).on('click.bs.carousel.data-api', '[data-slide], [data-slide-to]', function (e) {
//    var $this   = $(this), href
//    var $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) //strip for ie7
//    var options = $.extend({}, $target.data(), $this.data())
//    var slideIndex = $this.attr('data-slide-to')
//    if (slideIndex) options.interval = false
//
//    $target.carousel(options)
//
//    if (slideIndex = $this.attr('data-slide-to')) {
//      $target.data('bs.carousel').to(slideIndex)
//    }
//
//    e.preventDefault()
//  })
//
//  $(window).on('load', function () {
//    $('[data-ride="carousel"]').each(function () {
//      var $carousel = $(this)
//      $carousel.carousel($carousel.data())
//    })
//  })
  var getDaysInMonth = function(month,year) {
    return new Date(year, month, 0).getDate();
  }

      
//  $( "#hotelStartDay" ).datepicker({
//    minDate: new Date(),
//    maxDate: "+1y",
//    changeMonth: true,
//    changeYear: true,
//     dateFormat: 'dd-mm-yy'
//  });
//  
//  $( "#hotelEndDay" ).datepicker({
//    minDate: "+1d",
//    maxDate: "+1y",
//    changeMonth: true,
//    changeYear: true,
//     dateFormat: 'dd-mm-yy'
//  });
//  
//  $( "#hotelStartDay" ).on('change', function(){
//    var startDay = $(this).val();
//    console.log(startDay);
//    
//    $( "#hotelEndDay" ).datepicker('destroy');
//    $( "#hotelEndDay" ).datepicker({
//      minDate: startDay,
//      maxDate: "+1y",
//      changeMonth: true,
//      changeYear: true,
//      dateFormat: 'dd-mm-yy'
//    });
////dateField.datepicker(customOptions);
//    $( "#hotelEndDay" ).datepicker('refresh');
//  });
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
//  this.data = {};
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
search.render = function(){
  var btnClick = $("#search ." +search.homeItem + " .panel-tab");
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
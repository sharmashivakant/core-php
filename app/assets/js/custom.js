
/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
    $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
    e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
            a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
    tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
    })
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
    template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}

$(function() { 
  $(window).scroll(function () {
    if ($(window).scrollTop() > 5) {
      $("header").addClass("scrolled");
    }
    else {
      $("header").removeClass("scrolled");
    }
  })
});

// .product-list .inner-sec .img-sec:hover .img-cont p {
  
    $(".product-list .img-sec").hover(function(){
  $(this).find('p').slideDown();
  }, function(){
  $(this).find('p').slideUp();
});

$(".menu-toggle").on('click', function () {
  $(".menu-desktop").fadeToggle("slow");
  // $(".menu-desktop li").toggleClass('slideInLeft');
  $('body').toggleClass('body-fix');
  $("header").toggleClass('header-mobile-menu');
})



/******Smooth scrool*****/
$('.scroll a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function (event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function () {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
/******Lightslider******/


$("#banner-cara").lightSlider({
  item: 1,
  loop: true,
  keyPress: true,
  auto: true,
  pager: false,
  slideMargin: 0,
  easing: 'linear',
  enableDrag: true,
  freeMove: true,
  pause: 10000,
  slideEndAnimation: true,
  mode: 'slide'
});

if ($(window).width() < 767) {
  $("#content-slider").lightSlider({
    item: 1,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 0
  });
}

if ($(window).width() < 768) {
  $("#content-slider").lightSlider({
    item: 2,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 10,
  });
}
else if ($(window).width() > 767 && $(window).width() <= 991) {
  $("#content-slider").lightSlider({
    item: 3,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 10,
  });
}
else if ($(window).width() > 991 && $(window).width() <= 1367
) {
  $("#content-slider").lightSlider({
    item: 3,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 25,
  });
}
else if ($(window).width() > 1367 && $(window).width() <= 1440) {
  $("#content-slider").lightSlider({
    item: 3,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 40,
  });
}
else if ($(window).width() > 1440) {
  $("#content-slider").lightSlider({
    item: 3,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 35,
  });
}
/****contslider2******/
if ($(window).width() < 768) {
  $("#content-slider1").lightSlider({
    item: 2,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 10,
  });
}
else if ($(window).width() > 767 && $(window).width() <= 991) {
  $("#content-slider1").lightSlider({
    item: 3,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 10,
  });
}
else if ($(window).width() > 991 && $(window).width() <= 1367
) {
  $("#content-slider1").lightSlider({
    item: 3,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 25,
  });
}
else if ($(window).width() > 1367 && $(window).width() <= 1440) {
  $("#content-slider1").lightSlider({
    item: 3,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 40,
  });
}
else if ($(window).width() > 1440) {
  $("#content-slider1").lightSlider({
    item: 4,
    loop: true,
    keyPress: true,
    auto: true,
    pager: false,
    slideMargin: 35,
  });
}

$("#content-slider3").lightSlider({
  item: 2,
  loop: true,
  keyPress: true,
  auto: true,
  pager: false,
  slideMargin: 10,
});

jQuery(document).ready(function($) {
  $('.slick.marquee').slick({
    speed: 5000,
    autoplay: true,
    autoplaySpeed: 0,
    centerMode: true,
    cssEase: 'linear',
    slidesToShow: 1,
    slidesToScroll: 1,
    variableWidth: true,
    infinite: true,
    initialSlide: 1,
    arrows: false,
    buttons: false
  });
});


jQuery(document).ready(function() {
  setInterval(function() {
    var active = $(".value-sec .value-right li.active");
    active.removeClass('active');
    if (active.next('li').length == 0) {
      active.parent('ul').find('li:first').addClass('active');
    } else {
      active.next('li').addClass('active');
    }
  }, 1000);
});


$(document).ready(function(){
  if ($(window).width() < 768){
    $(".team-sec .team-member").attr("id" , "content-slider4");
    $("#content-slider4").lightSlider({
      item: 1,
      loop: true,
      keyPress: true,
      auto: true,
      pager: false,
      slideMargin: 10,
    });
    console.log("it should work")
  }
})



// new WOW().init();

$(document).ready(function() {
  $("body").removeClass("body-fix");
  $(".toggle-btn").on("click", function () {
    $(this).toggleClass("active");
    $(".fullview-menu").toggleClass("open");
    $("body").toggleClass("body-fix");
  });
  $("toggle-btn.active").on("click", function () {
    $("body").removeClass("body-fix");
  });

  $('.feature-funt-content').removeClass('to-expand-block');
  $('.feature-funt-content .show-more-content').hide();
  $('.feature-funt-content .show-more-img').hide();
  
  $('.feature-funt-content .show-more').click(function(){
    $('.feature-funt-content .show-more-content').slideDown();
    $('.feature-funt-content .show-more-img').slideDown();
    $('.feature-funt-content .show-less').show();
    $('.feature-funt-content .show-more').hide();
    $('.feature-funt-content').addClass('to-expand-block');
  });
  
  $('.feature-funt-content .show-less').click(function(){
    $('.feature-funt-content .show-more-content').slideUp();
    $('.feature-funt-content .show-more-img').slideUp();
    setTimeout(function(){ 
        $('.feature-funt-content .show-more').show();
        $('.feature-funt-content .show-less').hide(); 
        
    }, 400);
    
    $('.feature-funt-content').removeClass('to-expand-block');
  });


  $('.scheme-block').removeClass('scheme-expand-block');
  $('.scheme-block .scheme-more-content').hide();
  $('.scheme-block .show-more').click(function(){
    $('.scheme-block .scheme-more-content').slideDown();
    $('.scheme-block .show-less').show();
    $('.scheme-block .show-more').hide();
    $('.scheme-block').addClass('to-expand-block');
  });
  
  $('.scheme-block .show-less').click(function(){
    $('.scheme-block .scheme-more-content').hide();
    $('.scheme-block .show-more').show();
    $(this).hide();
    $('.scheme-block').removeClass('scheme-expand-block');
  });


  //  common-text
  $('.content-to-show').hide();
  $('.to-show-inner .to-show-more').click(function(){
    $(this).parent().find('.content-to-show').slideDown();
    $(this).parent().find('.content-to-show .to-show-less').show();
    $(this).hide();
  });
  
  $('.to-show-inner .content-to-show .to-show-less').click(function(){
    $(this).parent('.content-to-show').hide();
    $(this).parent().parent().find('.to-show-more').show();
    $(this).hide();
  });

  $('.popover-btn').popover({
    trigger: 'focus'
  });
  
//        $('.to-show-hover').hide();
//   $(".team-main-content").mouseover(function() {
//     $(this).find('.to-hide-hover').hide();
//     $(this).find('.to-show-hover').show();
//   });
//   $(".team-main-content").mouseout(function() {
//     $(this).find('.to-hide-hover').show();
//     $(this).find('.to-show-hover').hide();
//   });


});








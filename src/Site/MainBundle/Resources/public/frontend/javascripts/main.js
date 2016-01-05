$(function(){
  init();
});

$(window).scroll(function(){
  var wScroll = $(this).scrollTop();

  $("#main").css({
    'transform' : 'translate(0px, '+wScroll/3+'%)'
  });

  if(wScroll >= $(".main").height() - $('nav').height()){
    $("nav").addClass('black');
  }else{
    $("nav").removeClass('black');
  }
});

$(window).resize(function(){
  init();
});

function init(){
  var $container = $('.container');

  $('#our_work').find('.box').imagesLoaded(function(){
    $('#our_work').find('.box').masonry({
      itemSelector: 'figure',
      columnWidth: function( containerWidth ) {
        if($(window).width() <= 900){
          return containerWidth;// depends how many boxes per row
        }else{
          return containerWidth /2;// depends how many boxes per row
        }
      }(), // () to execute the anonymous function right away and use its result
      isAnimated: true
    });
  });

    //  Инициализация слайдера на главной
    jQuery('.slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        autoplay: false,
        autoplaySpeed: 3000
    });

    jQuery('.slider').on('init setPosition', function (slick) {
        jQuery('.slider .slick-slide div').css({
            'height': jQuery('body').height(),
            'width': jQuery('body').width()
        });
    });

    jQuery('.slider').on('afterChange', function (slick, currentSlide) {
        var slide = jQuery('.slider .slick-slide[data-slick-index="'+currentSlide.currentSlide+'"]');
        if(slide.hasClass('video')){
            var videoObject = slide.data('vide').getVideoObject();
            videoObject.play();
        }
    });

    jQuery('.slider').on('beforeChange', function (slick, currentSlide, nextSlide) {
        var slide = jQuery('.slider .slick-slide[data-slick-index="'+nextSlide.currentSlide+'"]');
        if(slide.hasClass('video')){
            var videoObject = slide.data('vide').getVideoObject();
            videoObject.stop();
        }
    });

    jQuery('.slider .video').each(function (i, e) {
        jQuery(e).vide({
            mp4: jQuery(e).data('video')
        }, {
            volume: 1,
            playbackRate: 1,
            muted: true,
            autoplay: false,
            loop: true,
            position: '50% 50%', // Similar to the CSS `background-position` property.
            posterType: 'detect', // Poster image type. "detect" — auto-detection; "none" — no poster; "jpg", "png", "gif",... - extensions.
            resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing...
        });
    });

    /* Validate and Submit Question form */
    $('#form-feedback').submit(function(){
        var $form = $('#form-feedback');

        $.post($form.attr('action'), $form.serialize(), function(response){
            if(response.status == "OK"){
                $form[0].reset();
                $form.find('input[type="text"]').removeClass('error');
                $form.find('input[type="email"]').removeClass('error');
                $form.find('textarea').removeClass('error');
                $form.parent().find('.flash-notice').html(response.message).show();
                setTimeout(function(){
                    $form.parent().find('.flash-notice').hide();
                }, 4000);
            } else {
                if(response.name.status != "OK"){
                    $form.find('input#name').addClass('error');
                } else {
                    $form.find('input#name').removeClass('error');
                }
                if(response.email.status != "OK"){
                    $form.find('input#email').addClass('error');
                } else {
                    $form.find('input#email').removeClass('error');
                }
                if(response.message.status != "OK"){
                    $form.find('textarea#message').addClass('error');
                } else {
                    $form.find('textarea#message').removeClass('error');
                }
            }
        });

        return false;
    });
    /* end Validate and Submit Question form */
}

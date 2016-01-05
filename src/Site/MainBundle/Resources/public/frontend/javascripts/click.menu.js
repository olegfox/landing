$(function(){
  $(".menu-button").click(function(){
    if(!$("ul.menu").hasClass("collapse-block")){
      if($("ul.menu").hasClass("collapse-in")){
        var height = $("ul.menu").height();
        $("ul.menu").animate({'height' : '0px'}, 500, function(){
          $("ul.menu").removeClass("collapse-in").removeClass("collapse-block").css('height', height);
        }).addClass("collapse-block");
      }else{
        var height = $("ul.menu").height();
        $("ul.menu").addClass("collapse-in").css('height', '0px').addClass("collapse-block");
        $("ul.menu").animate({'height' : height}, 500, function(){
          $("ul.menu").removeClass("collapse-block");
        });
      }
    }
  });

  $(".icon-arrow").click(function(e){
      e.preventDefault();
    $("ul.menu li a").removeClass('current');
    $("html, body").animate({scrollTop: $('#services').offset().top - $('nav').height()}, 1000);
  });

  $("ul.menu li a").click(function(){
    $("ul.menu li a").removeClass('current');
    $(this).addClass('current');
    $("html, body").animate({scrollTop: $($(this).attr('href')).offset().top - $('nav').height() + 20}, 1000);
  });
});

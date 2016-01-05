$(function(){
  init();
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
        if($(window).width() < 900){
          return containerWidth / 2;// depends how many boxes per row
        }else{
          return containerWidth / 3;// depends how many boxes per row
        }
      }(), // () to execute the anonymous function right away and use its result
      isAnimated: true
    });

    $("#our_work").css({
      "top" : '20px'
    });

  });
}

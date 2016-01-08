$(function(){
    if(jQuery('.wrap-header').data('video').length > 0) {
        jQuery('.wrap-header').vide({
            mp4: jQuery('.wrap-header').data('video')
        }, {
            volume: 1,
            playbackRate: 1,
            muted: true,
            autoplay: true,
            loop: true,
            position: '50% 50%', // Similar to the CSS `background-position` property.
            posterType: 'detect', // Poster image type. "detect" — auto-detection; "none" — no poster; "jpg", "png", "gif",... - extensions.
            resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing...
        });
    }

    $(".arrow").each(function(i, el) {
        $(el).click(function(e){
            e.preventDefault();
            $("html, body").animate({scrollTop: $("#" + $(el).data('current-level')).nextAll('.level').first().offset().top}, 1000);
        });
    });

});
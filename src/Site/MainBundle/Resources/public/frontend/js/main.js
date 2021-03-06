$(function(){
    if(jQuery('.wrap-header').attr('data-video') != undefined) {
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
    }

    $(".arrow").each(function(i, el) {
        $(el).click(function(e){
            e.preventDefault();
            $("html, body").animate({scrollTop: $("#" + $(el).data('current-level')).nextAll('.level').first().offset().top}, 1000);
        });
    });

    $(".feedback").colorbox({
        html: $(".contact-form").html(),
        onComplete: function(){
            $("#cboxContent form").validate({
                messages: {
                    "site_mainbundle_feedback[name]": "Введите имя!",
                    "site_mainbundle_feedback[email]": "Введите email!"
                },
                showErrors: function(errorMap, errorList) {
                    this.defaultShowErrors();
                    $.colorbox.resize();
                },
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        beforeSubmit: function(arr, $form, options) {
                            $("#cboxLoadedContent").html('<div class="alert alert-success" role="alert">Сообщение успешно отправлено!</div>');
                            $.colorbox.resize();
                        }
                    });
                }
            });
        }
    });

    if($(".wow").length > 0) {
        var wow = new WOW(
            {
                boxClass:     'wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset:       0,          // distance to the element when triggering the animation (default is 0)
                mobile:       true,       // trigger animations on mobile devices (default is true)
                live:         true,       // act on asynchronously loaded content (default is true)
                callback:     function(box) {
                    // the callback is fired every time an animation is started
                    // the argument that is passed in is the DOM node being animated
                },
                scrollContainer: null // optional scroll container selector, otherwise use window
            }
        );
        wow.init();
    }
});
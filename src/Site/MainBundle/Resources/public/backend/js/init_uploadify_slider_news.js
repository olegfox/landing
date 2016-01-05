$(function () {
    var uploadEnd = 0,
        image = [],
        i = 0;
    $('.uploadifySlider').parent().append("<input type='hidden' name='sliderGallery' class='sliderGallery' />");
    $('.uploadifySlider').uploadify({
        'auto': false,
        'fileTypeDesc' : 'Image Files',
        'fileTypeExts' : '*.gif; *.jpg; *.png',
        'swf': '/bundles/sitemain/backend/js/uploadify/uploadify.swf',
        'uploader': '/bundles/sitemain/backend/js/uploadify/uploadifySlider.php',
        'onQueueComplete': function (queueData) {
            uploadEnd = 1;
            $(".sliderGallery").val(JSON.stringify(image));
            $("form.form-horizontal").unbind('submit');
            $("form.form-horizontal").submit();
        },
        'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('Файл ' + file.name + ' не может быть загружен: ' + errorString);
        },
        'onUploadSuccess': function (file, data, response) {
            image[i] = data;
            i++;
        }
    });
    $("button[type='submit']").click(function () {
        $("form .type-button").remove();
        $("form").prepend("<input type='hidden' class='type-button' name='"+$(this).attr("name")+"' value='1' />");
        $("form").submit(function(){
            if (uploadEnd == 0 && $(".uploadify-queue *").length > 0) {
                $('.uploadify').uploadify('upload', '*');
                return false;
            }
        });
    });
});
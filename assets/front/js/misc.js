(function ($) {
    "use strict";

    $(document).on('click', '.review-value li a', function () {
        $('.review-value li a i').removeClass('text-primary');
        let reviewValue = $(this).attr('data-href');
        let parentClass = `review-${reviewValue}`;
        $('.' + parentClass + ' li a i').addClass('text-primary');
        $('#reviewValue').val(reviewValue);
    });


    $(document).on('change', '.image', function () {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.showimage').attr('src', e.target.result)
        };

        reader.readAsDataURL(file);
    });
})(jQuery); 

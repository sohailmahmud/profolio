(function ($) {
    "use strict";
    $('input[name="is_trial"]').on('change',function(){
        if ($(this).val() == 1) {
            $('#trial_day').show();
        } else {
            $('#trial_day').hide();
        }
        $('#trial_days_2').val(null);
        $('#trial_days_1').val(null);
    });
})(jQuery); 

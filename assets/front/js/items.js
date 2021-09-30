(function ($) {
    "use strict";
    let maxprice = 0;
    let minprice = 0;
    let typeSort = '';
    let category = '';
    let tag = '';
    let review = '';
    let search = '';

    $("#slider-range").slider({
        range: true,
        min: 0,
        max: sliderInitMax,
        values: [sliderMinPrice, sliderMaxPrice],
        slide: function (event, ui) {
            $("#amount").val((position == 'left' ? symbol : '') + ui.values[0] + (position == 'right' ? symbol : '') + " - " + (position == 'left' ? symbol : '') + ui.values[1] + (position == 'right' ? symbol : ''));
        }
    });

    $("#amount").val((position == 'left' ? symbol : '') + $("#slider-range").slider("values", 0) + (position == 'right' ? symbol : '') + " - " + (position == 'left' ? symbol : '') + $("#slider-range").slider("values", 1) + (position == 'right' ? symbol : ''));

    $(document).on('click', '.filter-button', function () {
        let filterval = $('#amount').val();
        filterval = filterval.split('-');
        maxprice = filterval[1].replace('$', '');
        minprice = filterval[0].replace('$', '');
        maxprice = parseInt(maxprice);
        minprice = parseInt(minprice);
        $('#maxprice').val(maxprice);
        $('#minprice').val(minprice);
        $('#search-button').trigger('click');
    });

    $(document).on('change', '#type_sort', function () {
        typeSort = $(this).val();
        $('#type').val(typeSort);
        $('#search-button').trigger('click');
    })
    $(document).ready(function () {
        typeSort = $('#type_sort').val();
        $('#type').val(typeSort);
    })

    $(document).on('click', '.category-id', function () {
        category = '';
        if ($(this).attr('data-href') != 0) {
            category = $(this).attr('data-href');
        }
        $('#category_id').val(category);
        $('#search-button').trigger('click');
    })
    $(document).on('click', '.tag-id', function () {
        tag = '';
        if ($(this).attr('data-href') != 0) {
            tag = $(this).attr('data-href');
        }
        $('#tag').val(tag);
        $('#search-button').trigger('click');
    })

    $(document).on('click', '.review_val', function () {
        review = $(".review_val:checked").val();
        $('#review').val(review);
        $('#search-button').trigger('click');
    })

    $(document).on('click', '.input-search-btn', function () {
        search = $('.input-search').val();
        $('#search').val(search);
        $('#search-button').trigger('click');
    })
})(jQuery);
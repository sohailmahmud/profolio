"use strict";
$(function() {
    // Menu js

    $(".nav-toggole,.main-menu li a").on('click', function (e) {
      $(".nav-toggole").toggleClass("active");
    });
    $(".nav-toggole,.main-menu li a").on('click', function (e) {
      $(".menu-wrapper").toggleClass("active");
    });

    //====== Magnific Popup

    $('.video-popup').magnificPopup({
        type: 'iframe'
        // other options
    });

    //===== Magnific Popup

    $('.image-popup').magnificPopup({
      type: 'image',
      gallery:{
        enabled:true
      }
    });

    //===== counter up

    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });

    //===== Back to top

    $(window).on('scroll', function(event) {
        if ($(this).scrollTop() > 600) {
            $('.back-to-top').fadeIn(200)
        } else {
            $('.back-to-top').fadeOut(200)
        }
    });

    // Animate the scroll to top

    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });

    //  Slick Slider js
    $('.testimonial-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        slidesToShow: 3,
        rtl: rtl == 1 ? true : false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // page_scroll JS
    
    $("a.page_scroll").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            scrollToPosition(hash);
        } 
    });
    function scrollToPosition(hash){
        //Initialize Active Class
        $('body,html').animate({
            start: function(){},
            scrollTop: $(hash).offset().top,
        },1000,function(){
            window.location.hash = hash;
        });
    }

    // Isotope js

    $('#portfolio').imagesLoaded( function() {
        var $grid = $('.filter-grid').isotope({
            itemSelector: '.grid-column',
            percentPosition: true,
            isOriginLeft: rtl == 1 ? false : true,
            masonry:{
              columnWidth: 1
            }
        });
        $('.work-filter').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
        $('.work-filter').each(function(i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', 'button', function() {
                $buttonGroup.find('.active-btn').removeClass('active-btn');
                $(this).addClass('active-btn');
            });
        });
    });

    
    
    $('.post-gallery-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        autoplay: true,
        speed: 800,
        prevArrow: '<div class="prev"><i class="fas fa-angle-left"></i></div>',
		nextArrow: '<div class="next"><i class="fas fa-angle-right"></i></div>',
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false
    });

    // wow min js
    new WOW().init();

    // Typed js
    if($("#typed").length > 0) {
        var typed = new Typed('#typed', {
          stringsElement: '.type-string',
          typeSpeed: 80,
          loop: true
        });
    }

    // lazy load init
    var lazyLoadInstance = new LazyLoad();
});

//===== Prealoder

$(window).on('load', function(event) {
    $('.preloader').delay(500).fadeOut('500');
})

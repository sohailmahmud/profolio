"use strict";
var saas_theme;

function popupAnnouncement($this) {
    let closedPopups = [];
    if (sessionStorage.getItem('closedPopups')) {
        closedPopups = JSON.parse(sessionStorage.getItem('closedPopups'));
    }
    
    // if the popup is not in closedPopups Array
    if (closedPopups.indexOf($this.data('popup_id')) == -1) {
        $('#' + $this.attr('id')).show();
        let popupDelay = $this.data('popup_delay');
  
        setTimeout(function() {
            jQuery.magnificPopup.open({
                items: {src: '#' + $this.attr('id')},
                type: 'inline',
                callbacks: {
                    afterClose: function() {
                        // after the popup is closed, store it in the sessionStorage & show next popup
                        closedPopups.push($this.data('popup_id'));
                        sessionStorage.setItem('closedPopups', JSON.stringify(closedPopups));
    
                        
                        if ($this.next('.popup-wrapper').length > 0) {
                            popupAnnouncement($this.next('.popup-wrapper'));
                        }
                    }
                }
            }, 0);
        }, popupDelay);
    } else {
        if ($this.next('.popup-wrapper').length > 0) {
            popupAnnouncement($this.next('.popup-wrapper'));
        }
    }
  }

$(function() {

    saas_theme = {
        init: function() {
            this.mainMenu();
        },
        //===== 01. Main Menu
        mainMenu() {
            // Variables
            var var_window = $(window),
                navContainer = $('.nav-container'),
                pushedWrap = $('.nav-pushed-item'),
                pushItem = $('.nav-push-item'),
                pushedHtml = pushItem.html(),
                pushBlank = '',
                navbarToggler = $('.navbar-toggler'),
                navMenu = $('.nav-menu'),
                navMenuLi = $('.nav-menu ul li ul li'),
                closeIcon = $('.navbar-close');
            // navbar toggler
            navbarToggler.on('click', function() {
                navbarToggler.toggleClass('active');
                navMenu.toggleClass('menu-on');
            });
            // close icon
            closeIcon.on('click', function() {
                navMenu.removeClass('menu-on');
                navbarToggler.removeClass('active');
            });

            // adds toggle button to li items that have children
            navMenu.find('li a').each(function() {
                if ($(this).next().length > 0) {
                    $(this)
                        .parent('li')
                        .append(
                            '<span class="dd-trigger"><i class="fas fa-angle-down"></i></span>'
                        );
                }
            });
            // expands the dropdown menu on each click
            navMenu.find('li .dd-trigger').on('click', function(e) {
                e.preventDefault();
                $(this)
                    .parent('li')
                    .children('ul')
                    .stop(true, true)
                    .slideToggle(350);
                $(this).parent('li').toggleClass('active');
            });

            // check browser width in real-time
            function breakpointCheck() {
                var windoWidth = window.innerWidth;
                if (windoWidth <= 1199) {
                    navContainer.addClass('breakpoint-on');

                    pushedWrap.html(pushedHtml);
                    pushItem.hide();
                } else {
                    navContainer.removeClass('breakpoint-on');

                    pushedWrap.html(pushBlank);
                    pushItem.show();
                }
            }

            breakpointCheck();
            var_window.on('resize', function() {
                breakpointCheck();
            });
        },
    };
    // Document Ready
    $(document).ready(function() {
        saas_theme.init();
    });

    //===== Sticky
    $(window).on('scroll', function(event) {
        var scroll = $(window).scrollTop();
        if (scroll < 120) {
            $(".header-navigation").removeClass("sticky");
        } else {
            $(".header-navigation").addClass("sticky");
        }
    });
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
    $('.work-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        speed: 2000,
        slidesToShow: 4,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
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
    $('.user-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 1,
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
    $('.testimonial-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        speed: 2000,
        slidesToShow: 3,
        slidesToScroll: 1,
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
    $('.sponsor-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        speed: 2000,
        slidesToShow: 4,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
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

    // subscribe functionality
    if ($(".subscribeForm").length > 0) {
        $(".subscribeForm").each(function() {
            let $this = $(this);

            $this.on('submit', function(e) {
    
                e.preventDefault();
    
                let formId = $this.attr('id');
                let fd = new FormData(document.getElementById(formId));
    
                $.ajax({
                    url: $this.attr('action'),
                    type: $this.attr('method'),
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if ((data.errors)) {
                            $this.find(".err-email").html(data.errors.email[0]);
                        } else {
                            toastr["success"]("You are subscribed successfully!");
                            $this.trigger('reset');
                            $this.find(".err-email").html('');
                        }
                    }
                });
            });
        });
    }    

    // jquery nice select js
    $('select').niceSelect();
    
    // wow min js
    new WOW().init();

    $('.offer-timer').each(function() {
        let $this = $(this);
        let d = new Date($this.data('end_date'));
        let ye = parseInt(new Intl.DateTimeFormat('en', {year: 'numeric'}).format(d));
        let mo = parseInt(new Intl.DateTimeFormat('en', {month: 'numeric'}).format(d));
        let da = parseInt(new Intl.DateTimeFormat('en', {day: '2-digit'}).format(d));
        let t = $this.data('end_time');
        let time = t.split(":");
        let hr = parseInt(time[0]);
        let min = parseInt(time[1]);
        $this.syotimer({
            year: ye,
            month: mo,
            day: da,
            hour: hr,
            minute: min,
        });
      });    

    // lazy load init
    var lazyLoadInstance = new LazyLoad();
});

//===== Prealoder

$(window).on('load', function(event) {
    if ($(".popup-wrapper").length > 0) {
        let $firstPopup = $(".popup-wrapper").eq(0);
        popupAnnouncement($firstPopup);
    }
    $('.preloader').fadeOut('500');
})
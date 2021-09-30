<!DOCTYPE html>
<html lang="en" @if($rtl == 1) dir="rtl" @endif>
<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('meta-description')">
    <meta name="keywords" content="@yield('meta-keywords')">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--====== Title ======-->
    <title>{{$bs->website_title}} @yield('pagename')</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('assets/front/img/'.$bs->favicon)}}" type="image/png">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{asset('assets/front/css/plugin.min.css')}}">
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{asset('assets/front/css/default.css')}}">
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    @if ($rtl == 1)
        <link rel="stylesheet" href="{{asset('assets/front/css/rtl-style.css')}}">
    @endif
    <!-- base color change -->
    <link href="{{asset('assets/front/css/style-base-color.php').'?color='.$bs->base_color}}" rel="stylesheet">

    @yield('styles')

    @if ($bs->is_whatsapp == 0 && $bs->is_tawkto == 0)
    <style>
        .back-to-top {
            left: auto;
            right: 30px;
        }   
    </style>
    @endif
</head>
<body>

@if ($bs->preloader_status == 1)
<!--====== Start Preloader ======-->
<div class="preloader">
    <div class="lds-ellipsis">
        <img class="lazy" data-src="{{asset('assets/front/img/' . $bs->preloader)}}" alt="">
    </div>
</div><!--====== End Preloader ======-->
@endif

@includeIf('front.partials.header')

@if (!request()->routeIs('front.index'))
    <!--====== Start Breadcrumbs-section ======-->
    <section class="breadcrumbs-section bg_cover lazy"
             data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="breadcrumbs-content text-center">
                        <h1>@yield('breadcrumb-title')</h1>
                        <ul class="breadcrumbs-link">
                            <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                            <li class="active">@yield('breadcrumb-link')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Breadcrumbs-section ======-->    
@endif

@yield('content')

{{--footer section--}}
@includeIf('front.partials.footer')

<a href="#" class="back-to-top" ><i class="fas fa-angle-up"></i></a>

@if ($be->cookie_alert_status == 1)
<div class="cookie">
    @include('cookieConsent::index')
</div>
@endif

{{-- Popups start --}}
@includeIf('front.partials.popups')
{{-- Popups end --}}

{{-- WhatsApp Chat Button --}}
<div id="WAButton"></div>

<!--====== Jquery js ======-->
<script src="{{asset('assets/front/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/front/js/vendor/jquery-3.4.1.min.js')}}"></script>
<!--====== Bootstrap js ======-->
<script src="{{asset('assets/front/js/plugin.min.js')}}"></script>

<script>
    "use strict";
    var rtl = {{$rtl}};
</script>
<!--====== Main js ======-->
<script src="{{asset('assets/front/js/main.js')}}"></script>

@yield('scripts')

@yield('vuescripts')


    @if (session()->has('success'))
    <script>
        "use strict";
        toastr['success']("{{ __(session('success')) }}");
    </script>
    @endif

    @if (session()->has('error'))
    <script>
        "use strict";
        toastr['error']("{{ __(session('error')) }}");
    </script>
    @endif

    @if (session()->has('warning'))
    <script>
        "use strict";
        toastr['warning']("{{ __(session('warning')) }}");
    </script>
    @endif
    <script>
        "use strict";
        function handleSelect(elm) {
            window.location.href = "{{route('changeLanguage', '')}}" + "/" + elm.value;
        }
    </script>

    {{-- whatsapp init code --}}
    @if ($bs->is_whatsapp == 1)
    <script type="text/javascript">
        "use strict";
        var whatsapp_popup = {{$bs->whatsapp_popup}};
        var whatsappImg = "{{asset('assets/front/img/whatsapp.svg')}}";
        $(function () {
            $('#WAButton').floatingWhatsApp({
                phone: "{{$bs->whatsapp_number}}", //WhatsApp Business phone number
                headerTitle: "{{$bs->whatsapp_header_title}}", //Popup Title
                popupMessage: `{!! nl2br($bs->whatsapp_popup_message) !!}`, //Popup Message
                showPopup: whatsapp_popup == 1 ? true : false, //Enables popup display
                buttonImage: '<img src="' + whatsappImg + '" />', //Button Image
                position: "right" //Position: left | right

            });
        });
    </script>
    @endif

    @if ($bs->is_tawkto == 1)
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            "use strict";
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='{{$bs->tawkto_property_id}}';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    @endif

</body>
</html>

<!DOCTYPE html>
<html lang="en" @if($userCurrentLang->rtl == 1) dir="rtl" @endif>
    <head>
        <!--====== Required meta tags ======-->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="@yield('meta-description')">
        <meta name="keywords" content="@yield('meta-keywords')">

        @yield('og-meta')

        <!--====== Title ======-->
        <title>{{Request::route('username')}} - @yield('tab-title')</title>

        <!--====== Favicon Icon ======-->
        <link rel="shortcut icon" href="{{!empty($userBs->favicon) ? asset('assets/front/img/user/'.$userBs->favicon) : ''}}" type="image/png">
        <!--====== Bootstrap css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/plugin.min.css')}}">
        <!--====== Default css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/default.css')}}">
        <!--====== Style css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/style.css')}}">
        @if ($userCurrentLang->rtl == 1)
        <!--====== RTL Style css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/rtl-style.css')}}">
        @endif
        @if(!empty($userBs) && $userBs->theme == 'dark')
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/dark.css')}}">
        @endif
        <!--====== Base color ======-->
        @php
            if(!empty($userBs->base_color)) {
                $baseColor = $userBs->base_color;
            } else {
                $baseColor = '';
            }
        @endphp
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/base-color.php?color=' . $baseColor)}}">
    </head>
    <body @if(!empty($userBs) && $userBs->theme == 'dark') class="dark-body" @endif>
        {{-- Start Language Dropdown --}}
        @if (!empty($userLangs))
            <form action="{{route('changeUserLanguage')}}" id="userLangForm">
                <input type="hidden" name="username" value="{{Request::route('username')}}">
                <select name="code" class="language-dropdown" onchange="document.getElementById('userLangForm').submit();">
                    @foreach ($userLangs as $userLang)
                        <option value="{{$userLang->code}}" {{$userLang->id == $userCurrentLang->id ? 'selected' : ''}}>{{$userLang->name}}</option>
                    @endforeach
                </select>
            </form>
        @endif
        {{-- End Language Dropdown --}}

        @if (!empty($userBs->preloader))
        <!--====== Start Preloader ======-->
        <div class="preloader">
            <div class="lds-ellipsis">
                <img src="{{asset('assets/front/img/user/' . $userBs->preloader)}}" alt="">
            </div>
        </div>
        <!--====== End Preloader ======-->
        @endif
        <!--====== Start nav-toggole ======-->
        <div class="nav-toggole">
            <a href="#">
            <span></span>
            <span></span>
            <span></span>
            </a>
        </div>
        <!--====== End nav-toggole ======-->
        <!--====== Start header ======-->
        <header class="vaughn-aside">
            <div class="menu-wrapper">
                <div class="brand-logo">
                    <a href="{{route('front.user.detail.view', Request::route('username'))}}" class="page_scroll">
                    <img class="lazy" data-src="{{isset($userBs->logo) ?
                        asset('assets/front/img/user/'.$userBs->logo)
                        :asset('assets/front/img/profile/lgoo.png')}}"
                        alt="">
                    </a>
                </div>
                <nav class="primary-menu">
                    <ul class="main-menu">
                        <li class="@if(request()->routeIs('front.user.detail.view')) active @endif">
                            <a href="{{route('front.user.detail.view', Request::route('username'))}}" class="page_scroll"><span class="icon"><i class="fal fa-home"></i></span><span
                            class="text">{{$keywords["Home"] ?? "Home"}}</span></a>
                        </li>
                        @if(in_array('Service',$userPermissions) && in_array('Service',$packagePermissions))
                        <li class="@if(request()->routeIs('front.user.services') || request()->routeIs('front.user.service.detail')) active @endif">
                            <a href="{{route('front.user.services', Request::route('username'))}}"><span class="icon"><i class="far fa-pencil-ruler"></i></span><span
                            class="text">{{$keywords["Services"] ?? "Services"}}</span></a>
                        </li>
                        @endif

                        @if(in_array('Portfolio',$userPermissions) && in_array('Portfolio',$packagePermissions))
                        <li class="@if(request()->routeIs('front.user.portfolios') || request()->routeIs('front.user.portfolio.detail')) active @endif">
                            <a href="{{route('front.user.portfolios', Request::route('username'))}}"><span class="icon"><i class="fal fa-boxes-alt"></i></span><span
                            class="text">{{$keywords["Portfolios"] ?? "Portfolios"}}</span></a>
                        </li>
                        @endif
                        @if(in_array('Blog',$userPermissions) && in_array('Blog',$packagePermissions))
                        <li class="@if(request()->routeIs('front.user.blogs') || request()->routeIs('front.user.blog.detail')) active @endif">
                            <a href="{{route('front.user.blogs', Request::route('username'))}}" class="page_scroll"><span class="icon"><i class="fal fa-blog"></i></span><span
                            class="text">{{$keywords["Blogs"] ?? "Blogs"}}</span></a>
                        </li>
                        @endif
                        @if(in_array('Contact',$userPermissions))
                        <li>
                            <a
                            @if (request()->routeIs('front.user.detail.view'))
                                href="#contact"
                            @else
                                href="{{route('front.user.detail.view', Request::route('username'))}}#contact"
                            @endif
                            @if (request()->routeIs('front.user.detail.view')) class="page_scroll" @endif><span class="icon"><i class="fal fa-envelope"></i></span><span
                            class="text">{{$keywords["Contact"] ?? "Contact"}}</span></a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </header>
        <!--====== End header ======-->


        @if (!request()->routeIs('front.user.detail.view'))
        <section class="breadcrumbs-area mb-60">
            <div class="container">
                <div class="breadcrumbs-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="page-title">
                                <h1>@yield('br-title')</h1>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bredcumbs-link">
                                <ul>
                                    <li><a href="{{route('front.user.detail.view', Request::route('username'))}}">{{$keywords["Home"] ?? "Home"}}</a></li>
                                    <li class="active">@yield('br-link')</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        @yield('content')


        <!--====== Start Vaughn-footer section ======-->
        <footer class="vaughn-footer pt-80 pb-80">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="footer-content text-center">
                            <h4>{{$keywords["Stay_Connected"] ?? "Stay Connected"}}</h4>
                            <h3><a href="mailto:yourmail@gmail.com">{{$user->email}}</a></h3>
                            <ul class="social-link">
                                @if(isset($social_medias))
                                @foreach($social_medias as $social_media)
                                <li><a href="{{$social_media->url}}" class="facebook"
                                    target="_blank"><i
                                        class="{{$social_media->icon}}"></i></a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--====== End Vaughn-footer section ======-->

        <!--====== back-to-top ======-->
        <a href="#" class="back-to-top"><i class="fas fa-angle-up"></i></a>


        <!--====== Jquery js ======-->
        <script src="{{asset('assets/front/js/vendor/modernizr-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/front/js/vendor/jquery-3.4.1.min.js')}}"></script>
        <!--====== plugin js ======-->
        <script src="{{asset('assets/front/js/plugin.min.js')}}"></script>
        <script>
            "use strict";
            var rtl = {{$userCurrentLang->rtl}};
        </script>
        <!--====== Main js ======-->
        <script src="{{asset('assets/front/js/profile/main.js')}}"></script>
        @if (session()->has('success'))
        <script>
            "use strict";
            toastr['success']("{{ __(session('success')) }}");
        </script>
        @endif
        @yield('scripts')
    </body>
</html>

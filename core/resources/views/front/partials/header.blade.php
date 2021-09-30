<!--====== Start Header ======-->
<header class="header-area header-area-v1">
    <div class="header-navigation">
        <div class="nav-container d-flex align-items-center justify-content-between">
            <!-- site logo -->
            <div class="brand_logo">
                <a href="{{route('front.index')}}"><img src="{{asset('assets/front/img/'.$bs->logo)}}" class="img-fluid" alt=""></a>
            </div>
            <div class="nav-menu">
                <!-- Navbar Close Icon -->
                <div class="navbar-close">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <div class="mobile-logo">
                    <a href="#"><img src="{{asset('assets/front/img/'.$bs->logo)}}" class="img-fluid" alt=""></a>
                </div>
                <!-- nav-menu -->
                <nav class="main-menu">
                    <ul>
                        @php
                            $links = json_decode($menus, true);
                        @endphp
                        @foreach ($links as $link)
                            @php
                                $href = getHref($link);
                            @endphp
                            @if (!array_key_exists("children",$link))
                                <li class="menu-item"><a href="{{$href}}" target="{{$link["target"]}}">{{$link["text"]}}</a></li>
                            @else
                                <li class="menu-item menu-item-has-children">
                                    <a href="{{$href}}" target="{{$link["target"]}}">{{$link["text"]}}</a>
                                    <ul class="sub-menu">
                                        @foreach ($link["children"] as $level2)
                                            @php
                                                $l2Href = getHref($level2);
                                            @endphp
                                            <li><a href="{{$l2Href}}" target="{{$level2["target"]}}">{{$level2["text"]}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                        @guest
                            <li class="menu-item d-xl-none d-block"><a href="{{route('user.login')}}">{{__('Login')}}</a></li>
                        @endguest
                        @auth
                            <li class="menu-item d-xl-none d-block"><a href="{{route('user-dashboard')}}">{{__('Dashboard')}}</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>

            <div class="nav-push-item-container">
                <!-- nav push item -->
                <div class="nav-push-item d-none d-xl-block">
                    @guest
                        <div class="navbar-btn">
                            <a href="{{route('user.login')}}" class="main-btn"><i class="fal fa-sign-in-alt"></i>{{__('Login')}}</a>
                        </div>
                    @endguest
                    @auth
                        <div class="navbar-btn">
                            <a href="{{route('user-dashboard')}}" class="main-btn"><i class="far fa-user"></i>{{__('Dashboard')}}</a>
                        </div>
                    @endauth
                </div>
                <div class="nav-push-item language">
                    <div class="navbar-btn">
                        @if(!empty($currentLang))
                            <select onchange="handleSelect(this)">
                                @foreach($langs as $key =>$lang)
                                    <option
                                        value="{{$lang->code}}" {{$currentLang->code === $lang->code ?"selected":""}}>{{$lang->name}}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
    
                <!-- Navbar Toggler -->
                <div class="navbar-toggler">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>
    </div>
</header><!--====== End Header ======-->

@extends('front.layout')

@section('pagename')
    - {{__('Home')}}
@endsection

@section('meta-description', !empty($seo) ? $seo->home_meta_description : '')
@section('meta-keywords', !empty($seo) ? $seo->home_meta_keywords : '')

@section('content')
    <!--====== Start Saas-banner section ======-->
    <section class="saas-banner">
        <div class="shape">
            <img data-src="{{asset('assets/front/img/shape-1.png')}}" class="img-fluid img-1 lazy" alt="">
            <img data-src="{{asset('assets/front/img/shape-2.png')}}" class="img-fluid img-2 lazy" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <span class="span">
                            {{$be->hero_section_title}}
                        </span>
                        <h1>{{$be->hero_section_text}}</h1>
                        <ul>

                            @if(!empty($be->hero_section_button_url))
                                <li>
                                    <a href="{{$be->hero_section_button_url}}" class="main-btn">{{$be->hero_section_button_text}}
                                        <i class="fal fa-long-arrow-alt-right"></i>
                                    </a>
                                </li>
                            @endif
                            @if(!empty($be->hero_section_video_url))
                                <li>
                                    <a href="{{$be->hero_section_video_url}}" class="video-popup"><i class="fas fa-play"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img">
                        <img data-src="{{asset('assets/front/img/'.$be->hero_img)}}" class="img-fluid lazy" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Saas-banner section ======-->

    @if ($bs->intro_section == 1)
    <!--====== Start saas-analysis section ======-->
    <section class="saas-analysis pt-120 pb-80">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="choose-img mb-40">
                        <img data-src="{{asset('assets/front/img/'.$bs->intro_main_image)}}" class="img-fluid lazy" alt="">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="choose-content-box mb-40">
                        <div class="section-title-one section-title-two mb-20">
                            <span class="span">{{$bs->intro_title}}</span>
                            <h2>{{$bs->intro_subtitle}}</h2>
                        </div>
                        <p>{!! nl2br($bs->intro_text) !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End saas-analysis section ======-->
    @endif


    @if ($bs->feature_section == 1)
    <!--====== Start saas-features section ======-->
    <section class="saas-features pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title-one section-title-two">
                        @if (!empty($bs->feature_title))
                        <span class="span">{{$bs->feature_title}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($features as $feature)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="features-item mb-40">
                            <i class="{{$feature->icon}}"></i>
                            <h4>{{$feature->title}}</h4>
                            <p>{{ $feature->text }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!--====== End saas-features section ======-->
    @endif

    @if ($bs->process_section == 1)
    <!--====== Start saas-project section ======-->
    <section class="saas-project">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title-one text-center mb-55">
                        @if (!empty($bs->work_process_title))
                        <span class="span">{{$bs->work_process_title}}</span>
                        @endif
                        @if (!empty($bs->work_process_subtitle))
                        <h2>{{$bs->work_process_subtitle}}</h2>
                        @endif
                    </div>
                </div>
            </div>
            <div class="work-slide">
                @foreach($processes as $key => $process)
                    <div class="work-item">
                        <div class="work-img">
                            <img data-src="{{asset('assets/front/img/process/'.$process->image)}}" class="img-fluid lazy" alt="">
                            <a href="#" class="count">{{$key < 9 ? "0".++$key : ++$key }}</a>
                        </div>
                        <div class="work-info">
                            <h5>{{$process->title}}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!--====== End saas-project section ======-->
    @endif

    @if ($bs->featured_users_section == 1) 
    <!--====== Start saas-featured-users section ======-->
    <section class="saas-featured-users pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title-one section-title-two mb-50">
                        @if (!empty($bs->featured_users_title))
                        <span class="span">{{$bs->featured_users_title}}</span>
                        @endif
                        @if (!empty($bs->featured_users_subtitle))
                        <h2>{{$bs->featured_users_subtitle}}</h2>
                        @endif
                    </div>
                </div>
            </div>
            <div class="user-slide">
                @foreach($featured_users as $featured_user)
                    <div class="user-item">
                        <div class="title">
                            <img class="lazy" data-src="{{ isset($featured_user->photo) ? asset('assets/front/img/user/'.$featured_user->photo) : asset('assets/admin/img/propics/blank_user.jpg')}}" alt="user">
                            <h5>{{$featured_user->first_name." ".$featured_user->last_name}}</h5>
                            <span>{{$featured_user->username}}</span>
                        </div>
                        <div class="user-button">
                            <ul>
                                <li><a href="{{route('front.user.detail.view',['username' => $featured_user->username])}}"
                                       class="main-btn"><i class="fas fa-eye"></i>{{__('View Profile')}}</a></li>
                                @guest
                                    <li>
                                        <a href="{{route('user.follow',['id' => $featured_user->id])}}" class="main-btn"><i class="fal fa-user-plus"></i>{{__('Follow')}}
                                        </a>
                                    </li>
                                @endguest
                                @if(Auth::check() && Auth::id() != $featured_user->id)
                                    <li>
                                        @if (App\Models\User\Follower::where('follower_id', Auth::id())->where('following_id', $featured_user->id)->count() > 0)
                                            <a href="{{route('user.unfollow', $featured_user->id)}}" class="main-btn"><i class="fal fa-user-minus"></i>{{__('Unfollow')}}
                                        </a>
                                        @else
                                           <a href="{{route('user.follow',['id' => $featured_user->id])}}" class="main-btn"><i class="fal fa-user-plus"></i>{{__('Follow')}}
                                        @endif
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="social-box">
                            <ul class="social-link">
                                @foreach($featured_user->social_media as $social)
                                    <li><a href="{{$social->url}}" class="facebook" target="_blank"><i
                                                class="{{$social->icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!--====== End saas-featured-users section ======-->
    @endif

    @if ($bs->pricing_section == 1)
    <!--====== Start saas-pricing section ======-->
    <section class="saas-pricing pt-110 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title-one text-center mb-50">
                        @if (!empty($bs->pricing_title))
                        <span class="span">{{$bs->pricing_title}}</span>
                        @endif
                        @if (!empty($bs->pricing_subtitle))
                        <h2>{{$bs->pricing_subtitle}}</h2>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="pricing-tabs text-center">
                        <ul class="nav nav-tabs">
                            <li class="nav-item mr-1">
                                <a class="nav-link active" data-toggle="tab" href="#monthly">{{__('Monthly')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#yearly">{{__('Yearly')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="pricing-wrapper tab-content">
                <div id="monthly" class="tab-pane active">
                    <div class="row no-gutters ">
                        @foreach($packages as $package)
                            @php
                                $allFeatures = ['Follow/Unfollow', 'Blog', 'Portfolio', 'Skill', 'Achievements', 'Service', 'Experience', 'Testimonial'];
                                $pFeatures = json_decode($package->features);
                            @endphp
                            @if($package->term === "monthly")
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="pricing-item">
                                        <div class="title">
                                            <h3>{{$package->title}}</h3>
                                            <h2 class="price">
                                                @if($package->price != 0)
                                                    {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}
                                                @endif
                                                {{$package->price == 0 ? "Free" : $package->price}}
                                                <span class="sign">
                                                    @if($package->price != 0)
                                                    {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                    @endif
                                                </span>
                                                <span class="month">/ {{$package->term}}</span>
                                            </h2>
                                        </div>
                                        <div class="pricing-body">
                                            <ul class="list">
                                                @foreach ($allFeatures as $feature)
                                                    <li class="{{is_array($pFeatures) && in_array($feature, $pFeatures) ? 'checked' : 'unchecked'}}">{{$feature}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="pricing-button">
                                            @if($package->is_trial === "1" && $package->price != 0)
                                                <a href="{{route('front.register.view',['status' => 'trial','id'=> $package->id])}}"
                                                   class="main-btn">{{__('Trial')}}</a>
                                            @endif
                                            <a href="{{route('front.register.view',['status' => 'regular','id'=> $package->id])}}"
                                               class="main-btn">{{__('Purchase')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="yearly" class="tab-pane fade">
                    <div class="row no-gutters ">
                        @foreach($packages as $package)
                            @php
                                $allFeatures = ['Follow/Unfollow', 'Blog', 'Portfolio', 'Skill', 'Achievements', 'Service', 'Experience', 'Testimonial'];
                                $pFeatures = json_decode($package->features);
                            @endphp
                            @if($package->term === "yearly")
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="pricing-item">
                                        <div class="title">
                                            <h3>{{$package->title}}</h3>
                                            <h2 class="price">
                                                <span class="sign">
                                                    @if($package->price != 0)
                                                        {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}
                                                    @endif
                                                </span>
                                                {{$package->price == 0 ? "Free" : $package->price}}
                                                <span class="sign">
                                                     @if($package->price != 0)
                                                        {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                    @endif
                                                </span>
                                                <span class="month">/ {{$package->term}}</span>
                                            </h2>
                                        </div>
                                        <div class="pricing-body">
                                            <ul class="list">
                                                @foreach ($allFeatures as $feature)
                                                    <li class="{{is_array($pFeatures) && in_array($feature, $pFeatures) ? 'checked' : 'unchecked'}}">{{$feature}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="pricing-button">
                                            @if($package->is_trial === "1" && $package->price != 0)
                                                <a href="{{route('front.register.view',['status' => 'trial','id'=> $package->id])}}"
                                                   class="main-btn">{{__('Trial')}}</a>
                                            @endif
                                            <a href="{{route('front.register.view',['status' => 'regular','id'=> $package->id])}}"
                                               class="main-btn">{{__('Purchase')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End saas-pricing section ======-->
    @endif

    @if ($bs->testimonial_section == 1)
    <!--====== Start saas-testimonial section ======-->
    <section class="saas-testimonial pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title-one section-title-two mb-50">
                        @if (!empty($bs->testimonial_title))
                        <span class="span">{{$bs->testimonial_title}}</span>
                        @endif
                        @if (!empty($bs->testimonial_subtitle))
                        <h2>{{$bs->testimonial_subtitle}}</h2>
                        @endif
                    </div>
                </div>
            </div>
            <div class="testimonial-slide">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-item">
                        <div class="thumb">
                            <img class="lazy"
                                data-src="{{$testimonial->image ? asset('assets/front/img/testimonials/'. $testimonial->image) : asset('assets/front/img/thumb-1.jpg')}}"
                                alt="">
                        </div>
                        <div class="content">
                            <p>{{$testimonial->comment}}</p>
                            <h5>{{$testimonial->name}}</h5>
                            <small>{{$testimonial->rank}}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!--====== End saas-testimonial section ======-->
    @endif

    @if ($bs->news_section == 1)
    <!--====== Start saas-blog section ======-->
    <section class="saas-blog pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title-one text-center mb-50">
                        @if (!empty($bs->blog_title))
                        <span class="span">{{$bs->blog_title}}</span>
                        @endif
                        @if (!empty($bs->blog_subtitle))
                        <h2>{{$bs->blog_subtitle}}</h2>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-lg-6">
                        <div class="blog-item mb-40">
                            <div class="entry-content">
                                <div class="entry-meta">
                                    <ul>
                                        <li><span><i class="fas fa-user"></i><a
                                                    href="{{route('front.blogs', ['category'=>$blog->bcategory->id])}}">{{$blog->bcategory->name}}</a></span></li>
                                        <li>
                                        <span>
                                            <i class="fas fa-calendar-alt"></i>
                                            <a href="#">{{\Carbon\Carbon::parse($blog->created_at)->format("F j, Y")}}</a>
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title"><a href="{{route('front.blogdetails',['id' => $blog->id,'slug' => $blog->slug])}}">{{$blog->title}}</a></h3>
                                <a href="{{route('front.blogdetails',['id' => $blog->id,'slug' => $blog->slug])}}" class="read-btn">{{__('Read More')}}</a>
                            </div>
                            <a class="post-img d-block" href="{{route('front.blogdetails',['id' => $blog->id,'slug' => $blog->slug])}}">
                                <img data-src="{{asset('assets/front/img/blogs/'.$blog->main_image)}}" class="img-fluid lazy"
                                     alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!--====== End saas-blog section ======-->
    @endif

    @if ($bs->partners_section == 1)
    <!--====== Start saas-sponsor section ======-->
    <section class="saas-sponsor">
        <div class="container">
            <div class="row sponsor-slide">
                @foreach($partners as $partner)
                    <div class="col-lg-3 sponsor-item">
                        <a href="{{$partner->url}}" target="_blank">
                            <img data-src="{{asset('assets/front/img/partners/'.$partner->image)}}" class="img-fluid lazy" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!--====== End saas-sponsor section ======-->
    @endif
@endsection

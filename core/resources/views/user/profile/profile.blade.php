@extends('user.profile.layout')

@section('tab-title')
{{$keywords["Home"] ?? "Home"}}
@endsection

@section('meta-description', !empty($userSeo) ? $userSeo->home_meta_description : '')
@section('meta-keywords', !empty($userSeo) ? $userSeo->home_meta_keywords : '')


@section('content')
    @php
    $user = App\Models\User::where('username', Request::route('username'))->firstOrFail();
    $currentPackage = App\Http\Helpers\UserPermissionHelper::userPackage($user->id);
    $preferences = App\Models\User\UserPermission::where([
        ['user_id',$user->id],
        ['package_id',$currentPackage->package_id]
    ])->first();
    $permissions = isset($preferences) ? json_decode($preferences->permissions, true) : [];
    @endphp
    <!--====== Start Hero-section ======-->
    <section class="hero-section bg_cover" id="home">
        <div class="shape-img">
            <img data-src="{{asset('assets/front/img/profile/shape/shape-1.png')}}" alt="" class="img-1 lazy">
            <img data-src="{{asset('assets/front/img/profile/shape/shape-2.png')}}" alt="" class="img-2 lazy">
            <img data-src="{{asset('assets/front/img/profile/shape/shape-3.png')}}" alt="" class="img-3 lazy">
            <img data-src="{{asset('assets/front/img/profile/shape/shape-4.png')}}" alt="" class="img-4 lazy">
            <img data-src="{{asset('assets/front/img/profile/shape/shape-5.png')}}" alt="" class="img-5 lazy">
        </div>
        <div class="hero-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="hero-content text-center">
                            @if(isset($home_text->hero_image))
                            <img data-src="{{asset('assets/front/img/user/home_settings/'.$home_text->hero_image)}}" class="img-fluid lazy" alt="">
                            @else
                            <img data-src="{{asset('assets/admin/img/propics/blank_user.jpg')}}" alt="..."
                                class="avatar-img rounded-circle lazy">
                            @endif
                            <h1>{{$home_text->first_name ?? $user->first_name}} {{$home_text->last_name ?? $user->last_name}}</h1>
                            @if (!empty($home_text->designation))
                            <h4><span id="typed"></span></h4>
                            <div class="type-string">
                                @php
                                $designations = explode(",",$home_text->designation);
                                @endphp
                                @foreach($designations as $designation)
                                <p> {{$designation}}</p>
                                @endforeach
                            </div>
                            @endif
                            <ul class="social-link">
                                @if(isset($social_medias))
                                @foreach($social_medias as $social_media)
                                <li>
                                    <a href="{{$social_media->url}}" class="facebook"
                                    target="_blank"><i
                                        class="{{$social_media->icon}}"></i></a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                            @if(in_array('Contact',$userPermissions))
                            <a href="#contact" class="main-btn page_scroll">{{$keywords["Hire_me"] ?? 'Hire me'}}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Hero-section ======-->
    <!--====== Start Vaughn-About section ======-->
    <section class="vaughn-about pt-140" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img
                            data-src="{{isset($home_text->about_image) ? asset('assets/front/img/user/home_settings/'.$home_text->about_image) : asset('assets/front/img/profile/about.png')}}"
                            class="img-fluid lazy" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title mb-15">
                        <span
                            class="span">{{$home_text->about_title ?? 'My Resume'}}</span>
                        <h2>{{$home_text->about_subtitle ?? 'About Me'}}</h2>
                    </div>
                    <div class="about-content-box">
                        <p>{!! nl2br($home_text->about_content ?? "") !!}</p>
                        @if(isset($userBs->cv))
                        <a href="{{asset('assets/front/img/user/cv/'.$userBs->cv)}}" class="main-btn" download="{{Request::route('username')}}.pdf"
                            target="_blank">
                        {{$keywords["Download_CV"] ?? "Download CV"}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Vaughn-About section ======-->
    <!--====== Start Vaughn-Skills section ======-->
    @if(in_array('Skill',$permissions))
    <section class="vaughn-skills pt-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title mb-25">
                        <span
                            class="span">{{$home_text->skills_title ?? __('Skills')}}</span>
                        <h2>{{$home_text->skills_subtitle ?? __('Technical Skills')}}</h2>
                    </div>
                    <div class="skills-content-box">
                        <p>{!! nl2br($home_text->skills_content ?? "") !!}</p>
                        @foreach($skills as $skill)
                        <div class="single-bar mb-20">
                            <div class="progress-title">
                                <h5>{{$skill->title}}</h5>
                            </div>
                            <div class="progress progress-one">
                                <div class="progress-bar wow slideInLeft"
                                    style="width: {{$skill->percentage}}%; background-color: #{{$skill->color}};"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="skills-img">
                        <img
                            data-src="{{isset($home_text->skills_image) ? asset('assets/front/img/user/home_settings/'.$home_text->skills_image) : asset('assets/front/img/profile/skill.png')}}"
                            class="img-fluid lazy" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Vaughn-Skills section ======-->
    @endif
    @if(in_array('Service',$permissions))
    <!--====== Start Vaughn-Features section ======-->
    <section class="vaughn-features pt-150" id="service">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mb-30">
                        <span
                            class="span">{{$home_text->service_title ?? __('Services')}}</span>
                        <h2>{{$home_text->service_subtitle ?? __('What I Do ?')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="features-box mb-50">
                        <a class="features-img" @if($service->detail_page == 1) href="{{route('front.user.service.detail',['username' => Request::route('username'),'slug' => $service->slug,'id' => $service->id])}}" @endif>
                            <img
                                data-src="{{isset($service->image) ? asset('assets/front/img/user/services/'.$service->image) : asset('assets/front/img/profile/service-1.jpg')}}"
                                class="img-fluid lazy" alt="">
                        </a>
                        <div class="features-content">
                            @if($service->detail_page == 1)
                            <h4 class="title"><a
                                href="{{route('front.user.service.detail',['username' => Request::route('username'),'slug' => $service->slug,'id' => $service->id])}}">{{$service->name}}</a>
                            </h4>
                            @else
                            <h4>{{$service->name}}</h4>
                            @endif
                            <img src="{{asset('assets/front/img/profile/icon-1.png')}}" class="icon" alt="">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--====== End Vaughn-Features section ======-->
    @endif
    @if(in_array('Experience',$permissions))
    <!--====== Start Vaughn-Eexperience section ======-->
    <section class="vaughn-experience pt-100 pb-100" id="experience">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title mb-30">
                        <span
                            class="span">{{$home_text->experience_title ?? __('Experience')}}</span>
                        <h2>{{$home_text->experience_subtitle ?? __('Experience')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (count($educations) > 0)
                    <div class="col-lg-6">
                        <div class="box experience-box mb-50">
                            <div class="title mb-25">
                                <i class="fas fa-user-graduate icon"></i>
                                <h4>{{$keywords["Education"] ?? "Education"}}</h4>
                            </div>
                            <ul class="list">
                                @foreach($educations as $education)
                                <li>
                                    <i class="fas fa-check"></i>
                                    <h6>{{$education->degree_name}}</h6>
                                    @if (!empty($education->start_date))

                                    <small class="duration">
                                        {{\Carbon\Carbon::parse($education->start_date)->format('M j, Y')}}
                                        -
                                        @if (!empty($education->end_date))
                                            {{ \Carbon\Carbon::parse($education->end_date)->format('M j, Y') }}
                                        @else
                                            Present
                                        @endif

                                    </small>
                                    @endif
                                    <p>{!! nl2br($education->short_description) !!}</p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if (count($job_experiences) > 0)
                    <div class="col-lg-6">
                        <div class="box job-box mb-50">
                            <div class="title mb-25">
                                <i class="fas fa-business-time icon"></i>
                                <h4>{{$keywords["Job"] ?? "Job"}}</h4>
                            </div>
                            <ul class="list">
                                @foreach($job_experiences as $job_experience)
                                <li>
                                    <i class="fas fa-check"></i>
                                    <h6>{{$job_experience->designation}}</h6>
                                    <small class="duration">{{\Carbon\Carbon::parse($job_experience->start_date)->format('M j, Y')}} - {{ $job_experience->is_continue == 0 ? \Carbon\Carbon::parse($job_experience->end_date)->format('M j, Y') : "Present"}}</small>
                                    <p>{!! nl2br($job_experience->content) !!}</p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--====== End Vaughn-Eexperience section ======-->
    @endif

    @if(in_array('Achievements',$permissions))
    <!--====== Start Vaughn-Achievements section ======-->
    <section class="vaughn-achievements">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title mb-40">
                        <span
                            class="span">{{$home_text->achievement_title ??__('Achievements')}}</span>
                        <h2>{{$home_text->achievement_subtitle ?? __('Achievements')}}</h2>
                    </div>
                </div>
            </div>
            <div class="achievements-wrapper bg_cover lazy"
                data-bg="{{!empty($home_text->achievement_image) ? asset('assets/front/img/user/home_settings/' . $home_text->achievement_image) : asset('assets/front/img/achievement_bg.jpg')}}">
                <div class="row">
                    @foreach ($achievements as $achievement)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="box">
                            <h2><span class="counter">{{$achievement->count}}</span><span class="plus">+</span></h2>
                            <h5>{{$achievement->title}}</h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--====== End Vaughn-Achievements section ======-->
    @endif

    @if(in_array('Portfolio',$permissions))
    <!--====== Start Vaughn-Work section ======-->
    <section class="vaughn-work pt-150 pb-120" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mb-35">
                        <span
                            class="span">{{$home_text->portfolio_title ?? __('Portfolios')}}</span>
                        <h2>{{$home_text->portfolio_subtitle ??  __('Portfolios')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="work-filter mb-45">
                        <button class="work-btn active-btn" data-filter="*">{{$keywords["All"] ?? "All"}}</button>
                        @foreach($portfolio_categories as $portfolio_category)
                        <button class="work-btn"
                            data-filter=".cat-{{$portfolio_category->id}}">{{$portfolio_category->name}}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="filter-grid row">
                @foreach($portfolios as $portfolio)
                <div
                    class="col-lg-4 col-md-6 col-sm-12 grid-column cat-{{$portfolio->bcategory->id}}">
                    <div class="work-item mb-30">
                        <div class="work-img">
                            <a href="{{route('front.user.portfolio.detail', [Request::route('username'), $portfolio->slug, $portfolio->id])}}"><img
                                src="{{asset('assets/front/img/user/portfolios/'.$portfolio->image)}}"
                                class="img-fluid" alt=""></a>
                        </div>
                        <h3><a href="{{route('front.user.portfolio.detail', [Request::route('username'), $portfolio->slug, $portfolio->id])}}">{{strlen($portfolio->title) > 25 ? mb_substr($portfolio->title, 0, 25, 'UTF-8') . '...' : $portfolio->title}}</a></h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
    <!--====== End Vaughn-Work section ======-->
    @endif
    <!--====== Start Vaughn-Pricing section ======-->
    @if(in_array('Testimonial',$permissions))
    <!--====== Start Vaughn-Testimonial section ======-->
    <section class="vaughn-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mb-30">
                        <span
                            class="span">{{$home_text->testimonial_title ?? __('Testimonials')}}</span>
                        <h2>{{$home_text->testimonial_subtitle ?? __('Testimonials')}}</h2>
                    </div>
                </div>
            </div>
            <div class="testimonial-slide">
                @foreach($testimonials as $testimonial)
                <div class="testimonial-item">
                    <div class="testimonial-thumb-title">
                        <div class="thumb">
                            <img src="{{asset('assets/front/img/user/testimonials/'.$testimonial->image)}}"
                                class="img-fluid" alt="">
                        </div>
                        <div class="title">
                            <h5>{{$testimonial->name}}</h5>
                            @if (!empty($testimonial->occupation))
                            <p>{{$testimonial->occupation}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <p>{!! nl2br($testimonial->content) !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--====== End Vaughn-Testimonial section ======-->
    @endif
    @if(in_array('Blog',$permissions))
    <!--====== Start Vaughn-Blog section ======-->
    <section class="vaughn-blog pt-145" id="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mb-35">
                        <span
                            class="span">{{$home_text->blog_title ?? __('Blogs')}}</span>
                        <h2>{{$home_text->blog_subtitle ?? "Blogs"}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="blog-item mb-50">
                        <div class="post-img">
                            <a href="{{route('front.user.blog.detail', [Request::route('username'), $blog->slug, $blog->id])}}"><img data-src="{{asset('assets/front/img/user/blogs/'.$blog->image)}}"
                                class="img-fluid lazy" alt=""></a>
                        </div>
                        <div class="entry-content">
                            <div class="entry-meta">
                                <ul>
                                    <li><span><i class="fas fa-user"></i>{{$keywords['by'] ?? "by"}} <a
                                        href="#">{{$user->username}}</a></span></li>
                                    <li><span><i class="fas fa-calendar"></i><a
                                        href="#">{{\Carbon\Carbon::parse($blog->created_at)->format('F j, Y')}}</a></span>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="title"><a href="{{route('front.user.blog.detail', [Request::route('username'), $blog->slug, $blog->id])}}">{{$blog->title}}</a></h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--====== End Vaughn-Blog section ======-->
    @endif
    @if(in_array('Contact',$permissions))
    <!--====== Start Vaughn-Contact section ======-->
    <section class="vaughn-contact pt-100 pb-150" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title mb-45">
                        <span
                            class="span">{{$home_text->contact_title ??  __('Get in touch')}}</span>
                        <h2>{{$home_text->contact_subtitle ?? __('Get in touch')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-wrapper">
                        <form class="contact-form" action="{{route('front.contact.message')}}"
                            enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form_control" placeholder="{{$keywords["Name"] ?? "Name"}}" name="fullname">
                                        @if ($errors->has('fullname'))
                                            <p class="text-danger mb-0">{{$errors->first('fullname')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="email" class="form_control" placeholder="{{$keywords["Email_Address"] ?? "Email Address"}}"
                                            name="email" required>
                                        @if ($errors->has('email'))
                                            <p class="text-danger mb-0">{{$errors->first('email')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form_control" placeholder="{{$keywords["Subject"] ?? "Subject"}}" name="subject"
                                            required>
                                        @if ($errors->has('subject'))
                                            <p class="text-danger mb-0">{{$errors->first('subject')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form_control" placeholder="{{$keywords["Message"] ?? "Message"}}" name="message"
                                            required></textarea>
                                        @if ($errors->has('message'))
                                            <p class="text-danger mb-0">{{$errors->first('message')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        <button class="main-btn"
                                            type="submit">{{$keywords["Send_Message"] ?? "Send Message"}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Vaughn-Contact section ======-->
    @endif
@endsection

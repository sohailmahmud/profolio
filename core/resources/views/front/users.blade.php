@extends('front.layout')

@section('pagename')
    - {{__('Profiles')}}
@endsection

@section('meta-description', !empty($seo) ? $seo->profiles_meta_description : '')
@section('meta-keywords', !empty($seo) ? $seo->profiles_meta_keywords : '')

@section('breadcrumb-title')
    {{__('All Profiles')}}
@endsection
@section('breadcrumb-link')
    {{__('Profiles')}}
@endsection

@section('content')

    <!--====== Start saas-featured-users section ======-->
    <section class="saas-featured-users pt-120 pb-80">
        <div class="container">
            <div class="search-filter mb-30">
                <form action="{{route('front.user.view')}}">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="search-box">
                                <input type="text" class="form_control" placeholder="{{__('Search by first name, last name, username')}}" name="search" value="{{request()->input('search')}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="search-box">
                                <input type="text" class="form_control" placeholder="{{__('Search by designation')}}" name="designation" value="{{request()->input('designation')}}">
                            </div>
                        </div>
                        <input type="submit" class="d-none">
                    </div>
                </form>
            </div>
            <div class="row">
                @foreach($users as $user)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="user-item mb-40">
                            <div class="title">
                                @if(isset($user->photo))
                                    <img class="lazy" data-src="{{asset('assets/front/img/user/'.$user->photo)}}" alt="">
                                @else
                                    <img data-src="{{asset('assets/admin/img/propics/blank_user.jpg')}}" alt="..."
                                         class="avatar-img rounded-circle lazy">
                                @endif
                                <h5>{{$user->first_name." ".$user->last_name}}</h5>
                                <span>{{$user->username}}</span>
                            </div>
                            <div class="user-button">
                                <ul>
                                    <li><a href="{{route('front.user.detail.view',['username' => $user->username])}}"
                                           class="main-btn"><i class="fas fa-eye"></i>{{__('View Profile')}}</a></li>
                                    @guest
                                        <li>
                                            <a href="{{route('user.follow',['id' => $user->id])}}" class="main-btn"><i class="fal fa-user-plus"></i>{{__('Follow')}}
                                            </a>
                                        </li>
                                    @endguest
                                    @if(Auth::check() && Auth::id() != $user->id)
                                        <li>
                                            @if (App\Models\User\Follower::where('follower_id', Auth::id())->where('following_id', $user->id)->count() > 0)
                                                <a href="{{route('user.unfollow', $user->id)}}" class="main-btn"><i class="fal fa-user-minus"></i>{{__('Unfollow')}}
                                            </a>
                                            @else
                                               <a href="{{route('user.follow',['id' => $user->id])}}" class="main-btn"><i class="fal fa-user-plus"></i>{{__('Follow')}}
                                            @endif
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="social-box">
                                <ul class="social-link">
                                    @foreach($user->social_media as $social)
                                        <li><a href="{{$social->url}}" class="facebook"
                                               target="_blank"><i class="{{$social->icon}}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="saas-pagination text-center d-flex justify-content-center">
                        {{$users->appends(['search' => request()->input('search'), 'designation' => request()->input('designation')])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End saas-featured-users section ======-->
@endsection

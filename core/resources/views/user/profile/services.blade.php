@extends('user.profile.layout')

@section('tab-title')
{{$keywords["Services"] ?? "Services"}}
@endsection

@section('meta-description', !empty($userSeo) ? $userSeo->services_meta_description : '')
@section('meta-keywords', !empty($userSeo) ? $userSeo->services_meta_keywords : '')

@section('br-title')
{{$keywords["Services"] ?? "Services"}}
@endsection
@section('br-link')
{{$keywords["Services"] ?? "Services"}}
@endsection

@section('content')
    <!--====== Start Vaughn-Features section ======-->
    <section class="vaughn-features pt-60 pb-80" id="service">
        <div class="container">

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

@endsection

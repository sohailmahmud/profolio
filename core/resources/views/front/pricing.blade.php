@extends('front.layout')

@section('pagename')
    - {{__('Pricing')}}
@endsection

@section('meta-description', !empty($seo) ? $seo->pricing_meta_description : '')
@section('meta-keywords', !empty($seo) ? $seo->pricing_meta_keywords : '')

@section('breadcrumb-title')
    {{__('Pricing')}}
@endsection
@section('breadcrumb-link')
    {{__('Pricing')}}
@endsection

@section('content')

    <!--====== Start saas-pricing section ======-->
    <section class="saas-pricing pricing-page pt-110 pb-120">
        <div class="container">
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
                                                    {{$bex->base_currency_symbol_position == 'left' ? $bex->base_currency_symbol : ''}}
                                                @endif
                                                {{$package->price == 0 ? "Free" : $package->price}}
                                                <span class="sign">
                                                    @if($package->price != 0)
                                                    {{$bex->base_currency_symbol_position == 'right' ? $bex->base_currency_symbol : ''}}
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
                                                        {{$bex->base_currency_symbol_position == 'left' ? $bex->base_currency_symbol : ''}}
                                                    @endif
                                                </span>
                                                {{$package->price == 0 ? "Free" : $package->price}}
                                                <span class="sign">
                                                     @if($package->price != 0)
                                                        {{$bex->base_currency_symbol_position == 'right' ? $bex->base_currency_symbol : ''}}
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
@endsection

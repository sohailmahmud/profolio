@extends('user.layout')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/admin/css/buy_plan.css')}}">
@endsection

@section('content')
    @if($package_count >= 2)
        <div class="row justify-content-center align-items-center mb-1">
            <div class="col-12">
                <div class="alert border-left border-primary">
                    <strong class="text-danger">You have another package to activate after the current package expires. You cannot purchase / extend any package, until the next package is activated</strong><br>
                    <strong>Current Package: </strong> {{$current_package->title}} (Expire
                    Date: {{Carbon\Carbon::parse($current_membership->expire_date)->format('M-d-Y')}})
                    <div><strong>Next Package To Activate: </strong> {{$next_package->title}} (Activation Date: {{Carbon\Carbon::parse($next_membership->start_date)->format('M-d-Y')}}, Expire Date: {{Carbon\Carbon::parse($next_membership->expire_date)->format('M-d-Y')}})</div>
                </div>
            </div>
        </div>
    @endif
    <div class="row mb-5 justify-content-center">
        @foreach($packages as $key => $package)
            <div class="col-md-3 pr-md-0 mb-5">
                <div class="card-pricing2 @if(isset($current_package->id) && $current_package->id === $package->id) card-success @else card-primary @endif">
                    <div class="pricing-header">
                        <h3 class="fw-bold d-inline-block">
                            {{$package->title}}
                        </h3>
                        @if(isset($current_package->id) && $current_package->id === $package->id)
                        <h3 class="badge badge-danger d-inline-block float-right ml-2">Current</h3>
                        @endif
                        @if($package_count >= 2 && $next_package->id == $package->id)
                        <h3 class="badge badge-warning d-inline-block float-right ml-2">Next</h3>
                        @endif
                        <span class="sub-title"></span>
                    </div>
                    <div class="price-value">
                        <div class="value">
                            <span
                                class="amount">{{$package->price== 0 ? "Free" :format_price($package->price)}}</span>
                            <span class="month">/{{$package->term}}</span>
                        </div>
                    </div>
                    <ul class="pricing-content">
                        @foreach(json_decode($package->features) as $feature)
                            <li>{{$feature}}</li>
                        @endforeach
                    </ul>

                    @if($package_count < 2)
                        <div class="px-4">
                            @if(isset($current_package->id) && $current_package->id === $package->id)
                                <a href="{{route('user.plan.extend.checkout',$package->id)}}"
                                class="btn btn-success btn-lg w-75 fw-bold mb-3">{{__('Extend')}}</a>
                            @else
                                <a href="{{route('user.plan.extend.checkout',$package->id)}}"
                                class="btn btn-primary btn-block btn-lg fw-bold mb-3">{{__('Buy Now')}}</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@extends('front.layout')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/front/css/forgot-password.css')}}">
@endsection



@section('pagename')
    - {{__("Reset Password")}}
@endsection
@section('breadcrumb-title')
    {{__("Reset Password")}}
@endsection
@section('breadcrumb-link')
    {{__("Reset Password")}}
@endsection

@section('content')

    <!--====== End Breadcrumbs section ======-->
    <section class="login-section pb-1000">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="user-form">
                        <form class="login-form" action="{{route('user.reset.password.submit')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form_group">
                                <span>{{__('Email Address')}}*</span>
                                <input type="email" name="email" class="form_control" placeholder="{{__('email')}}"
                                       value="{{$email}}">
                                @error('email')
                                <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form_group">
                                <span>{{__('Password')}}*</span>
                                <input type="password" class="form_control" placeholder="{{__('password')}}"
                                       name="password" value="{{old('password')}}" required>
                                @error('password')
                                <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form_group">
                                <span>{{__('Confirm password')}}*</span>
                                <input id="password-confirm" type="password" class="form_control"
                                       placeholder="{{__('confirm Password')}}" name="password_confirmation" required
                                       autocomplete="new-password">
                                @error('password')
                                <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form_group">
                                <button class="main-btn">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

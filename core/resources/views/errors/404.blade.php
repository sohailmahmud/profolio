@extends('front.layout')

@section('breadcrumb-title')
    {{__('Page Not Found')}}
@endsection
@section('breadcrumb-link')
    {{__('404')}}
@endsection

@section('content')

  <!--    Error section start   -->
  <div class="error-section">
     <div class="container">
        <div class="row">
           <div class="col-lg-6">
              <div class="not-found">
                 <img src="{{asset('assets/front/img/404.png')}}" alt="">
              </div>
           </div>
           <div class="col-lg-6">
              <div class="error-txt">
                 <div class="oops">
                    <img src="{{asset('assets/front/img/oops.png')}}" alt="">
                 </div>
                 <h2>{{__("You're lost")}}...</h2>
                 <p>{{__("The page you are looking for might have been moved, renamed, or might never existed.")}}</p>
                 <a href="{{route('front.index')}}" class="go-home-btn">{{__("Back Home")}}</a>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--    Error section end   -->
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$bs->website_title}} - {{__("Success")}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset("assets/front/css/plugin.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("assets/front/css/success.css")}}"/>
    <!-- base color change -->
    <link href="{{asset('assets/front/css/style-base-color.php').'?color='.$bs->base_color}}" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto" id="mt">
            <div class="payment">
                <div class="payment_header">
                    <div class="check">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="content">
                    @auth
                        <h1>{{__('payment_success')}}</h1>
                        <p class="paragraph-text">
                            {{__('extend_success_msg')}}
                        </p>
                        <a href="{{route('user-dashboard')}}">{{__('Go to Dashboard')}}</a>
                    @endauth
                    @guest
                        <h1>{{__('payment_success')}}</h1>
                        <p class="paragraph-text">
                            {{__('payment_success_msg')}}
                        </p>
                        <a href="{{route('front.index')}}">{{__('Go to Home')}}</a>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

@extends('front.layout')

@section('meta-description', !empty($seo) ? $seo->contact_meta_description : '')
@section('meta-keywords', !empty($seo) ? $seo->contact_meta_keywords : '')

@section('pagename')
- {{__('Contact')}}
@endsection
@section('breadcrumb-title')
{{__('Contact')}}
@endsection
@section('breadcrumb-link')
    {{__('Contact')}}
@endsection

@section('content')

    <!--====== Start contacts-section ======-->
    <section class="contacts-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-information">
                        <div class="info-box">
                            <ul class="info-box-list">
                                <li>
                                    <div class="contact-info-title mb-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{__('Address')}} :
                                    </div>
                                    @php
                                        $addresses = explode(PHP_EOL, $be->contact_addresses);
                                    @endphp
                                    @foreach ($addresses as $address)
                                    <p><i class="fas fa-map-pin base-color mr-1"></i> {{$address}}</p>
                                    @endforeach
    
                                </li>
                                <li>
                                    <div class="contact-info-title mb-3">
                                        <i class="fas fa-phone"></i>
                                        {{__("Call Us")}} :
                                    </div>
                                    @php
                                        $phones = explode(',', $be->contact_numbers);
                                    @endphp
                                    @foreach ($phones as $phone)
                                    <p>{{$phone}}</p>
                                    @endforeach
    
                                </li>
                                <li>
                                    <div class="contact-info-title mb-3">
                                        <i class="fas fa-envelope"></i>
                                        {{__('Email Us')}} :
                                    </div>
                                    @php
                                        $mails = explode(',', $be->contact_mails);
                                    @endphp
                                    @foreach ($mails as $mail)
                                    <p>{{$mail}}</p>
                                    @endforeach
    
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact-form">
                        <form action="{{route('front.admin.contact.message')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form_group mb-5">
                                        <input type="text" class="form_control" placeholder="{{__('Full Name')}}" name="name" required>
                                        @if ($errors->has('name'))
                                            <p class="text-danger mb-0">{{$errors->first('name')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form_group mb-5">
                                        <input type="email" class="form_control" placeholder="{{__('Email Address')}}" name="email" required>
                                        @if ($errors->has('email'))
                                            <p class="text-danger mb-0">{{$errors->first('email')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form_group mb-5">
                                        <input type="text" class="form_control" placeholder="{{__('Subject')}}" name="subject" required>
                                        @if ($errors->has('subject'))
                                            <p class="text-danger mb-0">{{$errors->first('subject')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form_group mb-5">
                                        <textarea class="form_control" placeholder="{{__('Message')}}" name="message" required></textarea>
                                        @if ($errors->has('message'))
                                            <p class="text-danger mb-0">{{$errors->first('message')}}</p>
                                        @endif
                                    </div>
                                </div>
                                @if ($bs->is_recaptcha == 1)
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                        @php
                                            $errmsg = $errors->first('g-recaptcha-response');
                                        @endphp
                                        <p class="text-danger mb-0 mt-2">{{__("$errmsg")}}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <div class="col-lg-12">
                                    <div class="form_group">
                                        <button class="main-btn">{{__('Submit')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End contacts-section ======-->
@endsection

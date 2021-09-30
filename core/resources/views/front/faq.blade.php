@extends('front.layout')

@section('pagename')
- {{__('FAQs')}}
@endsection

@section('meta-description', !empty($seo) ? $seo->faqs_meta_description : '')
@section('meta-keywords', !empty($seo) ? $seo->faqs_meta_keywords : '')

@section('breadcrumb-title')
{{__('FAQs')}}
@endsection
@section('breadcrumb-link')
    {{__('FAQs')}}
@endsection

@section('content')

    <!--====== Start faqs-section ======-->
    <section class="faqs-section pt-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <div class="faq-wrapper mb-40">
                        <div class="accordion" id="accordionExample">
                          @foreach($faqs as $key => $faq)
                              @if($key == 0)
                                    <div class="card">
                                        <a class="collapsed card-header" id="heading{{$key}}" href="#" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">{{$faq->question}}<span class="toggle_btn"></span>
                                        </a>
                                        <div id="collapse{{$key}}" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p>{{$faq->question}}</p>
                                            </div>
                                        </div>
                                    </div>

                                  @else
                                  <div class="card">
                                      <a class="collapsed card-header" id="heading{{$key}}" href="#" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">{{$faq->question}}<span class="toggle_btn"></span>
                                      </a>
                                      <div id="collapse{{$key}}" class="collapse" data-parent="#accordionExample">
                                          <div class="card-body">
                                              <p>{{$faq->question}}</p>
                                          </div>
                                      </div>
                                  </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </section><!--====== End faqs-section ======-->
@endsection

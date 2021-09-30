@extends('user.profile.layout')

@section('tab-title')
{{$keywords["Portfolios"] ?? "Portfolios"}}
@endsection

@section('meta-description', !empty($userSeo) ? $userSeo->portfolios_meta_description : '')
@section('meta-keywords', !empty($userSeo) ? $userSeo->portfolios_meta_keywords : '')

@section('br-title')
{{$keywords["Portfolios"] ?? "Portfolios"}}
@endsection
@section('br-link')
{{$keywords["Portfolios"] ?? "Portfolios"}}
@endsection

@section('content')
    <!--====== Start Vaughn-Work section ======-->
    <section class="vaughn-work pt-60 pb-80" id="portfolio">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="work-filter mb-45">
                        <button class="work-btn active-btn" data-filter="*">{{$keywords['All'] ?? "All"}}</button>
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
@endsection


@section('scripts')
    @if (!empty(request()->input('category')))
        <script>
            "use strict";
            $(window).on('load', function() {
                setTimeout(function() {
                    let catid = {{request()->input('category')}};
                    $("button[data-filter='.cat-" + catid + "']").trigger('click');
                }, 500);
            });
        </script>
    @endif
@endsection

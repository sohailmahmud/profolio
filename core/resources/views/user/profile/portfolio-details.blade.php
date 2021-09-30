@extends('user.profile.layout')

@section('tab-title')
{{$keywords["Portfolio_Details"] ?? "Portfolio Details"}}
@endsection

@section('og-meta')
<meta property="og:image" content="{{asset('assets/front/img/user/portfolios/'.$portfolio->image)}}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1024">
<meta property="og:image:height" content="1024">
@endsection

@section('meta-description', $portfolio->meta_description)
@section('meta-keywords', $portfolio->meta_keywords)

@section('br-title')
{{$keywords["Portfolio_Details"] ?? "Portfolio Details"}}
@endsection
@section('br-link')
{{$keywords["Portfolio_Details"] ?? "Portfolio Details"}}
@endsection

@section('content')
<section class="single-page-details pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-page-wrapper mb-30">
                    <div class="post-item">
                        @if ($portfolio->portfolio_images()->count() > 0)
                            <div class="post-img mb-20">
                                <div class="post-gallery-slider">
                                        @foreach ($portfolio->portfolio_images as $pi)
                                        <a href="{{asset('assets/front/img/user/portfolios/' . $pi->image)}}" class="image-popup"><img data-src="{{asset('assets/front/img/user/portfolios/' . $pi->image)}}" class="img-fluid lazy" alt=""></a>
                                        @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="entry-content">
                            <h3 class="title mb-20">{{$portfolio->title}}</h3>
                            <div class="summernote-content">
                                {!! replaceBaseUrl($portfolio->content) !!}
                            </div>
                        </div>
                    </div>
                    <div class="post-share">
                        <ul class="social-link">
                            <li><a href="//www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" class="facebook"><i class="fab fa-facebook-f"></i>{{$keywords["Facebook"] ?? "Facebook"}}</a></li>
                            <li><a href="//twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}" class="twitter"><i class="fab fa-twitter"></i>{{$keywords["Twitter"] ?? "Twitter"}}</a></li>
                            <li><a href="//www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title={{$portfolio->title}}" class="linkedin"><i class="fab fa-linkedin-in"></i>{{$keywords["Linkedin"] ?? "Linkedin"}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-widget-area">
                    <div class="widget categories-widget mb-40">
                        <h4 class="widget-title">{{$keywords["Categories"] ?? "Categories"}}</h4>
                        <ul class="widget-link">
                            <li><a href="{{route('front.user.portfolios', Request::route('username'))}}">{{$keywords["All"] ?? "All"}} <span>({{$allCount}})</span></a></li>
                            @foreach ($portfolio_categories as $pc)
                            <li class="@if($pc->id == $portfolio->category_id) active @endif"><a href="{{route('front.user.portfolios', Request::route('username')) . '?category=' . $pc->id}}">{{$pc->name}} <span>({{$pc->portfolios()->count()}})</span></a></li>
                            @endforeach
                        </ul>
                    </div>

                    @if ($relatedPortfolios->count() > 0)
                        <div class="widget recent-post-widget mb-40">
                            <h4 class="widget-title">{{$keywords["Related_Portfolios"] ?? "Related Portfolios"}}</h4>
                            <ul class="recent-post-list">
                                @foreach ($relatedPortfolios->get() as $rp)
                                    <li class="post-thumbnail-content">
                                        <img data-src="{{asset('assets/front/img/user/portfolios/' . $rp->image)}}" class="img-fluid lazy" alt="">
                                        <div class="post-title-date">
                                            <h6><a href="{{route('front.user.portfolio.detail', [Request::route('username'), $rp->slug, $rp->id])}}">{{strlen($rp->title) > 30 ? mb_substr($rp->title, 0, 30, 'UTF-8') : $rp->title}}</a></h6>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

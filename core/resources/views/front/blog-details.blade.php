@extends('front.layout')

@section('pagename')
    - {{__('Blog Details')}}
@endsection

@section('meta-description', !empty($blog) ? $blog->meta_keywords : '')
@section('meta-keywords', !empty($blog) ? $blog->meta_description : '')

@section('breadcrumb-title')
    {{strlen($blog->title) > 30 ? mb_substr($blog->title, 0, 30) . '...' : $blog->title}}
@endsection
@section('breadcrumb-link')
    {{__('Blog Details')}}
@endsection

@section('content')

    <!--====== BLOG DETAILS PART START ======-->

    <section class="blog-details-area pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-details-items">
                        <div class="blog-thumb">
                            <img class="lazy" data-src="{{asset('assets/front/img/blogs/'.$blog->main_image)}}" alt="blog">
                        </div>
                        <div class="blog-details-content">
                            <h3 class="title">{{$blog->title}}</h3>
                            <div class="summernote-content">
                                <p>{!! replaceBaseUrl($blog->content) !!}</p>
                            </div>
                        </div>

                        <div class="blog-social">
                            <div class="shop-social d-flex align-items-center">
                                <span>{{__('Share')}} :</span>
                                <ul class="ml-3 d-flex">
                                    <li class="p-1"><a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="p-1"><a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}"><i class="fab fa-twitter"></i></a></li>
                                    <li class="p-1"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title={{$blog->title}}"><i class="fab fa-linkedin-in"></i></a></li>

                                </ul>
                            </div>
                        </div>

                        <div class="blog-details-comment mt-5">
                            <div class="comment-lists">
                                <div id="disqus_thread"></div>
                            </div>
                        </div> <!-- blog details comment -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    @includeIf('front.partials.blog-sidebar')
                </div>
            </div>
        </div>
    </section>

    <!--====== BLOG DETAILS PART ENDS ======-->


@endsection

@if($bs->is_disqus == 1)
    @section('scripts')
    <script>
        "use strict";
        (function() { 
            var d = document, s = d.createElement('script');
            s.src = 'https://{{$bs->disqus_shortname}}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    @endsection
@endif

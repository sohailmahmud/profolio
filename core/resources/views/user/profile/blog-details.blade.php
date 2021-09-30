@extends('user.profile.layout')

@section('tab-title')
{{$keywords["Blog_Details"] ?? "Blog Details"}}
@endsection

@section('og-meta')
<meta property="og:image" content="{{asset('assets/front/img/user/blogs/'.$blog->image)}}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1024">
<meta property="og:image:height" content="1024">
@endsection

@section('meta-description', $blog->meta_description)
@section('meta-keywords', $blog->meta_keywords)

@section('br-title')
{{$keywords["Blog_Details"] ?? "Blog Details"}}
@endsection
@section('br-link')
{{$keywords["Blog_Details"] ?? "Blog Details"}}
@endsection

@section('content')

<section class="single-page-details pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-page-wrapper mb-30">
                    <div class="post-item">
                        <div class="post-img mb-20">
                            <img data-src="{{asset('assets/front/img/user/blogs/'.$blog->image)}}" class="img-fluid lazy" alt="">
                        </div>
                        <div class="entry-content">
                            <h3 class="title mb-20">{{$blog->title}}</h3>
                            <div class="entry-meta mb-15">
                                <ul>
                                    <li><span><i class="fas fa-user"></i>{{$keywords["by"] ?? "by"}} <a href="#">{{Request::route('username')}}</a></span></li>
                                    <li><span><i class="fas fa-calendar"></i><a href="#">{{\Carbon\Carbon::parse($blog->created_at)->format('F j, Y')}}</a></span></li>
                                </ul>
                            </div>
                            <div class="summernote-content">
                                {!! replaceBaseUrl($blog->content) !!}
                            </div>
                        </div>
                    </div>
                    <div class="post-share">
                        <ul class="social-link">
                            <li><a href="//www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" class="facebook"><i class="fab fa-facebook-f"></i>{{$keywords["Facebook"] ?? "Facebook"}}</a></li>
                            <li><a href="//twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}" class="twitter"><i class="fab fa-twitter"></i>{{$keywords["Twitter"] ?? "Twitter"}}</a></li>
                            <li><a href="//www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title={{$blog->title}}" class="linkedin"><i class="fab fa-linkedin-in"></i>{{$keywords["Linkedin"] ?? "Linkedin"}}</a></li>
                        </ul>
                    </div>
                    <div class="mt-5">
                        <div id="disqus_thread"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @includeIf('user.profile.blog-sidebar')
            </div>
        </div>
    </div>
</section>
<!--====== Start Vaughn-footer section ======-->

@endsection

@if($bs->is_user_disqus == 1)
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
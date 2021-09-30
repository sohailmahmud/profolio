@extends('user.profile.layout')

@section('tab-title')
{{$keywords["Blogs"] ?? "Blogs"}}
@endsection

@section('meta-description', !empty($userSeo) ? $userSeo->blogs_meta_description : '')
@section('meta-keywords', !empty($userSeo) ? $userSeo->blogs_meta_keywords : '')

@section('br-title')
{{$keywords["Blogs"] ?? "Blogs"}}
@endsection
@section('br-link')
{{$keywords["Blogs"] ?? "Blogs"}}
@endsection

@section('content')
    <!--====== Start Vaughn-Blog section ======-->
    <section class="vaughn-blog pt-60 pb-80" id="blog">
        <div class="container">

            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-lg-6 col-sm-12">
                            <div class="blog-item mb-50">
                                <div class="post-img">
                                    <a href="{{route('front.user.blog.detail', [Request::route('username'), $blog->slug, $blog->id])}}"><img data-src="{{asset('assets/front/img/user/blogs/'.$blog->image)}}"
                                        class="img-fluid lazy" alt=""></a>
                                </div>
                                <div class="entry-content">
                                    <div class="entry-meta">
                                        <ul>
                                            <li><span><i class="fas fa-user"></i>{{$keywords['by'] ?? 'by'}} <a
                                                href="#">{{$user->username}}</a></span></li>
                                            <li><span><i class="fas fa-calendar"></i><a
                                                href="#">{{\Carbon\Carbon::parse($blog->created_at)->format('F j, Y')}}</a></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="title"><a href="{{route('front.user.blog.detail', [Request::route('username'), $blog->slug, $blog->id])}}">{{strlen($blog->title) > 50 ? mb_substr($blog->title, 0, 50, 'UTF-8') . '...' : $blog->title}}</a></h3>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center">
                        {{$blogs->appends(['category' => request()->input('category'), 'term' => request()->input('term')])->links()}}
                    </div>
                </div>

                <div class="col-lg-4">
                    @includeIf('user.profile.blog-sidebar')
                </div>
            </div>
        </div>
    </section>
    <!--====== End Vaughn-Blog section ======-->

@endsection

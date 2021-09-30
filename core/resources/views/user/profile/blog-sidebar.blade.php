<div class="sidebar-widget-area">
    <div class="widget search-widget mb-40">
        <h4 class="widget-title">{{$keywords["Search_Here"] ?? "Search Here"}}</h4>
        <form action="{{route('front.user.blogs', Request::route('username'))}}">
            <div class="form_group">
                <input name="category" type="hidden" value="{{request()->input('category')}}">
                <input name="term" type="search" class="form_control" placeholder="{{$keywords["Search_your_keyword"] ?? "Search your keyword"}}..." value="{{request()->input('term')}}">
                <button type="submit" class="search_btn"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="widget categories-widget mb-40">
        <h4 class="widget-title">{{$keywords["Categories"] ?? "Categories"}}</h4>
        <ul class="widget-link">
            <li @if(empty(request()->input('category'))) class="active" @endif><a href="{{route('front.user.blogs', Request::route('username'))}}">{{$keywords["All"] ?? "All"}} <span>({{$allCount}})</span></a></li>
            @foreach ($blog_categories as $bc)
            <li @if($bc->id == request()->input('category')) class="active" @endif><a href="{{route('front.user.blogs', Request::route('username')) . '?category=' . $bc->id}}">{{$bc->name}} <span>({{$bc->blogs()->count()}})</span></a></li>
            @endforeach
        </ul>
    </div>
    <div class="widget recent-post-widget mb-40">
        <h4 class="widget-title">{{$keywords["Latest_Blogs"] ?? "Latest Blogs"}}</h4>
        <ul class="recent-post-list">
            @foreach ($latestBlogs as $lb)
                <li class="post-thumbnail-content">
                    <img src="{{asset('assets/front/img/user/blogs/'.$lb->image)}}" class="img-fluid" alt="">
                    <div class="post-title-date">
                        <h6><a href="{{route('front.user.blog.detail', [Request::route('username'), $lb->slug, $lb->id])}}">{{strlen($lb->title) > 30 ? mb_substr($lb->title, 0, 30, 'UTF-8') . '...' : $lb->title}}</a></h6>
                        <span class="posted-on"><i class="fas fa-calendar-alt"></i><a href="#">{{\Carbon\Carbon::parse($lb->created_at)->format('F j, Y')}}</a></span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

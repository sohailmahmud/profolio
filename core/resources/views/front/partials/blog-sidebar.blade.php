<div class="blog-sidebar">
    <div class="blog-box blog-border">
        <div class="blog-title pl-45">
            <h4 class="title"><i class="fa fa-list {{$rtl == 1 ? 'mr-20 ml-10' : 'mr-10'}}"></i>{{__('All Categories')}}</h4>
        </div>
        <div class="blog-cat-list pl-45 pr-45">
            <ul>
                <li class="single-category @if(empty(request()->input('category'))) active @endif"><a href="{{route('front.blogs')}}">{{__('All')}}</a></li>
                @foreach ($bcats as $key => $bcat)
                    <li class="single-category @if(request()->input('category') == $bcat->id) active @endif"><a href="{{route('front.blogs', ['category'=>$bcat->id])}}">{{$bcat->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
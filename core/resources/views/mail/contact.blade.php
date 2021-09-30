@if ($subsc)
<h4>Hello Subscriber, </h4>
@endif


<p>@php echo replaceBaseUrl($text); @endphp</p>

@if ($subsc)
<p class="mb-0">Best Regards,</p>
<p>{{$bs->website_title}}</p>
@endif


@extends('front.layout')

@section('pagename')
- {{$page->name}}
@endsection

@section('meta-description', !empty($page) ? $page->meta_keywords : '')
@section('meta-keywords', !empty($page) ? $page->meta_description : '')

@section('breadcrumb-title')
{{$page->title}}
@endsection
@section('breadcrumb-link')
    {{$page->name}}
@endsection

@section('content')

    <!--====== Start faqs-section ======-->
    <section class="faqs-section pt-120 pb-80">
        <div class="container">
            <div class="summernote-content">
                {!! replaceBaseUrl($page->body) !!}
            </div>
        </div>
    </section><!--====== End faqs-section ======-->
@endsection

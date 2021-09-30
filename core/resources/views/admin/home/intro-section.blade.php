@extends('admin.layout')

@if(!empty($abs->language) && $abs->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select,
    select {
        direction: rtl;
    }
    form .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
  <div class="page-header">
    <h4 class="page-title">Intro Section</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Home Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Intro Section</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Update Intro Section</div>
                </div>
                <div class="col-lg-2">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">

              <form id="ajaxForm" action="{{route('admin.introsection.update', $lang_id)}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="col-12 mb-2">
                        <label for="image"><strong>Main Image **</strong></label>
                      </div>
                      <div class="col-md-12 showImage mb-3">
                        <img src="{{$abs->intro_main_image ? asset('assets/front/img/'.$abs->intro_main_image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                      </div>
                      <input type="file" name="intro_main_image" id="image" class="form-control image">
                      <p id="errintro_main_image" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>

                
                <div class="form-group">
                  <label for="">Title </label>
                  <input type="text" class="form-control" name="intro_title" value="{{$abs->intro_title}}">
                  <p id="errintro_title" class="em text-danger mb-0"></p>
                </div>

                <div class="form-group">
                  <label for="">Subtitle</label>
                  <input type="text" class="form-control" name="intro_subtitle" value="{{$abs->intro_subtitle}}">
                  <p id="errintro_subtitle" class="em text-danger mb-0"></p>
                </div>

                <div class="form-group">
                  <label for="">Text </label>
                  <textarea name="intro_text" class="form-control" rows="4">{{$abs->intro_text}}</textarea>
                  <p id="errintro_text" class="em text-danger mb-0"></p>
                </div>

              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection


@section('scripts')
<script>
$(function ($) {
  "use strict";

    $(".remove-image").on('click', function(e) {
        e.preventDefault();
        $(".request-loader").addClass("show");

        let type = $(this).data('type');
        let fd = new FormData();
        fd.append('type', type);
        fd.append('language_id', {{$abs->language->id}});

        $.ajax({
            url: "{{route('admin.introsection.img.rmv')}}",
            data: fd,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                    window.location = "{{url()->current() . '?language=' . $abs->language->code}}";
                }
            }
        })
    });
});
</script>
@endsection

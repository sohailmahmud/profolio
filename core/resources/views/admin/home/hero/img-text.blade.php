@extends('admin.layout')

@if(!empty($abe->language) && $abe->language->rtl == 1)
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
    <h4 class="page-title">Hero Section</h4>
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
        <a href="#">Hero Section</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Static Version</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Update Hero Section</div>
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
              <form id="ajaxForm" action="{{route('admin.herosection.update', $lang_id)}}" method="post">
                @csrf

                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="mb-2">
                              <label for="image"><strong>Image</strong></label>
                            </div>
                            <div class="showImage mb-3">
                              <img src="{{!empty($abe->hero_img) ? asset('assets/front/img/'.$abe->hero_img) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail w-100">
                            </div>
                            <input type="file" name="image" class="form-control image">
                            <p id="errimage" class="mb-0 text-danger em"></p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input name="hero_section_title" class="form-control" value="{{$abe->hero_section_title}}">
                            <p id="errhero_section_title" class="em text-danger mb-0"></p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="">Text</label>
                        <input name="hero_section_text" class="form-control" value="{{$abe->hero_section_text}}">
                        <p id="errhero_section_text" class="em text-danger mb-0"></p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                          <label for="">Button Text </label>
                          <input type="text" class="form-control" name="hero_section_button_text" value="{{$abe->hero_section_button_text}}">
                          <p id="errhero_section_button_text" class="em text-danger mb-0"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Button URL </label>
                            <input type="text" class="form-control ltr" name="hero_section_button_url" value="{{$abe->hero_section_button_url}}">
                            <p id="errhero_section_button_url" class="em text-danger mb-0"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Video URL </label>
                            <input type="text" class="form-control ltr" name="hero_section_video_url" value="{{$abe->hero_section_video_url}}">
                            <p id="errhero_section_video_url" class="em text-danger mb-0"></p>
                        </div>
                    </div>
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

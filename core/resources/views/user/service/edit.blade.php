@extends('user.layout')

@if(!empty($service->language) && $service->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
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
    <h4 class="page-title">Edit Service</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('user.services.index')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Service Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Edit Service</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Service</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('user.services.index') . '?language=' . $service->language->code}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" class="" action="{{route('user.service.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$service->id}}">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="col-12 mb-2">
                        <label for="image"><strong>Image*</strong></label>
                      </div>
                      <div class="col-md-12 showImage mb-3">
                        <img src="{{isset($service->image) ? asset('assets/front/img/user/services/'.$service->image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                      </div>
                      <input type="file" name="image" id="image" class="form-control">
                      <p id="errimage" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Name*</label>
                  <input type="text" class="form-control" name="name" value="{{$service->name}}" placeholder="Enter name">
                  <p id="errname" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Content **</label>
                  <textarea class="form-control summernote" name="content" data-height="300" placeholder="Enter content">{{ replaceBaseUrl($service->content) }}</textarea>
                  <p id="errcontent" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                  <label for="">Serial Number **</label>
                  <input type="number" class="form-control ltr" name="serial_number" value="{{$service->serial_number}}" placeholder="Enter Serial Number">
                  <p id="errserial_number" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><small>The higher the serial number is, the later the blog will be shown.</small></p>
                </div>
                  <div class="form-group">
                      <label for="featured" class="my-label mr-3">Featured</label>
                      <input id="featured" type="checkbox" name="featured" value="1" {{$service->featured == 1 ? "checked": ""}}>
                      <p id="errfeatured" class="mb-0 text-danger em"></p>
                  </div>
                  <div class="form-group">
                      <div class="d-flext">
                          <label class="mr-3">Detail Page</label>
                          <div class="radio mr-3">
                              <label><input class="mr-1" type="radio" name="detail_page" value="1" {{$service->detail_page == 1 ? "checked": ""}}>Enable</label>
                          </div>
                          <div class="radio">
                              <label><input class="mr-1" type="radio" name="detail_page" value="0" {{$service->detail_page == 0 ? "checked": ""}}>Disable</label>
                          </div>
                      </div>
                      <p id="errdetail_page" class="mb-0 text-danger em"></p>
                  </div>
                <div class="form-group">
                  <label for="">Meta Keywords</label>
                  <input type="text" class="form-control" name="meta_keywords" value="{{$service->meta_keywords}}" data-role="tagsinput">
                  <p id="errmeta_keywords" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Meta Description</label>
                  <textarea type="text" class="form-control" name="meta_description" rows="5">{{$service->meta_description}}</textarea>
                  <p id="errmeta_description" class="mb-0 text-danger em"></p>
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
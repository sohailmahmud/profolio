@extends('admin.layout')


@if(!empty($partner->language) && $partner->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
        direction: rtl;
    }
    .nicEdit-main {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif


@section('content')
  <div class="page-header">
    <h4 class="page-title">Edit Partner</h4>
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
        <a href="#">Edit Partner</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Partner</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.partner.index') . '?language=' . request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" class="" action="{{route('admin.partner.update')}}" method="post">
                @csrf
                <input type="hidden" name="partner_id" value="{{$partner->id}}">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="form-group">
                              <div class="col-12 mb-2">
                                  <label for="image"><strong>Image*</strong></label>
                              </div>
                              <div class="col-md-12 showImage mb-3">
                                  <img src="{{$partner->image ? asset('assets/front/img/partners/'.$partner->image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                              </div>
                              <input type="file" name="image" id="image" class="form-control">
                              <p id="errimage" class="mb-0 text-danger em"></p>
                          </div>
                      </div>
                  </div>
                <div class="form-group">
                  <label for="">URL **</label>
                  <input type="text" class="form-control ltr" name="url" value="{{$partner->url}}" placeholder="Enter URL of social media account">
                  <p id="errurl" class="text-danger mb-0 em"></p>
                </div>
                <div class="form-group">
                  <label for="">Serial Number **</label>
                  <input type="number" class="form-control ltr" name="serial_number" value="{{$partner->serial_number}}" placeholder="Enter Serial Number">
                  <p id="errserial_number" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><small>The higher the serial number is, the later the partner will be shown.</small></p>
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

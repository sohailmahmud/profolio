@extends('admin.layout')

@if(!empty($process->language) && $process->language->rtl == 1)
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
    <h4 class="page-title">Work Process</h4>
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
        <a href="#">Work Process</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="{{route('admin.process.update')}}" method="post" enctype="multipart/form-data">
          <div class="card-header">
            <div class="card-title d-inline-block">Edit Process</div>
            <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.process.index') . '?language=' . request()->input('language')}}">
                <span class="btn-label">
                    <i class="fas fa-backward"></i>
                </span>
                Back
            </a>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                  @csrf
                  <input type="hidden" name="process_id" value="{{$process->id}}">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="mb-2">
                          <label for="image"><strong> Process Image</strong></label>
                        </div>
                        <div class="showImage mb-3">
                          <img src="{{ !empty($process->image) ? asset('assets/front/img/process/'.$process->image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                        </div>
                        <input type="file" name="image" class="form-control image">
                        <p id="errimage" class="mb-0 text-danger em"></p>
                        <div class="progress mt-3 d-none">
                          <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          <small class="show-name mt-1">{{__('Upload only ZIP Files, Max File Size is 5 MB')}}</small>
                          <p class="text-danger mb-2 file-error d-none"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Title **</label>
                    <input class="form-control" name="title" placeholder="Enter title" value="{{$process->title}}">
                    @if ($errors->has('title'))
                      <p class="mb-0 text-danger">{{$errors->first('title')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="">Serial Number **</label>
                    <input type="number" class="form-control ltr" name="serial_number" value="{{$process->serial_number}}" placeholder="Enter Serial Number">
                    @if ($errors->has('serial_number'))
                      <p class="mb-0 text-danger">{{$errors->first('serial_number')}}</p>
                    @endif
                    <p class="text-warning"><small>The higher the serial number is, the later the process will be shown.</small></p>
                  </div>
              </div>
            </div>
          </div>
          <div class="card-footer pt-3">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

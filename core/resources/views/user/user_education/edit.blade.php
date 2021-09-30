@extends('user.layout')

@php
    $userDefaultLang = \App\Models\User\Language::where([
       ['user_id',\Illuminate\Support\Facades\Auth::id()],
       ['is_default',1]
    ])->first();
    $userLanguages = \App\Models\User\Language::where('user_id',\Illuminate\Support\Facades\Auth::id())->get();
@endphp

@includeIf('user.partials.rtl-style')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Edit Education</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('user-dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Education Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Edit Education</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Education</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('user.experience.index')."?language=".request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" class="" action="{{route('user.experience.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$education->id}}">
                <div class="form-group">
                  <label for="">Degree Name **</label>
                  <input type="text" class="form-control" name="degree_name" value="{{$education->degree_name}}" placeholder="Enter degree name">
                  <p id="errdegree_name" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                    <label for="">Short Description</label>
                    <textarea class="form-control" name="short_description" rows="5">{{$education->short_description}}</textarea>
                </div>
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                              <label for="">Start Date **</label>
                              <input type="date" class="form-control" name="start_date" value="{{$education->start_date}}">
                              <p id="errstart_date" class="mb-0 text-danger em"></p>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                              <label for="">End Date</label>
                              <input type="date" class="form-control" id="myDate" name="end_date" value="{{$education->end_date}}">
                              <p id="errend_date" class="mb-0 text-danger em"></p>
                          </div>
                      </div>
                  </div>
                <div class="form-group">
                  <label for="">Serial Number **</label>
                  <input type="number" class="form-control ltr" name="serial_number" value="{{$education->serial_number}}" placeholder="Enter Serial Number">
                  <p id="errserial_number" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><small>The higher the serial number is, the later the education will be shown.</small></p>
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

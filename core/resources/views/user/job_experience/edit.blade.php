@extends('user.layout')
@if(!empty($jobExperience->language) && $jobExperience->language->rtl == 1)
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
    <h4 class="page-title">Edit Job Experience</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('user.job.experiences.index')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Job Experience Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Edit Job Experience</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Job Experience</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('user.job.experiences.index').'?language=' . $jobExperience->language->code}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" class="" action="{{route('user.job.experience.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$jobExperience->id}}">
                  <div class="form-group">
                      <label for="">Company Name **</label>
                      <input type="text" class="form-control" name="company_name" placeholder="Enter company name" value="{{$jobExperience->company_name}}">
                      <p id="errcompany_name" class="mb-0 text-danger em"></p>
                  </div>
                  <div class="form-group">
                      <label for="">Designation/Position Name **</label>
                      <input type="text" class="form-control" name="designation" placeholder="Enter name" value="{{$jobExperience->designation}}">
                      <p id="errdesignation" class="mb-0 text-danger em"></p>
                  </div>
                  <div class="form-group">
                      <label for="">Content/Job Responsibility</label>
                      <textarea class="form-control" name="content" rows="5" placeholder="Enter content">{{ $jobExperience->content }}</textarea>
                      <p id="errcontent" class="mb-0 text-danger em"></p>
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                              <label for="">Start Date **</label>
                              <input type="date" class="form-control" name="start_date" value="{{$jobExperience->start_date}}">
                              <p id="errstart_date" class="mb-0 text-danger em"></p>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                              <label for="">End Date</label>
                              <input type="date" class="form-control" id="myDate" name="end_date" value="{{$jobExperience->end_date}}">
                              <p id="errend_date" class="mb-0 text-danger em"></p>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                              <input type="checkbox"  name="is_continue" class="is_continue"  rows="5"
                                     onchange="valueChanged()"
                                     {{$jobExperience->is_continue == 1 ? "checked" : ""}}>
                              <label for="is_continue" class="my-label" style="margin-right: 20px;">Present</label>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="">Serial Number **</label>
                      <input type="number" class="form-control ltr" name="serial_number" value="{{$jobExperience->serial_number}}" placeholder="Enter Serial Number">
                      <p id="errserial_number" class="mb-0 text-danger em"></p>
                      <p class="text-warning mb-0"><small>The higher the serial number is, the later the job will be shown.</small></p>
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
    <script type="text/javascript">
        "use strict";
        $(document).ready(function (){
            if($('.is_continue').is(":checked")){
                $("#myDate").attr("disabled","disabled");
            }
        })
        function valueChanged()
        {
            if($('.is_continue').is(":checked"))
            $("#myDate").attr("disabled","disabled");
            else
            $("#myDate").removeAttr("disabled");
        }
    </script>
@endsection

@extends('user.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">CV Upload</h4>
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
        <a href="#">CV Upload</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">CV Upload</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Update CV Upload</div>
        </div>
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form  id="ajaxForm" enctype="multipart/form-data" action="{{route('user.cv.upload.update')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                      @if(isset($basic_setting->cv))
                      <div class="form-group">
                          <div class="col-md-12">
                              <a class="btn btn-primary" href="{{asset('assets/front/img/user/cv/'.$basic_setting->cv)}}" target="_blank" download="{{Auth::user()->username}}.pdf">
                                  <i class="fas fa-download"></i>
                                  &nbsp;&nbsp;
                                  <span>Download</span>
                              </a>
                          </div>
                      </div>
                      @endif
                    <div class="form-group">
                      <div class="col-12 mb-2">
                        <label for="image"><strong>CV upload*</strong></label>
                      </div>
                      <input type="file" name="cv" id="cv" class="form-control" required>
                      <p id="errcv" class="mb-0 text-danger em"></p>
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
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

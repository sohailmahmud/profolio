@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Maintenance Mode') }}</h4>
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
        <a href="#">{{ __('Basic Settings') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Maintenance Mode') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title">{{ __('Update Maintenance Mode') }}</div>
            </div>
          </div>
        </div>

        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="maintenanceForm" action="{{ route('admin.maintainance.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="col-12 mb-2">
                        <label for="image"><strong>Maintainance Image **</strong></label>
                      </div>
                      <div class="col-md-12 showImage mb-3">
                        <img src="{{ asset('assets/front/img/'. $bs->maintenance_img) }}" alt="..." class="img-thumbnail">
                      </div>
                      <input type="file" name="file" id="image" class="form-control">
                      <p id="errfile" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>{{ __('Maintenance Status*') }}</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input
                        type="radio"
                        name="maintenance_status"
                        value="1"
                        class="selectgroup-input"
                        {{ $data->maintenance_status == 1 ? 'checked' : '' }}
                      >
                      <span class="selectgroup-button">{{ __('Active') }}</span>
                    </label>
                    <label class="selectgroup-item">
                      <input
                        type="radio"
                        name="maintenance_status"
                        value="0"
                        class="selectgroup-input"
                        {{ $data->maintenance_status == 0 ? 'checked' : '' }}
                      >
                      <span class="selectgroup-button">{{ __('Deactive') }}</span>
                    </label>
                  </div>
                  @if ($errors->has('maintenance_status'))
                    <p class="mt-2 mb-0 text-danger">{{ $errors->first('maintenance_status') }}</p>
                  @endif
                </div>

                <div class="form-group">
                  <label>{{ __('Maintenance Message*') }}</label>
                  <textarea
                    class="form-control"
                    name="maintainance_text"
                    rows="3"
                    cols="80"
                  >{{ $data->maintainance_text }}</textarea>
                  @if ($errors->has('maintainance_text'))
                    <p class="mt-2 mb-0 text-danger">{{ $errors->first('maintainance_text') }}</p>
                  @endif
                </div>

                <div class="form-group">
                  <label>Secret Path</label>
                  <input name="secret_path" type="text" class="form-control" value="{{$data->secret_path}}">
                  <p class="text-warning">After activating maintenance mode, You can access the website via <strong class="text-danger">{{url('{secret_path}')}}</strong></p>
                  <p class="text-warning">Try to avoid using special characters</p>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="maintenanceForm" class="btn btn-success">
                {{ __('Update') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

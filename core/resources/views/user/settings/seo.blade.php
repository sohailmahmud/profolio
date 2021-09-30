@extends('user.layout')

@php
    $selLang = \App\Models\User\Language::where([
    ['code', \Illuminate\Support\Facades\Session::get('currentLangCode')],
    ['user_id',\Illuminate\Support\Facades\Auth::id()]
    ])->first();
    $userDefaultLang = \App\Models\User\Language::where([
        ['user_id',\Illuminate\Support\Facades\Auth::id()],
        ['is_default',1]
    ])->first();
    $userLanguages = \App\Models\User\Language::where('user_id',\Illuminate\Support\Facades\Auth::id())->get();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form:not(.modal-form) input,
    form:not(.modal-form) textarea,
    form:not(.modal-form) select,
    select[name='userLanguage'] {
        direction: rtl;
    }
    form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('SEO Informations') }}</h4>
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
        <a href="#">{{ __('Basic Settings') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('SEO Informations') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form
          action="{{ route('admin.basic_settings.update_seo_informations') }}"
          method="post"
        >
          @csrf
          <div class="card-header">
            <div class="row">
              <div class="col-lg-9">
                <div class="card-title">{{ __('Update SEO Informations') }}</div>
              </div>

              <div class="col-lg-3">
                    @if(!is_null($userDefaultLang))
                      @if (!empty($userLanguages))
                      <select name="language" class="form-control float-right" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                         <option value="" selected disabled>Select a Language</option>
                         @foreach ($userLanguages as $lang)
                         <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                         @endforeach
                      </select>
                      @endif
                    @endif
              </div>
            </div>
          </div>

          <div class="card-body pt-5 pb-5">
            <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta Keywords For Home Page') }}</label>
                    <input
                      class="form-control"
                      name="home_meta_keywords"
                      value="{{ $data->home_meta_keywords }}"
                      placeholder="Enter Meta Keywords"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta Description For Home Page') }}</label>
                    <textarea
                      class="form-control"
                      name="home_meta_description"
                      rows="5"
                      placeholder="Enter Meta Description"
                    >{{ $data->home_meta_description }}</textarea>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta Keywords For Blogs Page') }}</label>
                    <input
                      class="form-control"
                      name="blogs_meta_keywords"
                      value="{{ $data->blogs_meta_keywords }}"
                      placeholder="Enter Meta Keywords"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta Description For Blogs Page') }}</label>
                    <textarea
                      class="form-control"
                      name="blogs_meta_description"
                      rows="5"
                      placeholder="Enter Meta Description"
                    >{{ $data->blogs_meta_description }}</textarea>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta Keywords For Services Page') }}</label>
                    <input
                      class="form-control"
                      name="services_meta_keywords"
                      value="{{ $data->services_meta_keywords }}"
                      placeholder="Enter Meta Keywords"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta Description For Services Page') }}</label>
                    <textarea
                      class="form-control"
                      name="services_meta_description"
                      rows="5"
                      placeholder="Enter Meta Description"
                    >{{ $data->services_meta_description }}</textarea>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta Keywords For Portfolios Page') }}</label>
                    <input
                      class="form-control"
                      name="portfolios_meta_keywords"
                      value="{{ $data->portfolios_meta_keywords }}"
                      placeholder="Enter Meta Keywords"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta Description For Portfolios Page') }}</label>
                    <textarea
                      class="form-control"
                      name="portfolios_meta_description"
                      rows="5"
                      placeholder="Enter Meta Description"
                    >{{ $data->portfolios_meta_description }}</textarea>
                  </div>
                </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="form">
              <div class="row">
                <div class="col-12 text-center">
                  <button
                    type="submit"
                    class="btn btn-success {{ $data == null ? 'd-none' : '' }}"
                  >{{ __('Update') }}</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

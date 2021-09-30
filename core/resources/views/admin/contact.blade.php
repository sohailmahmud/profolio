@extends('admin.layout')

@php
$selLang = \App\Models\Language::where('code', request()->input('language'))->first();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form:not(.modal-form) input,
    form:not(.modal-form) textarea,
    form:not(.modal-form) select,
    select[name='language'] {
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
    <h4 class="page-title">Contact Page</h4>
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
        <a href="#">Contact Page</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form   enctype="multipart/form-data" action="{{route('admin.contact.update', $lang_id)}}" method="POST">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card-title">Contact Page</div>
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
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
              
                <div class="form-group">
                  <label>Form Title **</label>
                  <input class="form-control" name="contact_form_title" value="{{$abs->contact_form_title}}" placeholder="Enter form Titlte">
                  @if ($errors->has('contact_form_title'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_form_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Information Title **</label>
                  <input class="form-control" name="contact_info_title" value="{{$abs->contact_info_title}}" placeholder="Enter Information Titlte">
                  @if ($errors->has('contact_info_title'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_info_title')}}</p>
                  @endif
                </div>
               
                <div class="form-group">
                  <label>Address **</label>
                  <textarea class="form-control" name="contact_addresses" rows="4" placeholder="Enter Address">{{$abe->contact_addresses}}</textarea>
                  <div class="text-warning">Use newline to seperate multiple addresses.</div>
                  @if ($errors->has('contact_addresses'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_addresses')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Contact Information Text **</label>
                  <input class="form-control" name="contact_text" value="{{$abs->contact_text}}" placeholder="Enter Information text">
                  @if ($errors->has('contact_text'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_text')}}</p>
                  @endif
                </div>

               
                <div class="form-group">
                  <label>Phone **</label>
                  <input class="form-control" data-role="tagsinput" name="contact_numbers" value="{{$abe->contact_numbers}}" placeholder="Enter Phone Number">
                  <div class="text-warning">Use comma (,) to add multiple Phone Numbers</div>
                  @if ($errors->has('contact_numbers'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_numbers')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Email **</label>
                  <input class="form-control ltr" data-role="tagsinput"  name="contact_mails" value="{{$abe->contact_mails}}" placeholder="Enter Email Addresses">
                  <div class="text-warning">Use comma (,) to add multiple Email Addresses</div>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer pt-3">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button id="displayNotif" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

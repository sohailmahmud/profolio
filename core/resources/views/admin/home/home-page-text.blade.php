@extends('admin.layout')

@if(!empty($abs->language) && $abs->language->rtl == 1)
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
    <h4 class="page-title">Section Titles</h4>
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
        <a href="#">Section Titles</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Update Section Titles</div>
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
            <div class="col-lg-8 offset-lg-2">

              <form id="ajaxForm" action="{{route('admin.home.page.text.update', $lang_id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Feature Section Title</label>
                        <input type="hidden" name="types[]" value="feature_title">
                        <input name="feature_title" class="form-control" value="{{$abs->feature_title}}">
                        <p id="errfeature_title" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Work Process Section Title</label>
                      <input type="hidden" name="types[]" value="work_process_title">
                      <input name="work_process_title" class="form-control" value="{{$abs->work_process_title}}">
                      <p id="errwork_process_title" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Work Process Section Subtitle</label>
                       <input type="hidden" name="types[]" value="work_process_subtitle">
                      <input name="work_process_subtitle" class="form-control" value="{{$abs->work_process_subtitle}}">
                      <p id="errwork_process_subtitle" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Featured Users Section Title **</label>
                        <input type="hidden" name="types[]" value="featured_users_title">
                        <input name="featured_users_title" class="form-control" value="{{$abs->featured_users_title}}">
                        <p id="errfeatured_users_title" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">  
                    <div class="form-group">
                        <label for="">Featured Users Section Subtitle **</label>
                        <input type="hidden" name="types[]" value="featured_users_subtitle">
                        <input name="featured_users_subtitle" class="form-control" value="{{$abs->featured_users_subtitle}}">
                        <p id="errfeatured_users_subtitle" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Pricing Section Title **</label>
                      <input type="hidden" name="types[]" value="pricing_title">
                      <input name="pricing_title" class="form-control" value="{{$abs->pricing_title}}">
                      <p id="errpricing_title" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Pricing Section Subtitle **</label>
                      <input type="hidden" name="types[]" value="pricing_subtitle">
                      <input name="pricing_subtitle" class="form-control" value="{{$abs->pricing_subtitle}}">
                      <p id="errpricing_subtitle" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Testimonial Section Title **</label>
                      <input type="hidden" name="types[]" value="testimonial_title">
                      <input name="testimonial_title" class="form-control" value="{{$abs->testimonial_title}}">
                      <p id="errtestimonial_title" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                </div>  

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Testimonial Section Subtitle **</label>
                        <input type="hidden" name="types[]" value="testimonial_subtitle">
                        <input name="testimonial_subtitle" class="form-control" value="{{$abs->testimonial_subtitle}}">
                        <p id="errtestimonial_subtitle" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Blog Section Title **</label>
                      <input type="hidden" name="types[]" value="blog_title">
                      <input name="blog_title" class="form-control" value="{{$abs->blog_title}}">
                      <p id="errblog_title" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                </div>
                  
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Blog Section Subtitle **</label>
                      <input type="hidden" name="types[]" value="blog_subtitle">
                      <input name="blog_subtitle" class="form-control" value="{{$abs->blog_subtitle}}">
                      <p id="errblog_subtitle" class="em text-danger mb-0"></p>
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

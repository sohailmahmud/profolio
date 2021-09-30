@extends('admin.layout')
@section('content')
<div class="page-header">
   <h4 class="page-title">Plugins</h4>
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
         <a href="#">Basic Settings</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">Plugins</a>
      </li>
   </ul>
</div>
<div class="row">
   <div class="col-md-12">
      <form id="scriptForm" class="" action="{{route('admin.script.update')}}" method="post">
         @csrf
         <div class="row">

            <div class="col-lg-4">
                <div class="card">
                   <div class="card-header">
                      <div class="card-title">
                         Google Recaptcha
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="form-group">
                         <label>Google Recaptcha Status</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_recaptcha" value="1" class="selectgroup-input" {{$data->is_recaptcha == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Active</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_recaptcha" value="0" class="selectgroup-input" {{$data->is_recaptcha == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Deactive</span>
                            </label>
                         </div>
                         @if ($errors->has('is_recaptcha'))
                         <p class="mb-0 text-danger">{{$errors->first('is_recaptcha')}}</p>
                         @endif
                      </div>
                      <div class="form-group">
                         <label>Google Recaptcha Site key</label>
                         <input class="form-control" name="google_recaptcha_site_key" value="{{$data->google_recaptcha_site_key}}">
                         @if ($errors->has('google_recaptcha_site_key'))
                         <p class="mb-0 text-danger">{{$errors->first('google_recaptcha_site_key')}}</p>
                         @endif
                      </div>
                      <div class="form-group">
                         <label>Google Recaptcha Secret key</label>
                         <input class="form-control" name="google_recaptcha_secret_key" value="{{$data->google_recaptcha_secret_key}}">
                         @if ($errors->has('google_recaptcha_secret_key'))
                         <p class="mb-0 text-danger">{{$errors->first('google_recaptcha_secret_key')}}</p>
                         @endif
                      </div>
                   </div>
                </div>
             </div>

             <div class="col-lg-4">
                <div class="card">
                   <div class="card-header">
                      <div class="card-title">Disqus</div>
                   </div>
                   <div class="card-body">
                      <div class="form-group">
                         <label>Disqus Status (Website Blog Details)</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_disqus" value="1" class="selectgroup-input" {{$data->is_disqus == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Active</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_disqus" value="0" class="selectgroup-input" {{$data->is_disqus == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Deactive</span>
                            </label>
                         </div>
                         @if ($errors->has('is_disqus'))
                         <p class="mb-0 text-danger">{{$errors->first('is_disqus')}}</p>
                         @endif
                      </div>
                      <div class="form-group">
                         <label>Disqus Status (User Profile Blog Details)</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_user_disqus" value="1" class="selectgroup-input" {{$data->is_user_disqus == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Active</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_user_disqus" value="0" class="selectgroup-input" {{$data->is_user_disqus == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Deactive</span>
                            </label>
                         </div>
                         @if ($errors->has('is_user_disqus'))
                         <p class="mb-0 text-danger">{{$errors->first('is_user_disqus')}}</p>
                         @endif
                      </div>
                      <div class="form-group">
                         <label>Disqus Shortname</label>
                         <input class="form-control" name="disqus_shortname" value="{{$data->disqus_shortname}}">
                         @if ($errors->has('disqus_shortname'))
                         <p class="mb-0 text-danger">{{$errors->first('disqus_shortname')}}</p>
                         @endif
                      </div>
                   </div>
                </div>
             </div>

             <div class="col-lg-4">
                <div class="card">
                   <div class="card-header">
                      <div class="card-title">Tawk.to</div>
                   </div>
                   <div class="card-body">
                      <div class="form-group">
                         <label>Tawk.to Status</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_tawkto" value="1" class="selectgroup-input" {{$data->is_tawkto == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Active</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_tawkto" value="0" class="selectgroup-input" {{$data->is_tawkto == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Deactive</span>
                            </label>
                         </div>
                         <p class="mb-0 text-warning">If you enable Tawk.to, then WhatsApp must be disabled.</p>
                         @if ($errors->has('is_tawkto'))
                         <p class="mb-0 text-danger">{{$errors->first('is_tawkto')}}</p>
                         @endif
                      </div>
                      <div class="form-group">
                         <label>Tawk.to Direct Chat Link</label>
                         <input class="form-control" name="tawkto_property_id" value="{{$data->tawkto_property_id}}">
                         @if ($errors->has('tawkto_property_id'))
                         <p class="mb-0 text-danger">{{$errors->first('tawkto_property_id')}}</p>
                         @endif
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-lg-4">
                <div class="card">
                   <div class="card-header">
                      <div class="card-title">WhatsApp Chat Button</div>
                   </div>
                   <div class="card-body">
                      <div class="form-group">
                         <label>Status</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_whatsapp" value="1" class="selectgroup-input" {{$data->is_whatsapp == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Active</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_whatsapp" value="0" class="selectgroup-input" {{$data->is_whatsapp == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Deactive</span>
                            </label>
                         </div>
                         <p class="text-warning mb-0">If you enable WhatsApp, then Tawk.to must be disabled.</p>
                      </div>
                      <div class="form-group">
                         <label>WhatsApp Number</label>
                         <input class="form-control" type="text" name="whatsapp_number" value="{{$data->whatsapp_number}}">
                         <p class="text-warning mb-0">Enter Phone number with Country Code</p>
                      </div>
                      <div class="form-group">
                         <label>WhatsApp Header Title</label>
                         <input class="form-control" type="text" name="whatsapp_header_title" value="{{$data->whatsapp_header_title}}">
                         @if ($errors->has('whatsapp_header_title'))
                         <p class="mb-0 text-danger">{{$errors->first('whatsapp_header_title')}}</p>
                         @endif
                      </div>
                      <div class="form-group">
                         <label>WhatsApp Popup Message</label>
                         <textarea class="form-control" name="whatsapp_popup_message" rows="2">{{$data->whatsapp_popup_message}}</textarea>
                         @if ($errors->has('whatsapp_popup_message'))
                         <p class="mb-0 text-danger">{{$errors->first('whatsapp_popup_message')}}</p>
                         @endif
                      </div>
                      <div class="form-group">
                         <label>Popup</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="whatsapp_popup" value="1" class="selectgroup-input" {{$data->whatsapp_popup == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Active</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="whatsapp_popup" value="0" class="selectgroup-input" {{$data->whatsapp_popup == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Deactive</span>
                            </label>
                         </div>
                         @if ($errors->has('whatsapp_popup'))
                         <p class="mb-0 text-danger">{{$errors->first('whatsapp_popup')}}</p>
                         @endif
                      </div>
                   </div>
                </div>
             </div>
         </div>
         <div class="card">
            <div class="card-footer">
               <div class="form">
                  <div class="form-group from-show-notify row">
                     <div class="col-12 text-center">
                        <button type="submit" form="scriptForm" class="btn btn-success">Update</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection

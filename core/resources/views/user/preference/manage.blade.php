@extends('user.layout')
@php
    use App\Http\Helpers\UserPermissionHelper;
    use App\Models\Language;
    use Illuminate\Support\Carbon;
    $default = Language::where('is_default', 1)->first();
    $user = Auth::guard('web')->user();
    if (!empty($user)) {
      $permissions = UserPermissionHelper::packagePermission($user->id);
      $permissions = json_decode($permissions, true);
      $currentPackage = UserPermissionHelper::userPackage($user->id);
      $preferences = \App\Models\User\UserPermission::where([
          ['user_id',auth()->id()],
          ['package_id',$currentPackage->package_id],
          ])
          ->whereBetween('updated_at',[$currentPackage->start_date,$currentPackage->expire_date])
          ->first();
      $preferences = isset($preferences) ? json_decode($preferences->permissions, true) : [];
    }
@endphp
@section('content')
    <div class="page-header">
        <h4 class="page-title">Preference</h4>
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
                <a href="#">User</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Preference</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">Preference</div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <form id="permissionsForm" class="" action="{{route('user.preference.update')}}"
                                  method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="selectgroup selectgroup-pills mt-2">
                                        @if(in_array('Follow/Unfollow', $permissions))
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Follow/Unfollow"
                                                       class="selectgroup-input"
                                                       @if(in_array('Follow/Unfollow', $preferences)) checked @endif>
                                                <span class="selectgroup-button">Follow/Unfollow</span>
                                            </label>
                                        @endif
                                        @if(in_array('Blog', $permissions))
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Blog"
                                                       class="selectgroup-input"
                                                       @if(in_array('Blog',$preferences)) checked @endif>
                                                <span class="selectgroup-button">Blog</span>
                                            </label>
                                        @endif
                                        @if(in_array('Portfolio', $permissions))
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Portfolio"
                                                       class="selectgroup-input"
                                                       @if(in_array('Portfolio', $preferences)) checked @endif>
                                                <span class="selectgroup-button">Portfolio</span>
                                            </label>
                                        @endif
                                        @if(in_array('Achievements', $permissions))
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Achievements"
                                                       class="selectgroup-input"
                                                       @if(in_array('Achievements', $preferences)) checked @endif>
                                                <span class="selectgroup-button">Achievements</span>
                                            </label>
                                        @endif
                                        @if(in_array('Skill', $permissions))
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Skill"
                                                       class="selectgroup-input"
                                                       @if(in_array('Skill', $preferences)) checked @endif>
                                                <span class="selectgroup-button">Skill</span>
                                            </label>
                                        @endif
                                        @if(in_array('Service', $permissions))
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Service"
                                                       class="selectgroup-input"
                                                       @if(in_array('Service', $preferences)) checked @endif>
                                                <span class="selectgroup-button">Service</span>
                                            </label>
                                        @endif
                                        @if(in_array('Experience', $permissions))
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Experience"
                                                       class="selectgroup-input"
                                                       @if(in_array('Experience', $preferences)) checked @endif>
                                                <span class="selectgroup-button">Experience</span>
                                            </label>
                                        @endif
                                        @if(in_array('Testimonial', $permissions))
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Testimonial"
                                                       class="selectgroup-input"
                                                       @if(in_array('Testimonial', $preferences)) checked @endif>
                                                <span class="selectgroup-button">Testimonial</span>
                                            </label>
                                        @endif
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="permissions[]" value="Contact"
                                                   class="selectgroup-input"
                                                   @if(in_array('Contact', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Contact</span>
                                        </label>
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
                                <button type="submit" id="permissionBtn" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

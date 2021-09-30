@extends('admin.layout')

@section('pagename')
 - {{__('Edit Profile')}}
@endsection

@section('content')
  <div class="page-header">
    <h4 class="page-title">Profile</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="#">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Profile Settings</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Profile</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Update Profile</div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">

               <form action="{{route('admin.updateProfile')}}" method="post" role="form" enctype="multipart/form-data">
                 {{csrf_field()}}
                 <div class="form-body">
                    <div class="form-group">
                        <div class="col-12 mb-2">
                          <label for="image"><strong>Profile Image</strong></label>
                        </div>
                        <div class="col-md-12 showImage mb-3">
                          <img src="{{!empty(Auth::guard('admin')->user()->image) ? asset('assets/admin/img/propics/'.Auth::guard('admin')->user()->image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                        </div>
                        <input type="file" name="profile_image" id="image" class="form-control image">
                        <p id="errimage" class="mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                          <label>Username</label>
                        </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="username" value="{{$admin->username}}" placeholder="Your Username" type="text">
                          @if ($errors->has('username'))
                            <p class="text-danger mb-0">{{$errors->first('username')}}</p>
                          @endif
                       </div>
                    </div>
                     <div class="form-group">
                         <div class="col-md-12">
                           <label>Email</label>
                         </div>
                        <div class="col-md-12">
                           <input class="form-control input-lg" name="email" value="{{$admin->email}}" placeholder="Your Email" type="text">
                           @if ($errors->has('email'))
                             <p class="text-danger mb-0">{{$errors->first('email')}}</p>
                           @endif
                        </div>
                     </div>
                    <div class="form-group">
                        <div class="col-md-12">
                          <label>First Name</label>
                        </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="first_name" value="{{$admin->first_name}}" placeholder="Your First Name" type="text">
                          @if ($errors->has('first_name'))
                            <p class="text-danger mb-0">{{$errors->first('first_name')}}</p>
                          @endif
                       </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                       <label>Last Name</label>
                      </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="last_name" value="{{$admin->last_name}}" placeholder="Your Last Name" type="last_name">
                          @if ($errors->has('last_name'))
                            <p class="text-danger mb-0">{{$errors->first('last_name')}}</p>
                          @endif
                       </div>
                    </div>
                    <div class="row">
                       <div class="col-md-12 text-center">
                          <button type="submit" class="btn btn-success">Submit</button>
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

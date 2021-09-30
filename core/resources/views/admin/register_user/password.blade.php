@extends('admin.layout')

@section('content')
<div class="page-header">
    <h4 class="page-title">Password</h4>
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
            <a href="#">Registered Users</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Password</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{route('register.user.updatePassword')}}" method="post" role="form">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title">Update Password ({{$user->username}})</div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('admin.register.user')}}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">New Password</label>
                                            <input type="password" class="form-control" placeholder="{{__('New Password')}}" name="npass" value="{{Request::old('npass')}}">
                                            @error('npass')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="{{__('Confirm Password')}}" name="cfpass" value="{{Request::old('cfpass')}}">
                                            @error('cfpass')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
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

@endsection

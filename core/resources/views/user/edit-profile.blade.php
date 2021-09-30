@extends('user.layout')

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
        <h4 class="page-title">Edit Profile</h4>
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
                <a href="#">Edit Profile</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">Update Profile</div>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <form id="ajaxForm" class="" action="{{route('user-profile-update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-12 mb-2">
                                                <label for="image"><strong>Profile Image **</strong></label>
                                            </div>
                                            <div class="col-md-12 showImage mb-3">
                                                <img src="{{$user->photo ? asset('assets/front/img/user/'.$user->photo) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                                            </div>
                                            <input type="file" name="photo" id="image" class="form-control">
                                            <p id="errphoto" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">First Name **</label>
                                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Enter first name">
                                    <p id="errfirst_name" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name **</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Enter last name">
                                    <p id="errlast_name" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">User Name **</label>
                                    <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="Enter username">
                                    <p id="errusername" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone **</label>
                                    <input type="text" class="form-control" name="phone" value="{{$user->phone}}" placeholder="Enter phone">
                                    <p id="errphone" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Address **</label>
                                    <textarea type="text" class="form-control" name="address" rows="5">{{$user->address}}</textarea>
                                    <p id="erraddress" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">City **</label>
                                    <input type="text" class="form-control" name="city" rows="5" value="{{$user->city}}">
                                    <p id="errcity" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">State **</label>
                                    <input type="text" class="form-control" name="state" rows="5" value="{{$user->state}}">
                                    <p id="errstate" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Country **</label>
                                    <input type="text" class="form-control" name="country" rows="5" value="{{$user->country}}">
                                    <p id="errcountry" class="mb-0 text-danger em"></p>
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
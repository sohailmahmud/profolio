@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">
        Registered Users
    </h4>
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
        <a href="#">Registered Users</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-title">
                        Registered Users
                    </div>
                </div>
                <div class="col-lg-6 mt-2 mt-lg-0">
                    <button class="btn btn-danger float-lg-right float-none btn-sm ml-2 mt-1 d-none bulk-delete" data-href="{{route('register.user.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
                    <form action="{{url()->full()}}" class="float-lg-right float-none">
                        <input type="text" name="term" class="form-control min-w-250" value="{{request()->input('term')}}" placeholder="Search by Username / Email">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($users) == 0)
                <h3 class="text-center">NO USER FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Email Status</th>
                        <th scope="col">Account</th>
                        <td scope="col">Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $key => $user)
                        <tr>
                          <td>
                              <input type="checkbox" class="bulk-check" data-val="{{$user->id}}">
                          </td>
                          <td>{{$user->username}}</td>
                          <td>{{$user->email}}</td>

                          <td>
                              <form id="userFrom{{$user->id}}" class="d-inline-block" action="{{route('register.user.featured')}}" method="post">
                                  @csrf
                                  <select class="form-control {{$user->featured == 1 ? 'bg-success' : 'bg-danger'}}"
                                          name="featured" onchange="document.getElementById('userFrom{{$user->id}}').submit();">
                                      <option value="1" {{$user->featured == 1 ? 'selected' : ''}}>Yes</option>
                                      <option value="0" {{$user->featured == 0 ? 'selected' : ''}}>No</option>
                                  </select>
                                  <input type="hidden" name="user_id" value="{{$user->id}}">
                              </form>
                          </td>

                          <td>
                          <form id="emailForm{{$user->id}}" class="d-inline-block" action="{{route('register.user.email')}}" method="post">
                            @csrf
                            <select class="form-control form-control-sm {{strtolower($user->email_verified) == 1 ? 'bg-success' : 'bg-danger'}}" name="email_verified" onchange="document.getElementById('emailForm{{$user->id}}').submit();">
                                <option value="1" {{strtolower($user->email_verified) == 1 ? 'selected' : ''}}>Verified</option>
                                <option value="0" {{strtolower($user->email_verified) == 0 ? 'selected' : ''}}>Unverified</option>
                            </select>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            </form>
                          </td>

                          <td>
                          <form id="userFrom{{$user->id}}" class="d-inline-block" action="{{route('register.user.ban')}}" method="post">
                            @csrf
                            <select class="form-control form-control-sm {{$user->status == 1 ? 'bg-success' : 'bg-danger'}}" name="status" onchange="document.getElementById('userFrom{{$user->id}}').submit();">
                                <option value="1" {{$user->status == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{$user->status == 0 ? 'selected' : ''}}>Deactive</option>
                            </select>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            </form>
                          </td>
                          <td>
                            <div class="dropdown">
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('register.user.view',$user->id)}}">Details</a>
                                    <a class="dropdown-item" href="{{route('register.user.changePass',$user->id)}}">Change Password</a>
                                    <form class="deleteform d-block" action="{{route('register.user.delete')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <button type="submit" class="deletebtn">
                                        Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

              @endif
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="d-inline-block mx-auto">
              {{$users->appends(['term' => request()->input('term')])->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

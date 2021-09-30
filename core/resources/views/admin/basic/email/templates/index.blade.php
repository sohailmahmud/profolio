@extends('admin.layout')

@section('content')
<div class="page-header">
    <h4 class="page-title">
        Email Templates
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
          <a href="#">Basic Settings</a>
       </li>
       <li class="separator">
          <i class="flaticon-right-arrow"></i>
       </li>
       <li class="nav-item">
          <a href="#">Email Settings</a>
       </li>
       <li class="separator">
          <i class="flaticon-right-arrow"></i>
       </li>
       <li class="nav-item">
          <a href="#">Email Templates</a>
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
                      Email Templates
                   </div>
                </div>
             </div>
          </div>
          <div class="card-body">
             <div class="row">
                <div class="col-lg-12">
                    @if (count($templates) == 0)
                        <h3 class="text-center">NO ORDER FOUND</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Email Type</th>
                                        <th scope="col">Email Subject</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($templates as $template)
                                        <tr>
                                            <td>{{$template->email_type}}</td>
                                            <td>{{$template->email_subject}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" href="{{route('admin.email.editTemplate', $template->id)}}"><i class="far fa-edit"></i> Edit</a>
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
       </div>
    </div>
 </div>
@endsection

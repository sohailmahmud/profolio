@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Edit Email Template</h4>
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
        <a href="#">Edit Email Template</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Email Template</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.email.templates')}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <table class="table table-striped mb-5 border" >
                    <thead>
                      <tr>
                        <th class="text-white" scope="col">BB Code</th>
                        <th class="text-white" scope="col">Meaning</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td>
                            {customer_name}
                          </td>
                          <th scope="row">
                            Customer Name
                          </th>
                        </tr>

                        @if ($template->email_type == 'email_verification')
                        <tr>
                            <td>
                              {verification_link}
                            </td>
                            <th scope="row">
                              Verification Link
                            </th>
                        </tr>
                        @endif

                        @if ($template->email_type == 'order_received' || $template->email_type == 'order_preparing' || $template->email_type == 'order_ready_to_pick_up' || $template->email_type == 'order_picked_up' || $template->email_type == 'order_delivered' || $template->email_type == 'order_cancelled')

                        <tr>
                          <td>
                            {order_number}
                          </td>
                          <th scope="row">
                            Order Number
                          </th>
                        </tr>
                        <tr>
                          <td>
                            {order_link}
                          </td>
                          <th scope="row">
                            Order Link
                          </th>
                        </tr>

                        @endif
                        <tr>
                          <td>
                            {website_title}
                          </td>
                          <th scope="row">
                            Website Title
                          </th>
                        </tr>
                    </tbody>
                </table>

              <form id="ajaxForm" action="{{route('admin.email.templateUpdate', $template->id)}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                           <label for="">Email Type **</label>
                           <input type="text" class="form-control" name="email_type" placeholder="Email Type" value="{{$template->email_type}}" readonly>
                           <p id="erremail_type" class="mb-0 text-danger em"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                           <label for="">Email Subject **</label>
                           <input type="text" class="form-control" name="email_subject"  placeholder="Email Subject" value="{{$template->email_subject}}">
                           <p id="erremail_subject" class="mb-0 text-danger em"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                   <div class="col-lg-12">
                      <div class="form-group">
                         <label for="">Email Body **</label>
                         <textarea class="form-control summernote" name="email_body" placeholder="Enter description" data-height="300">{{$template->email_body}}</textarea>
                         <p id="erremail_body" class="mb-0 text-danger em"></p>
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

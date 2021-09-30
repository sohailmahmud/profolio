@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Subscribers</h4>
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
        <a href="#">Subscribers</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Subscribers</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <div class="card-title d-inline-block">Subscribers</div>
                </div>
                <div class="col-6 mt-2 mt-lg-0">
                    <button class="btn btn-danger float-right btn-sm ml-2 mt-1 d-none bulk-delete" data-href="{{route('admin.subscriber.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
                    <form action="{{url()->full()}}" class="float-right">
                        <input type="text" name="term" class="form-control" value="{{request()->input('term')}}" placeholder="Search by Email">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($subscs) == 0)
                <h3 class="text-center">NO SUBSCRIBER FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">email</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($subscs as $key => $subsc)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{$subsc->id}}">
                          </td>
                          <td>{{$subsc->email}}</td>
                          <td>
                            <form class="deleteform d-inline-block" action="{{route('admin.subscriber.delete')}}" method="post">
                                @csrf
                                <input type="hidden" name="subscriber_id" value="{{$subsc->id}}">
                                <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                    <i class="fas fa-trash"></i>
                                </span>
                                Delete
                                </button>
                            </form>
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
                {{$subscs->appends(['term' => request()->input('term')])->links()}}
              </div>
            </div>
        </div>

      </div>
    </div>
  </div>

@endsection

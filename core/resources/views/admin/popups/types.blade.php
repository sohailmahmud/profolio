@extends('admin.layout')
@section('content')

<div class="page-header">
   <h4 class="page-title">Choose a Popup Type</h4>
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
         <a href="#">Announcement Popup</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">Types</a>
      </li>
   </ul>
</div>
<div class="product-type">

    <div class="row">
        <div class="col-lg-3">
            <a href="{{route('admin.popup.create') . '?type=1'}}" class="d-block">
                <div class="card card-stats">
                    <div class="card-body ">
                        <img src="{{asset('assets/admin/img/popups/popup-1.jpg')}}" alt="" width="100%">
                        <h5 class="text-center text-white mt-2 mb-0">Type - 1</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{route('admin.popup.create') . '?type=2'}}" class="d-block">
                <div class="card card-stats">
                    <div class="card-body ">
                        <img src="{{asset('assets/admin/img/popups/popup-2.jpg')}}" alt="" width="100%">
                        <h5 class="text-center text-white mt-2 mb-0">Type - 2</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{route('admin.popup.create') . '?type=3'}}" class="d-block">
                <div class="card card-stats">
                    <div class="card-body ">
                        <img src="{{asset('assets/admin/img/popups/popup-3.jpg')}}" alt="" width="100%">
                        <h5 class="text-center text-white mt-2 mb-0">Type - 3</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{route('admin.popup.create') . '?type=4'}}" class="d-block">
                <div class="card card-stats">
                    <div class="card-body ">
                        <img src="{{asset('assets/admin/img/popups/popup-4.jpg')}}" alt="" width="100%">
                        <h5 class="text-center text-white mt-2 mb-0">Type - 4</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{route('admin.popup.create') . '?type=5'}}" class="d-block">
                <div class="card card-stats">
                    <div class="card-body ">
                        <img src="{{asset('assets/admin/img/popups/popup-5.jpg')}}" alt="" width="100%">
                        <h5 class="text-center text-white mt-2 mb-0">Type - 5</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{route('admin.popup.create') . '?type=6'}}" class="d-block">
                <div class="card card-stats">
                    <div class="card-body ">
                        <img src="{{asset('assets/admin/img/popups/popup-6.jpg')}}" alt="" width="100%">
                        <h5 class="text-center text-white mt-2 mb-0">Type - 6</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{route('admin.popup.create') . '?type=7'}}" class="d-block">
                <div class="card card-stats">
                    <div class="card-body ">
                        <img src="{{asset('assets/admin/img/popups/popup-7.jpg')}}" alt="" width="100%">
                        <h5 class="text-center text-white mt-2 mb-0">Type - 7</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

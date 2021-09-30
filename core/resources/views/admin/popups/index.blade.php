@extends('admin.layout')

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
    <h4 class="page-title">Popups</h4>
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
        <a href="#">Announcement Popup</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Popups</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-title d-inline-block">Announcement Popups</div>
                </div>
                <div class="col-lg-3">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                    <a href="{{route('admin.popup.types')}}" class="btn btn-primary float-right btn-sm"><i class="fas fa-plus"></i> Add Popup</a>
                    <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('admin.popup.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($popups) == 0)
                <h3 class="text-center">NO POPUP FOUND</h3>
              @else
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="alert alert-warning text-dark">
                            All <strong class="text-info">Activated Popups</strong> will be shown in website according to <strong class="text-info">Serial Number</strong>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Type</th>
                        <th scope="col">Serial Number</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($popups as $key => $popup)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{$popup->id}}">
                          </td>
                          <td>
                              <div class="mb-2">
                                  @if (!empty($popup->image))
                                      <img src="{{asset('assets/front/img/popups/' . $popup->image)}}" width="65">
                                  @elseif (!empty($popup->background_image))
                                    <img src="{{asset('assets/front/img/popups/' . $popup->background_image)}}" width="65">
                                  @endif
                              </div>
                          </td>
                          <td>{{strlen($popup->name) > 20 ? mb_substr($popup->name,0,20,'utf-8') . '...' : $popup->name}}</td>
                          <td>
                            <form id="statusForm{{$popup->id}}" class="d-inline-block" action="{{route('admin.popup.status')}}" method="post">
                                @csrf
                                <input type="hidden" name="popup_id" value="{{$popup->id}}">
                                <select class="form-control form-control-sm
                                @if ($popup->status == 1)
                                  bg-success
                                @elseif ($popup->status == 0)
                                  bg-danger
                                @endif
                                " name="status" onchange="document.getElementById('statusForm{{$popup->id}}').submit();">
                                  <option value="1" {{$popup->status == 1 ? 'selected' : ''}}>Active</option>
                                  <option value="0" {{$popup->status == 0 ? 'selected' : ''}}>Deactive</option>
                                </select>
                              </form>
                          </td>
                          <td>
                              <img width="60" src="{{asset('assets/admin/img/popups/popup-' . $popup->type . '.jpg')}}">
                              <p class="mb-0">
                                Type - {{$popup->type}}
                              </p>
                          </td>
                          <td>{{$popup->serial_number}}</td>
                          <td>
                            <a class="btn btn-secondary btn-sm" href="{{route('admin.popup.edit', $popup->id) . "?language=" . request()->input('language')}}">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.popup.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="popup_id" value="{{$popup->id}}">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
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
      </div>
    </div>
  </div>

@endsection

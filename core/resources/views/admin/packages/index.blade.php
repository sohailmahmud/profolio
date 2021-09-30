@extends('admin.layout')

@php
    use App\Models\Language;
    $selLang = Language::where('code', request()->input('language'))->first();
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
        <h4 class="page-title">Packages</h4>
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
                <a href="#">Packages</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">Package Page</div>
                        </div>
                        <div class="col-lg-4 offset-lg-4 mt-2 mt-lg-0">
                            <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                               data-target="#createModal"><i class="fas fa-plus"></i>
                                Add Package</a>
                            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
                                    data-href="{{route('admin.package.bulk.delete')}}"><i
                                    class="flaticon-interface-5"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (count($packages) == 0)
                                <h3 class="text-center">NO PACKAGE FOUND YET</h3>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="basic-datatables">
                                        <thead>
                                        <tr>
                                            <th scope="col">
                                                <input type="checkbox" class="bulk-check" data-val="all">
                                            </th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Cost</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($packages as $key => $package)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="bulk-check"
                                                           data-val="{{$package->id}}">
                                                </td>
                                                <td>{{strlen($package->title) > 30 ? mb_substr($package->title, 0, 30, 'UTF-8') . '...' : $package->title}}</td>
                                                <td>
                                                    @if($package->price == 0)
                                                        Free
                                                    @else
                                                        {{format_price($package->price)}}
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($package->status == 1)
                                                        <h2 class="d-inline-block">
                                                            <span class="badge badge-success">Active</span>
                                                        </h2>
                                                    @else
                                                        <h2 class="d-inline-block">
                                                            <span class="badge badge-danger">Deactive</span>
                                                        </h2>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-secondary btn-sm"
                                                       href="{{route('admin.package.edit', $package->id) . '?language=' . request()->input('language')}}">
                                                           <span class="btn-label">
                                                             <i class="fas fa-edit"></i>
                                                           </span>
                                                           Edit
                                                    </a>
                                                    <form class="deleteform d-inline-block"
                                                          action="{{route('admin.package.delete')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="package_id" value="{{$package->id}}">
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
            </div>
        </div>
    </div>
    <!-- Create Blog Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="ajaxForm" enctype="multipart/form-data" class="modal-form"
                          action="{{route('admin.package.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Package title*</label>
                            <input id="title" type="text" class="form-control" name="title"
                                   placeholder="Enter Package title" value="">
                            <p id="errtitle" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="price">Price ({{$bex->base_currency_text}})*</label>
                            <input id="price" type="number" class="form-control" name="price"
                                   placeholder="Enter Package price" value="">
                            <p class="text-warning"><small>If price is 0 , than it will appear as free</small></p>
                            <p id="errprice" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="term">Package term*</label>
                            <select id="term" name="term" class="form-control" required>
                                <option value="" selected disabled>Choose a Package term</option>
                                <option value="monthly">{{__('monthly')}}</option>
                                <option value="yearly">{{__('yearly')}}</option>
                            </select>
                            <p id="errterm" class="mb-0 text-danger em"></p>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Package Features</label>
                            <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Follow/Unfollow" class="selectgroup-input">
                                    <span class="selectgroup-button">Follow/Unfollow</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Blog" class="selectgroup-input">
                                    <span class="selectgroup-button">Blog</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Portfolio" class="selectgroup-input">
                                    <span class="selectgroup-button">Portfolio</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Achievements" class="selectgroup-input">
                                    <span class="selectgroup-button">Achievements</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Skill" class="selectgroup-input">
                                    <span class="selectgroup-button">Skill</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Service" class="selectgroup-input">
                                    <span class="selectgroup-button">Service</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Experience" class="selectgroup-input">
                                    <span class="selectgroup-button">Experience</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Testimonial" class="selectgroup-input">
                                    <span class="selectgroup-button">Testimonial</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Featured *</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="featured" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button">Yes</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="featured" value="0" class="selectgroup-input" checked>
                                    <span class="selectgroup-button">No</span>
                                </label>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="form-label">Trial *</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_trial" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button">Yes</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_trial" value="0" class="selectgroup-input" checked>
                                    <span class="selectgroup-button">No</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group" id="trial_day" style="display: none">
                            <label for="trial_days">Trial days*</label>
                            <input id="trial_days" type="number" class="form-control" name="trial_days"
                                   placeholder="Enter trial days" value="">
                            <p id="errtrial_days" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('Status')}}*</label>
                            <select id="status" class="form-control ltr" name="status">
                                <option value="" selected disabled>Select a status</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            <p id="errstatus" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="">{{__('Meta Keywords')}}</label>
                            <input type="text" class="form-control" name="meta_keywords" value="" data-role="tagsinput">
                        </div>
                        <div class="form-group">
                            <label for="meta_description">{{__('Meta Description')}}</label>
                            <textarea id="meta_description" type="text" class="form-control" name="meta_description"
                                      rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/admin/js/packages.js')}}"></script>
@endsection

@extends('user.layout')

@if(!empty($portfolio->language) && $portfolio->language->rtl == 1)
@section('styles')
    <style>
        form input,
        form textarea,
        form select {
            direction: rtl;
        }

        form .note-editor.note-frame .note-editing-area .note-editable {
            direction: rtl;
            text-align: right;
        }
    </style>
@endsection
@endif

@section('content')
    <div class="page-header">
        <h4 class="page-title">Edit Portfolio</h4>
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
                <a href="#">Portfolio Page</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit Portfolio</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">Edit Portfolio</div>
                    <a class="btn btn-info btn-sm float-right d-inline-block"
                       href="{{route('user.portfolio.index') . '?language=' . $portfolio->language->code}}">
                        <span class="btn-label">
                        <i class="fas fa-backward"></i>
                        </span>
                        Back
                    </a>
                </div>
                <div class="card-body pt-5 pb-5">

                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">

                            {{-- Slider images upload start --}}
                            <div class="px-2">
                                <label for="" class="mb-2"><strong>Slider Images **</strong></label>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped" id="imgtable">
                                        </table>
                                    </div>
                                </div>
                                <form action="{{route('user.portfolio.sliderstore')}}" id="my-dropzone" enctype="multipart/formdata" class="dropzone">
                                    @csrf
                                    <input type="hidden" name="portfolio_id" value="{{$portfolio->id}}">
                                </form>
                                <p class="em text-danger mb-0" id="errslider_images"></p>
                            </div>
                            {{-- Slider images upload end --}}

                            <form id="ajaxForm" class="" action="{{route('user.portfolio.update')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$portfolio->id}}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-12 mb-2">
                                                <label for="image"><strong>Image</strong></label>
                                            </div>
                                            <div class="col-md-12 showImage mb-3">
                                                <img
                                                    src="{{isset($portfolio->image) ? asset('assets/front/img/user/portfolios/'.$portfolio->image) : asset('assets/admin/img/noimage.jpg')}}"
                                                    alt="..." class="img-thumbnail">
                                            </div>
                                            <input type="file" name="image" id="image" class="form-control">
                                            <p id="errimage" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Title **</label>
                                    <input type="text" class="form-control" name="title" value="{{$portfolio->title}}"
                                           placeholder="Enter title">
                                    <p id="errtitle" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Category **</label>
                                    <select class="form-control" name="category">
                                        <option value="" selected disabled>Select a category</option>
                                        @foreach ($categories as $key => $category)
                                            <option
                                                value="{{$category->id}}" {{$category->id == $portfolio->bcategory->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <p id="errcategory" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Content **</label>
                                    <textarea class="form-control summernote" name="content" data-height="300"
                                              placeholder="Enter content">{{ replaceBaseUrl($portfolio->content) }}</textarea>
                                    <p id="errcontent" class="mb-0 text-danger em"></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Serial Number **</label>
                                    <input type="number" class="form-control ltr" name="serial_number"
                                           value="{{$portfolio->serial_number}}" placeholder="Enter Serial Number">
                                    <p id="errserial_number" class="mb-0 text-danger em"></p>
                                    <p class="text-warning"><small>The higher the serial number is, the later the
                                            portfolio will be shown.</small></p>
                                </div>
                                <div class="form-group">
                                    <label for="featured" class="my-label mr-3">Featured</label>
                                    <input id="featured" type="checkbox" name="featured"
                                           value="1" {{$portfolio->featured == 1 ? "checked": ""}}>
                                    <p id="errfeatured" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta Keywords</label>
                                    <input type="text" class="form-control" name="meta_keywords"
                                           value="{{$portfolio->meta_keywords}}" data-role="tagsinput">
                                    <p id="errmeta_keywords" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta Description</label>
                                    <textarea type="text" class="form-control" name="meta_description"
                                              rows="5">{{$portfolio->meta_description}}</textarea>
                                    <p id="errmeta_description" class="mb-0 text-danger em"></p>
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


@section('scripts')
  {{-- dropzone --}}
  <script>
    "use strict";
    // myDropzone is the configuration for the element that has an id attribute
    // with the value my-dropzone (or myDropzone)
    Dropzone.options.myDropzone = {
        acceptedFiles: '.png, .jpg, .jpeg',
        url: "{{route('user.portfolio.sliderstore')}}",
        success : function(file, response){

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='rmv-btn'><i class='fa fa-times'></i></button>");


            // Capture the Dropzone instance as closure.
            var _this = this;

            // Listen to the click event
            removeButton.addEventListener("click", function(e) {
            // Make sure the button click doesn't submit the form:
            e.preventDefault();
            e.stopPropagation();

            rmvimg(response.file_id, _this, file);
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);

            var content = {};

            content.message = 'Slider images added successfully!';
            content.title = 'Success';
            content.icon = 'fa fa-bell';

            $.notify(content,{
            type: 'success',
            placement: {
                from: 'top',
                align: 'right'
            },
            time: 1000,
            delay: 1000,
            });
        }
    };

    function rmvimg(fileid, _this, file) {

        // If you want to the delete the file on the server as well,
        // you can do the AJAX request here.

          $.ajax({
            url: "{{route('user.portfolio.sliderrmv')}}",
            type: 'POST',
            data: {
              _token: "{{csrf_token()}}",
              fileid: fileid,
              type: 'edit'
            },
            success: function(data) {
                if(data == "minimum_one") {
                    var content = {};

                    content.message = 'Minimum one slider image is required!';
                    content.title = 'Warning';
                    content.icon = 'fa fa-bell';

                    $.notify(content,{
                      type: 'warning',
                      placement: {
                        from: 'top',
                        align: 'right'
                      },
                      time: 1000,
                      delay: 1000,
                    });

                } else {
                    _this.removeFile(file);

                    var content = {};

                    content.message = 'Slider image deleted successfully!';
                    content.title = 'Success';
                    content.icon = 'fa fa-bell';

                    $.notify(content,{
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    time: 1000,
                    delay: 1000,
                    });
                }
            }
          });

    }

  var el = 0;

  $(document).ready(function(){
    $.get("{{route('user.portfolio.images', $portfolio->id)}}", function(data){
        for (var i = 0; i < data.length; i++) {
          $("#imgtable").append('<tr class="trdb" id="trdb'+data[i].id+'"><td><div class="thumbnail"><img style="width:150px;" src="{{asset('assets/front/img/user/portfolios/')}}/'+data[i].image+'" alt="Ad Image"></div></td><td><button type="button" class="btn btn-danger pull-right rmvbtndb" onclick="rmvdbimg('+data[i].id+')"><i class="fa fa-times"></i></button></td></tr>');
        }
    });
  });

  function rmvdbimg(indb) {
    $(".request-loader").addClass("show");
    $.ajax({
      url: "{{route('user.portfolio.sliderrmv')}}",
      type: 'POST',
      data: {
        _token: "{{csrf_token()}}",
        fileid: indb,
        type: 'edit'
      },
      success: function(data) {
        $(".request-loader").removeClass("show");

        if(data == "minimum_one") {
            var content = {};

            content.message = 'Minimum one slider image is required!';
            content.title = 'Warning';
            content.icon = 'fa fa-bell';

            $.notify(content,{
                type: 'warning',
                placement: {
                from: 'top',
                align: 'right'
                },
                time: 1000,
                delay: 1000,
            });

        } else {

            $("#trdb"+indb).remove();
            var content = {};

            content.message = 'Slider image deleted successfully!';
            content.title = 'Success';
            content.icon = 'fa fa-bell';

            $.notify(content,{
              type: 'success',
              placement: {
                from: 'top',
                align: 'right'
              },
              time: 1000,
              delay: 1000,
            });
        }
      }
    });

  }

  </script>

@endsection

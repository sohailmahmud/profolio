
<script>
  "use strict";
  var mainurl =  "{{url('/')}}";
  var imgupload = "{{route('admin.summernote.upload')}}";
  var storeUrl = "";
  var removeUrl = "";
  var rmvdbUrl = "";
  var audio = new Audio("{{asset('assets/front/files/new-order-notification.mp3')}}");
</script>
<!--   Core JS Files   -->
<script src="{{asset('assets/admin/js/core/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugin/vue/vue.js')}}"></script>
<script src="{{asset('assets/admin/js/plugin/vue/axios.js')}}"></script>
<script src="{{asset('assets/admin/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('assets/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- jQuery Timepicker -->
<script src="{{asset('assets/front/js/jquery.timepicker.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('assets/admin/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- Bootstrap Tag Input -->
<script src="{{asset('assets/admin/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

<!-- Bootstrap Datepicker -->
<script src="{{asset('assets/admin/js/plugin/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

<!-- Datatable -->
<script src="{{asset('assets/admin/js/plugin/datatables.min.js')}}"></script>

<!-- Dropzone JS -->
<script src="{{asset('assets/admin/js/plugin/dropzone/jquery.dropzone.min.js')}}"></script>

<!-- Summernote JS -->
<script src="{{asset('assets/admin/js/plugin/summernote/summernote-bs4.js')}}"></script>

<!-- JS color JS -->
<script src="{{asset('assets/admin/js/plugin/jscolor/jscolor.js')}}"></script>

<!-- Select2 JS -->
<script src="{{asset('assets/admin/js/plugin/select2.min.js')}}"></script>

<!-- Atlantis JS -->
<script src="{{asset('assets/admin/js/atlantis.min.js')}}"></script>

<!-- Fontawesome Icon Picker JS -->
<script src="{{asset('assets/admin/js/plugin/fontawesome-iconpicker/fontawesome-iconpicker.min.js')}}"></script>

{{-- fonts and icons script --}}
<script src="{{ asset('assets/admin/js/plugin/webfont/webfont.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{asset('assets/admin/js/custom.js')}}"></script>

@yield('variables')
<!-- misc JS -->
<script src="{{asset('assets/admin/js/misc.js')}}"></script>

@yield('scripts')

@yield('vuescripts')

@if (session()->has('success'))
<script>
  "use strict";
  var content = {};

  content.message = '{{session('success')}}';
  content.title = 'Success';
  content.icon = 'fa fa-bell';

  $.notify(content,{
    type: 'success',
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    delay: 4000,
  });
</script>
@endif


@if (session()->has('warning'))
<script>
  "use strict";
  var content = {};

  content.message = '{{session('warning')}}';
  content.title = 'Warning!';
  content.icon = 'fa fa-bell';

  $.notify(content,{
    type: 'warning',
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    delay: 4000,
  });
</script>
@endif
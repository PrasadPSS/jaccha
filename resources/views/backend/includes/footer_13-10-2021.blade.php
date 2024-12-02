<footer class="footer footer-static footer-light">
  <p class="clearfix mb-0"><span class="float-left d-inline-block">{{ date('Y') }} &copy; DADREEIOS</span><span class="float-right d-sm-inline-block d-none">Crafted with<i class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase" href="http://www.parasightsolutions.com" target="_blank">Parasight Solutions</a></span>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
  </p>
</footer>
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('backend-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/extensions/swiper.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('backend-assets/js/scripts/configs/vertical-menu-dark.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/core/app-menu.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/core/app.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/scripts/components.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/scripts/footer.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/scripts/customizer.min.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('backend-assets/js/scripts/pages/dashboard-ecommerce.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/scripts/datatables/datatable.min.js') }}"></script>
<!-- <script src="{{ asset('backend-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/scripts/editors/editor-quill.min.js') }}"></script> -->
<script src="{{ asset('backend-assets/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

<script src="{{ asset('backend-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/scripts/forms/form-repeater.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>

<script src="{{ asset('backend-assets/js/scripts/pages/bootstrap-toast.min.js') }}"></script>

<script src="{{ asset('backend-assets/vendors/js/extensions/toastr.min.js') }}"></script>

<script src="{{ asset('backend-assets/js/scripts/extensions/toastr.min.js') }}"></script>

<script src="{{ asset('backend-assets/js/axios.min.js') }}"></script>

<script src="{{ asset('backend-assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/pickers/daterange/moment.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
<script src="{{ asset('backend-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js') }}"></script>
<!-- END: Page JS-->

<script>
$(document).ready(function(){

  if($("#editor").length != 0)
  {
    CKEDITOR.replace('editor', {
      height: 260,

    });
  }
  if($("#editor1").length != 0)
  {
    CKEDITOR.replace('editor1', {
      height: 260,

    });
  }
  if($("#editor2").length != 0)
  {
    CKEDITOR.replace('editor2', {
      height: 260,

    });
  }


});
</script>

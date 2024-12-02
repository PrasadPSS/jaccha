<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'SkinClinic MLM') }}</title>

<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
      WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
      });
</script>
<!-- Styles -->
<link rel="apple-touch-icon" href="{{ asset('backend-assets/images/ico/apple-icon-120.html') }}">
<link rel="shortcut icon" type="image/x-icon" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/charts/apexcharts.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/extensions/swiper.min.css') }}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/bootstrap-extended.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/colors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/components.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/themes/dark-layout.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/themes/semi-dark-layout.min.css') }}">
<!-- END: Theme CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/pages/dashboard-ecommerce.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/tables/datatable/datatables.min.css') }}">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/style.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/plugins/extensions/toastr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/css/pages/dashboard-analytics.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/editors/quill/katex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/editors/quill/quill.bubble.css') }}"> -->
<!-- END: Custom CSS-->

<!-- BEGIN: Vendor JS-->
<script src="{{ asset('backend-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('backend-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js') }}"></script>
<script src="{{ asset('backend-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js') }}"></script>
<script src="{{ asset('backend-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('backend-assets/vendors/css/forms/select/select2.min.css') }}">
<!-- BEGIN Vendor JS-->

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
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/parasight-mlm-skinclinic-backend.css') }}" rel="stylesheet">
<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<link href="{{ asset('resources/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors -->
<link href="{{ asset('resources/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('resources/assets/demo/demo9/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Base Styles -->

<link rel="shortcut icon" href="{{ asset('resources/assets/demo/demo9/media/img/logo/favicon.ico') }}" />
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('resources/assets/app/js/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/select2.full.js') }}"></script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<!-- <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> -->
@include('backend.includes.head')
</head>
<body class="m--skin- m-page--loading-enabled m-page--loading m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--offcanvas-default m-aside-left--enabled m-aside-left--fixed m-aside-left--skin-dark m-aside--offcanvas-default">
	<!-- end::Page Loader -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
</div>
	<!--begin::Base Scripts -->
<script src="{{ asset('resources/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('resources/assets/demo/demo9/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<!-- begin::Page Loader -->

</body>
</html>

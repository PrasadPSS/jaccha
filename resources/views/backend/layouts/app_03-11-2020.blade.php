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
	<!-- begin::Page loader -->
	<div class="m-page-loader m-page-loader--base">
		<div class="m-blockui">
			<span>
				Please wait...
			</span>
			<span>
				<div class="m-loader m-loader--brand"></div>
			</span>
		</div>
	</div>
	<!-- end::Page Loader -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		@include('backend.includes.header')
		@include('backend.includes.leftmenu')

		@yield('content')

	@include('backend.includes.footer')
</div>
	<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
	<i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->		    <!-- begin::Quick Nav -->
<!-- <ul class="m-nav-sticky" style="margin-top: 30px;"> -->
	<!--
	<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Showcase" data-placement="left">
		<a href="">
			<i class="la la-eye"></i>
		</a>
	</li>
	<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Pre-sale Chat" data-placement="left">
		<a href="" >
			<i class="la la-comments-o"></i>
		</a>
	</li>
	-->
	<!-- <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Purchase" data-placement="left">
		<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">
			<i class="la la-cart-arrow-down"></i>
		</a>
	</li>
	<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Documentation" data-placement="left">
		<a href="https://keenthemes.com/metronic/documentation.html" target="_blank">
			<i class="la la-code-fork"></i>
		</a>
	</li>
	<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Support" data-placement="left">
		<a href="https://keenthemes.com/forums/forum/support/metronic5/" target="_blank">
			<i class="la la-life-ring"></i>
		</a>
	</li>
</ul> -->
<!-- begin::Quick Nav -->
	<!--begin::Base Scripts -->
<script src="{{ asset('resources/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('resources/assets/demo/demo9/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->
		<!--begin::Page Vendors -->
<script src="{{ asset('resources/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
<!--end::Page Vendors -->
		<!--begin::Page Snippets -->

<!--end::Page Snippets -->
		<!-- begin::Page Loader -->
<script>
				$(window).on('load', function() {
						$('body').removeClass('m-page--loading');
				});
</script>
<!-- end::Page Loader -->

	<!-- Scripts -->
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script> -->
	@yield('scripts')
</body>
</html>

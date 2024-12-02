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
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									@yield('title')
								</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="{{url('/admin')}}" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">
										-
									</li>
									<li class="m-nav__item">
										<a href="{{ url('/admin')}}" class="m-nav__link">
											<span class="m-nav__link-text">
												Dashboard
											</span>
										</a>
									</li>
									<li class="m-nav__separator">
										-
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">
												@yield('title')
											</span>
										</a>
									</li>
								</ul>
							</div>
							<div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="javascript:void(0)" onclick="history.back();" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
										<i class="la la-plus m--hide"></i>
										<i class="la la-ellipsis back-btn">BACK</i>
									</a>

								</div>
							</div>
						</div>
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
						@include('backend.includes.errors')
						@yield('content')
					</div>
				</div>
			</div>
		</div>
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
<script src="{{ asset('resources/assets/app/js/dashboard.js') }}" type="text/javascript"></script>
<!--end::Page Snippets -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<!-- begin::Page Loader -->
<script src="{{ asset('ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-barcode.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/multiform.js') }}" type="text/javascript"></script>

<script>
				$(window).on('load', function() {
						$('body').removeClass('m-page--loading');
				});
</script>

<script>
    CKEDITOR.replace('editor1', {
      height: 260,
     
    });
  </script>
<!-- end::Page Loader -->
<script>
$(document).ready(function(){

	$(document).on("change",".period_type",function(){
var type=$(this).val();
var page='{{url("admin/monthlyreports/type")}}'
$.ajax({
type: 'post',
// dataType: 'json',
url: page,
data: {type: type},
success: function(data) {
	var months = $.parseJSON(data);
	// if(months.length > 0){
		$(".bonus_period").html('');
		$.each( months, function( key, value ) {
    $(".bonus_period").append('<option value="'+key+'">'+value+'</option>');
});
	// }
}
});

});

});
</script>
	<!-- Scripts -->
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script> -->
	@yield('scripts')
</body>
</html>

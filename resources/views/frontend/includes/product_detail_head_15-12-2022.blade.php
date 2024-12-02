@php
use App\Models\backend\FrontendImages;

$favicon = FrontendImages::where('image_code','favicon')->first();
@endphp
@if(isset($favicon->image_url))
	<link rel="icon" href="{{ asset('backend-assets/uploads/frontend_images/') }}/{{ $favicon->image_url }}" />
@else
	<link rel="icon" href="{{ asset('favicon1.png')}}"/>
@endif
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"/>
<!--Roboto font link-->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('frontend-assets/css/bootstrap.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend-assets/css/parasight_dadreeios.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend-assets/css/mega_menu.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend-assets/css/owl.carousel.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend-assets/css/owl.theme.default.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend-assets/font/flaticon.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend-assets/css/chosen.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/slick-theme.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/cloudzoom.css') }}"/>

<link rel="stylesheet" href="{{ asset('frontend-assets/css/toastr.min.css') }}"/>
<!--<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha384-JUMjoW8OzDJw4oFpWIB2Bu/c6768ObEthBMVSiIx4ruBIEdyNSUQAjJNFqT5pnJ6" crossorigin="anonymous"></script>-->
<script src="{{ asset('frontend-assets/js/jquery-3.4.0.min.js') }}"></script>
@php
use App\Models\backend\FrontendImages;

$favicon = FrontendImages::where('image_code','favicon')->first();
@endphp

{{-- {{dd($content_prod->toArray())}} --}}


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">


@if(!empty($content_prod))
<meta name="title" content="<?php echo $content_prod->meta_title ?>">
<meta name="description" content="<?php echo $content_prod->meta_desc ?>">
<meta name="keywords" content="<?php echo $content_prod->meta_keywords ?>">
<link rel='canonical' href="{{url()->current()}}" />
{{-- <link rel='canonical' href="https://www.dadreeios.com" /> --}}
<meta property="og:description" content="<?php echo $content_prod->og_desc ?>">
<meta property="og:title" content="<?php echo $content_prod->og_title ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Dadreeios">
<meta name="fb:app_id" content="795786888261296">
<meta property="og:url" content="https://www.dadreeios.com/">
<meta property="og:image" content="https://www.dadreeios.com/backend-assets/uploads/frontend_images/165337789455.png">
@endif
    
<title>{{ config('app.name', 'Dadreeios') }}</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!--Roboto font link-->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/parasight_dadreeios.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/mega_menu.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/font/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/chosen.css') }}">
<!-- <link rel="stylesheet" href="https://rawcdn.githack.com/SochavaAG/example-mycode/master/_common/css/reset.css"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/slick-theme.css') }}"/>

<link rel="stylesheet" href="{{ asset('frontend-assets/css/toastr.min.css') }}">

@if(isset($favicon->image_url))
	<link rel="icon" href="{{ asset('backend-assets/uploads/frontend_images/') }}/{{ $favicon->image_url }}" />
@else
	<link rel="icon" href="{{ asset('favicon1.png')}}" />
@endif

<!-- <script src="{{ asset('frontend-assets/js/toastr.min.js') }}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

@php
use App\Models\backend\FrontendImages;

$favicon = FrontendImages::where('image_code','favicon')->first();
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel='canonical' href="{{url()->current()}}" />

<title>{{ config('app.name', 'Dadreeios') }}</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!--Roboto font link-->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/parasight_dadreeios.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/mega_menu.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/toastr.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>

@if(isset($favicon->image_url))
	<link rel="icon" href="{{ asset('backend-assets/uploads/frontend_images/') }}/{{ $favicon->image_url }}" />
@else
	<link rel="icon" href="{{ asset('favicon1.png')}}" />
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="{{ asset('frontend-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend-assets/js/owl.carousel.min.js') }}"></script>
<!-- <script src="{{ asset('frontend-assets/js/jquery.jConveyorTicker.min.js') }}"></script> -->
<!-- <script src="{{ asset('frontend-assets/js/webticker.js') }}"></script> -->

<script src="{{ asset('frontend-assets/js/toastr.min.js') }}"></script>

<!-- Added by Vijay Sutar -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ClothingStore",
  "name": "DADREEIOS",
  "image": "https://www.dadreeios.com/backend-assets/uploads/frontend_images/165337789455.png",
  "@id": "",
  "url": "https://www.dadreeios.com/",
  "telephone": "+91 74498042995",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Section 30",
    "addressLocality": "Ulhasnagar",
    "postalCode": "421004",
    "addressCountry": "IN"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 19.2215115,
    "longitude": 73.1644628
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday"
    ],
    "opens": "11:30",
    "closes": "19:30"
  },
  "sameAs": [
    "https://www.facebook.com/dadreeios",
    "https://twitter.com/dadreeios",
    "https://www.instagram.com/dadreeios/",
    "https://www.youtube.com/channel/UCrdgfTFoAGTcE84jMKnudEw",
    "https://www.linkedin.com/company/dadreeios/?viewAsMember=true&original_referer=https%3A%2F%2Fwww.dadreeios.com%2F",
    "https://in.pinterest.com/DADREEIOS/",
    "https://www.dadreeios.com/"
  ] 
}
</script>
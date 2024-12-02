<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<title>@yield('title')</title>
@include('frontend.includes.product_head')
</head>
<body>
@include('frontend.includes.header')
@yield('content')
@include('frontend.includes.product_footer')
</body>
</html>

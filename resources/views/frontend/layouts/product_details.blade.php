<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @yield('metatags')
<title>@yield('title')</title>
@include('frontend.includes.product_detail_head')
</head>
<body>
@include('frontend.includes.header')
@yield('content')
@include('frontend.includes.product_detail_footer')
@include('frontend.includes.alerts')
</body>
</html>

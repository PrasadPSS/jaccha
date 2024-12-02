<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<title>@yield('title')</title>
@include('frontend.includes.app_head')
</head>
<body>
@include('frontend.includes.header')
@yield('content')
@include('frontend.includes.app_footer')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<title>@yield('title')</title>
@include('frontend.includes.head')
</head>
<body>
@include('frontend.includes.header')
@yield('content')
@include('frontend.includes.alerts')
</body>
</html>

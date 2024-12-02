<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<title>@yield('title')</title>
@include('frontend.includes.login_head')
</head>
<body>

@yield('content')
@include('frontend.includes.login_footer')
@yield('extrajs')
@include('frontend.includes.alerts')
</body>
</html>

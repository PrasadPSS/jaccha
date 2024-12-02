<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!--<meta name="title" content="Dadreeios | Online shopping site for women, men clothing in India.">-->
    <!--<meta name="description" content="Dadreeios | Online shopping site for women, men clothing in India. Shop from the best online shopping site for most fashionable & trendy clothing at best prices.">-->
    <!--<meta name="keywords" content="Online shopping site, online clothing shopping site, shop online , shop online India, clothing, shop mens,  womens clothing online in India , online shopping sites for men in India, online shopping sites for women in india">-->
    
    <!--<meta property="og:description" content="">-->
    <!--<meta property="og:url" content="">-->
    <!--<meta property="og:title" content="">-->
    
    <?php

    use Illuminate\Support\Facades\DB;
    
    $meta_data = DB::table('meta_management')->select('*')->where('page_name', 'Home')->get();
    
    
    ?>
    <!-- meta details -->
    <meta name="title" content="<?php echo $meta_data[0]->meta_title ?>">
    <meta name="description" content="<?php echo $meta_data[0]->meta_desc ?>">
    <meta name="keywords" content="<?php echo $meta_data[0]->meta_keywords ?>">
    <link rel='canonical' href="https://www.dadreeios.com" />
    <meta property="og:description" content="<?php echo $meta_data[0]->og_desc ?>">
    <meta property="og:title" content="<?php echo $meta_data[0]->og_title ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Dadreeios">
    <meta property="og:url" content="https://www.dadreeios.com/">
    <meta property="og:image" content="https://www.dadreeios.com/backend-assets/uploads/frontend_images/165337789455.png">
    
    <title>@yield('title')</title>
    
    @include('frontend.includes.head')
</head>
<body>
@include('frontend.includes.header')
@yield('content')
@include('frontend.includes.footer')
@include('frontend.includes.alerts')
</body>
</html>

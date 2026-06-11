<!doctype html>
<html lang="en">


<!-- Mirrored from risingtheme.com/html/demo-becute/becute/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jul 2024 12:06:06 GMT -->
<head>
  <meta chaRs et="utf-8">
  <title>@yield('meta_title', get_setting('website_name'))</title>
  <meta name="description" content="Gorja Jewels">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Favicon -->
<link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

   <!-- ======= All CSS Plugins here ======== -->
  <link rel="stylesheet" href="{{static_asset('public/assets/webtheme/user/assets/css/plugins/swiper-bundle.min.css')}}">
  <link rel="stylesheet" href="{{static_asset('public/assets/webtheme/user/assets/css/plugins/glightbox.min.css')}}">

  <!-- Plugin css -->
  <link rel="stylesheet" href="{{static_asset('public/assets/webtheme/user/assets/css/vendor/bootstrap.min.css')}}">

  <!-- Custom Style CSS -->
  <link rel="stylesheet" href="{{static_asset('public/assets/webtheme/user/assets/css/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

@include('frontend.shirin-layouts.header')
@yield('content')
@include('frontend.shirin-layouts.footer')

</body>




<!-- All Script JS Plugins here  -->
<script src="{{static_asset('public/assets/webtheme/user/assets/js/vendor/popper.js')}}" defer="defer"></script>
<script src="{{static_asset('public/assets/webtheme/user/assets/js/vendor/bootstrap.min.js')}}" defer="defer"></script>
<script src="{{static_asset('public/assets/webtheme/user/assets/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{static_asset('public/assets/webtheme/user/assets/js/plugins/glightbox.min.js')}}"></script>

<!-- Customscript js -->
<script src="{{static_asset('public/assets/webtheme/user/assets/js/script.js')}}"></script>

<!-- Mirrored from risingtheme.com/html/demo-becute/becute/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jul 2024 12:06:36 GMT -->
</html>

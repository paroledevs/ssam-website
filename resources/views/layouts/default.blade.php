<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

	{{-- CSRF Token --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@auth('admin')

	<meta name="api-token" content="{{ auth('admin')->user()->api_token }}">

	@endauth

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="author" content="">
	<meta name="copyright" content="">
	<meta name="creator" content="Planetoide.mx">
	<meta name="distribution" content="global">
	<meta name="rating" content="general">
	<meta name="robots" content="all">

	@yield('metas')

	<title>@yield('title')</title>

	{{-- FAVICONS --}}
	<link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">

	{{-- CSS --}}
	@if (Str::startsWith(Request::path(), 'admin'))
		<link rel='stylesheet' href="{{ asset('css/style-dashboard.css') }}" />
	@else
		<link rel='stylesheet' href="{{ asset('css/style.css') }}" />
	@endif
	
	
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KT4CQ7B');</script>
<!-- End Google Tag Manager -->


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VVVNE4X0ZY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VVVNE4X0ZY');
</script>
	

	@stack('head_scripts')


</head>

<body>
	
	
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KT4CQ7B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	

	<div id="app">

		@yield('content')

		@if (!Request::is('admin/*'))
			<set-locale locale="{{ session()->get('locale') ?? 'es' }}"></set-locale>
		@endif
	</div>

	{{-- Scripts --}}
	{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFqX0tptzf5aYrlU4-OwdI2vsYy85-kLA"></script> --}}

	@routes

	<script src="{{ mix('js/manifest.js') }}"></script>
	<script src="{{ mix('js/vendor.js') }}"></script>

	@if (Request::is('admin/*'))
		<script src="{{ mix('js/admin.js') }}"></script>
	@else
		<script src="{{ mix('js/app.js') }}"></script>
	@endif

	@stack('scripts')

</body>

</html>

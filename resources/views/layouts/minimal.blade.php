<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="api-endpoint" content="{{ url('api') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title') - {{ config('hello.title', 'BYUS Tecnologia') }}</title>
	<meta name="robots" content="noindex, nofollow">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('h-assets/images/favicon/favicon.png') }}">

	<!-- CSSs -->
	<link href="{{ asset('h-assets/css/app.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ asset('h-assets/css/font-awesome.css') }}" type="text/css" rel="stylesheet">

	<!-- Scripts -->
	<script src="{{ asset('h-assets/js/app.js') }}"></script>
	<script src="{{ asset('h-assets/js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('h-assets/js/jquery.hello.js') }}"></script>

    <style type="text/css">

        body { overflow-x: hidden; }
        
        .container-fluid {
            padding: 0 !important;
            margin: 0 auto !important;
            max-width: 90%;
        }
    </style>
</head>
<body>
	<div id="app">
		<!-- Mensagens do sistema -->
		@include('hive::errors.list')
		@include('hive::messages.list')

		<!-- Conteúdo -->
		@yield('content')

		<!-- Rodapé -->
		@include('hive::layouts.footer')
	</div>

	<!-- Scripts -->
	@yield('script')
</body>
</html>
@php $agent = new Jenssegers\Agent\Agent(); @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8"/>
	<meta name="keywords" content="Jackson, Green, Family, Reunion"/>
	<meta name="description" content="Jackson and Green Family Reunion"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="author" content="Tramaine Jackson"/>
	<meta name="handheldfriendly" content="true"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('Title', 'Jackson/Green Reunion')</title>

    <!-- Styles -->
    @yield('styles')
	
	@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
		<link href="/css/myIEcss.css" rel="stylesheet">
	@endif
	
	<!-- Scripts -->
	@yield('scripts')

	<!--[if lte IE 9]> <script>window.open("oldBrowser/index.php", "_self");</script> <![endif]-->
</head>
<body>
    <div id="app">
		@if(session('status'))
			<h2 class="flashMessage text-center">{{ session('status') }}</h2>
		@endif
		@if(session('error'))
			<h2 class="errorMessage text-center">{{ session('error') }}</h2>
		@endif
		<div class="modal fade loadingSpinner">
			<div class="loader"></div>
			<div class="">
				<p class="text-white d-table mx-auto display-3"></p>
			</div>
		</div>
        @yield('content')
    </div>
</body>
</html>

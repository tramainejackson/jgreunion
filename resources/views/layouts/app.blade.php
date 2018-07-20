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
		<!-- Open Iconic icons -->
		<link href="/css/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

		<!-- Bootstrap core CSS -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link href="/css/mdb.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="/css/jgreunion.css" rel="stylesheet">
		<link href="/css/jquery.datetimepicker.css" rel="stylesheet">
		<link href="/css/magnific-popup.css" rel="stylesheet">
		
		@yield('add_styles')
		
		@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
			<link href="/css/myIEcss.css" rel="stylesheet">
		@endif

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
			
			<!-- Progress Bar Modal -->
			<div class="modal fade" id="progress_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header justify-content-around align-items-center">
							<h2 class="">Uploading....</h2>
						</div>
						<div class="modal-body">
							<div class="progress" style="height: 20px">
								<div class="progress-bar" id="pro" role="progressbar" style="width: 0%; height: 20px" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
							</div>
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<!-- Scripts -->
		<!-- Bootstrap core JS -->
		<script src="/js/jquery-3.3.1.min.js"></script>
		<script src="/js/popper.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/mdb.min.js"></script>

		<!-- Custom JS -->
		<script src="/js/jgreunion.js"></script>
		
		@yield('add_scripts')
		
	</body>

</html>

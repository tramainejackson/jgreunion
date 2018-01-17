<nav class="navbar navbar-expand-md w-100 mobileNavBar d-md-block d-flex">
	<a class="navbar-brand w-100" href="/"><img src="/images/E2W_Header.png" class="img-fluid mx-auto d-inline-block d-md-block" /></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
	<span class="oi oi-menu"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarToggler">
		@if(!Auth::check())
			<ul class="navbar-nav w-100 mt-2 mt-md-0 text-center align-items-center justify-content-around">
				<li class="nav-item active">
					<a class="nav-link" href="/">Upcoming Trips <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/past">Past Trips</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/photos">Photos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/contact_us">Contact Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/about_us">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/suggestion">Suggestions</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/login">Login</a>
				</li>
			</ul>
		@else
			<ul class="navbar-nav w-100 mt-2 mt-md-0 text-center align-items-center justify-content-around">
				<li class="nav-item">
					<a href="{{ route('location.index') }}" id="" class="nav-link">Trip Locations</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('pictures.index') }}" id="" class="nav-link">Trip Pictures</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('admin.index') }}" id="" class="nav-link">Users</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('questions.index') }}" class="nav-link">Questions</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('suggestions.index') }}" id="" class="nav-link">Suggestions</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
					
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
			</ul>
		@endif
	</div>
</nav>
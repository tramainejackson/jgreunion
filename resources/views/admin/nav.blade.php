<div class="row">
	<div class="col-12">
		<div class="jumbotron jumbotron-fluid">
			<div class="page_header">
				<h1>Jackson &amp; Green Family Reunion</h1>
			</div>
		</div>
	</div>
	<div class="col-3">
		<nav class="nav nav-pills justify-content-start py-3">
			<a href='/' class='profileLink nav-link'>Home</a>
			
			<a href="{{ route('logout') }}" class="profileLink nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
			
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		</nav>
	</div>
	<div class="col-9">
		<nav class="nav nav-pills justify-content-start py-3">
		
			@if(Auth::user()->is_admin())
				
				<a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), 'members') && !Auth::user()->is_admin() ? ' active' : '' }}">My Profile</a>

				<a href="/administrator" class="profileLink nav-link{{ str_contains(url()->current(), ['members', 'administrator']) ? ' active' : '' }}">Family Members</a>
				
				<a href="{{ route('reunions.index') }}" class="profileLink nav-link{{ str_contains(url()->current(), ['registrations', 'reunions']) ? ' active' : '' }}">Reunions</a>

				<a href="{{ route('settings') }}" class="profileLink nav-link{{ str_contains(url()->current(), 'setting') ? ' active' : '' }}">Settings</a>
		
			@else
				
				<a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), 'members') ? ' active' : '' }}">My Profile</a>
				
				<a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), ['registrations', 'reunions']) ? ' active' : '' }}">New Post</a>
				
			@endif

		</nav>
	</div>
</div>
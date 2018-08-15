<div class="row">

	<div class="col-12">
		<div class="jumbotron jumbotron-fluid">
		
			<div class="page_header">
				<h1>Jackson &amp; Green Family Reunion</h1>
			</div>

			<div class="d-block d-lg-none">
			
				<!-- SideNav slide-out button -->
				<a href="#" data-activates="slide-out" class="btn btn-primary p-3 button-collapse position-absolute" style="z-index: 1; top: 0;"><i class="fa fa-bars"></i></a>
				
			</div>
			
		</div>
		
	</div>
	
	<div class="col-3 d-none d-lg-flex">
		<nav class="nav nav-pills justify-content-start py-3">
			<a href='/' class='profileLink nav-link'>Home</a>
			
			<a href="{{ route('logout') }}" class="profileLink nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
			
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		</nav>
	</div>
	
	<div class="col-9 d-none d-lg-flex">
		<nav class="nav nav-pills justify-content-start py-3">

			@if(Auth::user()->is_admin())
				
				<a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), 'members') && (isset($family_member) ? $family_member->id == Auth::user()->member->id ? true : false : false) ? ' active' : '' }}">My Profile</a>

				<a href="/administrator" class="profileLink nav-link{{ str_contains(url()->current(), ['members', 'administrator']) && (isset($family_member) ? $family_member->id != Auth::user()->member->id ? true : false : true) ? ' active' : '' }}">Family Members</a>
				
				<a href="{{ route('reunions.index') }}" class="profileLink nav-link{{ str_contains(url()->current(), ['registrations', 'reunions']) ? ' active' : '' }}">Reunions</a>

				<a href="{{ route('settings') }}" class="profileLink nav-link{{ str_contains(url()->current(), 'setting') ? ' active' : '' }}">Settings</a>
		
			@else
				
				<a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), 'members') ? ' active' : '' }}">My Profile</a>
				
				<a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), ['registrations', 'reunions']) ? ' active' : '' }}">New Post</a>
				
			@endif

		</nav>
		
	</div>
	
</div>

<div class="d-block d-lg-none">

	<!-- Sidebar navigation -->
	<div id="slide-out" class="side-nav fixed">
		<ul class="custom-scrollbar">
			<!-- Logo -->
			<li>
				<div class="">
					<img src="{{ asset('/images/jg-logo.png') }}" class="img-fluid flex-center" />
				</div>
			</li>
			<!--/. Logo -->

			<!-- Side navigation links -->
			@if(Auth::user()->is_admin())
				
				<li><a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), 'members') && (isset($family_member) ? $family_member->id == Auth::user()->member->id ? true : false : false) ? ' active' : '' }}">My Profile</a></li>

				<li>
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Family Members<i class="fa fa-angle-down rotate-icon"></i>
							</a>
							
							<div class="collapsible-body">
								<ul>
									<li>
										<a href="{{ route('members.create') }}" class="waves-effect">Create New Member</a>
									</li>
								
									<li>
										<a href="/administrator" class="waves-effect">Edit Member</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</li>
				
				<li>
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Reunions<i class="fa fa-angle-down rotate-icon"></i>
							</a>
							
							<div class="collapsible-body">
								<ul>
									<li>
										<a href="{{ route('reunions.create') }}" class="waves-effect">Create Reunion</a>
									</li>
								
									<li>
										<a href="{{ route('reunions.index') }}" class="waves-effect">Edit Reunions</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</li>

				<li class="" style="margin: 1rem 0 0; padding: 0;">
					<a href="{{ route('settings') }}" class="" style="color: #fff; font-weight: 300; font-size: .8rem; height: 36px; line-height: 36px;"><i class="fa fa-chevron-right" style="font-size: .8rem; margin-right: 13px;"></i> Edit Settings</a>
				</li>
		
			@else
				
				<li><a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), 'members') ? ' active' : '' }}">My Profile</a></li>
				
				<li><a href="{{ route('members.edit', ['family_member' => Auth::user()->member->id]) }}" class="profileLink nav-link{{ str_contains(url()->current(), ['registrations', 'reunions']) ? ' active' : '' }}">New Post</a></li>
				
			@endif

			<!--/. Side navigation links -->
		</ul>

		<div class="sidenav-bg"></div>
	  
	</div>
	<!--/. Sidebar navigation -->
	
</div>
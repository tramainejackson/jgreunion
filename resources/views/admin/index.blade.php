@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div class="container-fluid" id="profilePage">
		<div id="overlay"></div>
		<div id="modal"></div>
		<div class="row">
			<div class="col-12">
				<div class="jumbotron jumbotron-fluid">
					<div class="page_header">
						<h1>Jackson &amp; Green Family Reunion</h1>
					</div>
				</div>
			</div>
			<div class="col-12">
				<nav class="nav">
					@if(!Auth::check())
						<a href='/registration' class='profileLink'>Register</a>
						<a href='/login' class='profileLink'>Login</a>
					@else
						<a href='/profile' class='profileLink'>My Profile</a>
						<a href='/registrations' class='profileLink'>Registrations</a>
						<a href='/administrator' class='profileLink'>Family Members</a>
						<a href='/reunions' class='profileLink'>Reunions</a>
						<a href='/logout' class='profileLink'>Logout</a>
					@endif
				</nav>
				<nav class="nav">
					@if(!Auth::check())
						<a href='/' class='homeLink'>Home</a>
					@else
						<a href='/' class='homeLink profileLink'>Home</a>
						<a href='/logout' class='profileLink'>Logout</a>
					@endif
				</nav>
			</div>
		</div>
		<div class="row bg-light" id="distribution_list">
			<div class="col-12">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>MR</th>
							<th>MRS</th>
							<th>Lastname</th>
							<th>Address</th>
							<th>City</th>
							<th>State</th>
							<th>Zip</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Preference</th>
							<th>Notes</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
						@foreach($distribution_list as $member)
							<tr>
								<td class="text-truncate">{{ $member->mr_firstname }}</td>
								<td class="text-truncate">{{ $member->ms_firstname }}</td>
								<td class="text-truncate">{{ $member->lastname }}</td>
								<td class="text-truncate">{{ $member->address }}</td>
								<td class="text-truncate">{{ $member->city }}</td>
								<td class="text-truncate">{{ $member->state }}</td>
								<td class="text-truncate">{{ $member->zip }}</td>
								<td class="text-truncate">{{ $member->phone }}</td>
								<td class="text-truncate">{{ $member->email }}</td>
								<td class="text-truncate">{{ $member->mail_preference }}</td>
								<td class="text-truncate">{{ $member->notes != null ? 'Y' : 'N' }}</td>
								<td class="text-truncate"><a href="#" class="btn btn-warning">Edit</a></td>
							</tr>			
						@endforeach
					</tbody>
				</table>
			</div>			
		</div>
	</div>
@endsection
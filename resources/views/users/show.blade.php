@extends('layouts.app')

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
				<nav class="nav nav-pills justify-content-center">
					@if(!Auth::check())
						<a href='/registration' class='profileLink nav-link'>Register</a>
						<a href='/login' class='profileLink nav-link'>Login</a>
					@else
						<a href='/profile' class='profileLink nav-link'>My Profile</a>
						<a href='/registrations' class='profileLink nav-link'>Registrations</a>
						<a href='/administrator' class='profileLink nav-link'>Family Members</a>
						<a href='/reunions' class='profileLink nav-link'>Reunions</a>
						<a href='/logout' class='profileLink nav-link'>Logout</a>
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
		<div class="row">
			<div class="col">
			</div>
		</div>
		<div class="">
			<h2 class="">Registrations for {{ $reunions->reunion_city . ' ' .  $reunions->reunion_year }}</h2>
		</div>
		<div id="registrations_list" class="row bg-light">
			<div class="col-12">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Registree</th>
							<th>Address</th>
							<th>City</th>
							<th>State</th>
							<th>Zip</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Due At Reg</th>
							<th>Total Due</th>
							<th>Total Paid</th>
							<th>Reg Notes</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
						@if($registrations->count() > 0)
							@foreach($registrations as $registration)
								<tr>
									<td class="text-truncate">{{ $registration->registree_name }}</td>
									<td class="text-truncate">{{ $registration->address }}</td>
									<td class="text-truncate">{{ $registration->city }}</td>
									<td class="text-truncate">{{ $registration->state }}</td>
									<td class="text-truncate">{{ $registration->zip }}</td>
									<td class="text-truncate">{{ $registration->phone }}</td>
									<td class="text-truncate">{{ $registration->email }}</td>
									<td class="text-truncate">${{ $registration->due_at_reg }}</td>
									<td class="text-truncate">${{ $registration->total_amount_due }}</td>
									<td class="text-truncate">${{ $registration->total_amount_paid }}</td>
									<td class="text-truncate">{{ $registration->registration != null ? 'Y' : 'N' }}</td>
									<td class="text-truncate"><a href="#" class="btn btn-warning">Edit</a></td>
								</tr>			
							@endforeach
						@else
							<tr>
								<td colspan="12" class="text-center display-4">No registrations on file for this reunion</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
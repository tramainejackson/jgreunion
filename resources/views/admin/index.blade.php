@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
	<style>
		.oi {
			top: 0px;
		}
	</style>
@endsection

@section('scripts')
	@include('function.bootstrap_js')
	<script src="/js/doubleScroll.js"></script>
@endsection

@section('content')
	<div class="container-fluid" id="profilePage">
		<div class="row">
			<div class="col-12">
				<div class="jumbotron jumbotron-fluid">
					<div class="page_header">
						<h1>Jackson &amp; Green Family Reunion</h1>
					</div>
				</div>
			</div>
			<div class="col-3">
				<nav class="nav nav-pills justify-content-center py-3">
					<a href='/' class='profileLink nav-link'>Home</a>
					<a href="{{ route('logout') }}" class="profileLink nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
					
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</nav>
			</div>
			<div class="col-9">
				<nav class="nav nav-pills justify-content-start py-3">
					<!-- <a href='/profile' class='profileLink nav-link border-0'>My Profile</a> -->
					<a href="/administrator" class="profileLink nav-link border-0">Family Members</a>
					<a href="/reunions" class="profileLink nav-link active">Reunions</a>
					<!-- <a href='/settings' class='profileLink nav-link'>Settings</a> -->
				</nav>
			</div>
		</div>
		<div class="row bg-light" id="distribution_list">
			<div class="col-2 my-2">
				<div class="">
					<a href="/members/create" class="btn btn-info btn-lg">Create New Member</a>
				</div>
			</div>
			<div class="col-4 my-2">
				<div class="form-group">
					<div class="input-group input-group-lg">
						<input type="text" name="" class="memberFilter form-control" value="" placeholder="Filter By Name" />
						<div class="input-group-prepend">
							<span class="oi oi-magnifying-glass input-group-text"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Firstname</th>
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
									<td class="text-truncate nameSearch">{{ $member->firstname }}</td>
									<td class="text-truncate nameSearch">{{ $member->lastname }}</td>
									<td class="text-truncate">{{ $member->address }}</td>
									<td class="text-truncate">{{ $member->city }}</td>
									<td class="text-truncate">{{ $member->state }}</td>
									<td class="text-truncate">{{ $member->zip }}</td>
									<td class="text-truncate">{{ $member->phone }}</td>
									<td class="text-truncate">{{ $member->email }}</td>
									<td class="text-truncate" data-toggle="tooltip" data-placement="left" title="{{ $member->mail_preference == 'M' ? 'Mail' : 'Email' }}">{{ $member->mail_preference }}</td>
									<td class="text-truncate" data-toggle="tooltip" data-placement="left" title="{{ $member->notes }}">{{ $member->notes != null ? 'Y' : 'N' }}</td>
									<td class="text-truncate"><a href="/members/{{ $member->id }}/edit" class="btn btn-warning">Edit</a></td>
								</tr>			
							@endforeach
						</tbody>
					</table>
					<script>$('.table-responsive').doubleScroll();</script>
				</div>
			</div>			
		</div>
	</div>
@endsection
@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
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
					<a href='/logout' class='profileLink nav-link'>Logout</a>
				</nav>
			</div>
			<div class="col-9">
				<nav class="nav nav-pills justify-content-start py-3">
					<a href='/profile' class='profileLink nav-link border-0'>My Profile</a>
					<a href='/registrations' class='profileLink nav-link active'>Registrations</a>
					<a href='/administrator' class='profileLink nav-link'>Family Members</a>
					<a href='/reunions' class='profileLink nav-link'>Reunions</a>
					<a href='/settings' class='profileLink nav-link'>Settings</a>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<h1 class="">Select A Reunion</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<select class="custom-select" name="">
					@foreach($reunions as $reunion)
						<option value="{{ $reunion->id }}" {{ $reunion->has_site == 'N' ? 'disabled' : '' }}>{{ $reunion->reunion_city . ' ' . $reunion->reunion_year }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
@endsection
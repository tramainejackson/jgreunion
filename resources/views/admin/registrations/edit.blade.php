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
					<a href='/administrator' class='profileLink nav-link'>Family Members</a>
					<a href='/reunions' class='profileLink nav-link active'>Reunions</a>
					<a href='/settings' class='profileLink nav-link'>Settings</a>
				</nav>
			</div>
		</div>
		<div class="row bg-light">
			<div class="col-2 my-2">
				<div class="">
					<a href="/reunions/{{ $registration->reunion->id }}/edit" class="btn btn-info btn-lg">All Registrations</a>
				</div>
			</div>
			<div class="col-8 membersForm">
				<h1 class="mt-2 mb-4">Edit {{ $registration->registree_name }} ({{ $registration->reunion->reunion_city }} Reunion {{ $registration->reunion->reunion_year }})</h1>
				{!! Form::open(['action' => ['RegistrationController@update', 'registration' => $registration->id], 'method' => 'PUT']) !!}
					<div class="form-group">
						<label class="form-label" for="registree">Registree</label>
						<select class="custom-select form-control" name="registree">
							@foreach($family as $family_member)
								<option value="{{ $family_member->id }}" {{ $family_member->id == $registration->reunion_dl->id ? 'selected' : '' }}>{{ $family_member->firstname . ' ' . $family_member->lastname }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label" for="email">Email</label>
						<input type="text" name="email" class="form-control" value="{{ $registration->email }}" placeholder="Enter Email Address" />
					</div>
					<div class="form-group">
						<label class="form-label" for="address">Address</label>
						<input type="text" name="address" class="form-control" value="{{ $registration->address }}" placeholder="Enter Address" />
					</div>
					<div class="form-group">
						<label class="form-label" for="city">City</label>
						<input type="text" name="city" class="form-control" value="{{ $registration->city }}" placeholder="Enter City" />
					</div>
					<div class="form-group">
						<label class="form-label" for="state">State</label>
						<select class="form-control" name="state">
							@foreach($states as $state)
								<option value="{{ $state->state_abb }}" {{ $registration->state == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-row">
						<label class="form-label col-12" for="city">Phone</label>
						<div class="form-group col-2">
							<input type="number" name="phone1" class="form-control" value="{{ old('phone1') ? old('phone1') : substr($registration->phone, 0, 3) }}" placeholder="###" max="999" />
						</div>
						<span>-</span>
						<div class="form-group col-2">
							<input type="number" name="phone2" class="form-control" value="{{ old('phone2') ? old('phone2') : substr($registration->phone, 3, 3) }}" placeholder="###" max="999" />
						</div>
						<span>-</span>
						<div class="form-group col-3">
							<input type="number" name="phone3" class="form-control" value="{{ old('phone3') ? old('phone3') : substr($registration->phone, 6, 4) }}" placeholder="####" max="9999" />
						</div>
					</div>
					<div class="form-group">
						<label class="form-label" for="mail_preference">Mail Preference</label>
						<select class="form-control" name="mail_preference">
							<option value="M" {{ $registration->mail_preference == 'M' ? 'selected' : '' }}>Mail</option>
							<option value="E" {{ $registration->mail_preference == 'E' ? 'selected' : '' }}>Email</option>
						</select>
					</div>
					<div class="form-group">
						{{ Form::submit('Update Registration', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>	
	</div>
@endsection
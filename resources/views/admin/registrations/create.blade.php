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
		<div class="row bg-light">
			<div class="col-2 my-2">
				<div class="">
					<a href="/reunions/{{ $reunion->id }}/edit" class="btn btn-info btn-lg">All Registrations</a>
				</div>
			</div>
			<div class="col-8 membersForm">
				<div class="form-block-header mt-3">
					<h3 class="mt-2 mb-4">Add A Family Member From List</h3>
				</div>
				<div class="form-row mb-5">
					<div class="form-group col-10">
						<!-- Select User Already In Distro List -->
						<select class="custom-select form-control createRegSelect">
							<option value="#" selected disabled>----- Select A User From Members List -----</option>
							@foreach($members as $member)
								@php
									$thisReg = $member->registrations()->where([
										['reunion_id', '=', $reunion->id],
										['dl_id', '=', $member->id]
									])->first();
								@endphp
								
								<option value="{{ $member->id }}" class="{{ $thisReg != null ? $thisReg->dl_id == $member->id ? 'text-danger' : '' : '' }}" {{ $thisReg != null ? $thisReg->dl_id == $member->id ? 'disabled' : '' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}{{ $thisReg != null ? $thisReg->dl_id == $member->id ? ' - member already registered' : '' : '' }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-2">
						<a href="#" class="btn btn-info createRegSelectLink">Go</a>
					</div>
				</div>
				
				<div class="form-block-header mt-5">
					<h3 class="mt-2 mb-4">Create A Family Member To Add To Registration</h3>
				</div>
				<!-- Create Form -->
				{!! Form::open(['action' => 'HomeController@store', 'method' => 'POST']) !!}
					<div class="hidden" hidden>
						<input type="text" name="reunion_id" class="hidden" value="{{ $reunion->id }}" hidden />
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label class="form-label" for="firstname">Firstname</label>
							<input type="text" name="firstname" class="form-control" value="{{  old('firstname') }}" placeholder="Enter First Name" />
							
							@if($errors->has('firstname'))
								<span class="text-danger">First Name cannot be empty</span>
							@endif
						</div>
						<div class="form-group col-6">
							<label class="form-label" for="lastname">Lastname</label>
							<input type="text" name="lastname" class="form-control" value="{{  old('lastname') }}" placeholder="Enter Last Name" />
							
							@if($errors->has('lastname'))
								<span class="text-danger">Last Name cannot be empty</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<label class="form-label" for="email">Email Address</label>
						<input type="text" name="email" class="form-control" value="{{  old('email') }}" placeholder="Enter Email Address" />
					</div>
					<div class="form-group">
						<label class="form-label" for="address">Address</label>
						<input type="text" name="address" class="form-control" value="{{  old('address') }}" placeholder="Enter Address" />
					</div>
					<div class="form-row">
						<div class="form-group col-4">
							<label class="form-label" for="city">City</label>
							<input type="text" name="city" class="form-control" value="{{  old('city') }}" placeholder="Enter City" />
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="state">State</label>
							<select class="form-control custom-select" name="state">
								@foreach($states as $state)
									<option value="{{ $state->state_abb }}" {{ old('reunion_state') && old('state') == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="zip">Zip Code</label>
							<input type="number" name="zip" class="form-control" max="99999" value="{{  old('zip') }}" placeholder="Enter Zip Code" />
						</div>
					</div>
					<div class="form-group">
						<label class="form-label" for="city">Phone</label>
						<input type="number" name="phone" class="form-control" value="{{  old('phone') }}" placeholder="##########" />
					</div>
					<div class="form-group">
						<label class="form-label" for="mail_preference">Mail Preference</label>
						<select class="form-control custom-select" name="mail_preference">
							<option value="M" {{ old('mail_preference') && old('mail_preference') == 'M' ? 'selected' : '' }}>Mail</option>
							<option value="E" {{ old('mail_preference') && old('mail_preference') == 'E' ? 'selected' : '' }}>Email</option>
						</select>
					</div>
					<div class="form-group">
						{{ Form::submit('Create New Member And Registration', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>	
	</div>
@endsection
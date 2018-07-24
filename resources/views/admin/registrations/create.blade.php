@extends('layouts.app')

@section('content')
	<div class="container-fluid" id="profilePage">
		
		@include('admin.nav')
		
		<div class="row white">
		
			<div class="col-2 my-2">
				<div class="">
					<a href="/reunions/{{ $reunion->id }}/edit" class="btn btn-info btn-lg">All Registrations</a>
				</div>
			</div>
			
			<div class="col-8 membersForm">
				<div class="pt-2 pb-4">
					<h1 class="text-center">{{ $reunion->reunion_city }} Registration Form</h1>
				</div>
				
				<div class="form-block-header mt-3">
					<h3 class="mt-2 mb-4">Add A Family Member From List</h3>
				</div>
				
				<div class="form-row mb-5">
				
					<div class="col-9 align-items-center justify-content-center d-flex">
					
						<!-- Select User Already In Distro List -->
						<select class="browser-default form-control createRegSelect">
						
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
					
					<div class="col-3">
						<a href="#" class="btn btn-info btn-block createRegSelectLink">Go</a>
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
							<select class="form-control browser-default" name="state">
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
						<label class="form-label" for="phone">Phone</label>
						<input type="number" name="phone" class="form-control" value="{{  old('phone') }}" placeholder="##########" />
					</div>
					<div class="form-group">
						<label class="form-label" for="mail_preference">Mail Preference</label>
						<select class="form-control browser-default" name="mail_preference">
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
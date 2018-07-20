@extends('layouts.app')

@section('content')
	<div class="container-fluid" id="profilePage">
		
		@include('admin.nav')
		
		<div class="row white">
		
			<div class="col-2 my-2">
				<div class="">
					<a href="/administrator" class="btn btn-info btn-lg">All Members</a>
				</div>
			</div>
			
			<div class="col-8 membersForm">
			
				<h1 class="mt-2 mb-4">Create New Member</h1>
				
				{!! Form::open(['action' => ['HomeController@store'], 'method' => 'POST']) !!}
				
					<div class="form-group">
						<label class="form-label" for="firstname">Firstname</label>
						<input type="text" name="firstname" class="form-control" value="{{  old('firstname') }}" placeholder="Enter First Name" />
						
						@if($errors->has('firstname'))
							<span class="text-danger">First Name cannot be empty</span>
						@endif
					</div>
					
					<div class="form-group">
						<label class="form-label" for="lastname">Lastname</label>
						<input type="text" name="lastname" class="form-control" value="{{  old('lastname') }}" placeholder="Enter Last Name" />
						
						@if($errors->has('lastname'))
							<span class="text-danger">Last Name cannot be empty</span>
						@endif
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
						<label class="form-label" for="city">Phone</label>
						<input type="text" name="phone" class="form-control" value="{{  old('phone') }}" placeholder="##########" />
					</div>
					
					<div class="form-group">
						<label class="form-label" for="age_group">Age Group</label>
						
						<select class="form-control browser-default" name="age_group">
							<option value="adult" {{ old('age_group') && old('age_group') == 'M' ? 'selected' : '' }}>Adult</option>
							<option value="youth" {{ old('age_group') && old('age_group') == 'E' ? 'selected' : '' }}>Youth</option>
							<option value="child" {{ old('age_group') && old('age_group') == 'E' ? 'selected' : '' }}>Child</option>
						</select>
					</div>
					
					<div class="form-group">
						<label class="form-label" for="mail_preference">Mail Preference</label>
						
						<select class="form-control browser-default" name="mail_preference">
							<option value="M" {{ old('mail_preference') && old('mail_preference') == 'M' ? 'selected' : '' }}>Mail</option>
							<option value="E" {{ old('mail_preference') && old('mail_preference') == 'E' ? 'selected' : '' }}>Email</option>
						</select>
					</div>
					
					<div class="form-group">
						{{ Form::submit('Create New Member', ['class' => 'btn btn-primary form-control']) }}
					</div>
					
				{!! Form::close() !!}
			</div>
			
		</div>
		
	</div>
@endsection
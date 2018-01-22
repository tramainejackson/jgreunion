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
					<a href='/administrator' class='profileLink nav-link border-0 active'>Family Members</a>
					<a href='/reunions' class='profileLink nav-link'>Reunions</a>
					<!-- <a href='/settings' class='profileLink nav-link'>Settings</a> -->
				</nav>
			</div>
		</div>
		<div class="row bg-light">
			<div class="col-2 my-2">
				<div class="">
					<a href="/administrator" class="btn btn-info btn-lg">All Members</a>
					<a href="/members/create" class="btn btn-info btn-lg my-2">New Member</a>
					
					@if($active_reunion != null)
						@if($family_members->count() > 1)
							<a href="{{ action('RegistrationController@update', ['registration' => $active_reunion->id ]) }}" class="btn btn-success btn-lg mw-100" style="white-space: initial;" onclick="event.preventDefault(); document.getElementById('one_click_registration').submit();">Add All Household Members To {{ $active_reunion->reunion_city }} Reunion</a>
						
							<form id="one_click_registration" action="{{ action('RegistrationController@update', ['registration' => $active_reunion->id ]) }}" method="PATCH" style="display: none;">
								{{ csrf_field() }}
								<input type="text" name="reg_member" class="" value="{{ $member->id }}" hidden />
							</form>
						@else
							<a href="{{ action('RegistrationController@update', ['registration' => $active_reunion->id ]) }}" class="btn btn-success btn-lg mw-100" style="white-space: initial;" onclick="event.preventDefault(); document.getElementById('one_click_registration').submit();">Add Member To {{ $active_reunion->reunion_city }} Reunion</a>
						
							<form id="one_click_registration" action="{{ action('RegistrationController@update', ['registration' => $active_reunion->id ]) }}" method="PATCH" style="display: none;">
								{{ csrf_field() }}
								<input type="text" name="reg_member" class="" value="{{ $member->id }}" hidden />
							</form>
						@endif
					@endif
				</div>
			</div>
			<div class="col-8 membersForm">
				<h1 class="mt-2 mb-4">Edit {{ $member->firstname . ' ' . $member->lastname }}</h1>
				{!! Form::open(['action' => ['HomeController@update', 'reunion_dl' => $member->id], 'method' => 'PUT']) !!}
					<div class="form-group">
						<label class="form-label" for="firstname">Firstname</label>
						<input type="text" name="firstname" class="form-control" value="{{ $member->firstname }}" placeholder="Enter First Name" />
					</div>
					<div class="form-group">
						<label class="form-label" for="lastname">Lastname</label>
						<input type="text" name="lastname" class="form-control" value="{{ $member->lastname }}" placeholder="Enter Last Name" />
					</div>
					<div class="form-group">
						<label class="form-label" for="email">Email</label>
						<input type="text" name="email" class="form-control" value="{{ $member->email }}" placeholder="Enter Email Address" />
					</div>
					<div class="form-group">
						<label class="form-label" for="address">Address</label>
						<input type="text" name="address" class="form-control" value="{{ $member->address }}" placeholder="Enter Address" />
					</div>
					<div class="form-row">
						<div class="form-group col-4">
							<label class="form-label" for="city">City</label>
							<input type="text" name="city" class="form-control" value="{{ $member->city }}" placeholder="Enter City" />
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="state">State</label>
							<select class="form-control" name="state">
								@foreach($states as $state)
									<option value="{{ $state->state_abb }}" {{ $member->state == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="zip">Zip</label>
							<input type="number" name="zip" class="form-control" value="{{ $member->zip }}" placeholder="Enter Zip Code" />
						</div>
					</div>
					<div class="form-row">
						<label class="form-label col-12" for="phone">Phone</label>
						<div class="form-group col-2">
							<input type="number" name="phone1" class="form-control" value="{{ substr($member->phone, 0, 3) }}" placeholder="###" max="999" />
						</div>
						<span>-</span>
						<div class="form-group col-2">
							<input type="number" name="phone2" class="form-control" value="{{ substr($member->phone, 3, 3) }}" placeholder="###" max="999" />
						</div>
						<span>-</span>
						<div class="form-group col-3">
							<input type="number" name="phone3" class="form-control" value="{{ substr($member->phone, 6, 4) }}" placeholder="####" max="9999" />
						</div>
					</div>
					<div class="form-group">
						<label class="form-label" for="age_group">Age Group</label>
						<select class="form-control custom-select" name="age_group">
							<option value="adult" {{ old('age_group') && old('age_group') == 'M' ? 'selected' : '' }}>Adult</option>
							<option value="youth" {{ old('age_group') && old('age_group') == 'E' ? 'selected' : '' }}>Youth</option>
							<option value="child" {{ old('age_group') && old('age_group') == 'E' ? 'selected' : '' }}>Child</option>
						</select>
					</div>
					<div class="form-group">
						<label class="form-label" for="mail_preference">Mail Preference</label>
						<select class="form-control" name="mail_preference">
							<option value="M" {{ $member->mail_preference == 'M' ? 'selected' : '' }}>Mail</option>
							<option value="E" {{ $member->mail_preference == 'E' ? 'selected' : '' }}>Email</option>
						</select>
					</div>
					<div class="form-group">
						<label class="form-label" for="notes">Additional Notes</label>
						<textarea class="form-control" name="notes" placeholder="Enter Additional Notes">{{ $member->notes }}</textarea>
					</div>
					<div class="form-row familyTreeGroup">
						<div class="form-group col-12">
							<h2 class="text-center">Family Tree</h2>
						</div>
						<div class="form-group text-center col-12">
							<button type="button" class="w-25 mx-auto btn btn-outline-success my-2{{ $member->descent == 'jackson' ? ' btn-success  text-light active' : '' }}">
								<input type="checkbox" name="descent" value="jackson" hidden {{ $member->descent == 'Y' ? 'checked' : '' }} />Jackson
							</button>
							<button type="button" class="w-25 mx-auto btn btn-outline-success my-2{{ $member->descent == 'green' ? ' btn-success text-light active' : '' }}">
								<input type="checkbox" name="descent" value="green" hidden {{ $member->descent == 'green' ? 'checked' : '' }} />Green
							</button>
						</div>
						<div class="form-group text-center col-6">
							<label for="" class="form-label text-center d-block">Mother</label>
							<select class="custom-select w-50 mx-auto" name="mother">
								<option value="blank">--- Select Mother ---</option>
								@foreach($members as $option)
									<option value="{{ $option->id }}" {{ $option->id == $member->mother ? 'selected' : '' }}>{{ $option->firstname . ' ' . $option->lastname }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group text-center col-6">
							<label for="" class="form-label text-center d-block">Father</label>
							<select class="custom-select w-50 mx-auto" name="father">
								<option value="blank">--- Select Father ---</option>
								@foreach($members as $option)
									<option value="{{ $option->id }}" {{ $option->id == $member->father ? 'selected' : '' }}>{{ $option->firstname . ' ' . $option->lastname }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group text-center col-12">
							<label for="" class="form-label text-center d-block">Spouse</label>
							<select class="custom-select w-50 mx-auto" name="spouse">
								<option value="blank">--- Select Spouse ---</option>
								@foreach($members as $option)
									<option value="{{ $option->id }}" {{ $option->id == $member->spouse ? 'selected' : '' }}>{{ $option->firstname . ' ' . $option->lastname }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group text-center col-12">
							<label for="" class="form-label text-center d-block">Siblings</label>
							<select class="custom-select w-50 mx-auto" name="siblings[]">
								<option value="blank">--- Select A Sibling ---</option>
								@foreach($siblings as $sibling)
									@foreach($members as $option)
										<option value="{{ $option->id }}" {{ $option->id == $sibling ? 'selected' : '' }}>{{ $option->firstname . ' ' . $option->lastname }}</option>
									@endforeach
								@endforeach
							</select>
							<button type="button" class="w-50 mx-auto btn btn-outline-success my-2" >Add Another Sibling</button>
						</div>
						<div class="form-group text-center col-12">
							<label for="" class="form-label text-center d-block">Children</label>
							<select class="custom-select w-50 mx-auto" name="children[]">
								<option value="blank">--- Select A Child ---</option>
								@foreach($children as $child)
									@foreach($members as $option)
										<option value="{{ $option->id }}" {{ $option->id == $child ? 'selected' : '' }}>{{ $option->firstname . ' ' . $option->lastname }}</option>
									@endforeach
								@endforeach
							</select>
							<button type="button" class="w-50 mx-auto btn btn-outline-success my-2" >Add Another Child</button>
						</div>
					</div>
					<div class="form-block-header">
						<h3 class="">Household Members
						<button type="button" class="btn btn-outline-success mb-2 addHHMember">Add House Hold Member</button>
						</h3>
					</div>
					@if($family_members->count() > 1)
						@foreach($family_members as $family_member)
							<div class="form-row">
								<div class="form-group col-8">
									<input class="form-control" value="{{ $family_member->firstname . ' ' . $family_member->lastname }}" disabled />
									<input value="{{ $family_member->id }}" hidden />
								</div>
								<div class="">
									<div class="form-group col-2">
										<a href="#" class="btn btn-danger{{ $family_member->id == $member->id ? ' disabled' : '' }}">Remove</a>
									</div>
								</div>
							</div>
						@endforeach
					@endif
					
					@if($potential_family_members->count() > 0)
						<div class="form-block-header">
							<h3 class="">Potential Household Members</h3>
						</div>
						@foreach($potential_family_members as $potential_family_member)
							<div class="form-row">
								<div class="form-group col-8">
									<input class="form-control" value="{{ $potential_family_member->firstname . ' ' . $potential_family_member->lastname }}" disabled />
									<input value="{{ $potential_family_member->id }}" hidden />
								</div>
								<div class="">
									<div class="form-group col-2">
										<a href="#" class="btn btn-danger{{ $potential_family_member->id == $member->id ? ' disabled' : '' }}">Add To</a>
									</div>
								</div>
							</div>
						@endforeach
					@endif
					<div class="form-group">
						{{ Form::submit('Update Member', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>	
	</div>
@endsection
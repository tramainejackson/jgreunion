@extends('layouts.app')

@section('content')
	<div class="container-fluid" id="profilePage">

		@include('admin.nav')
		
		<div class="row white">
			@if(Auth::user()->is_admin())
				<div class="col-2 my-2">
					<div class="">
						<a href="/administrator" class="btn btn-info btn-lg">All Members</a>
						<a href="{{ route('members.create') }}" class="btn btn-info btn-lg my-2">Add New Member</a>

						@if($active_reunion != null)
							
							<a href="/registrations" class="btn btn-success btn-lg mw-100{{ $registered_for_reunion != null ? ' disabled' : '' }}" style="white-space: initial;" onclick="event.preventDefault(); document.getElementById('one_click_registration').submit();">{{ $registered_for_reunion != null ? 'Member Already Registered For ' . $active_reunion->reunion_city . ' Reunion'  : 'Add Member To ' . $active_reunion->reunion_city . ' Reunion' }}</a>
						
							{!! Form::open(['action' => 'RegistrationController@store', 'method' => 'POST', 'style' => 'display:none;', 'id' => 'one_click_registration']) !!}
								<input type="text" name="reg_member" class="" value="{{ $family_member->id }}" hidden />
								<input type="text" name="reunion_id" class="" value="{{ $active_reunion->id }}" hidden />
							{!! Form::close() !!}
						@endif
					</div>
				</div>
			
			@else
				
				<div class="col-2 my-2">
				</div>

			@endif
			
			<div class="col-8 membersForm">
			
				<h1 class="mt-2 mb-4">Edit {{ $family_member->firstname . ' ' . $family_member->lastname }}</h1>
				
				{!! Form::open(['action' => ['FamilyMemberController@update', 'family_member' => $family_member->id], 'method' => 'PUT']) !!}
				
					<div class="form-group">
						<label class="form-label" for="firstname">Firstname</label>
						<input type="text" name="firstname" class="form-control" value="{{ $family_member->firstname }}" placeholder="Enter First Name" />
					</div>
					
					<div class="form-group">
						<label class="form-label" for="lastname">Lastname</label>
						<input type="text" name="lastname" class="form-control" value="{{ $family_member->lastname }}" placeholder="Enter Last Name" />
					</div>
					
					<div class="form-group">
						<label class="form-label" for="email">Email</label>
						<input type="text" name="email" class="form-control" value="{{ $family_member->email }}" placeholder="Enter Email Address" />
					</div>
					
					<div class="form-group">
						<label class="form-label" for="address">Address</label>
						<input type="text" name="address" class="form-control" value="{{ $family_member->address }}" placeholder="Enter Address" />
					</div>
					
					<div class="form-row">
						<div class="form-group col-4">
							<label class="form-label" for="city">City</label>
							<input type="text" name="city" class="form-control" value="{{ $family_member->city }}" placeholder="Enter City" />
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="state">State</label>
							<select class="form-control form-control browser-default" name="state">
								@foreach($states as $state)
									<option value="{{ $state->state_abb }}" {{ $family_member->state == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="zip">Zip</label>
							<input type="number" name="zip" class="form-control" value="{{ $family_member->zip }}" placeholder="Enter Zip Code" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="form-label" for="phone">Phone</label>
						<input type="text" name="phone" class="form-control" value="{{ $family_member->phone }}" placeholder="Enter Phone Number" />
					</div>
					
					<div class="form-group">
						<label class="form-label" for="age_group">Age Group</label>
						<select class="form-control form-control browser-default" name="age_group">
							<option value="adult" {{ $family_member->age_group == 'adult' ? 'selected' : '' }}>Adult</option>
							<option value="youth" {{ $family_member->age_group == 'youth' ? 'selected' : '' }}>Youth</option>
							<option value="child" {{ $family_member->age_group == 'child' ? 'selected' : '' }}>Child</option>
						</select>
					</div>
					
					<div class="form-group">
						<label class="form-label" for="mail_preference">Mail Preference</label>
						<select class="form-control form-control browser-default" name="mail_preference">
							<option value="M" {{ $family_member->mail_preference == 'M' ? 'selected' : '' }}>Mail</option>
							<option value="E" {{ $family_member->mail_preference == 'E' ? 'selected' : '' }}>Email</option>
						</select>
					</div>
					
					<div class="form-group">
						<label class="form-label" for="notes">Additional Notes</label>
						<textarea class="form-control" name="notes" placeholder="Enter Additional Notes">{{ $family_member->notes }}</textarea>
					</div>
					
					<div class="form-row familyTreeGroup">
						<div class="form-group col-12">
							<h2 class="text-center">Family Tree</h2>
						</div>
						<div class="form-group text-center col-12">
						
							<button type="button" class="w-25 mx-auto btn my-2 descentInput{{ $family_member->descent == 'jackson' ? ' btn-success active' : ' btn-outline-success' }}">
								<input type="checkbox" name="descent" value="jackson" hidden {{ $family_member->descent == 'Y' ? 'checked' : '' }} />Jackson
							</button>
							
							<button type="button" class="w-25 mx-auto btn my-2 descentInput{{ $family_member->descent == 'green' ? ' btn-success active' : ' btn-outline-success' }}">
								<input type="checkbox" name="descent" value="green" hidden {{ $family_member->descent == 'green' ? 'checked' : '' }} />Green
							</button>
						</div>
						
						<div class="form-group text-center col-6">
							<label for="" class="form-label text-center d-block">Mother</label>
							<select class="form-control browser-default w-50 mx-auto" name="mother">
								<option value="blank" selected disabled>--- Select Mother ---</option>
								
								@foreach($members as $option)
								
									<option value="{{ $option->id }}" {{ $option->id == $family_member->mother ? 'selected' : '' }}>{{ $option->full_name() }}</option>
									
								@endforeach
								
							</select>
						</div>
						
						<div class="form-group text-center col-6">
							<label for="" class="form-label text-center d-block">Father</label>
							<select class="form-control browser-default w-50 mx-auto" name="father">
								<option value="blank">--- Select Father ---</option>
								
								@foreach($members as $option)
									
									<option value="{{ $option->id }}" {{ $option->id == $family_member->father ? 'selected' : '' }}>{{ $option->full_name() }}</option>
									
								@endforeach
								
							</select>
						</div>
						
						<div class="form-group text-center col-12">
							<label for="" class="form-label text-center d-block">Spouse</label>
							<select class="form-control browser-default w-50 mx-auto" name="spouse">
								<option value="blank">--- Select Spouse ---</option>
								
								@foreach($members as $option)
									
									<option value="{{ $option->id }}" {{ $option->id == $family_member->spouse ? 'selected' : '' }}>{{ $option->full_name() }}</option>
									
								@endforeach
								
							</select>
						</div>
						
						<div class="form-group text-center col-12">
						
							<label for="" class="form-label text-center d-block">Siblings</label>
							
							@foreach($siblings as $sibling)
							
								<select class="form-control browser-default w-50 mx-auto" name="siblings[]">
									<option value="blank">--- Select A Sibling ---</option>
									
									@foreach($members as $option)
									
										<option value="{{ $option->id }}" {{ $option->id == $sibling ? 'selected' : '' }}>{{ $option->full_name() }}</option>
										
									@endforeach
									
								</select>
								
							@endforeach
						</div>

						<!-- Blank row for adding a sibling member --> 
						<div class="form-group text-center col-12 siblingRow hidden">
						
							<select class="form-control browser-default w-50 mx-auto" name="siblings[]">
							
								<option value="blank">--- Select A Sibling ---</option>
								
								@foreach($members as $option)
									<option value="{{ $option->id }}">{{ $option->full_name() }}</option>
								
								@endforeach
							
							</select>
						</div>
						
						<div class="form-group text-center col-12">
							<button type="button" class="w-50 mx-auto btn btn-outline-success addSiblingRow" >Add Another Sibling</button>
						</div>
						
						<div class="form-group text-center col-12">
							
							<label for="" class="form-label text-center d-block">Children</label>
							
							@foreach($children as $child)
							
								<select class="form-control browser-default w-50 mx-auto" name="children[]">
									<option value="blank">--- Select A Child ---</option>
									@foreach($members as $option)
									
										<option value="{{ $option->id }}" {{ $option->id == $child ? 'selected' : '' }}>{{ $option->full_name() }}</option>
									
									@endforeach
								
								</select>
							
							@endforeach
						
						</div>
						
						<!-- Blank row for adding a child member --> 
						<div class="form-group text-center col-12 childrenRow hidden">
							<select class="form-control browser-default w-50 mx-auto" name="children[]">
							
								<option value="blank">--- Select A Child ---</option>
								
								@foreach($members as $option)
								
									<option value="{{ $option->id }}">{{ $option->full_name() }}</option>
									
								@endforeach
							</select>
						</div>
						<div class="form-group text-center col-12">
							<button type="button" class="w-50 mx-auto btn btn-outline-success addChildrenRow" >Add Another Child</button>
						</div>
					</div>
					<div class="houseHoldBlock">
						<div class="form-block-header">
							<h3 class="">Household Members
							<button type="button" class="btn btn-outline-success mb-2 addHHMember">Add Household Member</button>
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
											<a href="#" class="btn btn-danger{{ $family_member->id == $family_member->id ? ' disabled' : '' }}" onclick="event.preventDefault(); removeFromHouseHold({{ $family_member->id . ',' .$family_member->id }});">Remove Household Member</a>
										</div>
									</div>
								</div>
							@endforeach
						@endif
						
						<!-- Blank row for adding a household member --> 
						<div class="form-row hhMemberRow hidden">
							<div class="form-group col-7">
								<select class="form-control browser-default" name="houseMember[]">
									<option value="blank">--- Select A Household Member ---</option>
									@foreach($family_members as $option)
										<option value="{{ $option->id }}">{{ $option->firstname . ' ' . $option->lastname }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-2">
								<button type="button" class="btn btn-danger d-block removeHHMember">Remove</button>
							</div>
						</div>

						@if($potential_family_members->count() > $family_members->count())
							<div class="form-block-header">
								<h3 class="">Potential Household Members</h3>
							</div>
							@foreach($potential_family_members as $potential_family_member)
								@if($potential_family_member->id != $family_member->id)
									<div class="form-row">
										<div class="form-group col-8">
											<input class="form-control" value="{{ $potential_family_member->firstname . ' ' . $potential_family_member->lastname }}" disabled />
											<input value="{{ $potential_family_member->id }}" hidden />
										</div>
										<div class="">
											<div class="form-group col-2">
												<a href="#" class="btn btn-warning" onclick="event.preventDefault(); addToHouseHold({{$family_member->id . ',' . $potential_family_member->id}});">Add To Household</a>
											</div>
										</div>
									</div>
								@endif
							@endforeach
						@endif
					</div>
					<div class="form-group">
						{{ Form::submit('Update Member', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>	
	</div>
@endsection
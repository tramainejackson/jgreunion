@extends('layouts.app')

@section('content')
	<div class="container-fluid" id="profilePage">

		@include('admin.nav')
		
		<div class="row white">
		
			<div class="col-2 my-2">
				<div class="">
					<a href="{{ route('reunions.index') }}" class="btn btn-info btn-lg btn-block my-2">All Reunions</a>
					
					<a href="{{ route('create_reunion_pictures', ['reunion' => $reunion->id]) }}" class="btn btn-lg btn-block btn-outline-light-green">Add Reunion Photos</a>
					
					@if($reunion->reunion_complete == 'N')
						<a href="#" type="button" data-target="#completeReunionModal" data-toggle="modal" class="btn btn-warning btn-lg btn-block my-2">Complete Reunion</a>
					@endif
				</div>
			</div>
			
			<div class="col-8 my-2">
			
				<div class="">
					<h2 class="text-left">Edit {{ ucwords($reunion->reunion_city) }} Reunion</h2>
				</div>
				
				<div class="reunionBgrdWrapper">
					<div class="reunionBgrdDiv mb-3 z-depth-1-half rounded" style="min-height:200px; background: url('{{ asset($reunion->picture) }}') no-repeat center;">
						<div class="rgba-black-light white-text d-flex flex-column align-items-center justify-content-center" style="min-height:200px;">
							<div class="">
								<h1 class="h1-responsive">Change Background</h1>
							</div>
							
							{!! Form::open(['method' => 'PUT', 'files' => true]) !!}
							
								<div class="md-form">
								
									<div class="file-field">
										<div class="btn btn-primary btn-sm float-left">
											<span>Choose file</span>
											<input type="file" id="new_reunion_background" name="new_reunion_background" />
										</div>
										<div class="file-path-wrapper">
										   <input class="file-path validate white-text" type="text" placeholder="Upload Picture" />
										   
										   <input class="hidden" type="number" value="{{ $reunion->id }}" hidden />
										</div>
									</div>
								</div>
									
								<div class="animated" style="visibility:hidden;">
									<button class="btn btn-block btn-success reunionBgrdImg" type="button">Change Photo</button>
								</div>
							
							{!! Form::close()!!}
							
						</div>
					</div>
				</div>
				
				{!! Form::open(['action' => ['ReunionController@update', 'reunion' => $reunion->id], 'method' => 'PUT', 'files' => true]) !!}
					<div class="form-row">
						
						<div class="form-group mr-3 col-4">
							{{ Form::label('type', 'Paper Registration Form', ['class' => 'd-block form-control-label']) }}
							
							<div class="input-group">
								<div class="custom-file">
									<input type="file" name="paper_reg_form" class="custom-file-input" value="" />
									<label class="custom-file-label" for="paper_reg_form">Choose Document</label>
								</div>
							</div>
						</div>
						
						@if($reunion->registration_form != null)
							<div class="align-items-center col d-flex">
								{{ Form::label('type', '&nbsp;', ['class' => 'd-block form-control-label']) }}
								
								<a href="{{ asset('storage/' . str_ireplace('public/', '', $reunion->registration_form)) }}" class="btn btn-link btn-outline-info text-dark" download="{{ $reunion->reunion_year }}_Registration_Form">View Registration Form</a>
							</div>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label" for="reunion_city">City</label>
						<input type="text" name="reunion_city" class="form-control" value="{{ old('reunion_city') ? old('reunion_city') : $reunion->reunion_city }}" />
					</div>
					
					<div class="form-group">
						<label class="form-label" for="reunion_state">State</label>
						
						<select class="form-control browser-default" name="reunion_state">
							
							@foreach($states as $state)
								<option value="{{ $state->state_abb }}" {{ old('reunion_state') && old('reunion_state') == $state->state_abb ? 'selected' : $reunion->reunion_state == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
							@endforeach
							
						</select>
					</div>
					<div class="form-group">
						<label class="form-label" for="reunion_state">Year</label>
						
						<select class="form-control browser-default" name="reunion_year">
						
							@for($i=0; $i <= 10; $i++)
							
								<option value="{{ $carbonDate->addYear()->year }}" {{ old('reunion_year') && old('reunion_year') == $carbonDate->year ? 'selected' : $reunion->reunion_year == $carbonDate->year ? 'selected' : '' }}>{{ $carbonDate->year }}</option>
								
							@endfor
								
						</select>
					</div>
					<div class="form-row">
						<div class="form-group col-4">
							<label class="form-label" for="adult_price">Adult Price</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">$</span>
								</div>
								<input type="number" name="adult_price" class="form-control" value="{{ old('adult_price') ? old('adult_price') : $reunion->adult_price }}" step="0.01" placeholder="Price For Adult 18-Older" />
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon1">Per Adult</span>
								</div>
							</div>
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="youth_price">Youth Price</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">$</span>
								</div>
								<input type="number" name="youth_price" class="form-control" value="{{ old('youth_price') ? old('youth_price') : $reunion->youth_price }}" step="0.01" placeholder="Price For Youth 4-18" />
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon1">Per Youth</span>
								</div>
							</div>
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="child_price">Child Price</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">$</span>
								</div>
								<input type="number" name="child_price" class="form-control" value="{{ old('child_price') ? old('child_price') : $reunion->child_price }}" aria-label="Username" aria-describedby="basic-addon1" step="0.01" placeholder="Price For Children 3-Under" />
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon1">Per Child</span>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Committee Members Section -->
					<div class="form-block-header">
						<h3 class="">Committee
							<button type="button" class="btn btn-outline-success mb-2 addCommitteeMember">Add Committee Member</button>
							<button type="button" class="btn btn-primary mb-2">Committee Members <span class="badge badge-light">{{ $reunion->committee->count() }}</span>
							<span class="sr-only">total committee members</span>
							</button>
						</h3>
					</div>
					<div class="form-row">
						<span class="text-muted col-12">*Select From Listed Family Members</span>
					</div>
					@foreach($reunion->committee as $committee_member)
						<div class="form-row">
							<div class="form-group col-4">
								<label class="form-label" for="member_title">Committee Title</label>
								<select class="form-control browser-default" name="member_title[]">
									@foreach($titles as $title)
										<option value="{{ $title->title_name }}" {{ old('member_title') && old('member_title') == $title->title_name ? 'selected' : $committee_member->member_title == $title->title_name ? 'selected' : '' }}>{{ ucwords(str_ireplace('_', ' ', $title->title_name)) }}</option>
									@endforeach
								</select>
								<input type="text" name="committee_member_id[]" class="hidden" value="{{ $committee_member->id }}" hidden />
							</div>
							<div class="form-group col-6">
								<label class="form-label" for="dl_id">Member</label>
								<select class="form-control browser-default" name="dl_id[]">
									@foreach($members as $member)
										<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : $committee_member->dl_id == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-2">
								<label class="form-label m-0" for="">&nbsp;</label>
								
								<button type="button" class="btn btn-danger w-100 m-0" onclick="event.preventDefault(); removeCommitteeMember({{ $committee_member->id }});">Delete Member</button>
							</div>
						</div>
					@endforeach
					
					@if($reunion->committee->isEmpty())
						<div class="form-row emptyCommittee">
							<h2 class="text-center">No Committee Members Added Yet</h2>
						</div>
					@endif
					
					<div class="form-row committeeRow" hidden>
						<div class="form-group col-4">
							<label class="form-label" for="member_title">Committee Title</label>
							
							<select class="browser-default form-control" name="member_title[]" disabled>
								@foreach($titles as $title)
									<option value="{{ $title->title_name }}" {{ old('member_title') && old('member_title') == $title->title_name ? 'selected' : '' }}>{{ ucwords(str_ireplace('_', ' ', $title->title_name)) }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group col-6">
							<label class="form-label" for="dl_id">Member</label>
							<select class="browser-default form-control" name="dl_id[]" disabled>
								@foreach($members as $member)
									<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-2">
							<label class="form-label" for="">&nbsp;</label>
							<button type="button" class="btn btn-danger w-100 removeCommitteeMember">Remove</button>
						</div>
					</div>
					
					<!-- Reunion Events Section -->
					<div class="form-block-header">
						<h3 class="">Events
							<button type="button" class="btn btn-outline-success mb-2 addReunionEvent">Add New Event</button>
						</h3>
					</div>
					
					@if($reunion->events->isEmpty())
						<div class="form-row emptyEvents">
							<h2 class="text-center">No Events Added Yet For This Reunion</h2>
						</div>
					@endif
					
					@foreach($reunion_events as $event)
						@php $eventDate = new Carbon\Carbon($event->event_date); @endphp
						
						<div class="form-row">
							<div class="form-group col-3">
								<label class="form-label" for="member_title">Event Date</label>
								
								<input type="text" name="event_date[]" class="form-control datetimepicker" value="{{ $eventDate->format('m/d/Y') }}" placeholder="Select A Date" />
								<input type="text" name="event_id[]" class="hidden" value="{{ $event->id }}" hidden />
							</div>
							<div class="form-group col-3">
								<label class="form-label" for="member_title">Event Location</label>
								<input type="text" name="event_location[]" class="form-control" placeholder="Enter The Event Location" value="{{ $event->event_location }}" />
							</div>
							<div class="form-group col-4">
								<label class="form-label" for="dl_id">Description</label>
								<textarea class="form-control" name="event_description[]" placeholder="Enter A Description of The Event" rows="1" >{{ $event->event_description }}</textarea>
							</div>
							<div class="form-group col-2">
								<label class="form-label m-0" for="">&nbsp;</label>
								
								<button type="button" class="btn btn-danger w-100 m-0" onclick="event.preventDefault(); removeReunionEvent({{ $event->id }});">Delete Event</button>
							</div>
						</div>
					@endforeach
					
					<div class="form-row reunionEventRow" hidden>
						<div class="form-group col-3">
							<label class="form-label" for="member_title">Event Date</label>
							
							<input type="text" name="event_date[]" class="form-control datetimepicker" placeholder="Select a date" disabled />
						</div>
						<div class="form-group col-3">
							<label class="form-label" for="member_title">Event Location</label>
							<input type="text" name="event_location[]" class="form-control" value="" placeholder="Enter The Event Location" disabled />
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="dl_id">Description</label>
							
							<textarea class="form-control" name="event_description[]" placeholder="Enter A Description of The Event" rows="1" disabled></textarea>
						</div>
						<div class="form-group col-2">
							<label class="form-label" for="">&nbsp;</label>
							<button type="button" class="btn btn-danger w-100 removeReunionEventRow">Remove</button>
						</div>
					</div>
					
					<!-- Registered Members Section -->
					<div class="form-block-header">
						<h3 class="text-left">Registered Members
							<a href="{{ action('RegistrationController@create' , ['reunion' => $reunion->id]) }}" class="btn btn-outline-success mb-2">Add Registration</a>
							
							<button type="button" class="btn btn-primary mb-2">Registrations <span class="badge badge-light">{{ $totalRegistrations }}</span>
							<span class="sr-only">total registrations</span>
							</button>

							<button type="button" class="btn btn-outline-primary mb-2" data-target="#viewRgistrationsModal" data-toggle="modal">View Registrations Totals</button>
						</h3>
					</div>
					
					@php $loopCount = 0; @endphp
					@foreach($reunion->registrations as $registration)
						@php
							$adults = $registration->adult_names != null || $registration->adult_names != '' ? explode('; ', $registration->adult_names) : null;

							$youths = $registration->youth_names != null || $registration->youth_names != '' ? explode('; ', $registration->youth_names) : null;

							$childs = $registration->children_names != null || $registration->children_names != '' ? explode('; ', $registration->children_names) : null;
						@endphp
						
						@if($registration->parent_reg == null)
							
							@php $loopCount++; @endphp
							
							<div class="form-row my-2">
								
								@if($registration->dl_id == null)
									
									<div class="col">
										<div class="d-inline-block">
											<span class="">{{ $loopCount }}.</span>
											
											<input type="text" class="hidden selectRegistration" value="{{ $registration->id }}" hidden />
										</div>
										
										<div class="d-inline-block">
											<select class="form-control browser-default" name="" disabled>
												<option value="">{{ $registration->registree_name }}</option>
											</select>
										</div>
									</div>
									
								@else
									
									<div class="col d-flex align-items-center justify-content-center">
										<div class="mr-2">
											<span class="">{{ $loopCount }}.</span>
											
											<input type="text" class="hidden selectRegistration" value="{{ $registration->id }}" hidden />
										</div>
										
										<div class="">
											<select class="form-control browser-default" name="" disabled>
												@foreach($members as $member)
													<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : $registration->dl_id == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
												@endforeach
											</select>
										</div>
									</div>
									
								@endif
								
								<div class="col">
									<button type="button" class="btn btn-primary btn-block mb-2">Family Total <span class="badge badge-light">{{ (count($adults) + count($youths) + count($childs)) }}</span>
									<span class="sr-only">total household members</span>
									</button>
								</div>
								
								<div class="col">
									<a href="/registrations/{{ $registration->id }}/edit" class="btn btn-warning btn-block">Edit</a>
								</div>
								
								<div class="col">
									<button type="button" data-toggle="modal" data-target=".delete_registration{{ $loop->iteration }}" class="btn btn-danger btn-block text-truncate deleteRegistration" onclick="removeRegistrationModal({{ $registration->id }});">Delete Registration</button>
								</div>
							</div>
							
						@endif
						
					@endforeach
					
					@if($reunion->registrations->isEmpty())
						<div class="form-row emptyRegistrations">
							<h2 class="text-left col-10">No Members Registered Yet</h2>
						</div>
					@endif
					<div class="form-group">
						{{ Form::submit('Update Reunion', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
		
		<!--Modal: modalConfirmDelete-->
		<div class="modal fade" id="completeReunionModal" tabindex="-1" role="dialog" aria-labelledby="completeReunionModal" aria-hidden="true">
		
			<div class="modal-dialog modal-sm modal-notify modal-warning" role="document">
			
				{!! Form::open(['action' => ['ReunionController@update', 'reunion' => $reunion->id], 'method' => 'PATCH']) !!}
				
					<!--Content-->
					<div class="modal-content text-center">
						<!--Header-->
						<div class="modal-header d-flex justify-content-center">
							<p class="heading">Are you sure?</p>
						</div>

						<!--Body-->
						<div class="modal-body">
							<h2 class="">Completing this reunion will make it inactive and disable any update to it. Continue?</h2>
							
							<input type="text" name="completed_reunion" class="hidden" value="Y" hidden />
						</div>

						<!--Footer-->
						<div class="modal-footer flex-center">
							<button type="submit" class="btn btn-outline-warning">Yes</button>
							
							<button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">No</a>
						</div>
						
					</div>
					<!--/.Content-->
					
				{!! Form::close() !!}
				
			</div>
			
		</div>
		<!--Modal: modalConfirmDelete-->
		
		<!--Modal: modalConfirmDelete-->
		<div class="modal fade" id="viewRgistrationsModal" tabindex="-1" role="dialog" aria-labelledby="viewRgistrationsModal" aria-hidden="true">
		
			<div class="modal-dialog modal-lg" role="document">
				
				<!--Content-->
				<div class="modal-content text-center">
					<!--Header-->
					<div class="modal-header d-flex justify-content-center">
					
						<p class="heading">View Registration Totals</p>
					
					</div>

					<!--Body-->
					<div class="modal-body">
					
						<div class="table-wrapper">
						
							<table class="table table-hover">
							
								<thead>
									<tr>
										<th>Total Registrations</th>
										<th># Adults</th>
										<th># Youth</th>
										<th># Children</th>
										<th>$ Total Reg Fees</th>
										<th>$ Total Reg Paid</th>
										<th>$ Total Reg Due</th>
									</tr>
								</thead>
								
								<tbody>
									<tr>
										<td>{{ $totalRegistrations }}</td>
										<td>{{ $totalAdults }}</td>
										<td>{{ $totalYouths }}</td>
										<td>{{ $totalChildren }}</td>
										<td>${{ $totalFees }}</td>
										<td>${{ $totalRegFeesPaid }}</td>
										<td>${{ $totalRegFeesDue }}</td>
									</tr>
									
								</tbody>
								
							</table>
							
						</div>
						
						<div class="table-wrapper">
						
							<table class="table table-hover">
							
								<thead>
									<tr>
										<th>Total Shirts</th>
										<th>3XL</th>
										<th>2XL</th>
										<th>XL</th>
										<th>Large</th>
										<th>Medium</th>
										<th>Small</th>
										<th>Youth Large</th>
										<th>Youth Medium</th>
										<th>Youth Small</th>
										<th>Youth XS</th>
										<th>6</th>
										<th>5T</th>
										<th>4T</th>
										<th>3T</th>
										<th>2T</th>
										<th>12 Month</th>
									</tr>
								</thead>
								
								<tbody>
									<tr>
										<td>{{ $totalShirts }}</td>
										<td>{{ $aXXXl }}</td>
										<td>{{ $aXXl }}</td>
										<td>{{ $aXl }}</td>
										<td>{{ $aLg }}</td>
										<td>{{ $aMd }}</td>
										<td>{{ $aSm }}</td>
										<td>{{ $yLg }}</td>
										<td>{{ $yMd }}</td>
										<td>{{ $ySm }}</td>
										<td>{{ $yXSm }}</td>
										<td>{{ $c6 }}</td>
										<td>{{ $c5T }}</td>
										<td>{{ $c4T }}</td>
										<td>{{ $c3T }}</td>
										<td>{{ $c2T }}</td>
										<td>{{ $c12M }}</td>
									</tr>
									
								</tbody>
								
							</table>
							
						</div>
					</div>

					<!--Footer-->
					<div class="modal-footer flex-center">
						<button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Close</a>
					</div>
					
				</div>
				<!--/.Content-->
				
			</div>
			
		</div>
		<!--Modal: modalConfirmDelete-->
	</div>
@endsection
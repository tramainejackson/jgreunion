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
					<!-- <a href='/profile' class='profileLink nav-link border-0'>My Profile</a> -->
					<a href='/administrator' class='profileLink nav-link border-0'>Family Members</a>
					<a href='/reunions' class='profileLink nav-link active'>Reunions</a>
					<!-- <a href='/settings' class='profileLink nav-link'>Settings</a> -->
				</nav>
			</div>
		</div>
		<div class="row bg-light">
			<div class="col-2 my-2">
				<div class="">
					<a href="/reunions" class="btn btn-info btn-lg">All Reunions</a>
					<a href="/reunions/create" class="btn btn-info btn-lg my-2">New Reunion</a>
				</div>
			</div>
			<div class="col-8 my-2">
				<div class="">
					<h2 class="text-left">Edit {{ ucwords($reunion->reunion_city) }} Reunion</h2>
				</div>
				{!! Form::open(['action' => ['ReunionController@update', 'reunion' => $reunion->id], 'method' => 'PUT']) !!}
					<div class="form-group">
						{{ Form::label('type', 'Reunion Complete', ['class' => 'd-block form-control-label']) }}
								
						<div class="btn-group">
							<button type="button" class="btn{{ $reunion->reunion_complete == 'Y' ? ' btn-success active' : ' btn-secondary' }}" style="line-height:1.5">
								<input type="checkbox" name="reunion_complete" value="Y" hidden {{ $reunion->reunion_complete == 'Y' ? 'checked' : '' }} />Yes
							</button>
							<button type="button" class="btn px-3{{ $reunion->reunion_complete == 'N' ? ' btn-danger active' : ' btn-secondary' }}" style="line-height:1.5">
								<input type="checkbox" name="reunion_complete" value="N" hidden {{ $reunion->reunion_complete == 'N' ? 'checked' : '' }} />No
							</button>
						</div>
					</div>
					<div class="form-group">
						<label class="form-label" for="reunion_city">City</label>
						<input type="text" name="reunion_city" class="form-control" value="{{ old('reunion_city') ? old('reunion_city') : $reunion->reunion_city }}" />
					</div>
					<div class="form-group">
						<label class="form-label" for="reunion_state">State</label>
						<select class="form-control" name="reunion_state">
							@foreach($states as $state)
								<option value="{{ $state->state_abb }}" {{ old('reunion_state') && old('reunion_state') == $state->state_abb ? 'selected' : $reunion->reunion_state == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label" for="reunion_state">Year</label>
						<select class="form-control" name="reunion_year">
							@foreach($years as $year)
								<option value="{{ $year->year_num }}" {{ old('reunion_year') && old('reunion_year') == $year->year_num ? 'selected' : $reunion->reunion_year == $year->year_num ? 'selected' : '' }}>{{ $year->year_num }}</option>
							@endforeach
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
					<div class="form-block-header">
						<h3 class="">Committee
							<button type="button" class="btn btn-outline-success mb-2 addCommitteeMember">Add Committee Member</button>
							<button type="button" class="btn btn-primary mb-2">Committee Members <span class="badge badge-light">{{ $reunion->committee->count() }}</span>
							<span class="sr-only">total committee members</span>
							</button>
						</h3>
					</div>
					
					@foreach($reunion->committee as $committee_member)
						<div class="form-row">
							<div class="form-group col-4">
								<label class="form-label" for="member_title">Committee Title</label>
								<select class="form-control" name="member_title">
									@foreach($titles as $title)
										<option value="{{ $title->title_name }}" {{ old('member_title') && old('member_title') == $title->title_name ? 'selected' : $committee_member->member_title == $title->title_name ? 'selected' : '' }}>{{ ucwords(str_ireplace('_', ' ', $title->title_name)) }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-6">
								<label class="form-label" for="dl_id">Member</label>
								<select class="form-control" name="dl_id">
									@foreach($members as $member)
										<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : $committee_member->dl_id == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-2">
								<label class="form-label" for="">&nbsp;</label>
								<button type="button" class="btn btn-danger w-100">Delete Member</button>
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
							<select class="form-control" name="member_title[]">
								@foreach($titles as $title)
									<option value="{{ $title->title_name }}" {{ old('member_title') && old('member_title') == $title->title_name ? 'selected' : '' }}>{{ ucwords(str_ireplace('_', ' ', $title->title_name)) }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-6">
							<label class="form-label" for="dl_id">Member</label>
							<select class="form-control" name="dl_id[]">
								@foreach($members as $member)
									<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-2">
							<label class="form-label" for="">&nbsp;</label>
							<button type="button" class="btn btn-danger w-100">Remove</button>
						</div>
					</div>
					<div class="form-block-header">
						<h3 class="text-left">Registered Members
							<button type="button" class="btn btn-outline-success mb-2 addCommitteeMember">Add Registration</button>
							<button type="button" class="btn btn-primary mb-2">Registrations <span class="badge badge-light">{{ $reunion->registrations->count() }}</span>
							<span class="sr-only">total registrations</span>
							</button>
						</h3>
					</div>
					@foreach($reunion->registrations as $registration)
						<div class="form-row">
							<div class="form-group col-1">
								<span class="d-inline-block">{{ $loop->iteration }}.</span>
							</div>
							<div class="form-group col-7">
								<select class="custom-select" name="" disabled>
									@foreach($members as $member)
										<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : $registration->dl_id == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-2">
								<a href="/registrations/{{ $registration->id }}/edit" class="btn btn-warning d-block">Edit</a>
							</div>
							<div class="form-group col-2">
								<a href="" class="btn btn-danger d-block">Remove</a>
							</div>
						</div>
					@endforeach
					
					<div class="form-row registreeeeRow" hidden>
						<div class="form-group col-4">
							<label class="form-label" for="registree">Member</label>
							<select class="form-control" name="dl_id[]">
								@foreach($members as $member)
									<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-2">
							<label class="form-label" for="">&nbsp;</label>
							<button type="button" class="btn btn-danger w-100">Remove</button>
						</div>
					</div>

					@if($reunion->registrations->isEmpty())
						<div class="form-row emptyRegistrations">
							<h2 class="text-left col-10">No Members Registered Yet</h2>
						</div>
					@endif
					<div class="form-group">
						{{ Form::submit('Update', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
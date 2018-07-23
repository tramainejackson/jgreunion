@extends('layouts.app')

@section('content')
	<div class="container-fluid" id="profilePage">
		
		@include('admin.nav')
		
		<div class="row white">
		
			<div class="col-2 my-2">
				<div class="">
					<a href="/reunions" class="btn btn-info btn-lg">All Reunions</a>
				</div>
			</div>
			
			<div class="col-8 reunionForm">
			
				<h1 class="mt-2 mb-0">Create New Reunion</h1>
				<h4 class="nt-0 mb-4 red-text">**Creating A New Reunion Will Make All Current Reunions Complete**</h4>
				
				{!! Form::open(['action' => ['ReunionController@store'], 'method' => 'POST']) !!}
				
					<div class="form-block-header">
						<h3 class="">Location</h3>
					</div>
					
					<div class="form-row">
						<div class="form-group col-6">
							<label class="form-label" for="reunion_city">City</label>
							<input type="text" name="reunion_city" class="form-control" value="{{  old('reunion_city') }}" placeholder="Enter City For Next Reunion" />
						</div>
						<div class="form-group col-6">
							<label class="form-label" for="reunion_state">State</label>
							
							<select class="browser-default form-control" name="reunion_state">
								@foreach($states as $state)
									<option value="{{ $state->state_abb }}" {{ old('reunion_state') && old('reunion_state') == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="form-label" for="reunion_state">Year</label>
						
						<select class="browser-default form-control" name="reunion_year">
							@for($i=0; $i <= 10; $i++)
								
								<option value="{{ $carbonDate->addYear()->year }}" {{ old('reunion_year') && old('reunion_year') == $year->year_num ? 'selected' : '' }}>{{ $carbonDate->year }}</option>
								
							@endfor
						</select>
					</div>
					<div class="form-block-header">
						<h3 class="">Prices</h3>
					</div>
					<div class="form-group">
						<label class="form-label" for="adult_price">Adult Price</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="adult_price" class="form-control" value="{{ old('adult_price') }}" step="0.01" placeholder="Price For Adult 18-Older" />
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon1">Per Adult</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="form-label" for="youth_price">Youth Price</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="youth_price" class="form-control" value="{{ old('youth_price') }}" step="0.01" placeholder="Price For Youth 4-18" />
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon1">Per Youth</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="form-label" for="child_price">Child Price</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="child_price" class="form-control" value="{{ old('child_price') }}" aria-label="Username" aria-describedby="basic-addon1" step="0.01" placeholder="Price For Children 3-Under" />
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon1">Per Child</span>
							</div>
						</div>
					</div>
					
					<div class="form-block-header">
						<h3 class="">Committee
							<button type="button" class="btn btn-outline-success mb-2 addCommitteeMember">Add Committee Member</button>
						</h3>
					</div>
					
					<div class="form-row">
					
						<div class="form-group col-4">
							<label class="form-label" for="member_title">Committee Title</label>
							
							<select class="browser-default form-control" name="member_title">
								@foreach($titles as $title)
									<option value="{{ $title->title_name }}" {{ old('member_title') && old('member_title') == $title->title_name ? 'selected' : '' }}>{{ ucwords(str_ireplace('_', ' ', $title->title_name)) }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group col-8">
							<label class="form-label" for="dl_id">Member</label>
							
							<select class="browser-default form-control" name="dl_id">
								@foreach($members as $member)
									<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-row committeeRow" hidden>
						<div class="form-group col-4">
							<label class="form-label" for="member_title">Committee Title</label>
							
							<select class="browser-default form-control" name="member_title[]">
								@foreach($titles as $title)
									<option value="{{ $title->title_name }}" {{ old('member_title') && old('member_title') == $title->title_name ? 'selected' : '' }}>{{ ucwords(str_ireplace('_', ' ', $title->title_name)) }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group col-8">
							<label class="form-label" for="dl_id">Member</label>
							
							<select class="browser-default form-control" name="dl_id[]">
								@foreach($members as $member)
									<option value="{{ $member->id }}" {{ old('dl_id') && old('dl_id') == $member->id ? 'selected' : '' }}>{{ $member->firstname . ' ' . $member->lastname }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::submit('Create New Reunion', ['class' => 'btn btn-primary form-control']) }}
					</div>
					
				{!! Form::close() !!}
				
			</div>
		</div>	
	</div>
@endsection
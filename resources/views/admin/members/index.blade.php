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
					<a href='/registrations' class='profileLink nav-link'>Registrations</a>
					<a href='/administrator' class='profileLink nav-link'>Family Members</a>
					<a href='/reunions' class='profileLink nav-link active'>Reunions</a>
					<a href='/settings' class='profileLink nav-link'>Settings</a>
				</nav>
			</div>
		</div>
		<div class="row bg-light">
			<div class="col-2 my-2">
				<div class="">
					<a href="/reunions/create" class="btn btn-info btn-lg">Create New Reunion</a>
				</div>
			</div>
			<div class="col-8 my-2">
				<ul class="list-group">
					<li class="list-group-item list-group-item-info">All Reunions</li>
					@foreach($reunions as $reunion)
						<li class="list-group-item list-group-item-action reunionItem">
							<h2 class="" data-toggle="collapse" data-parent="#reunionAccordion" href="#reunionAccordion{{$loop->iteration}}" aria-expanded="true" aria-controls="reunionAccordion1">{{ $reunion->reunion_city . ' ' . $reunion->reunion_year }}</h2>
							@if($reunion->has_site == 'Y')
								{!! Form::open(['action' => ['ReunionController@update', 'reunion' => $reunion->id], 'method' => 'POST']) !!}
									<div class="container-fluid collapse" id="reunionAccordion{{$loop->iteration}}">
										<div class="form-row my-3">
											<div class="form-group col-4">
												<label class="form-label" for="reunion_city">City</label>
												<input type="text" name="reunion_city" class="form-control" value="{{ old('reunion_city') ? old('reunion_city') : $reunion->reunion_city }}" />
											</div>
											<div class="form-group col-4">
												<label class="form-label" for="reunion_state">State</label>
												<select class="form-control" name="reunion_state">
													@foreach($states as $state)
														<option value="{{ $state->state_abb }}" {{ old('reunion_state') && old('reunion_state') == $state->state_abb ? 'selected' : $reunion->reunion_state == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group col-4">
												<label class="form-label" for="reunion_state">Year</label>
												<select class="form-control" name="reunion_year">
													@foreach($years as $year)
														<option value="{{ $year->year_num }}" {{ old('reunion_year') && old('reunion_year') == $year->year_num ? 'selected' : $reunion->reunion_year == $year->year_num ? 'selected' : '' }}>{{ $year->year_num }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-row my-3">
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
										<div class="form-group">
											{{ Form::submit('Update', ['class' => 'btn btn-primary form-control']) }}
										</div>
									</div>
								{!! Form::close() !!}
							@else
								<div class="container-fluid collapse" id="reunionAccordion{{$loop->iteration}}">
									<h3 class="text-center">No Additional Information For This Reunion</h3>
								</div>
							@endif
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection
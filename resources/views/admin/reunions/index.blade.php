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
								<div class="container-fluid collapse" id="reunionAccordion{{$loop->iteration}}">
									<div class="form-row my-3">
										<div class="form-group col-4">
											<label class="form-label" for="reunion_city">City</label>
											<input type="text" class="form-control" value="{{ $reunion->reunion_city }}" disabled />
										</div>
										<div class="form-group col-4">
											<label class="form-label" for="reunion_state">State</label>
											<select class="form-control" disabled>
												@foreach($states as $state)
													<option value="{{ $state->state_abb }}" {{ $reunion->reunion_state == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-4">
											<label class="form-label" for="reunion_state">Year</label>
											<select class="form-control" disabled>
												@foreach($years as $year)
													<option value="{{ $year->year_num }}" {{ $reunion->reunion_year == $year->year_num ? 'selected' : '' }}>{{ $year->year_num }}</option>
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
												<input type="number" class="form-control" value="{{ $reunion->adult_price }}" disabled />
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
												<input type="number" class="form-control" value="{{ $reunion->youth_price }}" disabled />
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
												<input type="number" class="form-control" value="{{ $reunion->child_price }}" aria-label="Username" disabled />
												<div class="input-group-append">
													<span class="input-group-text" id="basic-addon1">Per Child</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row justify-content-around mb-3">
										<button type="button" class="btn btn-primary col-4">Registrations <span class="badge badge-light">{{ $reunion->registrations->count() }}</span>
										<span class="sr-only">total registrations</span>
										</button>

										<button type="button" class="btn btn-primary col-4">Committee Members <span class="badge badge-light">{{ $reunion->committee->count() }}</span>
										<span class="sr-only">total committee members</span>
										</button>
									</div>
									<div class="form-group">
										<a href="/reunions/{{ $reunion->id }}/edit" class="btn btn-warning btn-lg">Edit Reunion</a>
									</div>
								</div>
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
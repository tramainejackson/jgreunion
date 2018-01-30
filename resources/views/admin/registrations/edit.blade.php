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
					<a href="/reunions/{{ $registration->reunion->id }}/edit" class="btn btn-info btn-lg">All Registrations</a>
				</div>
			</div>
			<div class="col-8 membersForm">
				<h1 class="mt-2 mb-4">Edit {{ $registration->registree_name }} ({{ $registration->reunion->reunion_city }} Reunion {{ $registration->reunion->reunion_year }})</h1>
				
				<!-- Update Form -->
				{!! Form::open(['action' => ['RegistrationController@update', 'registration' => $registration->id], 'method' => 'PUT']) !!}
					<div class="form-group">
						<label class="form-label" for="registree">Registree</label>
						<select class="custom-select form-control" name="registree">
							@foreach($family as $family_member)
								<option value="{{ $family_member->id }}" {{ $family_member->id == $registration->reunion_dl->id ? 'selected' : '' }}>{{ $family_member->firstname . ' ' . $family_member->lastname }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label" for="address">Address</label>
						<input type="text" name="address" class="form-control" value="{{ $registration->reunion_dl->address }}" placeholder="Enter Address" disabled />
					</div>
					<div class="form-row">
						<div class="form-group col-4">
							<label class="form-label" for="city">City</label>
							<input type="text" name="city" class="form-control" value="{{ $registration->reunion_dl->city }}" placeholder="Enter City" disabled />
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="state">State</label>
							<select class="form-control custom-select" name="state" disabled>
								@foreach($states as $state)
									<option value="{{ $state->state_abb }}" {{ $registration->reunion_dl->state == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-4">
							<label class="form-label" for="zip">Zip</label>
							<input type="number" name="zip" class="form-control" value="{{ $registration->reunion_dl->zip }}" placeholder="Enter Zip Code" disabled />
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label class="form-label" for="email">Email</label>
							<input type="text" name="email" class="form-control" value="{{ $registration->reunion_dl->email }}" placeholder="Enter Email Address" disabled />
						</div>
						<div class="form-row col-6">
							<label class="form-label col-12" for="city">Phone</label>
							<div class="form-group col-3">
								<input type="number" name="phone1" class="form-control" value="{{ old('phone1') ? old('phone1') : substr($registration->reunion_dl->phone, 0, 3) }}" placeholder="###" max="999" disabled />
							</div>
							<span>-</span>
							<div class="form-group col-3">
								<input type="number" name="phone2" class="form-control" value="{{ old('phone2') ? old('phone2') : substr($registration->reunion_dl->phone, 3, 3) }}" placeholder="###" max="999" disabled />
							</div>
							<span>-</span>
							<div class="form-group col-5">
								<input type="number" name="phone3" class="form-control" value="{{ old('phone3') ? old('phone3') : substr($registration->reunion_dl->phone, 6, 4) }}" placeholder="####" max="9999" disabled />
							</div>
						</div>
					</div>
					<div class="form-block-header">
						<h3 class="">Registration Information</h3>
					</div>
					<div class="form-row">
						<div class="form-group col-4">
							<label class="form-label text-danger" for="due_at_reg">Registration Amount</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">$</span>
								</div>
								<input type="number" name="due_at_reg" class="form-control" value="{{ $registration->due_at_reg }}" placeholder="Enter Registration Cost" step="0.01" />
							</div>
						</div>
						<div class="form-group col-4">
							<label class="form-label text-danger" for="total_amount_due">Due Amount</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">$</span>
								</div>
								<input type="number" name="total_amount_due" class="form-control" value="{{ $registration->total_amount_due }}" placeholder="Enter Due Cost" step="0.01" />
							</div>
						</div>
						<div class="form-group col-4">
							<label class="form-label text-danger" for="total_amount_paid">Paid Amount</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">$</span>
								</div>
								<input type="number" name="total_amount_paid" class="form-control" value="{{ $registration->total_amount_paid }}" placeholder="Enter Amount Paid" step="0.01" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<h3 class="">Shirt Sizes</h3>
					</div>
					<div class="form-row">
						<div class="form-group col-4 mb-0">
							<label for="" class="form-label">Adults</label>
						</div>
						<div class="form-group col-4 mb-0">
							<label for="" class="form-label">Youth</label>
						</div>
						<div class="form-group col-4 mb-0">
							<label for="" class="form-label">Children</label>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-4">
							@foreach($family as $family_reg)
								@if($family_reg->age_group == 'adult')
									<div class="my-1">
										<input type="text" name="" class="form-control" value="{{ $family_reg->firstname }}" disabled />

										<select class="custom-select form-control" name="shirt_sizes[]">
											<option value="S" {{ isset($adultSizes[$loop->iteration - 1]) ? $adultSizes[$loop->iteration - 1] == 'S' ? 'selected' : '' : ' '}}>Small</option>
											<option value="M" {{ isset($adultSizes[$loop->iteration - 1]) ? $adultSizes[$loop->iteration - 1] == 'M' ?  'selected' : ''  : '' }}>Medium</option>
											<option value="L" {{ isset($adultSizes[$loop->iteration - 1]) ? $adultSizes[$loop->iteration - 1] == 'L' ?  'selected' : '' : '' }}>Large</option>
											<option value="XL" {{ isset($adultSizes[$loop->iteration - 1]) ? $adultSizes[$loop->iteration - 1] == 'XL' ?  'selected' : '' : '' }}>Extra Large</option>
											<option value="XXL" {{ isset($adultSizes[$loop->iteration - 1]) ? $adultSizes[$loop->iteration - 1] == 'XXL' ?  'selected' : '' : '' }}>2XL</option>
											<option value="XXXL" {{ isset($adultSizes[$loop->iteration - 1]) ? $adultSizes[$loop->iteration - 1] == 'XXXL' ?  'selected' : '' : '' }}>3XL</option>
										</select>
									</div>
								@endif
							@endforeach
						</div>
						<div class="form-group col-4">
							@foreach($family as $family_reg)
								@if($family_reg->age_group == 'youth')
									<div class="my-1">
										<input type="text" name="" class="form-control" value="{{ $family_reg->firstname }}" />
										
										<select class="custom-select form-control" name="shirt_sizes[]">
											<option value="S">Small</option>
											<option value="M">Medium</option>
											<option value="L">Large</option>
											<option value="XL">Extra Large</option>
											<option value="XXL">2XL</option>
											<option value="XXXL">3XL</option>
										</select>
									</div>
								@endif
							@endforeach
						</div>
						<div class="form-group col-4">
							@foreach($family as $family_reg)
								@if($family_reg->age_group == 'child')
									<div class="my-1">
										<input type="text" name="" class="form-control" value="{{ $family_reg->firstname }}" disabled />
										
										<select class="custom-select form-control" name="shirt_sizes[]">
											<option value="S">Small</option>
											<option value="M">Medium</option>
											<option value="L">Large</option>
											<option value="XL">Extra Large</option>
											<option value="XXL">2XL</option>
											<option value="XXXL">3XL</option>
										</select>
									</div>
								@endif
							@endforeach
						</div>
					</div>
					<div class="form-group">
						<label class="form-label" for="reg_notes">Registration Notes</label>
						<textarea class="form-control" name="reg_notes" placeholder="Enter registration notes for {{ $registration->registree_name }}">{{ $registration->reg_notes }}</textarea>
					</div>
					<div class="form-group">
						{{ Form::submit('Update Registration', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>	
	</div>
@endsection
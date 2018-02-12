@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
	<style>
		#reunion_page {
			background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset('storage/' . str_ireplace('public/', '', $reunion->picture)) }}');
		}
		
		@media only screen and (max-width:576px) {
			#reunion_page {
				background: none;
			}
			
			#reunion_page::after {
				content: "";
				position: fixed;
				background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset('storage/' . str_ireplace('public/', '', $reunion->picture)) }}');
				background-size: cover;
				background-attachment: fixed;
				background-position: center center;
				background-repeat: no-repeat;
			    top: 0;
				left: 0;
				bottom: 0;
				right: 0;
				z-index: -10;
			}
			
			.activities_content:nth-of-type(2) {
				background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('/images/cookout.jpg');
				background-size: cover !important;
				background-attachment: fixed !important;
				background-position: center center !important;
				background-repeat: no-repeat !important;
			}
		}
	</style>
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div id="registration_modal" class="modal fade">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="">{{ $reunion->reunion_year . ' ' . $reunion->reunion_city }} Registration Form</h1>
				</div>
				<div class="modal-body">
					@include('reunion_registration_form')
				</div>
			</div>
		</div>
	</div>
	
	<div id="reunion_page" class="container-fluid pb-4">
		<div class="row d-sm-none">
			<button type="button" class="btn btn-dark btn-lg m-3" data-toggle="collapse" data-target="#upcoming_reunion_mobile" aria-expanded="false" aria-controls="upcoming_reunion_mobile">Menu</button>
		</div>
		<div class="row collapse" id="upcoming_reunion_mobile">
			<div class="col">
				<nav class="">
					<a href="/" class="btn btn-info btn-lg d-block my-2">Home</a>
					
					@if(!Auth::check())
						<a href="/upcoming_reunion/{{$reunion->id}}/registration_form" id="registrationFormLink" class="btn btn-info btn-lg w-100 d-block">Registration Form</a>
					@endif
					
					<a class="btn btn-lg my-2 d-block" id="fb_link" href="https://www.facebook.com/groups/129978977047141/" target="_blank">Jackson/Green Facebook Page Click Here</a>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="d-none d-sm-block col-sm-2">
				<div class="my-2">
					<a href="/" class="btn btn-info btn-lg d-block">Home</a>
				</div>
				
				@if(!Auth::check())
					<div id="registration_btn" class="my-1">
						<button type="button" id="registrationFormBtn" class="btn btn-info btn-lg w-100 d-block" data-toggle="modal" data-target="#registration_modal">Registration Form</button>
					</div>
				@endif
				
				<div class="">
					<a class="btn btn-lg my-2 d-block" id="fb_link" href="https://www.facebook.com/groups/129978977047141/" target="_blank">Jackson/Green Facebook Page Click Here</a>
				</div>
			</div>
			<div class="col-12 col-sm-8">
				<h1 class="text-center py-5 text-light display-sm-3 display-4">Jackson/Green Family Reunion {{ $reunion->reunion_year }}</h1>
			</div>
			<div class="d-none col-sm-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-11 col-md-8 mx-auto">
			
				<!-- Hotel information -->
				<div class="row reunion_content" id="hotel_information">
					<div class="col-12 reunionInformationHeader py-1">
						<h2 id="" class="text-center text-light">Hotel Information</h2>
					</div>
					<div class="col-12">
						<p class="text-center emptyInfo mt-3">Hotel Information Will Be Added Soon. Please Check Back At A Later Date.</p>
					</div>
				</div>
				
				<hr/>
				
				<!-- Activities information -->
				<div class="row reunion_content" id="activities_information" style="position: relative;">
					<div class="col-12 reunionInformationHeader py-1">
						<h2 id="" class="text-center text-light">Activities</h2>
					</div>
					@if($events->count() < 1)
						<div class="col-12">
							<p class="text-center mt-3 emptyInfo">No Activities Added Yet</p>
						</div>
					@else
						<div class="activities_content col-10 mx-auto my-2 py-2">
							@foreach($events as $events)
								<div class="activitiesEvent container-fluid">
									<div class="row">
										@foreach($events as $event)
											@php
												$eventDate = new Carbon\Carbon($event->event_date);
											@endphp
											@if($loop->first)
												<div class="col-12 my-3">
													<h2 class="activitiesEventLocation d-inline">{{ $eventDate->format('m/d/Y') }}</h2>
												</div>
											@endif
													
											@if($loop->first)
												<div class="col-12">
													<ul class="activitiesDescription col-12">
											@endif
												<li class=""><b><em>Location:&nbsp;</em></b>{{ $event->event_location }}</li>
												<li class=""><b><em>Event Description:&nbsp;</em></b>{{ $event->event_description }}</li>
												@if(!$loop->last)<li class="spacer-sm"></li>@endif
											@if($loop->last)
													</ul>
												</div>
											@endif
										@endforeach
									</div>
								</div>
							@endforeach
						</div>
					@endif
				</div>
				
				<hr/>
				
				<!-- Contact/Committee information -->
				<div class="row reunion_content" id="">
					<div class="col-12 reunionInformationHeader py-1">
						<h2 id="" class="text-center text-light">Committee Information</h2>
					</div>
					<div class="col-12 table-responsive">
						<table id="" class="table table-hover">
							<thead>
								<tr>
									<th><u>Title</u></th>
									<th><u>Name</u></th>
									<th><u>Email Address</u></th>
								</tr>
							</thead>
							<tbody>
								@foreach($committee_members as $committee)
									<tr>
										<td>{{ ucwords(str_ireplace('_', ' ', $committee->member_title)) }}</td>
										<td>{{ ucwords($committee->member_name) }}</td>
										<td><i>{{ $committee->member_email }}</i></td>
									</tr>
								@endforeach
								
								<tr>
									<td>Web Designer</td>
									<td>Tramaine Jackson</td>
									<td><i>jackson.tramaine3@yahoo.com</i></td>
								</tr>
							</tbody>
						</table>	
					</div>
				</div>
				
				<hr/>
				
				<!-- Payment Information -->
				<div class="row reunion_content" id="payment_information">
					<div class="col-12 reunionInformationHeader py-1">
						<h2 class="text-center text-light">Payment Information</h2>
					</div>
					<div id="paper_payment_option" class="payment_option col-11 col-sm-5 my-3 mx-auto">
						<h2>Paper Payment</h2>
						<p>Please make all checks payable to Jackson-Green Family Reunion. Checks can be sent to:</p>
						
						@if($committee_president->count() > 0)
							<p id="checks_address">
								<span>Address:</span>
								<span>{{ $committee_president->address }}</span>
								<span>{{ $committee_president->city. ', ' . $committee_president->state . ' ' .$committee_president->zip }}</span>
							</p>
							<p class="paymentsFinePrint">*Partial payments accepted</p>
							<p class="paymentsFinePrint">*Any return checks will incur a $30 penalty fee</p>
							
							@if($reunion->registration_form != null)
								<p>Click 
									<a href="{{ asset('storage/' . str_ireplace('public/', '', $reunion->registration_form)) }}" download="{{ $reunion->reunion_year }}_Registration_Form">here</a> to download the registration form.
								</p>
							@else
								<p class="">Paper Registration Form Has Not Been Uploaded Yet</p>
							@endif
						@else
							<p class="text-danger" id="checks_address">Committee Members Not Completed Yet. Once Members Addedd, An Address Will Be Available</p>
						@endif
					</div>
					<div id="electronic_payment_option" class="payment_option my-3 col-11 col-sm-5 mx-auto">
						<h2>Electronic Payment</h2>
						<p>All electronic payments can be sent to administrator@jgreunion.com for anyone who already has a paypal account.</p>
						<p>Click <a href="https://www.paypal.com" target="_blank">here</a> to go to paypal.</p>
					</div>
					<div class="col-12" id="registrationReminderMsg">
						<p>Please do not send any payment without completing the registration form first. You can click <span id="registrationLink" class="d-none d-sm-inline" data-toggle="modal" data-target="#registration_modal">here</span><a href="/upcoming_reunion/{{$reunion->id}}/registration_form" id="registrationLink" class="d-sm-none d-inline" >here</a> to complete your registration for the upcoming reunion.</p>
					</div>
				</div>
				
				<hr/>
				
				<!-- Registered Members For This Reunion -->
				<div class="row reunion_content" id="registered_members_information">
					<div class="col-12 reunionInformationHeader py-1">
						<h2 class="text-center text-light">Registered Family Members</h2>
					</div>
					
					@if($registrations->count() < 1)
						<div class="col-12">
							<p class="text-center emptyInfo mt-3">No Family Member Have Registered Yet</p>
						</div>
					@else
						<div class="col-12">
							<ul class="list-unstyled mt-4">
								@foreach($registrations as $registration)
									<li class="">{{ $loop->iteration . '. ' . $registration->registree_name }}</li>
									@if($registration->family_id != null)
										@php 
											$family_members = \App\Reunion_dl::where('family_id', $registration->family_id)->get();
										@endphp
										<li class="">
											<ul class="list-unstyled">
												@foreach($family_members as $family_member)
													<li class="">{{ $family_member->firstname }}</li>
												@endforeach
											</ul>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					@endif
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	
	<script>
		//Add total amounts to pay for registration
		$("body").on("change", "#attending_adult, #attending_youth, #attending_children", function(e) {
			var attendingNumA = $("#attending_adult").val();
			var attendingNumY = $("#attending_youth").val();
			var attendingNumC = $("#attending_children").val();
			var totalAmountA = Number(attendingNumA * $(".costPA").val());
			var totalAmountY = Number(attendingNumY * $(".costPY").val());
			var totalAmountC = Number(attendingNumC * $(".costPC").val());
			var totalDue = Number(totalAmountA + totalAmountY + totalAmountC);
			$("#total_adult").val(totalAmountA);
			$("#total_youth").val(totalAmountY);
			$("#total_children").val(totalAmountC);
			$("#total_amount_due").val(totalDue);
		});
	</script>
	@if($errors->count() > 0)
		<script>$('#registration_modal').modal('show');</script>
	@endif
@endsection
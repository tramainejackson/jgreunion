@extends('layouts.app')

@section('add_styles')

	<style>
	
		#reunion_page {
			background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset($reunion->picture) }}');
		}
		
		@media only screen and (max-width:576px) {
			
			#reunion_page {
				background: initial !important;
				background-size: initial !important;
				background-attachment: initial !important;
				background-position: initial !important;
				background-repeat: initial !important;
			}
			
			#reunion_page::before {
				content: "";
				display: block;
				position: fixed;
				background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset($reunion->picture) }}') no-repeat center center;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				width: 100%;
				height: 100%;
			    top: 0;
				left: 0;
				z-index: -1;
			}
			
			.activities_content:nth-of-type(2) {
				background: initial !important;
				background-size: initial !important;
				background-attachment: initial !important;
				background-position: initial !important;
				background-repeat: initial !important;
			}
			
			.activities_content:nth-of-type(2)::after {
				content: "";
				display: block;
				position: absolute;
				background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url("../images/cookout.jpg") no-repeat center center;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				width: 100%;
				height: 100%;
			    top: 0;
				left: 0;
				z-index: -1;
				
			}
			
		}

	</style>
	
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
		<div class="row d-xl-none">
			<button type="button" class="btn btn-dark m-3 px-4" data-toggle="collapse" data-target="#upcoming_reunion_mobile" aria-expanded="false" aria-controls="upcoming_reunion_mobile"><i class="fa fa-bars" aria-hidden="true"></i></button>
		</div>
		<div class="row collapse" id="upcoming_reunion_mobile">
			<div class="col">
				<nav class="">
					<a href="/" class="btn btn-info btn-lg d-block my-2">Home</a>
					
					@if(!Auth::check())
						<a href="/upcoming_reunion/{{$reunion->id}}/registration_form" id="registrationFormLink" class="btn btn-info btn-lg d-block">Registration Form</a>
					@endif
					
					<a class="btn btn-lg my-2 d-block" id="fb_link" href="https://www.facebook.com/groups/129978977047141/" target="_blank">Jackson/Green Facebook Page Click Here</a>
				</nav>
			</div>
		</div>
		
		<div class="row">
			<div class="d-none d-xl-block col-xl-2">
				<div class="my-2">
					<a href="/" class="btn btn-info btn-lg d-block">Home</a>
				</div>
				
				@if(!Auth::check())
					<div id="registration_btn" class="my-1">
						<a type="button" id="registrationFormBtn" class="btn btn-info btn-lg d-block" data-toggle="modal" data-target="#registration_modal">Registration Form</a>
					</div>
				@endif
				
				<div class="">
					<a class="btn btn-lg my-2 d-block" id="fb_link" href="https://www.facebook.com/groups/129978977047141/" target="_blank">Jackson/Green Facebook Page Click Here</a>
				</div>
			</div>
			<div class="col-12 col-xl-8">
				<h1 class="text-center py-5 text-light display-4">Jackson/Green Family Reunion {{ $reunion->reunion_year }}</h1>
			</div>
			<div class="d-none col-xl-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-11 col-xl-8 mx-auto">
			
				<!-- Hotel information -->
				<div class="row reunion_content" id="hotel_information">
				
					@if($reunion->hotel)
						
						<div class="col-12 reunionInformationHeader py-1">
							<h2 id="" class="text-center text-light">Hotel Information</h2>
						</div>
						<div class="col-12 col-xl-4 my-1">
							<img src="{{ asset($reunion->hotel->picture) }}" class="mw-100" />
						</div>
						
						<div class="col-12 col-xl-8">
							<p class="my-1"><span class="hotelInfoLabel">Hotel:</span> {{ $reunion->hotel->name != null ? $reunion->hotel->name : 'Not Hotel Added Yet' }}</p>
							
							<p class="my-1"><span class="hotelInfoLabel">Location:</span> {{ $reunion->hotel->location != null ? $reunion->hotel->location : 'Not Hotel Location Added Yet' }}</p>
							
							<p class="my-1"><span class="hotelInfoLabel">Room:</span> {{ $reunion->hotel->cost != null ? '$' . $reunion->hotel->cost . '/per night (not including taxes and fees)' : 'Not Hotel Room Cost Added Yet' }}</p>
							
							<p class="my-1"><span class="hotelInfoLabel">Contact:</span> {{ $reunion->hotel->phone != null ? $reunion->hotel->phone : 'Not Hotel Contact Added Yet'  }}</p>
							
							@if($reunion->hotel->phone != null)
								<p class="my-1"><span class="hotelInfoLabel">Additional Info:</span> Please call for any room upgrades.</p>
							@endif
							
							@if($reunion->hotel->book_room_link == null && $reunion->hotel->phone != null)
								<p class="my-1">*** Please Call To Book Room ***</p>
							@endif
						
						</div>
						
						<div class="col-12">
						
							<div class="form-block-header mb-xl-3">
							
								<h3 class="text-center">Hotel Amenities</h2>							
							</div>
							
							<div class="">
							
								<ul class="list-unstyled px-1">
								
									@if($reunion->hotel->features->isNotEmpty())
										
										@foreach($reunion->hotel->features as $hotel_feature)
										
											<li class="">{{ $hotel_feature->feature_desc }}</li>
										
										@endforeach
										
									@else
										
										<li class="text-center text-muted">We're still gathering information about the hotel and its amenities. Check back later for additional information</li>
										
									@endif
									
								</ul>
								
							</div>
						</div>
						
						@if($reunion->hotel->book_room_link !== null)
							
							<div class="col-12 text-center">
								<a href="{{ $reunion->hotel->book_room_link }}" class="btn btn-warning btn-lg" target="_blank">Book Hotel Room</a>
							</div>
							
						@endif
					
					@else
						
						<div class="col-12">
							<h2 class="text-center">No Hotel Added Yet For This Reunion</h2>
						</div>
						
					@endif
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
						
						<div class="activities_content col-11 col-md-10 mx-auto my-2 py-2">
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
					<div id="paper_payment_option" class="payment_option col-11 col-xl-5 my-3 mx-auto">
						@if($committee_president->count() > 0)
							<h2>Paper Payment</h2>
							<p>Please make all checks payable to {{ $committee_president->firstname . ' ' . $committee_president->lastname }}. Checks can be sent to:</p>
						@endif
						
						@if($committee_president->count() > 0)

							@if(strlen($committee_president->family_member->full_address()) > 5)
								<p id="checks_address">
									<span>Address:</span>
									<span>{{ $committee_president->family_member->full_address()}}</span></span>
								</p>
								<p class="paymentsFinePrint">*Partial payments accepted</p>
								<p class="paymentsFinePrint">*Any return checks will incur a $30 penalty fee</p>
							@endif
							
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
					<div id="electronic_payment_option" class="payment_option my-3 col-11 col-xl-5 mx-auto">
						<h2>Electronic Payment</h2>
						<p>All electronic payments can be sent to administrator@jgreunion.com for anyone who already has a paypal account.</p>
						<p>Click <a href=" https://www.paypal.com/pools/c/85OCIIUoUB" target="_blank">here</a> to go to paypal.</p>
					</div>
					
					@if(!Auth::check())
						
						<div class="col-12" id="registrationReminderMsg">
							<p>Please do not send any payment without completing the registration form first. You can click <span id="registrationLink" class="d-none d-sm-inline" data-toggle="modal" data-target="#registration_modal">here</span><a href="/upcoming_reunion/{{$reunion->id}}/registration_form" id="registrationLink" class="d-sm-none d-inline" >here</a> to complete your registration for the upcoming reunion.</p>
						</div>
						
					@else
						
						<div class="col-12" id="registrationReminderMsg">
							<p class="text-center">You are currently logged in as an admin. Please select <a href="/registrations/create/{{$reunion->id}}" id="registrationLink" class="d-inline" >here</a> to complete the registration for someone else.</p>
						</div>
						
					@endif
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
						@php
							function ucname($string) {
								$string =ucwords(strtolower($string));

								foreach (array('-', '\'') as $delimiter) {
								  if (strpos($string, $delimiter)!==false) {
									$string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
								  }
								}
								return $string;
							}
						@endphp

						@foreach($registrations->chunk(10) as $chunck)
							
							<div class="col-12 col-xl-4 mx-auto my-3">
							
								@foreach($chunck as $registration)
										
									<div class="px-3 py-3 my-1 rounded z-depth-1 rgba-stylish-strong white-text">
									
										<span>{{ $loop->iteration + (($loop->parent->iteration - 1) * 10) }}.</span>
										
										<h2 class="h2-responsive d-inline-block mb-1">{{ ucname($registration->registree_name) }}</h2>
									
										@if($registration->children_reg)
										
											@foreach($registration->children_reg as $reg_member)
													@php $firstname = explode(" ", $reg_member->registree_name); @endphp
													
													<h3 class="h3-responsive pl-5 my-1">{{ ucwords(strtolower($firstname[0])) }}</h3>
													
											@endforeach
											
										@endif
										
									</div>
								
								@endforeach
								
							</div>
							
						@endforeach
						
					@endif
					
				</div>
				
			</div>
			
			<div class="col-md-2"></div>
			
		</div>
	</div>
	
@endsection
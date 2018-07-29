@extends('layouts.app')

@section('add_styles')
	<style>
		#reunion_page {
			background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset($reunion->picture) }}');
		}
		
		#contact_information_header, #hotel_information_header, #activities_information_header {
			color: whitesmoke;
			text-shadow: 2px 1px 10px darkgrey;
		}
	
		.contactContent {
			margin: 0% 2%;
			padding: 1% 10%;
			border-radius: 10px;
			font-weight: bold;
			font-size: 130%;
		}
		
		#hotel_content {
			background: white;
			margin: 0%;
		}
		
		div#hotel_content dl {
			margin: 0%;
			width: 100%;
			font-size: 90%;
		}
	</style>
@endsection

@section('content')
	<div id="reunion_page" class="container-fluid">
	
		<div class="row mb-2">
			<div class="col">
				<div id="page_header" style="margin: 0px -15px;">
					<h1 id="jgphilly_page_header" class=" py-2">Jackson/Green Family Reunion {{ $reunion->reunion_year }}</h1>
					<h2 id="jgphilly_page_header" class="my-0 py-0 pb-2">{{ $reunion->reunion_city . ' ' . $reunion->reunion_state }}</h2>
				</div>
			</div>
		</div>
		
		<div class="row mt-5">
			<div class="col-11 col-lg-9 mx-auto">
				<div class="pastReunionContent" id="hotel_information">
					<h2 id="hotel_information_header">Hotel Information</h2>
					<div id="hotel_content" class="container-fluid">
						<div class="row">
							<div class="col-12 col-lg-3">
								<img id="hotel_pic" src="/images/crowne-plaza-feasterville-trevose.jpg"/>
							</div>
							<div class="col-12 col-lg-9">
								<p class="hotelContentInfo"><b>Address:</b> 4700 Street Rd, Feasterville-Trevose, PA 19053</p>
								<p class="hotelContentInfo"><b>Phone:</b> 1-215-364-2000</p>	
								<p class="hotelContentInfo"><b>Rooms:</b> $109/per night plus taxes for a standard room</p>
								<p class="hotelContentInfo"><b>Additional Info:</b> Please call for any room upgrades.</p><br/>
								<dl>
									<dt class="featuresList hotelContentInfo"><b>Hotel Features:</b></dt>
									<dd class="featuresList hotelContentInfo">Complimentary Wifi</dd>
									<dd class="featuresList hotelContentInfo">Free Parking</dd>
									<dd class="featuresList hotelContentInfo">Microwave/Refrigerator in guest room</dd>
									<dd class="featuresList hotelContentInfo">Fitness Center</dd>
									<dd class="featuresList hotelContentInfo">Swimming Pool</dd>
									<dd class="featuresList hotelContentInfo">Sofa-Bed</dd>
									<dd class="featuresList hotelContentInfo">Rollway Bed/Cot</dd>
									<dd class="featuresList hotelContentInfo">Electronic Check</dd>
								</dl>
							</div>
						</div>
					</div>
				</div>

				<hr/>

				<div class="pastReunionContent" id="activities_information">
				
					<h2 id="activities_information_header">Activities</h2>
					
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
				
				<div class="pastReunionContent" id="contact_information">
				
					<h2 id="contact_information_header">Committee Information</h2>
					<div id="" class="bg-white contactContent mx-0 mx-md-3 px-0 px-md-2 table-wrapper">
					
						<table id="contact_information_table" class="table text-center">
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
			</div>
		</div>
		
	</div>
@endsection
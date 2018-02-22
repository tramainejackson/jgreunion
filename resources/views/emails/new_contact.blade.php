<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reunion Registration</title>
	<style>
		div {
			font-family: Arial, Helvetica, sans-serif;
		}

		a:not(.flyer) {
			color: black;
			text-decoration: underline;
		}

		a.flyer.btn {
			color: #28a745;
			background-image: none;
			background-color: transparent;
			display: inline-block;
			font-weight: normal;
			text-align: center;
			text-decoration: none;
			border: 1px solid transparent;
			border-color: #28a745;
			padding: 0.5rem 0.75rem;
			font-size: 1rem;
			line-height: 1.25;
			border-radius: 0.25rem;
			white-space: initial;
			margin: 0 30%;
			width: 35%;
			font-size: 150%;
			-ms-touch-action: manipulation;
			touch-action: manipulation;
			-webkit-text-decoration-skip: objects;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			-webkit-transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
			transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
		}

		a.btn.flyer:hover {
			color: #fff;
			background-color: #28a745;
			border-color: #28a745;
		}

		p, h3 {
			font-size: 150%;
		}

		ul {
			margin: 20px auto;
			padding: 35px 50px;
			list-style: none;
			width: fit-content;
			border: solid 1px;
			border-radius: 10px;
			font-size: 125%;
			color: whitesmoke;
			background: linear-gradient(to bottom right, rgba(91, 149, 90, 0.75), rgba(91, 149, 90, 0.75), rgba(138, 138, 144, 0.75), rgba(138, 138, 144, 0.75));
		}
		
		@media (max-width: 576px) {
			ul, p {
				font-size: 100%;
			}
			
			p, h3 {
				margin: 35px 0px 20px;
			}
			
			h3 {
				font-size: 125%;
			}
		}
	</style>
</head>
<body>
    <div id="app" class="container">
		<div style="position:relative; height:100%;">
			<div style="box-sizing: border-box; width: 100% !important;">
				<h2 class="" style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px; font-size: 200%;">{{ $reunion->reunion_year }} Family Reunion Registration</h2>
			</div>
			<div style="">
				<h3 style="margin: 35px 35px 20px;">Registration:</h3>
				<ul>
					<li style="padding:2px 0px;">Registree: {{ ucwords($registration->registree_name) }}</li>
					<li style="padding:2px 0px;">Email Address: {{ $registration->email != null ? $registration->email : 'No Email Address Added' }}</li>
					<li style="padding:2px 0px;">Phone: {{ $registration->phone != null ? $registration->phone : 'No Phone Number Added' }}</li>
					<li style="padding:2px 0px;">Address: {{ $registration->address . ' ' . $registration->city . ', ' . $registration->state . ' '. $registration->zip }}</li>
					@php
						$adults = explode('; ', $registration->adult_names);
						$youths = explode('; ', $registration->youth_names);
						$childs = explode('; ', $registration->children_names);
					@endphp
					<li style="padding:2px 0px;">Total Adults: 
						<u>{{ $totalAdults }}</u>
						@if(count($adults) == 1 && $adults[0] == '')
							<em><span style="padding:0px 35px; width:100%; display:block;">No Names Entered</span></em>
						@else
							@foreach($adults as $adult)
								<em><span style="padding:0px 35px; width:100%; display:block;">{{ ucwords(strtolower($adult)) . ' - ' . $adultSizes[$loop->iteration - 1] . ' (Shirt Size)' }}</span></em>
							@endforeach
						@endif
					</li>
					<li style="padding:2px 0px;">Total Youth: 
						<u>{{ $totalYouths }}</u>
						@if(count($youths) == 1 && $youths[0] == '')
							<em><span style="padding:0px 35px; width:100%; display:block;">No Names Entered</span></em>
						@else
							@foreach($youths as $youth)
								<em><span style="padding:0px 35px; width:100%; display:block;">{{ ucwords(strtolower($youth)) . ' - ' . $youthSizes[$loop->iteration - 1] . ' (Shirt Size)' }}</span></em>
							@endforeach
						@endif
					</li>
					<li style="padding:2px 0px;">Total Children: 
						<u>{{ $totalChildren }}</u>
						@if(count($childs) == 1 && $childs[0] == '')
							<em><span style="padding:0px 35px; width:100%; display:block;">No Names Entered</span></em>
						@else
							@foreach($childs as $child)
								<em><span style="padding:0px 35px; width:100%; display:block;">{{ ucwords(strtolower($child)) . ' - ' . $childrenSizes[$loop->iteration - 1] . ' (Shirt Size)' }}</span></em>
							@endforeach
						@endif
					</li>
				</ul>
				<p style="padding: 0px 35px;">Thank you for registering online for the {{ $reunion->reunion_year }} Family Reunion Registration which will be located in {{ $reunion->reunion_city . ', ' . $reunion->reunion_state }}. If you have any questions please feel free to reach out to us anytime.</p>
				<p style="padding:0px 35px;">Above is all the information that we received on your registration form. If any of this information is incorrect, please respond to this email so that we can correct the information.</p>
				<p style="padding:0px 35px;">Your Total Amount Due is $<span style="color:darkred;">{{ $registration->total_amount_due }}.</span> The total amount due needs to be paid in full at least one month before the reunion.</p>
			</div>
			<footer style="box-sizing: border-box; width: 100% !important;">
				<h3 style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">2017 {{ config('app.name') }}. All rights reserved.</h3>
			</footer>
		</div>
	</div>
</body>
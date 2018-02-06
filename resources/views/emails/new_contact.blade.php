<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jackson Rental Homes Contact</title>
	
	<style>
		.list-unstyled {
			padding-left: 0;
			list-style: none;
		}
		
		.contactInfoList {
			border: solid 1.5px;
			border-radius: 5px;
			margin: 0px auto;
			padding: 0px 1.2px;
			width: 60%;
			text-align: center;
		}
		
		ul.contactInfoList li {
			padding: 10px 0px;
			text-align: center;
		}

		ul.contactInfoList li:nth-of-type(even) {
			background: #5b955a;
			color: whitesmoke;
		}
		
		ul.contactInfoList li:last-of-type {
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 5px;
		}
		
		@media (min-width: 1400px) {
            p, h3 {
                font-size: 150%;
            }
        }
		
		@media (max-width: 576px) {
            .contactEmailHeader {
				text-align: center:
				margin: 0px 0px 35px;
			}
			
			.contactInfoList {
				border: solid 1.5px;
				border-radius: 5px;
				margin: 0px auto;
				padding: 0px 1.2px;
				width: 94%;
				text-align: center;
			}
        }
	</style>
</head>
<body>
    <div id="app" class="container">
		<div style="position:relative; height:100%;">
			<div style="box-sizing: border-box; width: 100% !important;">
				<img src="{{ url('/images/jrh_logo.png') }}" class="" height="250px" style="margin:0 auto; text-align: center; display: block;" />
			</div>
			<div style="font-family: 'Playfair Display', serif;">
				<h3 class="contactEmailHeader" style="margin: 0px 35px 35px;">You Have A New Contact:</h3>
				<ul class="list-unstyled contactInfoList">
					<li class=""><b>First Name:</b> {{ $contact->first_name }}</li>
					<li class=""><b>Last Name:</b> {{ $contact->last_name }}</li>
					<li class=""><b>Email Address:</b> <a href="mailto:{{ $contact->email }}" class="">{{ $contact->email }}</a></li>
					<li class=""><b>Phone Number:</b> {{ $contact->phone }}</li>
				</ul>
			</div>
			<footer style="box-sizing: border-box; width: 100% !important;">
				<h3 style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">2017 {{ config('app.name') }}. All rights reserved.</h3>
			</footer>
		</div>
	</div>
</body>
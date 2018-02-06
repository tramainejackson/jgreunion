<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jackson Rental Homes Contact</title>
	
	<style>
		@media (min-width: 1400px) {
            p, h3 {
                font-size: 150%;
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
				<h3 style="margin: 0px 35px 35px;"><b>New Contact:</b></h3>
				<p style="padding: 0px 35px 15px;">Thanks for adding yourself to my contacts list. I will be sending emails out with any new properties that I have available that fit you and your family size. Please feel free to reach out to me at any time if you have any questions. I can be reached by phone at <span style="color: blue;"><i>215.252.4146</i></span> or by email at <a href="mailto:lorenzo@jacksonrentalhomesllc.com" class=""><i>lorenzo@jacksonrentalhomesllc.com</i>.</a></p>
				<p style="padding: 0px 35px 15px;">Thanks you, <br/><br/>Have a nice day</p>
			</div>
			<footer style="box-sizing: border-box; width: 100% !important;">
				<h3 style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">2017 {{ config('app.name') }}. All rights reserved.</h3>
			</footer>
		</div>
	</div>
</body>
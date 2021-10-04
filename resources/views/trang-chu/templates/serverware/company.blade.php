@extends(config('template.homeTemplateBladeURL').'layout')
@section('content')

<div class="container-fuild contact-background">
	<div class="container">
		<div class="row">
			<div class="col-md-6 thumbnail-contact">
			<h1 class="title-maketing-contact contact-content">About ServerWarehouse</h1>
			<p class="content contact-content">Server Warehouse is a trading name of Broadberry Data Systems - a custom server and storage provider to the world's largest brands for over 28 years.</p class="content contact-content">
			
			</div>
			<div class="col-md-6">
				<img src="{{ asset(config('template.homeTemplateURL')  . 'images/lid.png') }}" class="img-reponsive img-contact">
			</div>
		</div>
	</div>
</div>

<!--forward-->
<div class="container">
	<div id="forward" class="content-form-contact">
		<div class="row">
			<div class="col-md-4">
				<h2 class="title-forward">Moving things forward</h2>
			 	<div class="content-forward">
			 		<p >After years of providing HPE quotations for customers, like so many other people we realised how hard it was to obtain a quick and accurate quote on a customised HPE server.</p>
					<p >Getting a quote on a customised HPE server proved to be harder still - requiring multiple emails between ourselves and the vendor in order to get a price.</p>
					<p>
						<strong>We found the whole process slow, cumbersome and outdated.</strong>
					</p>
			 	</div>
			</div>
			<div class="col-md-4">
				<div class="content-thumbnail">
					<div class="titile-info-contact">
						<img src="{{ asset(config('template.homeTemplateURL')  . 'images/before.png') }}" class="img-reponsive img-contact">
					</div>
					<div class="content-info-contact contact-content">
						 <div class="info border-info-item-contact">
						 	<h4>Slow</h4>
						 	<p >Getting an accurate quote was slow and required waiting around for a salesman.</p>
						 </div>
					</div>
					<div class="content-info-contact contact-content">
						 <div class="info border-info-item-contact">
						 	<h4>Non-Configurable</h4>
						 	<p >Configuring an HPE server to your exact specifications was almost impossible.</p>
						 </div>
					</div>
					<div class="content-info-contact contact-content">
						 <div class="info border-info-item-contact">
						 	<h4>Confusing</h4>
						 	<p >Extensive knowledge of the HPE catalogue required in order to ensure compatibility.</p>
						 </div>
					</div>
					<div class="content-info-contact contact-content">
						 <div class="info border-info-item-contact">
						 	<h4>Required Building</h4>
						 	<p >After buying the options needed, the user would then need to integrate them into the server themselves</p>
						 </div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="content-thumbnail">
					<div class="titile-info-contact">
						<img src="{{ asset(config('template.homeTemplateURL')  . 'images/serverwarehouse.png') }}" class="img-reponsive img-contact">
					</div>
					<div class="content-info-contact contact-content">
						 <div class="info border-info-item-contact">
						 	<h4>Fast</h4>
						 	<p >Configure your system online now and get an instant quote.</p>
						 </div>
					</div>
					<div class="content-info-contact contact-content">
						 <div class="info border-info-item-contact">
						 	<h4>Configurable</h4>
						 	<p >Customise your HPE server from a massive range of configurable items.</p>
						 </div>
					</div>
					<div class="content-info-contact contact-content">
						 <div class="info border-info-item-contact">
						 	<h4>Simple</h4>
						 	<p >We've done the leg-work. If it's an option - its compatible.</p>
						 </div>
					</div>
					<div class="content-info-contact contact-content">
						 <div class="info border-info-item-contact">
						 	<h4>Pre-Built & Tested</h4>
						 	<p >Your customised HPE server will be delivered pre-built and fully tested.</p>
						 </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--End forward-->
<!--screen-maketing -->
<div id="screen-maketing" class="container">
	<div class="row">
		<div class="col-md-6">
			<img src="{{ asset(config('template.homeTemplateURL')  . 'images/screenshot.png') }}" class="img-reponsive img-contact">
		</div>
		<div class="col-md-6">
			 <div class="screen-maketing-content">
			 	<h4>ServerWarehouse is a Fresh Approach</h4>
			 	<p >Our unique, powerful server configurator allows you to build your perfect HPE server quickly and easily from a comprehensive list of compatible components.</p>
			 	<p>You'll get your customised quote instantly in PDF or email format - from which you can use as a reference or buy online.</p>
			 	<p>Your fully-customised HPE server will be delivered within 3-5 working days, built to specification, and fully tested.</p>
			 </div>
					
		</div>
	</div>
</div>
<!--End screen-maketing -->

<!--Cat listing -->
@include(config('template.homeTemplateBladeURL'). 'homepage.cat-purple')
<!--End Cat listing -->

<!--featurette-divider -->
@include(config('template.homeTemplateBladeURL'). 'homepage.featurette-divider')
<!--End featurette-divider -->

@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset(config('template.homeTemplateURL')  . 'css/contact-page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(config('template.homeTemplateURL')  . 'css/company-page.css') }}">
@endsection

@section('page-js')

@endsection
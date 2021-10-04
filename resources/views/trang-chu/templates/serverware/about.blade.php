@extends(config('template.homeTemplateBladeURL').'layout')

@section('title')
	<title>HPE Server Configurator - Configure your HP ProLiant Server</title>
@endsection

@section('seo-meta')
	<!--SEO-->
@endsection

@section('content')

	<div class="colour_grey">
	  <div class="container marketing">
	    <div class="row">
	      <div class="col-md-6">

	        <h1 class="page-header">About ServerWarehouse</h1>
	        <p class="lead">Server Warehouse is a trading name of Broadberry Data Systems - a custom server and storage provider to the world's largest brands for over 28 years.</p>
	      </div>

	        <div class="col-md-6">
	            <img src="{{ asset(config('template.homeTemplateURL')  . 'img/css/bootstrap-container-bgs/lid-short.png') }}" class="img-responsive top_img" />
	        </div>

	    </div>
	  </div>
	  <!-- /.container -->
	</div>

	<hr class="divider-blank" />
	<div class="container">

	    <div class="row">

	        <div class="col-md-4">
	            <h2 class="page-header">Moving things forward</h2>
	            <p class="lead">After years of providing HPE quotations for customers, like so many other people we realised how hard it was to obtain a quick and accurate quote on a customised HPE server.</p>

	            <p>Getting a quote on a <u>customised</u> HPE server proved to be harder still - requiring multiple emails between ourselves and the vendor in order to get a price.</p>

	            <p><strong>We found the whole process slow, cumbersome and outdated.</strong></p>
	        </div>

	        <div class="col-md-4">
	            <div class="well problems_well_bad" style="border-color: #ffffff; box-shadow: none">
	                <div class="problems">
	                    <div class="problems_head"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/shakeup/before.png') }}" class="img-reponsive" /></div>

	                    <div class="problem_hold">
	                        <h4>Slow</h4>
	                        <p>Getting an accurate quote was slow and required waiting around for a salesman.</p>
	                    </div><hr class="hr_well_about_homepage">

	                    <div class="problem_hold">
	                        <h4>Non-Configurable</h4>
	                        <p>Configuring an HPE server to your exact specifications was almost impossible.</p>
	                    </div><hr class="hr_well_about_homepage">

	                    <div class="problem_hold">
	                        <h4>Confusing</h4>
	                        <p>Extensive knowledge of the HPE catalogue required in order to ensure compatibility.</p>
	                    </div><hr class="hr_well_about_homepage">

	                    <div class="problem_hold problem_hold_last">
	                        <h4>Required Building</h4>
	                        <p>After buying the options needed, the user would then need to integrate them into the server themselves</p>
	                    </div>

	                </div>
	            </div>
	        </div>

	        <div class="col-md-4">
	            <div class="well problems_well_good">
	                <div class="problems">
	                    <div class="problems_head"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/shakeup/serverwarehouse.jpg') }}" class="img-reponsive" /></div>

	                    <div class="problem_hold">
	                        <h4>Fast</h4>
	                        <p>Configure your system online now and get an instant quote.</p>
	                    </div><hr class="hr_well_about_homepage">

	                    <div class="problem_hold">
	                        <h4>Configurable</h4>
	                        <p>Customise your HPE server from a massive range of configurable items.</p>
	                    </div><hr class="hr_well_about_homepage">

	                    <div class="problem_hold">
	                        <h4>Simple</h4>
	                        <p>We've done the leg-work. If it's an option - its compatible.</p>
	                    </div><hr class="hr_well_about_homepage">

	                    <div class="problem_hold problem_hold_last">
	                        <h4>Pre-Built &amp; Tested</h4>
	                        <p>Your customised HPE server will be delivered pre-built and fully tested.</p>
	                    </div>

	                </div>
	            </div>
	        </div>

	    </div>

	</div>
	<!--Cat list -->
	
    <!--End cat list-->
	<!-- Featurette divider-->
	<hr class="featurette-divider" />
	<div class="container">
	    <div class="row">
	        <div class="col-md-6">
	            <img src="{{ asset(config('template.homeTemplateURL')  . 'img/shakeup/screenshot.png') }}" class="img-responsive" />
	        </div>

	        <div class="col-md-6">
	            <h3 style="margin-top: 50px;">ServerWarehouse is a Fresh Approach</h3>
	            <p class="lead">Our unique, powerful server configurator allows you to build your perfect HPE server quickly and easily from a comprehensive list of compatible components.</p>
	            <p>You'll get your customised quote instantly in PDF or email format - from which you can use as a reference or buy online.</p>
	            <p>Your fully-customised HPE server will be delivered within 3-5 working days, built to specification, and fully tested.</p>
	        </div>
	    </div>
	</div>
	<div class="container">
	   <div class="cat_listing">
	      <div class="row">
	         <div class="col-md-3">
	            <div class="cat cat-purple" style="background-image: url('{{ asset(config('template.homeTemplateURL')  . 'img/shakeup/images/quickspecs.jpg') }}'); height: 340px;">
	               <div class="cat_box">
	                  <p class="cat_box_head">No More QuickSpecs</p>
	                  <p>You can finally ditch the QuickSpecs! Our configurator tells you what's compatible.</p>
	               </div>
	            </div>
	         </div>
	         <div class="col-md-3">
	            <div class="cat cat-purple" style="background-image: url('{{ asset(config('template.homeTemplateURL')  . 'img/shakeup/images/boxes.jpg') }}'); height: 340px;">
	               <div class="cat_box">
	                  <p class="cat_box_head">No More Boxes</p>
	                  <p>No more boxes of components for you to build your server from! We do it all for you.</p>
	               </div>
	            </div>
	         </div>
	         <div class="col-md-3">
	            <div class="cat cat-purple" style="background-image: url('{{ asset(config('template.homeTemplateURL')  . 'img/shakeup/images/quote.jpg') }}'); height: 340px;">
	               <div class="cat_box">
	                  <p class="cat_box_head">Instant Quotes</p>
	                  <p>Configure your server online and download an accurate PDF quotation, instantly.</p>
	               </div>
	            </div>
	         </div>
	         <div class="col-md-3">
	            <div class="cat cat-purple" style="background-image: url('{{ asset(config('template.homeTemplateURL')  . 'img/shakeup/images/salesman.jpg') }}'); height: 340px;">
	               <div class="cat_box">
	                  <p class="cat_box_head">Account Managers</p>
	                  <p>You'll be assigned a dedicated account manager to speak to.</p>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
	<!-- End Featurette divider -->
	@include(config('template.homeTemplateBladeURL'). 'includes.featurette-divider')
@endsection

@section('page-css')
	<!--custom css-->
@endsection
@section('page-js')
	<!--custom js-->
@endsection

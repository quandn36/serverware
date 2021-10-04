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

			        <h1 class="page-header">Say Hello</h1>
			        <p class="lead">If you would like further information regarding any of the products or services we offer, or to arrange a no obligation appointment, we'd love to hear from you.</p>
			        <p>If you're an existing customer looking for product support or information on how to return faulty items, please use the links below or call your account  manager.</p>

		        </div>

		        <div class="col-md-6">
		            <img src="{{ asset(config('template.homeTemplateURL')  . 'img/css/bootstrap-container-bgs/lid.png') }}" class="img-responsive top_img" />
		        </div>

		    </div>
	 	</div>
  	<!-- /.container -->

	</div>

	<!--Con tact-form -->
	@include(config('template.homeTemplateBladeURL'). 'contact.contact-form')
	<!--End con tact-form -->

	<!-- Featurette divider-->
	@include(config('template.homeTemplateBladeURL'). 'includes.featurette-divider')
	<!-- End Featurette divider -->

@endsection

@section('page-css')
	<!--custom css-->
@endsection
@section('page-js')
	<!--custom js-->
@endsection

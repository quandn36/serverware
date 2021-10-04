@extends(config('template.homeTemplateBladeURL').'layout')

@section('title')
	<title>HPE Server Configurator - Configure your HP ProLiant Server</title>
@endsection

@section('seo-meta')
	<!--SEO-->
@endsection

@section('content')

	<!--Banner -->
	@include(config('template.homeTemplateBladeURL'). 'homepage.banner')
	<!--End benner -->

	<!--Top products hold -->
	
	@include(config('template.homeTemplateBladeURL'). 'homepage.our-most-popular', ['products' => $productPopular])
	<!--End top products hold -->

	<!-- Colour grey light -->
	
	@include(config('template.homeTemplateBladeURL'). 'homepage.colour-grey-light')
	<!--End  colour grey light -->
	@foreach($popularCategories as $categories)

		@if($categories->childrenCategories->isNotEmpty() && $loop->index == 0)
		<!--Cat list -->
			@include(config('template.homeTemplateBladeURL'). 'homepage.cat_list.cat_listing', ['categories' => $categories->childrenCategories] )
		@endif

		@if($categories->childrenCategories->isNotEmpty() && $loop->index == 1)
			@include(config('template.homeTemplateBladeURL'). 'homepage.cat_list.long_cat_listing',['categories' => $categories->childrenCategories])
		@endif
		<!--End cat list -->
		
		
	@endforeach
	<!-- Featurette divider-->
	@include(config('template.homeTemplateBladeURL'). 'includes.featurette-divider')
	<!-- End Featurette divider -->

@endsection

@section('page-css')
	<style type="text/css">
		.marketing-image a img {
			height: 116px ;
		}
	</style>
@endsection
@section('page-js')
	<!--custom js-->
@endsection

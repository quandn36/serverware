@extends(config('template.homeTemplateBladeURL').'layout')

@section('title')
	<title>HPE Server Configurator - Configure your HP ProLiant Server</title>
@endsection

@section('seo-meta')
	<!--SEO-->
@endsection

@section('content')


	<!-- Detail -->
	@include(config('template.homeTemplateBladeURL'). 'product-detail.product-type-detail.content-detail')
	<!--End  Detail -->

	<!-- Detail -->
	@include(config('template.homeTemplateBladeURL'). 'product-detail.product-type-detail.product-other')
	<!--End  Detail -->

	<!-- Interview product -->
	@include(config('template.homeTemplateBladeURL'). 'product-detail.product-type-detail.interview-product')
	<!--End  interview product -->

	<!-- Featurette divider-->
	@include(config('template.homeTemplateBladeURL'). 'includes.featurette-divider')
	<!-- End Featurette divider -->

@endsection

@section('page-css')
	<!--custom css-->
	<style type="text/css">
		.page-header .price-guarantee {
		    position: absolute;
		    right: 50px;
		    top: 50px;
		    height: 110px;
		    z-index: 999;
		}
	</style>
@endsection
@section('page-js')
	<!--custom js-->
@endsection

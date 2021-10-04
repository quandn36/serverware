@extends(config('template.homeTemplateBladeURL').'layout')

@section('title')
	<title>HPE Server Configurator - Configure your HP ProLiant Server</title>
@endsection

@section('seo-meta')
	<!--SEO-->
@endsection

@section('content')


	<!-- Detail -->
	@include(config('template.homeTemplateBladeURL'). 'product-detail.product-hold-detail.content-detail')
	<!--End  Detail -->

	<!-- Configurator Tabs -->
	@include(config('template.homeTemplateBladeURL'). 'product-detail.product-hold-detail.configurator-tabs')
	<!--End configurator Tabs-->

	<!--Cat list -->
	@include(config('template.homeTemplateBladeURL'). 'homepage.cat_list.long_cat_listing')
	<!--End cat list -->

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

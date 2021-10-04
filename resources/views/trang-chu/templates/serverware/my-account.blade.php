@extends(config('template.homeTemplateBladeURL').'layout')

@section('title')
	<title>HPE Server Configurator - Configure your HP ProLiant Server</title>
@endsection

@section('seo-meta')
	<!--SEO-->
@endsection

@section('content')

	<!--Log in account -->
	@include(config('template.homeTemplateBladeURL'). 'my-account.log-in')
	<!--End Log in account -->

	<!--Create account -->
	@include(config('template.homeTemplateBladeURL'). 'my-account.create-account')
	<!--End Create account -->
@endsection

@section('page-css')
	<!--custom css-->
@endsection
@section('page-js')
	<!--custom js-->
@endsection

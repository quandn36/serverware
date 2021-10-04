@extends(config('template.homeTemplateBladeURL').'layout')
@section('content')
<div class="colour_grey">
    <div class="container">
       <h1 class="page-header">Thank you, we are feedback for you soon!</h1>
    </div>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset(config('template.homeTemplateURL')  . 'css/basket-page.css') }}">
<link href="{{ asset(config('template.homeTemplateURL')  . 'css/styles-bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-js')

@endsection
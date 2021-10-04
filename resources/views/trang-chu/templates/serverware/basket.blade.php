@extends(config('template.homeTemplateBladeURL').'layout')
@section('content')


<div class="colour_grey">
   <div class="container">
        <h1 class="page-header">My Cart</h1>
        <ol class="breadcrumb">
         <li><a href="{{ route('home.home') }}">Home</a></li>
         <li class="active">Cart</li>
        </ol>
        <form method="post" action="{{ route('home.basket.update') }}">
        @csrf
      	@if(session('cart'))
			@php
				$basket = session('cart');
			@endphp
		@foreach($basket as $id => $product)
        <div class="panel panel-primary">
            <div class="panel-heading">
               <div class="basket-system-name">Your Configured {{ $product['name'] }}</div>
            </div>
            <div class="panel-body">
                <div class="row basket-table">
                    <div class="col-md-3">
                    	@php
                    	$cover_image = json_decode($product['cover_image'])
                    	@endphp
                    	@isset($cover_image->url)
                    	<img src="{{ $cover_image->url }}" style="max-width: 260px; max-height: 80px; margin-top: 25px;" alt="$cover_image->alt_text_image">
                    	@endisset
                    	@empty($cover_image->url)
                    	
                    	<img src="{{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }}" style="max-width: 260px; max-height: 80px; margin-top: 25px;" alt="Not image">
                    	@endempty
                    </div>
                    <div class="col-md-7">
                        <div class="basket-quote-source"></div>
                        <div>
	                        <table class="table table-condensed system-specs-overview">
	                            <tbody>
	                                @php
	                    				$accessories = $product['accessories'];
		                			@endphp
		                			@foreach($accessories as $json_accessory)
			                			@php
    			                			$accessory = json_decode($json_accessory);
                                            $tdArr = '';
			                			@endphp
                                        @if(!empty($accessory))
                                            @if(is_array($accessory))
                                            <tr>
                                                @foreach($accessory as $accessory)
                                                @if($loop->first)
                                                <td class="system-specs-overview-l">{{ $accessory->category_tree_name }}</td>
                                                @endif
                                                @if($accessory->accessory_qty>1)
                                                @php
                                                 $tdArr.= $accessory->accessory_qty.'x'.$accessory->accessory_name.'<br>';
                                                @endphp
                                                @endif
                                                @php
                                                 $tdArr.= $accessory->accessory_name.'<br>';
                                                @endphp
                                                @endforeach
                                                <td>{!! $tdArr !!}</td>
                                            </tr>
                                            @else
    			                			<tr>
    			                				<td class="system-specs-overview-l">{{ $accessory->category_tree_name }}</td>
    			                				<td>
    			                					@if($accessory->accessory_qty>1)
    			                					{{ $accessory->accessory_qty }}x @endif
    			                					{{ $accessory->accessory_name }}
    			                				</td>
    			                			</tr>
                                            @endif
                                        @endif
		                			@endforeach
	                            </tbody>
	                        </table>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="basket-price">${{ number_format($product['price_config'],2) }}</div>
                        <div class="input-group">
                        <input type="text" class="form-control" name="update_qty[{{ $id }}]" value="{{ $product['quantity'] }}" style="text-align:center;">
                        <span class="input-group-btn">
                        <a href="{{ route('home.basket.remove',$id) }}" class="btn btn-default"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </span>
                    </div>
                    <div style="margin-top: 5px;"><a href="{{ route('home.basket.re-configure', [ 'slug' => $product['slug'], 'id_basket' => $id] ) }}" class="btn btn-success btn-block">Re-Configure</a></div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="basket-total">Subtotal: <strong>${{ number_format( $cart->total_price,2) }}</strong></div>
         <div class="well clearfix"><input type="submit" name="update_cart" value="Update Cart" class="btn btn-primary pull-left"><a href="{{ route('home.invoice.check-out') }}" class="btn btn-primary pull-right"><i class="fa fa-arrow-right" aria-hidden="true"></i> Checkout</a></div>
        @else 
        <div class="well well-lg">Your Cart is Empty!</div>
        @endif
        </form>
   </div>
</div>

@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset(config('template.homeTemplateURL')  . 'css/basket-page.css') }}">
<link href="{{ asset(config('template.homeTemplateURL')  . 'css/styles-bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-js')

@endsection
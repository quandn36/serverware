@extends(config('template.homeTemplateBladeURL').'layout')

@section('title')
	<title>HPE Server Configurator - Configure your HP ProLiant Server</title>
@endsection

@section('seo-meta')
	<!--SEO-->
@endsection

@section('content')

	
	<!-- Detail -->
	<div class="colour_grey ">
		<div class="container">
			@if(!empty($category))
			<h1 class="page-header">{{ $category->name }}<small></small></h1> 
			<ol class="breadcrumb">
		      <li><a href="{{ route('home.home') }}">Home</a></li>
		      <li><a href="{{ route('home.category-list',[$category->category_slug,$category->parent_category_id]) }}">{{ ucwords(strtolower($category->category_name))  }}</a></li>
		      <li class="active">{{ $category->name }}</li>
		    </ol>    
		    <div class="row">
		      	<div class="col-md-6" id="top_lead_hold">
			        {!! $category->long_description !!}
			        @php
			          $logoImage = json_decode($category->brand_image_logo);
			          $bannerImage = json_decode($category->image_banner_category);
			        @endphp
			        @empty($logoImage->url)
			    		<img src="{{ asset(config('template.homeTemplateURL')  . 'img/broadberry_brand_logos/50.png') }}" style="margin-top: 15px;" />
			        @endempty
			        @isset($logoImage->url)
			        <img src="{{ $logoImage->url }}" style="margin-top: 15px;" />
			        @endisset                    
		      	</div>
		      	<div class="col-md-6 z_index_98">
			        @empty($bannerImage->url)    
			        <img class="fix_width_images" src="{{ asset(config('template.homeTemplateURL')  . 'img/system_attribute_value_trans/dl-1u-gen10.png') }}" id="top_lead_img"> 
			        @endempty

			        @isset($bannerImage->url)    
			        <img class="fix_width_images" src="{{ $bannerImage->url }}" id="top_lead_img"> 
			        @endisset     
		      	</div>
		  	@endif 
				<script>
				$(window).load(function() {
					valign("top_lead_img", "top_lead_hold");
				});
				</script>  
		    </div>    
		</div>
		<hr class="divider-blank">
	</div>
	<!--End  Detail -->

	<!--List  Product of category-->

	<!--End  Detail -->
	<div id="change_results">
	   <hr class="divider-blank">
	   <div class="container">
	      <div class="row">
	         <div class="col-md-2">
	            <div class="form_holder--">
	               <form method="get" id="theForm">
	                  <div class="-container">	        
	                        <div class="filter_button_hold--">
	                           <div class="panel panel-default">
	                              <div class="panel-heading" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-filter" aria-hidden="true"></i> Drive Bay Size</div>
	                              <div class="list-group">
	                              	@foreach($drive_bay_sizes as $drive_bay_size)
	                                 <a class="list-group-item" href="Javascript: filter({{ $drive_bay_size }},-1)" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-check-square" aria-hidden="true"></i>{{ $drive_bay_size }}" Drive Bays</a>
	                                @endforeach
	                              </div>
	                           </div>
	                        </div>
	                        <div class="filter_button_hold--">
	                           <div class="panel panel-default">
	                              <div class="panel-heading" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-filter" aria-hidden="true"></i> Qty Drives</div>
	                              <div class="list-group">
	                              	@foreach($qty_drives as $qty_drive)
	                                 <a class="list-group-item" href="Javascript: filter(-1, {{ $qty_drive }})" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-check-square" aria-hidden="true"></i> {{ $qty_drive }} Drives</a>
	                                @endforeach
	                              </div>
	                           </div>
	                        </div>
	                  </div>
	                  <div class="applied_filters">
	                     <div></div>
	                  </div>
	               </form>
	            </div>
	         </div>
	         <div class="col-md-10">
	            <table id="" cellspacing="0" class="results">
	               <tbody>
	               	    <tr class="topHead">
	               	    	<td colspan="3">System</td><td>Drive Bay Size</td><td>Storage Bays</td><td>Memory</td><td>Qty Drives</td><td>Server Processor</td>
	               	    </tr>
	                    <tr>
	                    	<td colspan="8">&nbsp;</td>
	                    </tr>
	               </tbody>
	               <tbody id="change_systems_tbody">
	               	@if(!empty($products))
	               	@foreach($products as $product)
	               		@php
                     	 $slugProduct = $slugCate.'/'.$product->slug;
                     	@endphp
	                  <tr class="splitter" data-sys-id="45">
	                     <td colspan="8">
	                        <a href="{{ url($slugProduct) }}"><strong>{{ $product->name }}</strong><small> Intel Dual Scalable Processor Server</small></a>
	                     </td>
	                  </tr>
	                  <tr class="prod" data-sys-id="45">
	                  		@php
	                  		  $cover_image =json_decode($product->cover_image);
	                  		@endphp
	                     	@isset($cover_image->url)
							<td class="noRightBord" width="260"><img class="image_page_product_detail" src="{{ $cover_image->url }}" width="260" border="0" /></td>
							@endisset
							@empty($cover_image->url)
							<td class="noRightBord" width="260"><img class="image_page_product_detail" src="{{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }}" width="260" border="0" /></td>
							@endempty
	                     <td style="text-align: center">
	                     	 

	                        <a href="{{ url($slugProduct) }}" data-button="configure" class="btn btn-sm btn-default fix_css_button_config_in_category">Configure</a>
	                

	                        <div class="conf_price">From: ${{ number_format($product->price + $product->price_config ,2)}}</div>
	                     </td>
	                     <td><i class="fa fa-list-alt pop45" id="pop45" aria-hidden="true" data-original-title="" title=""></i></td>
	                     <td id="group200">
	                        <p class="att"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/system_attribute_values_icons/sff.png') }}" class="att_img"><span class="p_comp"><em>SFF</em> Small Form Factor Drives</span></p>
	                     </td>
	                     <td id="group300">
	                        <p class="att"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/system_attribute_values_icons/hot-swap.png') }}" class="att_img"><span class="p_comp"><em>Hot-Swap</em> Drives</span></p>
	                     </td>
	                     <td id="group400">
	                        <p class="att"><em>3TB</em> 24x 128GB RDIMM @2400MHz</p>
	                     </td>
	                     <td id="group600">
	                        <p class="att"><em>{{ $product->qty_drive }}</em> Drives</p>
	                     </td>
	                     <td id="group800">
	                        <p class="att"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/system_attribute_values_icons/xeon-sp.png') }}" class="att_img"><span class="p_comp"><em>Xeon</em> Scalable Processor</span></p>
	                     </td>
	                  </tr>
	                @endforeach
	                @endif
	               </tbody>
	            </table>
	            <div id="close_sticky_top_anchor"></div>
	         </div>
	      </div>
	   </div>
	</div>

	<!-- Interview product 
	@include(config('template.homeTemplateBladeURL'). 'product-detail.product-type-detail.interview-product')
	End  interview product -->

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
	<link href="{{ asset(config('template.homeTemplateURL')  . 'css/product_finder-bootstrap.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('page-js')
	<!--custom js-->
<script type="text/javascript">
	// Create our number formatter.
	var formatter = new Intl.NumberFormat('en-US', {
	  style: 'currency',
	  currency: 'USD',

	  // These options are needed to round to whole numbers if that's what you want.
	  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
	  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
	});
	function filter($drive_bay_size = -1, $qty_drive = -1, $action = 1,$remove = -1){
        var drive_bay_size = $drive_bay_size;
        var qty_drive      = $qty_drive;
        var action         = $action;
        var category_id    = '@isset($product->category_id) {{ $product->category_id }} @endisset';
        console.log(category_id);
        var removeFilter   = $remove;
        var token = "{{ csrf_token() }}";
       	
        $.ajax({
                url : "{!! route('home.load-ajax-filter') !!}",
                method: "POST",
                data: {_token:token, drive_bay_size : drive_bay_size, qty_drive:qty_drive, action:action,category_id: category_id, removeFilter:removeFilter}
            }).done(function(response) {
                var message  = response.message;
                var render   = '';
                var filter   = response.filter;
                var chose    = response.chose;
                var products = response.data;
                var remove   = response.remove;
            	var theForm     = renderTheForm(filter, chose, remove);
            	var listProduct = renderProduct(products);
            	$("#theForm").html(theForm);  
                $("#change_systems_tbody").html(listProduct);
                //console.log(response.whereQuery);
            });
	}

	function renderTheForm($filter,$chose, $remove = false){
		var html   = '';
		var title  = '';
		var chose  = $chose;
		var filter = $filter;
		var check_type_chose  = typeof(chose);
		if(Array.isArray(filter)){
			if (chose.title == 'drive_bay_size' || chose.title == 'qty_drive') {
					html += '<div class="applied_filters">'+
				                '<div>'+
				                'Filters Applied:';
				            if( title == '"Drive Bay Size"'){ 
				                html+= '<button type="button" class="btn btn-warning btn-xs" onclick="filter('+chose.data+',-1,0);" ><i class="fa fa-times" aria-hidden="true"></i>'+chose.data+'" Drive Bays</button>';
				            }
				            else {
				                html+= '<button type="button" class="btn btn-warning btn-xs" onclick="filter(-1,'+chose.data+',0,1);" ><i class="fa fa-times" aria-hidden="true"></i>'+chose.data+'" Drives </button>';
				            }
				html+= '</div></div>';

			}
		
			if (chose.title == 'Drive Bay Size & Qty Drives') {
				title = $filter.title;
				html += '<div class="applied_filters">'+
				                '<div>'+
				                'Filters Applied:';
			    var data  = chose.data;
			
                html+= '<button type="button" class="btn btn-warning btn-xs" onclick="filter('+data.drive_bay_size+','+data.qty_drive+',0,1);" ><i class="fa fa-times" aria-hidden="true"></i>'+data.drive_bay_size+'" Drive Bays</button>';
           
                html+= '<button type="button" class="btn btn-warning btn-xs" onclick="filter('+data.drive_bay_size+','+data.qty_drive+',0,0);" ><i class="fa fa-times" aria-hidden="true"></i>'+data.qty_drive+'" Drives </button>';
				            
				html+= '</div></div>';
			}
		}
		
		if(Array.isArray(filter) == false ) {
			var title   = $filter.title;
			var $drive_bay_sizes = $filter.data.drive_bay_size;
			var $qty_drives = $filter.data.qty_drive;
			if (chose.title == 'drive_bay_size' || chose.title == 'qty_drive' ){
				var filters = $filter.data;
				var html = '<div class="-container">'+	        
			                '<div class="filter_button_hold--">'+
			                    '<div class="panel panel-default">';
			                    if(title == 'drive_bay_size'){
			                        html += '<div class="panel-heading" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-filter" aria-hidden="true"></i> Drive Bay Size</div>'+
			                        '<div class="list-group">';
			                        $.each(filters, function(index, filter){
			                        		html += '<a class="list-group-item" href="Javascript: filter('+filter+', '+chose.data+');" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-check-square" aria-hidden="true"></i>'+filter+'" Drive Bays</a>';
			                        });	
			                    }
			                    else {
			                    	html += '<div class="panel-heading" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-filter" aria-hidden="true"></i>  Qty Drives</div>'+
			                        '<div class="list-group">';
			                        $.each(filters, function(index, filter){
			                        	html += '<a class="list-group-item" href="Javascript: filter('+chose.data+','+filter+');" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-check-square" aria-hidden="true"></i>'+filter+'" Drives </a>';
			                        	
			                        });	
			                    }	    
			                        html+='</div>'+
			                       '</div>'+
			                    '</div>'+ 
			              	'</div>'+
			            '<div class="applied_filters">'+
			                '<div>'+
			                'Filters Applied:';
			            if( chose.title == 'drive_bay_size'){ 
			                html+= '<button type="button" class="btn btn-warning btn-xs" onclick="filter('+chose.data+',-1,0,1)"><i class="fa fa-times" aria-hidden="true"></i>'+chose.data+' Drives </button>';
			               
			            }
			            else {
			                html+= '<button type="button" class="btn btn-warning btn-xs" onclick="filter('+chose.data+',-1,0,1)" ><i class="fa fa-times" aria-hidden="true"></i>'+chose.data+'"Drive Bays</button>';
			            }
			    html+= '</div></div>';
			}
			if (chose.title == 'non-select') {
				var html = '<div class="-container">'+	        
			                '<div class="filter_button_hold--">'+
			                    '<div class="panel panel-default">';
			                        html += '<div class="panel-heading" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-filter" aria-hidden="true"></i> Drive Bay Size</div>'+
			                        '<div class="list-group">';
			                        $.each($drive_bay_sizes, function(index, filter){
			                        		html += '<a class="list-group-item" href="Javascript: filter('+filter+',-1);" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-check-square" aria-hidden="true"></i>'+filter+'" Drive Bays</a>';
			                        	
			                        });	
			                        html+='</div>'+
			                       '</div>'+
			                    '</div>'+ 
			              	'</div>';
			html += '<div class="-container">'+	        
			                '<div class="filter_button_hold--">'+
			                    '<div class="panel panel-default">';
			                   
			                    	html += '<div class="panel-heading" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-filter" aria-hidden="true"></i>  Qty Drives</div>'+
			                        '<div class="list-group">';
			                        $.each($qty_drives, function(index, filter){
			                        	html += '<a class="list-group-item" href="Javascript: filter(-1,'+filter+');" style="white-space: nowrap; text-overflow: ellipsis;"><i class="fa fa-check-square" aria-hidden="true"></i>'+filter+'" Drives </a>';
			                        	
			                        });		    
			                        html+='</div>'+
			                       '</div>'+
			                    '</div>'+ 
			              	'</div>';
			            
			}	    
		}
		return html;
	}

	function renderProduct($products){
     	var html = '';
		$.each($products,function(index, product){
			var cover_image = JSON.parse(product.cover_image);
            var slugProduct = "{{ $slugCate }}"+'/'+product.slug;   
			html+= '<tr class="splitter" data-sys-id="45">'+
	               		'<td colspan="8">'+
	                        '<a href="'+slugProduct+'"><strong>'+product.name+'</strong><small> Intel Dual Scalable Processor Server</small></a>'+
	                    '</td>'+
	                '</tr>'+
	                '<tr class="prod" data-sys-id="45">'+
						'<td class="noRightBord" width="260"><img src="'+cover_image.url+'" width="260" border="0" /></td>'+
	                    '<td style="text-align: center">'+
	                        '<a href="'+slugProduct+'" data-button="configure" class="btn btn-sm btn-default">Configure</a>'+
	                        '<div class="conf_price">From:'+formatter.format(product.price+product.price_config)+'</div>'+
	                    '</td>'+
	                    '<td><i class="fa fa-list-alt" id="pop45" aria-hidden="true" data-original-title="" title=""></i></td>'+
	                    '<td id="group200">'+
	                        '<p class="att"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/system_attribute_values_icons/sff.png') }}" class="att_img"><span class="p_comp"><em>SFF</em> Small Form Factor Drives</span></p>'+
	                    '</td>'+
	                    '<td id="group300">'+
	                        '<p class="att"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/system_attribute_values_icons/hot-swap.png') }}" class="att_img"><span class="p_comp"><em>Hot-Swap</em> Drives</span></p>'+
	                    '</td>'+
	                    '<td id="group400">'+
	                        '<p class="att"><em>3TB</em> 24x 128GB RDIMM @2400MHz</p>'+
	                    '</td>'+
	                    '<td id="group600">'+
	                        '<p class="att"><em>'+product.qty_drive+'</em> Drives</p>'+
	                    '</td>'+
	                    '<td id="group800">'+
	                        '<p class="att"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/system_attribute_values_icons/xeon-sp.png') }}" class="att_img"><span class="p_comp"><em>Xeon</em> Scalable Processor</span></p>'+
	                    '</td>'+
	                '</tr>';
		});
		return html;
	}



	// ngoc quan popover quick specs
	 $(".pop45").popover({
        content: "<div class=\"popup_specs\"><ul class=\"features_ul\"><li>Redundant Power Supply Option</li><li>HPE iLO Standard with Intelligent Provisioning</li><li>3-year parts, 3-year labor, 3-year onsite support with next business day response.</li><li>3 x USB3 Ports</li><li>Powered by 2x  Intel Xeon Scalable Processor Gen2  Processors</li><li>Supports up to 24 modules of Registered 2933Mhz DIMMs (RDIMMs) Memory</li><li>3x PCI Expansion Slots configurable with </li></ul></div>", 
        html: true,
        trigger: "hover",
        title: "<i class=\"fa fa-list-ul greyed-icon\"></i> &nbsp;Quick Specs:",
        template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"><div class="data-content"></div></div></div>'
    });
</script>
@endsection

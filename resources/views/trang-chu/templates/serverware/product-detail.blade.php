@extends(config('template.homeTemplateBladeURL').'layout')

@section('content')
<!-- product-detail-->
<div id="product-detail" >
	<div class="container">
		<div class="row">
			<h1  class="col-md-12 header-pro-detail">
				<img src="{{ asset(config('template.homeTemplateURL')  . 'images/price_guarantee_2.png') }}" class="price-guarantee">
				{{ $product->name }}
                <input type="hidden" id="price_product" name="price_product" value="{{ $product->price }}">
            </h1>
            <div class="col-md-12 breadcrumb">
                <a href="{{ route('home.home') }}">Home</a>
                <p>/</p>
                <a href="{{ route('home.category-list',[$category->category_slug,$category->parent_category_id]) }}">{{ ucwords(strtolower($category->category_name))  }}</a>
                <p>/</p>
                <a href="{{ route('home.category-detail',$category->slug )}}">{{ $category->name }}</a>
                <p>/</p>
                @if(!empty($product->name))<p class="active" >{{ $product->name }}</p>@else <p>....</p>@endif
            </div>
            <div class="col-md-6">
                @php
                $brand_image_logo_cate = json_decode($category->brand_image_logo);
                @endphp
                <img src="@if(!empty($brand_image_logo_cate->url)) {{ asset($brand_image_logo_cate->url) }} @else {{  asset(config('template.cmsTemplateURL'). 'assets/images/small/default.jpg') }} @endif">
                {!! $product->description !!}
            </div>
            <div class="col-md-6">
                @php
                $cover_image = json_decode($product->cover_image);
                @endphp
                <img class="image_banner_in_product_detail" src="@if(!empty($cover_image->url)) {{ asset($cover_image->url) }} @else {{ asset(config('template.homeTemplateURL')  . 'images/storeeasy.png') }} @endif" >
            </div>
            <p class="col-md-12">
                <span class="delievery-timespan"><i class="fa fa-truck" aria-hidden="true"></i> Built &amp; Delivered 3-5 Days.</span>
                <strong><a href="#" class="conf_price">Configure From  ${{ number_format($total_price_config ,2) }}</a></strong>
            </p>
            <div class="col-md-3 ">
                <button class="btn btn-primary" id="fix_css_add_to_basket">add to basket</button>
            </div>

        </div>
    </div>
</div>
<!--End product-detail-->
<br><br>
<!-- configurator_tabs and change_prices-->
<div class="container">
	<div class="row" style="position: relative;">
        <div class="col-md-9">
           <div class="tabbable" id="configurator_tabs">
              <ul class="nav nav-tabs">
                 <li class="active"><a href="#pane1" data-toggle="tab">Configure</a></li>
                 <li><a href="#pane2" data-toggle="tab">Specifications</a></li>
                 <li><a href="#pane3" data-toggle="tab">Features</a></li>
                 <li><a href="#pane4" data-toggle="tab">Resources</a></li>
                 <li><a href="#pane5" data-toggle="tab">Order</a></li>
             </ul>
             <div class="tab-content">
                 <div id="pane1" class="tab-pane active">

                    <form method="get" id="load-accessory-category">
                       {!! $htmlAccessories !!}
                   </form>
               </div>
               <div id="pane2" class="tab-pane ">
                <div class="" style="min-height: 800px;">
                    <h3>Specifications is comming soon</h3>  
                </div>  
            </div>
            <div id="pane3" class="tab-pane ">
                <div class="" style="min-height: 800px;">
                    <h3>Features is comming soon</h3>   
                </div> 
                
            </div>
            <div id="pane4" class="tab-pane">
                <div class="" style="min-height: 800px;">
                    <h3>Resources is comming soon</h3> 
                </div> 
                
            </div>
            <div id="pane5" class="tab-pane ">
                <div class="" style="min-height: 800px;">
                    <h3>Order is comming soon</h3>   
                </div> 
                
            </div>
        </div>
        <!-- /.tab-content --> 
    </div>
    <!-- /.tabbable --> 
    <div id="close_sticky_anchor"></div>
</div>
<!-- /.9 col -->


<div class="col-md-3">
   <div id="rightCol" class="">
      <div id="change_prices">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title">Your Configuration:</h3>
           </div>
           <form method="post" action="{{ route('home.basket.add',  $product->id ) }}" name="priceTableActions" id="actions">
            <div class="panel-body" style="background-color:#ffffff;">
               <p>HPE ProLiant DL380 Gen10 - 16 Bay SFF 16x 2.5   Configured with:</p>
               {!! $bill !!}
               <div class="sl_price">
                  <div  id="total_price" class="big_price total_price"><sup></sup> ${{ number_format($total_price_config ,2) }} </div>
                  <input type="hidden" name="price_config" value="{{ $total_price_config }}">
                  <!-- <div class="you_save"><i>You're Saving:</i> $990.60</div> -->
                  
                  @csrf
                  <!-- Split button -->
                  <div class="text-center" style="margin-top: 10px;">
                    <div class="--btn-group">
                       <!--<a onclick="open_buy_now_modal()" class="btn btn-success">Buy Now</a>-->
                       <input type="submit" id="add_to_basket" name="add_to_basket" value="Add to Basket" class="btn btn-success btn-block" style="margin-bottom: 5px;">

                       <div class="btn-group">
                          <a data-toggle="modal" href="#pdfModal" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i> Create PDF</a>

                          <a class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                             <span class="caret"></span>
                         </a>
                         <ul class="dropdown-menu" role="menu">
                             <li><a data-toggle="modal" href="#myModal">Email Quote</a></li>
                             <!--<li><a href="javascript: save_quote();"><i class="fa fa-save"></i> Save Quote</a></li> -->
                             <li><a data-toggle="modal" href="#contactModal">Ask a Question</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
             
         </div>	
     </div>
 </form>	
</div>
<br><br><br>
</div>
</div>
<script type="text/javascript">

            // Right Col Stick =================================================================================================
            rightCol_offset_top = $('#rightCol').offset().top - 1;

            //alert(stop_offset_top);

            $('.logoHold').tooltip();

            function check_filter_scroll()
            {
            	stop_offset_top = $('#close_sticky_anchor').offset().top - $('#rightCol').outerHeight();

            	if( $(window).scrollTop() > rightCol_offset_top && $(window).scrollTop() < stop_offset_top )
            	{
            		$('#rightCol').attr("class", "stick-right");
                    //console.log("Add Class Stick Right");
                }
                else if($(window).scrollTop() > stop_offset_top)
                {
                	$('#rightCol').attr("class", "stick-right-bottom");
                }
                else
                {
                	$('#rightCol').attr("class", "");
                }

                console.log("Stop offset top: "+ stop_offset_top);
            }

            // Sockets Stick =======================================================================================================
            /* Some systems dont have sockets therefore there is no change_sockets_repeat*/
            if($('#change_sockets_repeat').length){
            	sockets_offset_top = $('#change_sockets_repeat').offset().top - 50;
            } else {
            	sockets_offset_top = 0;
            }


            function check_sockets_scroll()
            {
            	if( $(window).scrollTop() > sockets_offset_top )  {
            		$('#change_sockets_repeat').addClass("stick-top");
            	} else {
            		$('#change_sockets_repeat').removeClass("stick-top");
            	}
            }

            //Aslo update stop offset top on tab change
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            	stop_offset_top = $('#close_sticky_anchor').offset().top - $('#rightCol').outerHeight();
            	check_filter_scroll();
            })

            // Generic on Scroll to control ===========================================================================================
            $(window).on("scroll", function(){
            	if ($(window).width() > 992) {
            		check_filter_scroll();
            	}
            	check_sockets_scroll();
            });
        </script>
    </div>
</div>
</div>
<!--End configurator_tabs and change_prices-->
<!--Cat listing -->
@include(config('template.homeTemplateBladeURL'). 'homepage.cat-listing')
<!--End Cat listing -->
@endsection

@section('page-css')
<link href="{{ asset(config('template.homeTemplateURL')  . 'css/product_finder-bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset(config('template.homeTemplateURL')  . 'css/product-detail.css') }}" type="text/css" />
<link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/custom-list-accessory-product.css') }}" rel="stylesheet" />

<link href="{{ asset(config('template.homeTemplateURL'). 'css/system_items-bootstrap.css') }}" rel="stylesheet" />
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom-list-accessory-product.js') }}"></script>
<script type="text/javascript">
// Create our number formatter.
var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',

  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

function changed_item($idParent,$idChil,$idAccessory,$priceAccessory,$priceDefault,$url, checkbox = false){
    $("#"+$idParent+" .right_image img").attr("src",$url);
    
    if (checkbox == false) {
        $("#"+$idParent+" .item").removeClass("item_selected");
        $("#"+$idParent+" #"+$idChil).addClass("item_selected");
    }
    
    $("#"+$idParent+" select").removeClass("displayBlock");
    console.log("#"+$idParent+" #"+$idChil+" #"+$idAccessory+" #select-"+$idAccessory);
    $("#"+$idParent+" #"+$idAccessory+" #select-"+$idAccessory).addClass("displayBlock");
    var arrQuantity = new Array();
    var arrPrice    = new Array();
    var totalQty = $("#load-accessory-category .item_selected select").each(function (index, select) {
        arrQuantity.push(Number(select.value));
    });
    var total_price_config = $("#load-accessory-category .item_selected span.price_default").each(function (index, span) {
       arrPrice.push(Number(span.textContent));
   });
    //console.log("arrPrice11:"+arrPrice.length + "arrQuantity11:"+arrQuantity.length);
    var total_price_config = 0;
    for (var i = 0; i < arrPrice.length; i++) {
        total_price_config = total_price_config + (arrQuantity[i]*arrPrice[i]);
        //console.log(arrQuantity[i]+"*"+arrPrice[i]);
    };
    var price_product = Number($("#price_product").val());
    console.log(total_price_config);
    var totalPrice    = price_product + total_price_config;
    //totalPrice.toFixed(2)
    $("#total_price").text(formatter.format(totalPrice));
    $("input[name*='price_config']").val(totalPrice);
}
function changed_bill($idParent, $idChil, $idAccessory, $nameAccessory){
    var nameTree = $("#"+$idParent+" .new_item_type").text();
    var nameChil = $("#"+$idParent+" .cate-div-item-"+$idChil).text();
    var quantity = $("#"+$idParent+" #div-item-"+$idChil+" #"+$idAccessory+" select").val();
    var category = {
        'category_tree_name' :nameTree,
        'category'           :Number($idChil),
        'category_name'      :nameChil,
        'accessory_id'       :Number($idAccessory),
        'accessory_qty'      :Number(quantity),
        'accessory_name'     :$nameAccessory
    };
    //console.log(category);
    var html = '';
    if (Number(quantity)>1) {
        html += '<li><i class="fa fa-check" aria-hidden="true"></i>'
        +category.accessory_qty
        +'x'
        +category.accessory_name
        +'</li>';
    }
    else {
        html += '<li><i class="fa fa-check" aria-hidden="true"></i>'
        +category.accessory_name
        +'</li>';
    }
    html +="<input type='hidden'  name='myConfig[]' value='"+JSON.stringify(category)+"' />"
    $("ul #"+$idParent).html(html);
    
    //$("ul li#"+idParent).remove();
}
function changed_qty_item_bill($this){
	var quantity  = $("#"+$this.id).val(); //46
    var idParent  = $("#"+$this.id).parents().eq(4).attr("id"); //change-configurator-38 
    var nameTree  = $("#"+idParent+" .new_item_type").text();
    var idAccessoryDiv = $("#"+$this.id).parents().eq(0).attr("id");
    var idChilDiv      = $("#"+$this.id).parents().eq(1).attr("id");  
    var idChil         = $("#"+idChilDiv+" #"+idAccessoryDiv+" input").attr("id");
    var nameChil       = $("#"+idParent+" .cate-div-item-"+idChil).text();
    var nameAccessory  = $("#"+idChilDiv+" #"+idAccessoryDiv+" label").text();
    var input          = $("ul #"+idParent+" input").val();
    var categories     = $.parseJSON(input);
    var typeSelect  = $("#"+idParent+" p.type-select").attr("id");
    //console.log(typeSelect+" idParent: "+idParent+" idChil:"+idChil+" idAccessoryDiv:"+idAccessoryDiv+ " idChilDiv:"+idChilDiv);
    function thisName(category) {
        return category.accessory_name === nameAccessory;
    }
    var html = '';
    if (typeSelect == "Select") {
        if (categories.find(thisName)) {
            category = categories.find(thisName);
            if( Number(quantity) == 0 ){
                var idRemove = categories.indexOf(category.accessory_name)
                categories.splice(idRemove,1);
            }
            else {
                category.accessory_qty = Number(quantity);
            }
        }
        else {
            var item = {
                'category_tree_name' :nameTree,
                'category'           :Number(idChil),
                'category_name'      :nameChil,
                'accessory_id'       :Number(idAccessoryDiv),
                'accessory_qty'      :Number(quantity),
                'accessory_name'     :nameAccessory
            };
            categories.push(item);
        }
        $.each(categories, function (index, category) {
            if (category.accessory_qty > 1) {
                html += '<li><i class="fa fa-check" aria-hidden="true"></i>'+
                +category.accessory_qty
                +'x'
                +category.accessory_name
                +'</li>';
            }
            else{
                html += '<li><i class="fa fa-check" aria-hidden="true"></i>'
                +category.accessory_name
                +'</li>';
            }
            
        });
    }
    else {
        categories = {};
        var categories = {
            'category_tree_name' :nameTree,
            'category'      :Number(idChil),
            'category_name' :nameChil,
            'accessory_id'  :Number(idAccessoryDiv),
            'accessory_qty' :Number(quantity),
            'accessory_name':nameAccessory
        };
        if (categories.accessory_qty > 1) {
            html += '<li><i class="fa fa-check" aria-hidden="true"></i>'+
            +categories.accessory_qty
            +'x'
            +categories.accessory_name
            +'</li>';
        }
        else{
            html += '<li><i class="fa fa-check" aria-hidden="true"></i>'
            +categories.accessory_name
            +'</li>';
        }

    }
    
    var newCategories = JSON.stringify(categories);
    html += "<input type='hidden'  name='myConfig[]' value='"+newCategories+"'/>";
    $("ul #"+idParent).html(html);
}
$('.item input').click(function (){
    var idAccessory = $(this).val(); //46
    var idChil      = $(this).parents().eq(0).attr("id"); //
    var idChilDiv   = $(this).parents().eq(1).attr("id"); //
    var idParent    = $(this).parents().eq(4).attr("id"); //change-configurator-38
    var priceAccessory = $("#"+idChilDiv+" #"+idAccessory+" span").text(); //53234
    console.log(" idAccessory: "+idAccessory+" idChil:"+idChil+" idChilDiv:"+idChilDiv);
    var nameAccessory  = $("#"+idChilDiv+" #"+idAccessory+" label").text();
    var priceDefault   = $("#"+idParent+" span.price_default").text();
    var urlImage = $("#"+idChilDiv+" #"+idAccessory+" img").attr("src");
    $("#"+idParent+" span").removeClass("price_default");
    $("#"+idChilDiv+" #"+idAccessory+" span").addClass("price_default");
    $("#"+idParent+" label").removeClass("label_default");
    $("#"+idChilDiv+" #"+idAccessory+" label").addClass("label_default");

    changed_bill(idParent, idChil, idAccessory, nameAccessory);
    changed_item(idParent, idChil, idAccessory, priceAccessory, priceDefault, urlImage);
});

$('.item select').change(function (){
    var idParent    = $(this).parents().eq(4).attr("id");
    var idChil = $(this).parents().eq(1).attr("id");
    var idAccessory = $(this).parents().eq(0).attr("id");
    $(this).parent().addClass("item_selected");
    $("#"+idChil+" span").addClass("price_default");
    var typeSelect  = $("#"+idParent+" p.type-select").attr("id");
    var limit  = $("#"+idParent+" p.type-select").text();
    if ($("#"+idAccessory+" input").attr("type") == "checkbox" &&  Number($(this).val()) > 0 )  {
        $("#"+idAccessory+" input").attr("checked", "checked");
    }
    if($("#"+idAccessory+" input").attr("type") == "checkbox" &&  Number($(this).val()) == 0) {
        $("#"+idAccessory+" input").removeAttr('checked');
        //$("#"+idChil+" span").removeClass("price_default");
        console.log($(this).val());
        $(this).parent().removeClass("item_selected");
    }
    //type_selects = ['Radio', 'Radio-limit', 'Select-limit', 'checked'];
    if (typeSelect == "Select-limit") {
        var limit_selected = $(this).val();
        var reset_limit = limit-limit_selected;
        var newOption = '';
        $(this).removeClass('displayBlock');
        $(this).addClass('selected');
        $("#"+idParent+" select.displayBlock").children().remove();
        for (var i = 0; i <= reset_limit; i++) {
         newOption += '<option value="'+i+'">'+i+'</option>';
     }
     $("#"+idParent+" select.displayBlock").html(newOption);
        // có 2 thẻ select class="selected"
        if ($("#"+idParent+" select.selected").length > 1) {
            var limit_selected = 0;
            var reset_limit    = 0;
            $("#"+idParent+" select.selected").each(function (index, select) {
               limit_selected += Number(select.value);
           });
            reset_limit = limit-limit_selected;
            // ____reset option select non-selected____
            $("#"+idParent+" select.displayBlock").children().remove();
            var newOption = '';
            for (var i = 0; i <= reset_limit; i++) {
                newOption += '<option value="'+i+'">'+i+'</option>';
            }
            $("#"+idParent+" select.displayBlock").html(newOption);
        };
        //____reset option selected____ 
        //limit       = 12
        //reset_limit = 4
        //limit_selected = 7
        $("#"+idParent+" select.selected").each(function (index, select) {
            //select.value = 3
            var optionSelected = limit - (limit_selected - select.value) ;
            var newOption = '';
            for (var i = 0; i <= optionSelected; i++) {
                if(select.value == i){
                    newOption += '<option value="'+i+'" selected>'+select.value+'</option>';
                }
                else {
                    newOption += '<option value="'+i+'">'+i+'</option>';
                };
            };
            $("#"+select.id).html(newOption);
        });  
    }
    var arrQuantity = new Array();
    var arrPrice    = new Array();
    var totalQty = $("#load-accessory-category .item_selected select").each(function (index, select) {
        arrQuantity.push(Number(select.value));
    });
    var total_price_config = $("#load-accessory-category .item_selected span.price_default").each(function (index, span) {
       arrPrice.push(Number(span.textContent));
   });
    //console.log("arrPrice11:"+arrPrice.length + "arrQuantity11:"+arrQuantity.length);
    var total_price_config = 0;
    for (var i = 0; i < arrPrice.length; i++) {
        total_price_config = total_price_config + (arrQuantity[i]*arrPrice[i]);
        //console.log(arrQuantity[i]+"*"+arrPrice[i]);
    };
    var price_product = Number($("#price_product").val());
    console.log(total_price_config);
    var totalPrice    = price_product + total_price_config;
    $("#total_price").text(formatter.format(totalPrice));
    $("input[name*='price_config']").val(totalPrice);
    changed_qty_item_bill(this);
    
});
$(".item .input-checked").on('click', function() {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    var idAccessory = $(this).val(); //46
    var idChil      = $(this).parents().eq(1).attr("id"); //div-item-40
    var idParent    = $(this).parents().eq(4).attr("id"); //change-configurator-38
    var priceAccessory = $("#"+idChil+" #"+idAccessory+" span").text(); //53234
    var priceDefault   = $("#"+idParent+" span.price_default").text();
    var urlImage = $("#"+idChil+" #"+idAccessory+" img").attr("src");
    if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
    $("#"+idParent+" #"+idChil+" #"+idAccessory).addClass("item_selected");
    $("#"+idChil+" #"+idAccessory+" span").addClass("price_default");
    changed_item(idParent, idChil, idAccessory, priceAccessory, priceDefault, urlImage, true);
} else {
    $box.prop("checked", false);
    $("#"+idParent+" #"+idChil+" #"+idAccessory).removeClass("item_selected");
    $("#"+idChil+" #"+idAccessory+" span").removeClass("price_default");
    changed_item(idParent, idChil, idAccessory, priceAccessory, priceDefault, urlImage, true);
}

});
</script>

@endsection

@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-group">
                        <label>Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" maxlength="191" required placeholder="Enter name " />
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="col-12">
                                <span class="font-13 text-muted">{{ config('app.url') }}/slug-example/</span>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ $product->slug }}" required placeholder="Enter slug" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Price <span class="required">*</span></label>
                        <input type="text" name="price_product" id="price_product" class="form-control" required placeholder="Price of product " value="{{ $product->price }}" />
                    </div>
                    <div class="form-group">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Drive Bay Size</label>
                                    <input step="0.1" type="number" name="drive_bay_size" id="drive_bay_size" class="form-control" required value="{{ $product->drive_bay_size }}" min="0"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity Drive</label>
                                    <input  type="number" name="qty_drive" id="qty_drive" class="form-control" required value="{{ $product->qty_drive }}" min="0"  />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Popular </label>
                        <div class="custom-control custom-checkbox checkbox-lg">
                          <input type="checkbox" name="is_popular" class="custom-control-input" id="checkbox-2" @if( $product->is_popular == 1) checked @endif>
                          <label class="form-check-label custom-control-label" for="checkbox-2" style="padding-top: 2px">Popular</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description <span class="required">*</span></label>
                        <textarea name="description" id="description" required class="form-control" rows="5">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="parent_category">Choose the Product's Category<span class="required">*</span></label>
                        <select name="category_id"  id="category-id" class="form-control js-example-basic-single" required>
                        {{ productCategories($categories,$product->category_id) }}
                        </select>
                    </div>
                    <div id="load-accessory-category" class="tab-pane active">
                        @if($htmlAccessories !='')
                        {!! $htmlAccessories !!}
                        @else
                            Eror
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">
                                Save
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light btn-block">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            @include(config('template.cmsTemplateBladeURL') . 'product.cover-image.edit')
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Total price </label>
                                @php 
                                $total_price = $total_price_config + $product->price;
                                @endphp
                                <input readonly="readonly" type="hidden" name="hidden" id="total_price" class="form-control" required placeholder="Total price for product " value="{{ $total_price }}" />
                                <input type="hidden" name="total_price_config" id="total_price_config"  value="{{ $total_price_config }}" />
                                <input type="text" readonly="readonly" name="total_price_custom" id="total_price_custom" class="form-control" required placeholder="Total price for product " value="${{ number_format($total_price ,2) }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">SEO Metadata</h4>
                            @php
                            $seoMeta = json_decode($product->seo_metadata);
                            $title = "";
                            if (!empty($seoMeta->title)) {
                                $title = $seoMeta->title;
                            }
                            $description = "";
                            if (!empty($seoMeta->description)) {
                                $description = $seoMeta->description;
                            }
                            $keywords = "";
                            if (!empty($seoMeta->keywords)) {
                                $keywords = $seoMeta->keywords;
                            }
                            @endphp
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="SEO Meta Title" value="{{ $title }}"/>
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3" placeholder="SEO Meta Description">{{ $description }}</textarea>                            </div>
                            <div class="form-group">
                                <label>Keywords</label>
                                <textarea name="meta_keywords" class="form-control" rows="3" placeholder="SEO Keywords">{{ $keywords }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@include(config('template.cmsTemplateBladeURL') . 'modals.config-product-modal')
@endsection
@section('page-css')
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/custom-list-accessory-product.css') }}" rel="stylesheet" />
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<style type="text/css">
    .form-check-label {
        margin-left: 15px;
    }
</style>
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/select2/dist/js/select2.min.js') }}"></script>
@endsection

@section('page-custom-js')
<script type="text/javascript">
     // Create our number formatter.
    var formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',

      // These options are needed to round to whole numbers if that's what you want.
      //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
      //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
    });
    // disabled input slug name
    $(document).ready(function() {
        $('form').parsley({
            excluded: 'input[type=button], input[type=submit], input[type=reset]',
            inputs: 'input, textarea, select, input[type=hidden], :hidden',
        });
      
        $('.js-example-basic-single').select2();

        
    });

    @include(config('template.cmsTemplateBladeURL') . 'includes.ckeditor', ['textID' => 'description', 'height' => 500]);
    @include(config('template.cmsTemplateBladeURL') . 'product.cover-image.js');
    
    $("#category-id").change(function(){
        var token = "{{ csrf_token() }}";
        var id = $(this).val();
        console.log(id);
        $.ajax({
                url : "{!! route('product.load-accessories-create') !!}",
                method: "POST",
                data: { _token:token, id:id }
            }).done(function(response) {
               console.log(response);
                var total_price = response.total_price;
                $("#total_price").val(total_price.toFixed(2));
                $("#total_price_config").val(response.total_price_config);
                $("#total_price_custom").val(formatter.format(total_price));
                if(response.html != ""){
                    $("#load-accessory-category").html(response.html);
                    $.getScript("{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom-list-accessory-product.js') }}");
                }  
                else {
                    render = '<div class="form-group"><p>This category does not accessory  </p></div>';
                    $("#load-accessory-category").html(render);
                }                   
        });

    });

     $("#price_product").keyup(function(){
        var price_product = Number($(this).val());
        var total_price_config = Number($("#total_price_config").val());
        var total_price        = price_product+total_price_config;
        $("#total_price").val(total_price.toFixed(2));
        $("#total_price_custom").val(formatter.format(total_price))
    });

    $('#name').blur(function() {
        $('#slug').val(slugify($('#name').val()));
    });
</script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom-list-accessory-product.js') }}"></script>
@endsection
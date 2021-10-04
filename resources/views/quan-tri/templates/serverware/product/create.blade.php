@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('product.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-group">
                        <label>Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"  placeholder="Enter name " maxlength="191" required data-parsley-name="" />
                    </div>
                    <div class="form-group">
                        <label>Slug </label>
                        <div class="row">
                            <div class="col-12">
                                <span class="font-13 text-muted">{{ config('app.url') }}/slug-example</span>
                                <input type="text" name="slug" id="slug" class="form-control" required placeholder="Enter slug"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Price <span class="required">*</span></label>
                        <input type="text" name="price_product" id="price_product" class="form-control" required placeholder="Enter price " value="0" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Drive Bay Size</label>
                                    <input step="0.1" type="number" name="drive_bay_size" id="drive_bay_size" class="form-control" required value="0" min="0"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity Drive</label>
                                    <input  type="number" name="qty_drive" id="qty_drive" class="form-control" required value="0" min="0"  />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Popular </label>
                        <div class="custom-control custom-checkbox checkbox-lg">
                          <input type="checkbox" name="is_popular" class="custom-control-input" id="checkbox-2" >
                          <label class="form-check-label custom-control-label" for="checkbox-2" style="padding-top: 2px">Popular</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description <span class="required">*</span></label>
                        <textarea name="description" id="description" required class="form-control" rows="5"></textarea>
                    </div>
                  
                    <div id="div-accessory-category" class="form-group">
                        <label for="accessory_category_id">Product's Category</span></label>
                        <select name="category_id" id="category-id" class="js-example-basic" required>
                         @if(!empty($categories))
                          {{ productCategories($categories)}}
                          @endif
                        </select>
                    </div>
                    <!-- LOAD ACCESSORY -->
                    <div id="load-accessory-category" class="tab-pane active">
                    </div>
                    <input type="hidden" name="list_selected">
                    <!-- END LOAD ACCESSORY -->
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
            @include(config('template.cmsTemplateBladeURL') . 'product.cover-image.create')
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                             <div class="form-group">
                                <label>Total price</label>
                                <input readonly="readonly" type="hidden" name="hidden" id="total_price" class="form-control" required placeholder="Total price for product " value="" />
                                <input type="hidden" name="total_price_config" id="total_price_config"  value="0" />
                                <input type="text" readonly="readonly" name="total_price_custom" id="total_price_custom" class="form-control" required placeholder="Total price for product "  />
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
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="SEO Meta Title"/>
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3" placeholder="SEO Meta Description"></textarea>                            </div>
                            <div class="form-group">
                                <label>Keywords</label>
                                <textarea name="meta_keywords" class="form-control" rows="3" placeholder="SEO Keywords"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
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
        $("#category-id").change();
        $('.js-example-basic').select2({
          width: '100%'
        });

    });

    window.Parsley.addValidator('name', {
      validateString: function(value) {
        var product_name = value;
        var token = "{{ csrf_token() }}";
        var xhr = $.ajax({
              url : "{!! route('product.check-unique-name') !!}",
              method: "GET",
              data: {_token:token, name : product_name  },
          });
        return xhr.then(function (data) {
            if (data == 1) {
                return true;
            } else {
                return $.Deferred().reject();
            }
        });
      },
      messages: {en: 'Already exist "%s"'}
    });


    @include(config('template.cmsTemplateBladeURL') . 'includes.ckeditor', ['textID' => 'description', 'height' => 300]);

    @include(config('template.cmsTemplateBladeURL') . 'product.cover-image.js');

    $('.item-li').mouseover(function() {
        var id = this.id
       $('#ul'+id ).css("display", "block");
    });
   
    $('.item-li').mouseleave(function() {
        var id = this.id;
       $('#ul'+id ).css("display", "none");
    });

    $("#category-id").change(function(){
        var token = "{{ csrf_token() }}";
        var id = $(this).val();
        var image = $("#image-cover").attr("src");
        var category_name  = $("#cate-"+id).text();
        var product_name = $("#name").val();
        var product_price = $("#price_product").val();
        console.log(id);
        $.ajax({
                url : "{!! route('product.load-accessories-create') !!}",
                method: "POST",
                data: { _token:token, id:id, image:image, product_name:product_name, category_name:category_name, product_price:product_price}
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
    
    $(".item select[name*='selected']").change(function (){
        var idAccessory = $(this).parents().eq(1).attr("id");
        var newHtml = 
        $("#"+idAccessory).html();
    });
</script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom-list-accessory-product.js') }}"></script>
@endsection
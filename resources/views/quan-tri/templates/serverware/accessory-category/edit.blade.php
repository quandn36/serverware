@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('accessory-category.update', ['id' => $accessoryCate->id]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-group">
                        <label for="parent_category">Parent category<span class="required">*</span></label>
                        <select name="parent_category_id" id="parent_category_id" class="form-control">
                          <option @if($accessoryCate->parent_category_id == 0) selected @endif value="0"> > The default is parent category</option>
                          @foreach($accessoryCategories as $cate)
                          <option @if($accessoryCate->parent_category_id == $cate->id && $accessoryCate->parent_category_id != 0) selected @endif value="{{ $cate->id }}">{{ $cate->name }} </option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name<span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $accessoryCate->name }}" required placeholder="" maxlength="191" />
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug </label>
                        <div class="row">
                            <div class="col-12">
                                <span class="font-13 text-muted">{{ config('app.url') }}/slug-example</span>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ $accessoryCate->slug }}" required placeholder="" />
                            </div>
                        </div>
                    </div>
                    <input id="checked-category" type="hidden" name="checked_category" value="{{ $accessoryCate->parent_category_id }}" required>
                    <div id="type-of-select" class="form-group">
                        @php
                            $type_select = ['Radio', 'Radio-limit', 'Select', 'checked'];
                            $check =  json_decode($accessoryCate->type_of_select);
                        @endphp
                        <div class="form-group">
                            <label for="name">Type of select category<span class="required">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block" >
                                Save
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light btn-block">Cancel</a>
                        </div>
                    </div>
                    <!-- them vao ckfinder hinh anh -->
                    @include(config('template.cmsTemplateBladeURL') . 'accessory-category.cover-image.edit')
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('page-css')
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.css') }}" rel="stylesheet" />
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom.js') }}"></script>
@endsection

@section('page-custom-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley({
            excluded: 'input[type=button], input[type=submit], input[type=reset]',
            inputs: 'input, textarea, select, input[type=hidden], :hidden',
        });
         
        $("#parent_category_id").change();
        $('.js-example-basic-multiple').select2({
          width: '100%'
        });
      
    });
    

    // hien thi slug name cho nguoi dung chinh sua
    $('#name').blur(function(){
        $('#slug').val(slugify($('#name').val()));
    });

    $("#parent_category_id").change(function(){
        var check = $(this).val();
        $("#checked-category").val(check);
        console.log(check);
        if (check == 0) {
            var checked = <?php echo json_encode($check); ?>; 
            console.log(checked);
            var type_select = ['Radio', 'Radio-limit', 'Select-limit', 'checked'];
            var render_radio_checkbox = '<div class="row"><div class="col-12"><div class="form-group" id="test"><label for="name">Type of select category<span class="required">*</span></label>';
            var radio ='<div class="form-check">';
                        if (checked != null && checked.type == type_select[0]) {
                            radio += '<input class="form-check-input" type="radio" name="type_select" id="'+type_select[0]+'" value="'+type_select[0]+'" checked>';
                        }
                        else{
                            radio += '<input class="form-check-input" type="radio" name="type_select" id="'+type_select[0]+'" value="'+type_select[0]+'" >';
                        }
                radio += '<label class="form-check-label" for="'+type_select[0]+'">'+type_select[0]+
                '</label>'+
                '<input style="display:none;" id="qty-max-select" name="qty_max['+type_select[0]+']" type="number" value="1" readonly/>'+
                '</div>';
            var radio_limit ='<div class="form-check">'+
                                '<div class="row">'+
                                '<div class="col-md-6">';
                                if (checked != null && checked.type == type_select[1]) {
                                    radio_limit +='<input class="form-check-input"  type="radio" name="type_select" id="'+type_select[1]+'" value="'+type_select[1]+'" checked>';
                                }
                                else {
                                    radio_limit +='<input class="form-check-input"  type="radio" name="type_select" id="'+type_select[1]+'" value="'+type_select[1]+'">';
                                }
                radio_limit +='<label class="form-check-label" for="'+
                                type_select[1]+'">'+
                                type_select[1]+
                                '</label>'+
                                '</div>';
                               
                                if (checked != null && checked.type == type_select[1]) {
                                    radio_limit +='<div class="col-md-6 '+type_select[1]+' selectt" >'+
                                    '<label class="form-check-label" for="qty-max-select">'+
                                    'Limit '+
                                    '</label>';
                                    radio_limit +='<input id="qty-max-select" class="form-control" name="qty_max['+type_select[1]+']" type="number" value="'+checked.limit+'" min="2"/>';
                                }
                                else{
                                    radio_limit +='<div style="display:none;" class="col-md-6 '+type_select[1]+' selectt" >'+
                                    '<label class="form-check-label" for="qty-max-select">'+
                                    'Limit '+
                                    '</label>';
                                    radio_limit +='<input id="qty-max-select" class="form-control" name="qty_max['+type_select[1]+']" type="number" value="2" min="2"/>';
                                }
                radio_limit+='</div></div></div>';
            var select_limit ='<div class="form-check">'+
                                '<div class="row">'+
                                '<div class="col-md-6">';
                                if (checked != null && checked.type == type_select[2]) {
                                    select_limit +='<input class="form-check-input"  type="radio" name="type_select" id="'+type_select[2]+'" value="'+type_select[2]+'" checked>';
                                }
                                else {
                                    select_limit +='<input class="form-check-input"  type="radio" name="type_select" id="'+type_select[2]+'" value="'+type_select[2]+'">';
                                }
                select_limit +='<label class="form-check-label" for="'+
                                type_select[2]+'">'+
                                type_select[2]+
                                '</label>'+
                                '</div>';
                                
                                if (checked != null && checked.type == type_select[2]) {
                                    select_limit +='<div class="col-md-6 '+type_select[2]+' selectt" >'+
                                    '<label class="form-check-label" for="qty-max-select">'+
                                    'Limit '+
                                    '</label>';
                                    select_limit +='<input id="qty-max-select" class="form-control" name="qty_max['+type_select[2]+']" type="number" value="'+checked.limit+'" min="2"/>';
                                }
                                else{
                                     select_limit +='<div style="display:none;" class="col-md-6 '+type_select[2]+' selectt" >'+
                                    '<label class="form-check-label" for="qty-max-select">'+
                                    'Limit '+
                                    '</label>';
                                    select_limit +='<input id="qty-max-select" class="form-control" name="qty_max['+type_select[2]+']" type="number" value="2" min="2"/>';
                                }
                select_limit+='</div></div></div>';
            var ichecked = '<div class="form-check">';
                            if (checked != null && checked.type == type_select[3]) {
                                ichecked += '<input class="form-check-input" type="radio" name="type_select" id="'+type_select[3]+'" value="'+type_select[3]+'" checked>';
                            }
                            else{
                                ichecked += '<input class="form-check-input" type="radio" name="type_select" id="'+type_select[3]+'" value="'+type_select[3]+'" >';
                            }
                ichecked += '<label class="form-check-label" for="'+type_select[3]+'">Checked'
                '</label>'+
                '<input style="display:none;" id="qty-max-select" name="qty_max['+type_select[3]+']" type="number" value="1" readonly/>'+
                '</div>';
 
            render_radio_checkbox+= radio+radio_limit+select_limit+ichecked
            render_radio_checkbox+='</div></div>';            
            $("#type-of-select").html(render_radio_checkbox);

            //START hide and show div limit when click radio checkbox
            $('input[type="radio"]').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".selectt").not(targetBox).hide();
                $(targetBox).show();
            });
            $('#div-product-category').show();
            $("#product_category_id").attr("required", true );
            //END hide and show div limit when click radio checkbox
        }
        else {
          $("#type-of-select").children().remove();
          $('#div-product-category').hide();
          $("#product_category_id").attr("required", false );
        }
    }); 
   
    $( '#name_category' ).on('keyup', function(  ){
        var string = $( this ).val(  );
        getSlug ( string );
    });

    function getSlug ( string ) {
        var slug = _.str.slugify( string );
        console.log( slug );
        $( '#result' ).text( slug );
    };

    // LOAD js hình ảnh
    @include(config('template.cmsTemplateBladeURL').'accessory-category.cover-image.js');
</script>
@endsection

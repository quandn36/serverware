@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('accessory-category.store') }}" method="POST">
  @csrf
  <div class="row">
    <div class="col-lg-8">
      <div class="card m-b-30">
        <div class="card-body">
          <div class="form-group">
            <label for="parent_category">Parent category<span class="required">*</span></label>
            <select name="parent_category_id" id="parent_category_id" class="form-control">
              <option value="0">> The default is parent category</option>
              @foreach($accessoryCategories as $accessoryCate)
              <option value="{{ $accessoryCate->id }}">{{ $accessoryCate->name }} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="name">Name<span class="required">*</span></label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="Enter name" maxlength="191"/>
          </div>
          <div class="form-group">
            <label for="slug">Slug</label>
            <div class="row">
              <div class="col-12">
                <span class="font-13 text-muted">{{ config('app.url') }}/slug-example</span>
                <input type="text" name="slug" id="slug" class="form-control" required placeholder="Enter slug" />
              </div>
            </div>
          </div>
          
          <input id="checked-category" type="hidden" name="checked_category" required>
          <div id="type-of-select" class="form-group"></div>
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
      @include(config('template.cmsTemplateBladeURL') . 'accessory-category.cover-image.create')
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
<style type="text/css">
  .group-config {
    padding: 10px;
    margin: 10px;
    border: 1px solid;
  }
  .form-check {
    margin: 10px 10px 20px 0px;
  }
  .selectt
  {
    display: none;
  }
  .intro {
    font-size: 150%;
  }
</style>
@endsection

@section('page-custom-js')
<script type="text/javascript">
  $(document).ready(function() {
    $('form').parsley({
      excluded: 'input[type=button], input[type=submit], input[type=reset]',
      inputs: 'input, textarea, select, input[type=hidden], :hidden',
    });
    // hiển thị slug name cho người dùng xem trước hoặc có thể chỉnh sửa
    $('#name').blur(function() {
      $('#slug').val(slugify($('#name').val()));
    });
    $("#parent_category_id").change();
    $('.js-example-basic-multiple').select2({
      width: '100%'
    });
  });
  $("#parent_category_id").change(function(){
    var check = $(this).val();
    $("#checked-category").val(check);
    console.log(check);
    if (check == 0) {
      var type_select = ['Radio', 'Radio-limit', 'Select-limit', 'checked'];
      var render_radio_checkbox = '<div class="row"><div class="col-12">'+
      '<div class="form-group" id="test">'+
      '<label for="name">Type of select category<span class="required">*</span></label>'+
      '<div class="form-check">'+
      '<input class="form-check-input" type="radio" name="type_select" id="'+type_select[0]+'" value="'+type_select[0]+'" checked>'+
      '<label class="form-check-label" for="'+type_select[0]+'">'+
      type_select[0]+
      '</label>'+
      '<input style="display:none;" id="qty-max-select" name="qty_max['+type_select[0]+']" type="number" value="1" readonly/>'+
      '</div>'+

      '<div class="form-check">'+
      '<div class="row">'+
      '<div class="col-md-6">'+
      '<input class="form-check-input"  type="radio" name="type_select" id="'+type_select[1]+'" value="'+type_select[1]+'" >'+
      '<label class="form-check-label" for="'+type_select[1]+'">'+
      type_select[1]+
      '</label>'+
      '</div>'+
      '<div class="col-md-6 '+type_select[1]+' selectt" >'+
      '<label class="form-check-label" for="qty-max-select">'+
      'Limit '+
      '</label>'+
      '<input id="qty-max-select" class="form-control" name="qty_max['+type_select[1]+']" type="number" value="2" min="2"/>'+
      '</div>'+
      '</div>'+
      '</div>'+

      '<div class="form-check">'+
      '<div class="row">'+
      '<div class="col-md-6">'+
      '<input class="form-check-input"  type="radio" name="type_select" id="'+type_select[2]+'" value="'+type_select[2]+'" >'+
      '<label class="form-check-label" for="'+type_select[2]+'">'+
      type_select[2]+
      '</label>'+
      '</div>'+
      '<div class="col-md-6 '+type_select[2]+' selectt">'+
      '<label class="form-check-label" for="qty-max-select">'+
      'Limit '+
      '</label>'+
      '<input id="qty-max-select" class="form-control" name="qty_max['+type_select[2]+']" type="number" value="2" min="2"/>'+
      '</div>'+
      '</div>'+
      '</div>'+

      '<div class="form-check">'+
      '<input class="form-check-input" type="radio" name="type_select" id="'+type_select[3]+'" value="'+type_select[3]+'" checked>'+
      '<label class="form-check-label" for="'+type_select[3]+'">Checked'
      '</label>'+
      '<input style="display:none;" id="qty-max-select" name="qty_max['+type_select[3]+']" type="number" value="1" readonly/>'+
      '</div>'+

      '</div></div></div>';            
      $("#type-of-select").html(render_radio_checkbox);

      //START hide and show div limit when click radio checkbox
      $('input[type="radio"]').click(function () {
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".selectt").not(targetBox).hide();
        $(targetBox).show();
      });
      
      $('#div-product-category').show();
      //END hide and show div limit when click radio checkbox
    }
    else {
      $("#type-of-select").children().remove();
      $('#div-product-category').hide();
      
    }
  }); 

  // LOAD js hình ảnh
  @include(config('template.cmsTemplateBladeURL').'accessory-category.cover-image.js');
</script>
@endsection



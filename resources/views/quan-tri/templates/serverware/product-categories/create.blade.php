@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('product-categories.store') }}" method="POST" class="needs-validation" id="form_create_category">
  @csrf
  <div class="row">
    <div class="col-lg-8">
      <div class="card m-b-30">
        <div class="card-body">
          <div class="form-group">
            <label for="name_category">Name<span class="required">*</span></label>
            <input type="text" name="name_category" maxlength="191" id="name_category" data-parsley-trigger="keyup" class="form-control{{ ($errors->has('name_category') ? " form-error" : "") }}" required placeholder="Enter name" />
            @if($errors->has('name_category'))
            <p class="vali-error" style="color:red;">{{ $errors->first('name_category') }}</p>
            @endif 
          </div>
          <div class="form-group">
            <label for="slug_name">Slug</label>
            <div class="row">
              <div class="col-12">
               <span class="font-1 text-muted">{{ config('app.url') }}/slug-example</span>
               <input type="text" name="slug_name" maxlength="191" id="slug_name" data-parsley-trigger="keyup" class="form-control{{ ($errors->has('slug_name') ? " form-error" : "") }}" required="required" placeholder="Enter slug" />
             </div>
           </div>
           @if($errors->has('slug_name'))
           <p class="vali-error" style="color:red;">{{ $errors->first('slug_name') }}</p>
           @endif 
         </div>
         <div class="form-group">
          <label for="short_name_category">Short name<span class="required">*</span></label>
          <input type="text" name="short_name_category" id="short_name_category" maxlength="40" data-parsley-trigger="keyup" class="form-control add_attribute_required{{ ($errors->has('short_name_category') ? " form-error" : "") }}" placeholder="Enter short name" />
          @if($errors->has('short_name_category'))
          <p class="vali-error" style="color:red;">{{ $errors->first('short_name_category') }}</p>
          @endif
        </div>
        <div class="form-group">
          <label for="code_name">Code <span class="required">*</span></label>
          <input type="text" name="code_name" id="code_name" maxlength="20" data-parsley-trigger="keyup" class="form-control add_attribute_required{{ ($errors->has('code_name') ? " form-error" : "") }}" placeholder="Enter code" /> 
          @if($errors->has('code_name'))
          <p class="vali-error" style="color:red;">{{ $errors->first('code_name') }}</p>
          @endif
        </div>
        <div class="form-group">
          <label for="parent_category">Parent category<span class="required">*</span></label>
          <select name="parent_category" id="parent_category" class="form-control parent_category">
            <option value="0" data-id="0" data-value="-1" class="_sub_category">The parent category</option>
            <!--ham de quy : app/Functions/functions.php -->
            <?php categoryRecursive($categories) ?>
          </select>
          @if($errors->has('parent_category'))
          <p class="vali-error" style="color:red;">{{ $errors->first('parent_category') }}</p>
          @endif
        </div>

        <!--start select category accessory list-->
        <div id="div-accessory-category" class="form-group">
          <label for="accessory_category_id">Accessory's category<span class="required">*</span></label>
          <select name="check[]" id="accessory_category_id" class="js-example-basic-multiple" multiple="multiple" required>
            @foreach($all_accessory_category as $accessory_category)
            <option value="{{ $accessory_category->id}}">{{ $accessory_category->name}}</option>
            @endforeach
          </select>
        </div>
        <!--end select category accessory list-->

        <br>
        <div class="form-group">
          <label>Short description<span class="required">*</span></label><br>
          <span class="color_error" id="error_short_name_description" style="color:red;"></span>
          <textarea name="short_name_description" id="short_name_description" class="form-control add_attribute_required clear_parsley_error"></textarea>
        </div>

        <div class="form-group">
          <label>Description <span class="required">*</span></label><br>
          <span class="color_error" id="error_long_description" style="color:red;"></span>
          <textarea name="long_description" id="long_description" class="form-control"></textarea>
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
    @include(config('template.cmsTemplateBladeURL') . 'product-categories.cover-image.create')
    @include(config('template.cmsTemplateBladeURL') . 'product-categories.image-banner-category.create')
    @include(config('template.cmsTemplateBladeURL') . 'product-categories.brand-image-category.create')

  </div>
</div>
</form>

@endsection

@section('page-css')
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
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
  $(document).ready(function() {
    /*focus text box name*/
    $("#name_category").focus();

    $('form').parsley({
      excluded: 'input[type=button], input[type=submit], input[type=reset]',
      inputs: 'input, textarea, select, input[type=hidden], :hidden',
    });

    /*xoa thong bao loi khi nguoi dung nhap lai thong tin*/ 
    $(".form-error").click(function() {
      $(this).removeClass('form-error');
      $("p").remove(".vali-error");
    });

    /*hiển thị slug name cho người dùng xem trước hoặc có thể chỉnh sửa*/
    $('#name_category').blur(function() {
      $('#slug_name').val(slugify($('#name_category').val()));
    });

    /*khi slug được nhập lại thông tin mới sẽ xoá thông báo lỗi*/
    $("#name_category").change(function(){
      $('#parsley-id-9').remove();
      $('#slug_name').removeClass('parsley-error');
    });


    $('.js-example-basic-multiple').select2({
      width: '100%'
    });
    $("#parent_category").change();

  });

  /* start xu ly su kien bat required cho short_description*/
  $("form").submit( function(e) {
    var short_description_lenght = CKEDITOR.instances['short_name_description'].getData().replace(/<[^>]*>/gi, '').length;
    if( !short_description_lenght ) {
      $('#error_short_name_description').html('This value is required.');
      e.preventDefault();
    }
  });
  $('#short_name_description').ready(function(){
    var short_name_description = CKEDITOR.instances.short_name_description;
    short_name_description.on('change', function(evt) {
      var check_null = short_name_description.getData();
      if(check_null != ""){
        $('#error_short_name_description').html('');
        $('#short_name_description').prop('required',false);
      }
      evt.cancel();
    });
  });
  /*end xu ly su kien bat required cho short_description*/

  /*start xu ly su kien bat required cho long_description*/
  $("form").submit( function(e) {
    var long_description_lenght = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '').length;
    if( !long_description_lenght ) {
      $('#error_long_description').html('This value is required.');
      e.preventDefault();
    }
  });
  $('#long_description').ready(function(){
    var long_description = CKEDITOR.instances.long_description;
    long_description.on('change', function(evt) {
      var check_null = long_description.getData();
      if(check_null != ""){
        $('#error_long_description').html('');
        $('#long_description').prop('required',false);
      }
      evt.cancel();
    });
  });
  /*end xu ly su kien bat required cho long_description*/


  /*select_accessory_class click event handler function*/
  $("#parent_category").change(function() {
    var check = $(this).val();
    if (check != 0) { 
      $('#div-accessory-category').show();
      $('#accessory_category_id').prop('required', true);
    }else {
      $('#div-accessory-category').hide();
      $('#accessory_category_id').prop('required', false);
    }
  });




  // load js ckeditor
  @include(config('template.cmsTemplateBladeURL').'includes.ckeditor', ['textID' => 'short_name_description', 'height' => 400]);
  @include(config('template.cmsTemplateBladeURL').'includes.ckeditor', ['textID' => 'long_description', 'height' => 400]);

  // LOAD js hình ảnh
  @include(config('template.cmsTemplateBladeURL').'product-categories.cover-image.js');
  @include(config('template.cmsTemplateBladeURL').'product-categories.image-banner-category.js');
  @include(config('template.cmsTemplateBladeURL').'product-categories.brand-image-category.js');
</script>
@endsection

@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('supplier.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name" maxlength="191" class="form-control" required placeholder="Enter name " maxlength="191"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Code <span class="required">*</span></label>
                        <input type="text" name="supplier_code" id="supplier_code" maxlength="20" class="form-control" required placeholder="Enter code " maxlength="20" data-parsley-code=""/>
                    </div>
                    <div class="form-group">
                        <label for="title">Email address <span class="required">*</span></label>
                        <input type="email" name="email" id="email" maxlength="250" class="form-control" required placeholder="Enter email address " data-parsley-type="email"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Address <span class="required">*</span></label>
                        <input type="text" name="address" maxlength="254" id="address" class="form-control" required placeholder="Enter address"/>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Number phone <span class="required">*</span></label>
                        <input type="text" name="telephone" minlength="10" maxlength="11" id="telephone" id="telephone" class="form-control" required placeholder="Enter number phone "/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body" style=" padding: 23px 15px; ">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">
                                Save
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light btn-block">Cancel</a>
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

        //called when key is pressed in textbox
        $("#telephone").keyup(function (e) {
            // if letters found flag error, display error, and remove any non-numbers
            if ($(this).val().match(/[^0-9]/g, '')) {
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
                console.log("=====")
                errorflag = 1;
            } else {
                console.log("==tt===")
            }
        });
    });

    window.Parsley.addValidator('code', {
      validateString: function(value) {
        var supplier_code = value;
        var token = "{{ csrf_token() }}";
        var xhr = $.ajax({
              url : "{!! route('supplier.check-unique-code') !!}",
              method: "GET",
              data: {_token:token, supplier_code : supplier_code  },
          });
        return xhr.then(function (data) {
            if (data == 1) {
                return true;
            } else {
                return $.Deferred().reject();
            }
        });
      },
      messages: {en: 'the supplier has already existed.'}
    });

    
</script>

@endsection
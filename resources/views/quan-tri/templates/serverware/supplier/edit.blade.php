@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('supplier.update', ['id' => $supplier->id]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Name <span class="required">*</span></label>
                        <input type="text" name="name" id="title" maxlength="191" class="form-control" required placeholder="Enter name " value="{{ $supplier->name }}" maxlength="191"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Address <span class="required">*</span></label>
                        <input type="text" name="address" id="address" maxlength="254" class="form-control" required placeholder="Enter address" value="{{ $supplier->address }}"/>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Number phone <span class="required">*</span></label>
                        <input type="text" name="telephone" minlength="10" maxlength="11" id="telephone" class="form-control" required placeholder="Enter number phone " value="{{ $supplier->telephone }}"/>
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
    
</script>
@endsection
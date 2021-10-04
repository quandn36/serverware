@extends(config('template.cmsTemplateBladeURL') . 'layout')
{{-- @if($errors->has('email') != false){{ dd($errors->all()) }} @endif --}}
@section('main-content')
<form action="{{ route('customers.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name"  maxlength="191" class="form-control{{ ($errors->has('name') ? " form-error" : "") }}" required placeholder="Enter name "/>
                        @if($errors->has('name'))
                        <p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('name') }}</p>
                        @endif 
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="text" name="email" id="email" maxlength="191"  class="form-control{{ ($errors->has('email') ? " form-error" : "") }}" required placeholder="Enter email"/>
                        @if($errors->has('email'))
                        <p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <input type="text" name="password" id="password" maxlength="20" class="form-control{{ ($errors->has('password') ? " form-error" : "") }}" required placeholder="Enter password"/>
                        @if($errors->has('password'))
                        <p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="company">Company <span class="required">*</span></label>
                        <input type="text" name="company" id="company" maxlength="191" class="form-control{{ ($errors->has('company') ? " form-error" : "") }}" required placeholder="Enter company name"/>
                        @if($errors->has('company'))
                        <p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('company') }}</p>
                        @endif
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
        window.onload = function() {
            document.getElementById("name").focus();
        };
    });
    // xoa thong bao loi khi nguoi dung nhap lai thong tin
    $(".form-error").click(function() {
        $(this).removeClass('form-error');
        $("p").remove(".vali-error");
    });
    
</script>

@endsection
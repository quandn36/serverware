@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="container-fluid">
                        <a href="{{ route('customers.create') }}" class="btn btn-success waves-effect waves-light mb-4"><i class="fas fa-plus-square"></i> Add new</a>
                    </div>
                    
                    <table id="table-user" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="thead_cursor_change" scope="col">Name</th>
                                <th class="thead_cursor_change" scope="col">Email</th>
                                <th class="thead_cursor_change" scope="col">Company</th>
                                <th class="thead_cursor_change" scope="col">Created at</th>
                                <th class="thead_cursor_change" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include(config('template.cmsTemplateBladeURL') . 'modals.reset-password-modal')
@endsection

@section('page-css')
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/custom-text-td-table-overflow.css') }}" rel="stylesheet" />
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/alertify/js/alertify.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/pages/alertify-init.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/parsleyjs/parsley.min.js') }}"></script>
@endsection

@section('page-custom-js')

<script type="text/javascript">
    $(document).ready(function(){
        
        @if (session('status') && session('status') == 'success')
            alertify.success("{!! session('message') !!}");
        @else 
            @if(!empty(session('message')))
                alertify.error("{!! session('message') !!}");
            @endif
        @endif
        $('form').parsley({
            excluded: 'input[type=button], input[type=submit], input[type=reset]',
            inputs: 'input, textarea, select, input[type=hidden], :hidden',
        });

        /*$("#form-reset-password").submit(function(){
            if ($("#form-reset-password").parsley().isValid()) {
                var id    = $("#form-reset-password-input-id-customer").val();
                var pws   = $("#password").val();
                $.ajax({
                        url : "{!! route('customers.reset-password') !!}",
                        method: "POST",
                        data: {_token:token, id : id, password:pws }
                    }).done(function(response) {
                        if (response.status == 'success') {
                            alertify.success(response.msg);
                            location.reload();
                        }else {
                            alertify.error(response.msg);
                        }
                        
                    });
            }
        });*/
        $('#table-user').DataTable({
            processing  : false,
            serverSide  : true,
            autoWidth   : false,
            drawCallback:function() {
                /*Action Delete*/
                $('.btn-delete').click(function() {
                    var mId = $(this).data("id");
                    var mTitle = $(this).data("title");
                    alertify.confirm("<b>Confirm Delete</b></br>Are you sure you want to delete the customer has name '" + mTitle + "'?", function (ev) {
                        ev.preventDefault();
                        $.ajax({
                            url : "{!! route('customers.delete') !!}",
                            method: "GET",
                            data: { id : mId }
                        }).done(function(response) {
                            alertify.success(response.msg);name
                            location.reload();
                        });
                    }, function(ev) {
                        ev.preventDefault();
                    });
                });
                /*End Action Delete */

                $('.btn-reset-pw').click(function() {
                    var mId = $(this).data("id");
                    var mTitle = $(this).data("title");
                    var newBody = '<div class="form-group row">'+
                        '<label for="inputPassword" class="col-sm-3 col-form-label">Password</label>'+
                        '<div class="col-sm-10">'+
                          '<input id="password" type="password" name="password" class="form-control"  placeholder="Password" required data-parsley-pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$">'+
                        '</div>'+
                        '</div>'+
                        '<div class="form-group row">'+
                            '<label for="inputPassword" class="col-sm-3 col-form-label">Confirm Password</label>'+
                            '<div class="col-sm-10">'+
                            '<input type="password" class="form-control" name="re_password"  placeholder="Confirm Password" required data-parsley-pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"'+
                            'data-parsley-trigger="keyup" data-parsley-equalto="#password"  onpaste="return false;">'+
                        '</div>'+
                        '</div>';
                    $("#myLargeModalLabel").html("Change password for email: "+mTitle) ;
                    $(".modal-body").html(newBody);
                    $("#form-reset-password-input-id-customer").val(mId);
                    $("#myRowConfigModal").val(this.id);
                    $("#reset-password-modal").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                });
                //ENd Action Reset-password
            },
            ajax: "{{ route('customers.load-ajax') }}",
            columns: [
            { data: 'name' },
            { data: 'email' },
            { data: 'company' },
            { data: 'created_at' },
            { data: 'action',bSortable: false},
            ],
        });
        
    });
</script>

@endsection
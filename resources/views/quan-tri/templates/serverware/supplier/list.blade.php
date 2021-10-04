@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="container-fluid">
                <a href="{{ route('supplier.create') }}" class="btn btn-success waves-effect waves-light mb-4"><i class="fas fa-plus-square"></i> Add new</a>
                </div>
                <div class="table-responsive">
                    <table id="table-user" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="thead_cursor_change" scope="col">Name</th>
                                <th class="thead_cursor_change" scope="col">Address</th>
                                <th class="thead_cursor_change" scope="col">Number phone</th>
                                <th class="thead_cursor_change" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-css')
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/alertify/js/alertify.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/pages/alertify-init.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('page-custom-js')

<script type="text/javascript">
    $(document).ready(function(){
        @if (session('status'))
        alertify.success("{!! session('message') !!}");
        @endif

        $('#table-user').DataTable({
            processing: false,
            serverSide: true,
            drawCallback:function() {
                /*Action Delete*/
                $('.btn-delete').click(function() {
                    var mId = $(this).data("id");
                    var mTitle = $(this).data("title");
                    alertify.confirm("<b>Confirm Delete</b></br>Are you sure you want to delete the supplier has name '" + mTitle + "'?", function (ev) {
                        ev.preventDefault();
                        $.ajax({
                            url : "{!! route('supplier.delete') !!}",
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
            },
            ajax: "{{ route('supplier.load-ajax') }}",
            columns: [
            { data: 'name' },
            { data: 'address' },
            { data: 'telephone' },
            { data: 'action' },
            ],
        });
        
    });
</script>

@endsection
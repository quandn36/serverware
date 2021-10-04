@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-categorys" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="thead_cursor_change" scope="col">Order date</th>
                                <th class="thead_cursor_change" scope="col">Code</th>
                                <th class="thead_cursor_change" scope="col">Customer name</th>
                                <th class="thead_cursor_change" scope="col">Status</th>
                                <th class="thead_cursor_change" scope="col">Delivery type</th>
                                <th class="thead_cursor_change" scope="col">Detail</th>
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
<link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/custom-text-td-table-overflow.css') }}" rel="stylesheet" />
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

        $('#table-categorys').DataTable({
            processing  : false,
            serverSide  : true,
            autoWidth   : false,
            drawCallback:function() {
                /*Action change status*/
                $('.select-status').change(function(){
                    var id    = this.id;
                    var status = this.value;
                    var token = "{{ csrf_token() }}";
                    $.ajax({
                            url : "{!! route('invoice.update-ajax') !!}",
                            method: "POST",
                            data: {_token:token, id : id, status:status }
                        }).done(function(response) {
                            alertify.success(response.msg);
                            location.reload();
                        });
                });
            },
            ajax: "{{ route('invoice.load-ajax') }}",
            columns: [ 
                { data: 'created_at'},    
                { data: 'code_invoice', bSortable: false},
                { data: 'user_name',bSortable: false},
                { data: 'status_name',bSortable: false},
                { data: 'delivery_type'},
                { data: 'action',bSortable: false},
            ],
        });
    });
</script>
@endsection
@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="container-fluid">
                <a href="{{ route('product-categories.create') }}" class="btn btn-success waves-effect waves-light mb-4 choose-categorytree"><i class="fas fa-plus-square"></i> Add new</a>
                </div>
                <div class="table-responsive">
                    <table id="table-categorys" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="thead_cursor_change" scope="col">Name</th>
                                <th class="thead_cursor_change" scope="col">Image</th>
                                <th class="thead_cursor_change" scope="col">Code</th>
                                <th class="thead_cursor_change" scope="col">Parent Category</th>
                                <th class="thead_cursor_change" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include(config('template.cmsTemplateBladeURL') . 'modals.choose-categorytree-modal')
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
                /*Action delete comment*/
                $('.btn-delete').click(function() {
                    var mId = $(this).data("id");
                    var mTitle = $(this).data("title");
                    alertify.confirm("<b>Confirm Delete</b></br>Are you sure you want to delete the Product category has name '" + mTitle + "'?", function (ev) {
                        ev.preventDefault();
                        $.ajax({
                            url : "{!! route('product-categories.delete') !!}",
                            method: "GET",
                            data: { id : mId }
                        }).done(function(response) {
                            if(response.status == 'success') {
                                alertify.success(response.msg);
                                location.reload();

                            }else if(response.status == 'error') {
                                alertify.error(response.msg);
                                // location.reload(); 
                            }
                        });
                    }, function(ev) {
                        ev.preventDefault();
                    });
                });
                /*Action End sdelete comment*/
            },
            ajax: "{{ route('product-categories.load-ajax') }}",
            columns: [
                { data: 'name'},
                { data: 'image',bSortable: false},
                { data: 'code'},
                { data: 'category_name', bSortable: false},
                { data: 'action', bSortable: false},
            ],
        });
    });
</script>
@endsection
@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-1">Accessory Statistics</h4>
                <div class="row">
                    <div class="col-md-3">
                    <strong>Quick selection</strong>
                    <select id="select-quick" class="form-control populate placeholder" >
                            <option>Choose</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="lastweek">Last week</option>
                            <option value="lastmonth">Last month</option>
                    </select>
                    </div>
                    <div class="col-md-9">
                    <strong>Search</strong>
                    <div class="input-group row">
                        <div class="form-group col-md-4 row">
                            <label for="input-from-date" class="col-md-3">From</label>
                             <input class="form-control col-md-8" type="date"  id="input-from-date">
                        </div>
                        <div class="form-group col-md-4 row">
                            <label for="input-to-date" class="col-md-3">To</label>
                            <input class="form-control col-md-8" type="date" id="input-to-date">
                        </div>
                        <div class="form-group col-md-4">
                            <button id="search" type="button" class="btn btn-outline-primary" >Check</button>
                        </div>
                        
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table-categorys" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Parent Category</th>
                                <th scope="col">Category</th>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity in stock</th>
                                <th scope="col">Input</th>
                                <th scope="col">Sale</th>
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
    });

    $("#select-quick").change(function(){
        var quick_select = $(this).val();
        var token = "{{ csrf_token() }}";
        $.ajax({
            url : "{!! route('statistic.create-quick-accessories') !!}",
            method: "POST",
            data: { _token:token, quick_select : quick_select }
        }).done(function(response) {
            if (response.status == "ok") {
                $('#table-categorys').DataTable().destroy();
                $('#table-categorys').DataTable({
                    data: response.data,
                    columns: [
                        { data: 'parent_category_name'},
                        { data: 'category_name'},
                        { data: 'accessory_code'},
                        { data: 'name'},
                        { data: 'quantity_in_stock'},
                        { data: 'input_quantity'},
                        { data: 'sale'},
                    ],
                });
            }
        });
    });

    $("#search").click(function(){
        var fromDate = $("#input-from-date").val();
        var toDate   = $("#input-to-date").val();
        var token = "{{ csrf_token() }}";
        //console.log("from:"+fromDate+" to:"+toDate);
        $.ajax({
            url : "{!! route('statistic.create-quick-accessories') !!}",
            method: "POST",
            data: { _token:token, fromDate : fromDate, toDate:toDate }
        }).done(function(response) {
            if (response.status == "ok") {
                $('#table-categorys').DataTable().destroy();
                $('#table-categorys').DataTable({
                    data: response.data,
                    columns: [
                        { data: 'parent_category_name'},
                        { data: 'category_name'},
                        { data: 'accessory_code'},
                        { data: 'name'},
                        { data: 'quantity_in_stock'},
                        { data: 'input_quantity'},
                        { data: 'sale'},
                    ],
                });
            }
        });
    });
</script>

@endsection
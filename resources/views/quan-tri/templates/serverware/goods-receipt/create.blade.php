@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('goods-receipt.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="supplier">Supplier code</label>
                                    <select  class="form-control" id="supplier-code" name="supplier_id" required>
                                      @foreach($suppliers as $supplier)
                                      <option @if($loop->first) selected="selected" @endif id="{{ $supplier->id }}" value="{{ $supplier->id }}" > {{ $supplier->supplier_code }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="supplier">Supplier name</label>
                                    <div id="supplier-name">
                                      @foreach($suppliers as $supplier)
                                      @if($loop->first) {{ $supplier->name  }} 
                                      @break
                                      @endif 
                                      @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="supplier">Supplier phone</label>
                                    <div id="supplier-phone">
                                      @foreach($suppliers as $supplier)
                                      @if($loop->first) {{ $supplier->telephone  }} 
                                      @break
                                      @endif 
                                      @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Input date <span class="required">*</span></label>
                            <input type="date" class="form-control" name="input_date" value="{!! date('Y-m-d') !!}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Receipt code<span class="required">*</span></label>
                            <input type="text"  class="form-control" name="goods_receipt_code" value="@php echo 'MPL'.time();@endphp">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-12" >
                            <label for="address" >Goods <span class="required">*</span></label>
                        <table  class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="load-item">
                                
                            </tbody>
                        </table>
                        </div>
                        <div class="form-group col-md-12" >
                        <button id="btn-add-accessory" type="button" class="btn btn-success waves-effect waves-light mb-4 choose-categorytree col-md-2"><i class="fas fa-plus-square"></i> Add</button>
                        </div>
                    </div>
                    <div class="form-group">
                       
                        <table class="table">
                            <thead class="thead-light">
                                <tr >
                                    <th  scope="col">total price goods</th>
                                    <th scope="col">Shipping fee:</th>
                                    <th scope="col">total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-success">
                                    <td id="total_price_goods_format">
                                        0
                                    </td>
                                    <td> 
                                       <input type="hidden" name="total_price_goods" value="0">
                                       <p style="display: none;" id="total_price_goods"></p>
                                      
                                       <input id="shipping_fee" onchange="change_money()" style="width: 100px; height: 20px" type="text" name="shipping_fee" value=""  class="form-control" required />
                                       <input type="hidden" name="total_money" value="0">
                                    </td>
                                    <td id="total_money">
                                        0
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label>Note <span class="required">*</span></label>
                        <textarea name="note" id="long_description"  class="form-control" rows="7" cols="70"></textarea>
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


        </div>
    </div>
</form>

<form id="form-new-config">
<div id="find-accessory-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Search Accessory</h5>
                    <input id="myRowConfigModal" type="hidden" >
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="table-accessories">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" id="btn-cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
            </div>
    </div>
</div>
</form>

@endsection

@section('page-css')
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/alertify/js/alertify.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/pages/alertify-init.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('page-custom-js')
<script type="text/javascript">
      // Create our number formatter.
    var formatter = new Intl.NumberFormat('en-US', {
          style: 'currency',
          currency: 'USD',

          // These options are needed to round to whole numbers if that's what you want.
          //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
          //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
    });
    $(document).ready(function() {
        $('form').parsley({
            excluded: 'input[type=button], input[type=submit], input[type=reset]',
            inputs: 'input, textarea, select, input[type=hidden], :hidden',
        });

        // disabled input slug name
        $("#supplier-code").change(function(index,value){
            var id = $(this).val();
             $.ajax({
                        url : "{!! route('goods-receipt.get-supplier-code') !!}",
                        method: "GET",
                        data: { id : id }
                    }).done(function(response) {
                        var supplier = response.supplier;
                        $("#supplier-name").html(supplier.name);
                        $("#supplier-phone").html(supplier.telephone);
                    });
           
        });
    });
    
    $('#btn-add-accessory').click(function() {
        //var configName = $(this).children('p').text();
       // $("#myLargeModalLabel").html(configName) ;
        //$("#myRowConfigModal").val(this.id);
        $("#find-accessory-modal").modal({
            backdrop: 'static',
            keyboard: true,
            show: true
        });
    });
    
    $('#table-accessories').DataTable({
        processing: true,
        serverSide: true,
        drawCallback:function() {
            /*Action delete comment*/
            $('.btn-delete').click(function() {
                var mId = $(this).data("id");
                var mTitle = $(this).data("title");
                alertify.confirm("Are you sure to delete comment '" + mTitle + "'?", function (ev) {
                    ev.preventDefault();
                    $.ajax({
                        url : "{!! route('accessory.delete') !!}",
                        method: "GET",
                        data: { id : mId }
                    }).done(function(response) {
                        alertify.success(response.msg);
                        location.reload();
                    });
                }, function(ev) {
                    ev.preventDefault();
                });
            });
            /*Action End sdelete comment*/
        },
        ajax: "{{ route('accessory.load-ajax') }}",
        columns: [
            { data: 'accessory_code'},
            { data: 'name'},
            { data: 'format_price',bSortable: false},
            { data: 'add',bSortable: false},
        ],
    });

    var id_item = 0;
    var arr_check = new Array();
    var arr_accessories = new Array();
    function addItem (idAccessory){
        var token = "{{ csrf_token() }}";
        var id    = idAccessory;
        $.ajax({
            url : "{!! route('goods-receipt.get-accessory') !!}",
            method: "POST",
            data: {_token:token,id : id }
        }).done(function(response) {
            var formatter = new Intl.NumberFormat('en-US', {
              style: 'currency',
              currency: 'USD',

              // These options are needed to round to whole numbers if that's what you want.
              //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
              //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
            });
            var accessory = response.accessory;
            if (id_item > 0 ) {
                if (arr_check.indexOf(accessory.id) >= 0 ){
                    alertify.error('already exist this accesory!');
                }else {
                    var item = '<tr id="row-item-'+id_item+'">'
                        +'<td>'+accessory.accessory_code +'</td>'
                        +'<td>'+accessory.name+'</td>'
                        +'<td>'+formatter.format(accessory.price)+'</td>'
                        +'<td>'
                        +'<input id="'+accessory.id+'" style="width: 75px;" type="number" name="accessories['+accessory.id+']" value="1" min="1" class="input-qty" />'
                        +'</td>'
                        +'<td>'
                        +'<a class="del-row-item" onclick="del_row_item('+id_item+','+accessory.id+');"><i class="fas fa-trash-alt"></i></a>'
                        +'</td>'
                        +'</tr>';
                    $('#load-item').append(item);
                    var acessItem = {
                        'id'   : accessory.id,
                        'name' : accessory.name,
                        'price': accessory.price,
                        'qty'  : 1,
                        'index':id_item
                    };
                    arr_accessories.push(acessItem);
                    arr_check.push(accessory.id);
                    id_item++;
                     //tính total price all accessory
                    var total_price = 0;
                    $.each(arr_accessories, function(index,value){
                       total_price = total_price +Number(value.price) * (value.qty);
                    });
                    $("#total_price_goods").text(total_price);
                    $("#total_price_goods_format").text(formatter.format(total_price));
                    var shipping_fee = $("#shipping_fee").val();
                    var total_price_goods = $("#total_price_goods").text();
                    var total_money = Number(total_price_goods) + Number(shipping_fee);
                    $("#total_money").text(formatter.format(total_money));
                    $("input[name=total_price_goods]").val(total_price_goods);
                    $("input[name=total_money]").val(total_money);
                }
            }
            else {
                var item = '<tr id="row-item-'+id_item+'">'
                        +'<td>'+accessory.accessory_code+'</td>'
                        +'<td>'+accessory.name+'</td>'
                        +'<td>'+formatter.format(accessory.price)+'</td>'
                        +'<td>'
                        +'<input id="'+accessory.id+'" style="width: 75px;" type="number" name="accessories['+accessory.id+']" value="1" min="1" class="input-qty"/>'
                        +'</td>'
                        +'<td>'
                        +'<a class="del-row-item" onclick="del_row_item('+id_item+','+accessory.id+');"><i class="fas fa-trash-alt"></i></a>'
                        +'</td>'
                        +'</tr>';
                    $('#load-item').append(item);
                    var acessItem = {
                        'id'   : accessory.id,
                        'name' : accessory.name,
                        'price': accessory.price,
                        'qty'  : 1,
                        'index':id_item
                    };
                    arr_accessories.push(acessItem);
                    arr_check.push(accessory.id);
                    id_item++;
                     //tính total price all accessory
                    var total_price = 0;
                    $.each(arr_accessories, function(index,value){
                       total_price = total_price +Number(value.price) * (value.qty);
                    });
                    $("#total_price_goods").text(total_price);
                    $("#total_price_goods_format").text(formatter.format(total_price));
                    var shipping_fee = $("#shipping_fee").val();
                    var total_price_goods = $("#total_price_goods").text();
                    var total_money = Number(total_price_goods) + Number(shipping_fee);
                    $("#total_money").text(formatter.format(total_money));
                    $("input[name=total_price_goods]").val(total_price_goods);
                    $("input[name=total_money]").val(total_money);  
            }
            $(".input-qty").change(function(){
                var idAccessory = this.id;
                var qty         = $(this).val();
                function isID(item) {
                    return item.id == idAccessory;
                };
                var accessory = arr_accessories.find(isID);
                accessory.qty = qty;
                
                //tính total price all accessory
                var total_price = 0;
                $.each(arr_accessories, function(index,value){
                   total_price = total_price +Number(value.price) * (value.qty);
                });
                $("#total_price_goods").text(total_price);
                $("#total_price_goods_format").text(formatter.format(total_price));
                var shipping_fee = $("#shipping_fee").val();
                var total_price_goods = $("#total_price_goods").text();
                var total_money = Number(total_price_goods) + Number(shipping_fee);
                $("#total_money").text(formatter.format(total_money));
                $("input[name=total_price_goods]").val(total_price_goods);
                $("input[name=total_money]").val(total_money);
            });

            $("#find-accessory-modal").modal("hide");     
        });
       
    }

    function del_row_item(idRow, idAccessory){
        var del1 = arr_check.indexOf(idAccessory);
        function isID(item) {
            return item.id == idAccessory;
        };
        var accessory  = arr_accessories.find(isID);
        var del2 = accessory.index;
        if (del1 > -1) {
           arr_check.splice(del1, 1);
          
        };
        if (del2 > -1) {
            arr_accessories.splice(del2, 1);
        }
        var total_price = 0;
        if(arr_accessories.length > 0){
            $.each(arr_accessories, function(index,value){
           total_price = total_price +Number(value.price) * (value.qty);
            });
            $("#total_price_goods").text(total_price);
            $("#total_price_goods_format").text(formatter.format(total_price));
            var shipping_fee = $("#shipping_fee").val();
            var total_price_goods = $("#total_price_goods").text();
            var total_money = Number(total_price_goods) + Number(shipping_fee);
           
            $("#total_money").text(formatter.format(total_money));
            $("input[name=total_price_goods]").val(formatter.format(total_price_goods));
            $("input[name=total_money]").val(formatter.format(total_money));
        }
        else {
            $("#total_price_goods_format").text(formatter.format(0));
            var total_price_goods = $("#total_price_goods").text(0);
            var shipping_fee = $("#shipping_fee").val();
            var total_price_goods = $("#total_price_goods").text();
            var total_money = Number(total_price_goods) + Number(shipping_fee);
            
            $("#total_money").text(formatter.format(total_money));
            $("input[name=total_price_goods]").val(total_price_goods);
            $("input[name=total_money]").val(total_money);
        }
        $("#row-item-"+idRow).remove();
    }
    function change_money(){
        var shipping_fee = $("#shipping_fee").val();
        var total_price_goods = $("#total_price_goods").text();
        var total_money = Number(total_price_goods) + Number(shipping_fee);
        $("#total_money").text(formatter.format(total_money));
        $("input[name=total_price_goods]").val(total_price_goods);
        $("input[name=total_money]").val(total_money);
    }
</script>

@endsection
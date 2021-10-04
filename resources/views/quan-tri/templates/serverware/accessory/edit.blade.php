@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
<form action="{{ route('accessory.update', ['id' => $accessory->id]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card m-b-30">
                <div class="card-body">
                <div id="div-accessory-category" class="form-group">
                    <label for="accessory_category_id">Accesory's Category</span></label>
                    <select name="category_id" id="category_id" class="js-example-basic" required>
                    @if(!empty($accessoryCategories))
                      {{ productCategories($accessoryCategories,$accessory->category_id)}}
                    @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Code <span class="required">*</span></label>
                    <input type="text" name="accessory_code" id="accessory_code" class="form-control{{ ($errors->has('accessory_code') ? " form-error" : "") }}" value="{{ $accessory->accessory_code }}" required placeholder="Name of Accessory "/>
                    @if($errors->has('accessory_code'))
                    <p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('accessory_code') }}</p>
                    @endif 
                </div>
                <div class="form-group">
                    <label>Name <span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $accessory->name }}" required placeholder="Name of Accessory " maxlength="191"/>
                </div>
                <div class="form-group">
                    <label>Slug </label>
                    <div class="row">
                        <div class="col-12">
                            <span class="font-13 text-muted">{{ config('app.url') }}/blog/</span>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ $accessory->slug }}" required placeholder="slug-of-accessory"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Price <span class="required">*</span></label>
                    <input type="text" name="price"  class="form-control" required value="{{ $accessory->price }}" placeholder="Price of Accessory "/>
                </div>
                <div class="form-group">
                    <label>Attribute<span class="required">*</span></label>
                    <ul id="list-configuration" class="list-group">
                        <li id="li-config-row-0" class="list-group-item" >
                            <div class="thumb">
                                <a id="config-row-0" class="choose-config config-row-0">
                                    <p style="display: none">Attribute group </p>
                                    <i class="fas fa-cog" >
                                    </i>
                                </a>
                            </div>
                            <div id="list-item">
                                @php
                                    $attributes = json_decode($accessory->attributes);
                                @endphp
                                @isset($attributes)
                                <table class="spec_tab_full_item">
                                    <tbody class="testTbody">
                                        @foreach($attributes as $attribute)
                                            <tr>
                                                <td class="active" style="" colspan="2">{{ $attribute->name }}</td>
                                            </tr>
                                            @foreach($attribute->item as $item)
                                            <tr style="page-break-inside: auto;">
                                                <td class="leftHead">{{ $item->property }}</td>
                                                <td class="rightHead">{{ $item->parameter }}</td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                @endisset($attributes)
                                <input type="hidden" name="attributes" value="{{ $accessory->attributes }}">
                            </div>
                        </li>
                    </ul>
                </div>
                <!--end load table-->
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
        @include(config('template.cmsTemplateBladeURL') . 'accessory.cover-image.edit')
    </div>
</div>
</form>
@include(config('template.cmsTemplateBladeURL') . 'modals.config-product-modal')
@endsection

@section('page-css')
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.css') }}
" rel="stylesheet" />
<link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/custom-cms-accessory.css') }}" rel="stylesheet" />
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
        $('form').parsley({
            excluded: 'input[type=button], input[type=submit], input[type=reset]',
            inputs: 'input, textarea, select, input[type=hidden], :hidden',
        });
        $('.js-example-basic').select2({
          width: '100%'
        });
    });
    $("#product_category_id").change(function(){
        var product_category_id = $(this).val();
        var token = "{{ csrf_token() }}";
        $("#load-select-accessory-category").hide();
        $.ajax({
            url : "{!! route('accessory-category.load-select-accessory-category') !!}",
            method: "POST",
            data: { _token:token, product_category_id:product_category_id}
        }).done(function(response) {
            var render = '';
            if (response.option) {
                render = '<div class="form-group"><select name="category_id" id="category_id" class="form-control"><option value="">choose...</option>'+
                response.option+
                '</select></div>';        
                $("#load-select-accessory-category").html(render);  
                $("#load-select-accessory-category").show();
            }
            else {
                render = '<div class="form-group"><p>The product category is not accessory category </p></div>';
                $("#load-select-accessory-category").html(render);  
                $("#load-select-accessory-category").show();
                $("#checked-category").val("");
            };
            $("#category_id").change(function(){
                var check = $(this).val();
                $("#checked-category").val(check);
            });
        });
    });
    @include(config('template.cmsTemplateBladeURL') . 'accessory.cover-image.js');
    var id_group = 0;
    var total_group = 0;
    var arr_group_del = new Array();
    var id_item = 0;

    function addItem(id_group) {
        var item =   '<div id="row-item-'+id_item+'" class="row" >'
        + '<div class="col-md-7">'
        + '<div class="form-group">'
        + '<label>Property</label>'
        + '<input  type="text" name="item_property[]" class="form-control">'  
        + '</div>'
        + '</div>'
        + '<div class="col-md-4">'
        + '<div class="form-group">'
        + '<label>Parameter</label>'
        + '<input  type="text" name="item_parameter[]" class="form-control">'
        + '</div>'
        + '</div>'
        + '<a class="del-row-item" onclick="del_row_item('+id_item+');"><i class="fas fa-trash-alt"></i></a>'
        + '</div>';
        $('#group-config-row-'+id_group+'-modal #load-item').append(item);
        id_item++;
    }

    $("#btn-add-group-cofig").click(function(){
        var group =  '<div id="group-config-row-'+id_group+'-modal" class="row fix-config-group">'
        +'<div  class="col-md-12">'
        +'<a  class="del-row-group-config" onclick="del_row_group('+id_group+');">X</a>'
        +'</div>'
        +'<div class="col-md-6">'
        +'<div class="form-group">'
        +'<label>Attribute name</label>'
        +'<input id="name-group-'+id_group+'" type="text" name="name_group_'+id_group+'" class="form-control">'   
        +'</div>'
        +'</div>'
        +'<div id="load-item" class="col-md-12">'
        +'</div>'
        +'<button type="button" class="btn btn-primary" id="btn-add-item-group-cofig" onclick="addItem('+id_group+');">'
        +'add item' 
        +'</button>'
        +'</div>';
        $('#my-group').append(group);
        console.log("hien tai"+id_group);
        id_group++;
        console.log("hien tai"+id_group);
        total_group++;
    });

    function del_row_item(id){
        $("#row-item-"+id).remove();
    }

    function del_row_group(id){
        $("#group-config-row-"+id+"-modal").remove();
        arr_group_del.push(id);
        console.log(arr_group_del);
    }
    
    $('.choose-config').click(function() {
        $('#my-group').children().remove();
        id_group = 0;
        total_group = 0;
        arr_group_del = new Array();
        id_item = 0;
        var configName = $(this).children('p').text();
        $("#myLargeModalLabel").html(configName) ;
        $("#myRowConfigModal").val(this.id);
        $("#config-product-modal").modal({
            backdrop: 'static',
            keyboard: true,
            show: true
        });
        var attributes = JSON.parse($("input[name='attributes']").val());
        for (var i = 0; i < attributes.length; i++){
            var group =  '<div id="group-config-row-'+id_group+'-modal" class="row fix-config-group">'
            +'<div  class="col-md-12">'
            +'<a  class="del-row-group-config" onclick="del_row_group('+id_group+');">X</a>'
            +'</div>'
            +'<div class="col-md-6">'
            +'<div class="form-group">'
            +'<label>Attribute name</label>'
            +'<input id="name-group-'+id_group+'" type="text" name="name_group_'+id_group+'" value="'+attributes[i].name+'" class="form-control">'   
            +'</div>'
            +'</div>'

            +'<div id="load-item" class="col-md-12">'
            +'</div>'
            +'<button type="button" class="btn btn-primary" id="btn-add-item-group-cofig" onclick="addItem('+id_group+');">'
            +'add item' 
            +'</button>'
            +'</div>';
            $('#my-group').append(group);

            var arr_item = attributes[i].item;

            for (var j = 0; j < arr_item.length; j++){
                var item =   '<div id="row-item-'+id_item+'" class="row" >'
                + '<div class="col-md-7">'
                + '<div class="form-group">'
                + '<label>Property</label>'
                + '<input  type="text" name="item_property[]" class="form-control" value="'+arr_item[j].property+'">'  
                + '</div>'
                + '</div>'
                + '<div class="col-md-4">'
                + '<div class="form-group">'
                + '<label>Parameter</label>'
                + '<input  type="text" name="item_parameter[]" class="form-control" value="'+arr_item[j].parameter+'">'
                + '</div>'
                + '</div>'
                + '<a class="del-row-item" onclick="del_row_item('+id_item+');"><i class="fas fa-trash-alt"></i></a>'
                + '</div>';
                $('#group-config-row-'+id_group+'-modal #load-item').append(item);
                id_item++;
            }
            id_group++;
            total_group++;
        }
        //console.log("total-group: "+total_group+"id_group: "+id_group+ "id_item: "+id_item);
    });

    $("#btn-accept-config").click(function(){
        var id = $("#myRowConfigModal").val();
        $("#li-"+id+" #list-item").children().remove();
        var group;
        var arr_group = new Array();
        var html = "";
        //console.log("total-group: "+total_group+"id_group: "+id_group+ "id_item: "+id_item);
        for (var i = 0; i < total_group; i++){
            if (arr_group_del.length>0) {
                for (var k = 0; k < arr_group_del.length; k++){
                    if (arr_group_del[k] != i) {
                        var html_group = "";
                        var html_item  = "";
                        var arr_item = new Array();
                        var arr_property = new Array();
                        var arr_parameter = new Array();
                        var group_name  = $("input#name-group-"+i).val();
                        $("#group-config-row-"+i+"-modal .col-md-12 input[name='item_property[]']").each(function () {
                            arr_property.push($(this).val());  
                        });
                        $("#group-config-row-"+i+"-modal .col-md-12 input[name='item_parameter[]']").each(function () {
                            arr_parameter.push($(this).val());
                        });
                        
                        for (var j = 0; j <arr_property.length; j++) {
                            item = {
                                "property": arr_property[j],
                                "parameter": arr_parameter[j]
                            };
                            arr_item.push(item);
                            html_item += '<tr style="page-break-inside: auto;"><td class="leftHead">'
                            +arr_property[j]
                            +'</td>'
                            +'<td class="rightHead">'
                            +arr_parameter[j]
                            +'</td></tr>';
                        }
                        group = {
                          "name" :group_name,
                          "item" :arr_item
                        };
                        html_group =  '<table class="spec_tab_full_item col-md-12"><tbody><tr>'
                                    +'<td class="active" colspan="2">'+group_name+'</td>'
                                    +'</tr>'
                                    +html_item
                                    +'</tbody></table>';
                        html+=html_group;
                        arr_group.push(group);
                    }
                } 
            }
            else {
                var html_group = "";
                var html_item  = "";
                var arr_item = new Array();
                var arr_property = new Array();
                var arr_parameter = new Array();
                var group_name  = $("input#name-group-"+i).val();

                $("#group-config-row-"+i+"-modal .col-md-12 input[name='item_property[]']").each(function () {
                    arr_property.push($(this).val());  
                });
                $("#group-config-row-"+i+"-modal .col-md-12 input[name='item_parameter[]']").each(function () {
                    arr_parameter.push($(this).val());
                });

                for (var j = 0; j <arr_property.length; j++) {
                    item = {
                        "property": arr_property[j],
                        "parameter": arr_parameter[j]
                    };
                    arr_item.push(item);
                    html_item +=  '<tr style="page-break-inside: auto;"><td class="leftHead">'
                    +arr_property[j]
                    +'</td>'
                    +'<td class="rightHead">'
                    +arr_parameter[j]
                    +'</td></tr>';          
                }
                group = {
                  "name" :group_name,
                  "item" :arr_item
                };
                html_group =  '<table class="spec_tab_full_item col-md-12"><tbody><tr>'
                        +'<td class="active" colspan="2">'+group_name+'</td>'
                        +'</tr>'
                        +html_item
                        +'</tbody></table>';
                html+=html_group;
                arr_group.push(group);
            }
        }
        $("#li-"+id+" #list-item").append(html);
        $("#li-"+id+"  #list-item").append("<input type='hidden' name='attributes' value='"+JSON.stringify(arr_group)+"' >");
        $("#config-product-modal").modal("hide");
    });

    $('#name').blur(function() {
        $('#slug').val(slugify($('#name').val()));
    });

    $(".form-error").click(function() {
        $(this).removeClass('form-error');
        $("p").remove(".vali-error");
    });
</script>
@endsection
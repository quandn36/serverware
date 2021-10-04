function changed_item($idParent,$idChil,$idAccessory,$priceAccessory,$priceDefault,$url, checkbox = false){
    $("#"+$idParent+" .right_image img").attr("src",$url);
    if (checkbox == false) {
        $("#"+$idParent+" .item").removeClass("item_selected");
        $("#"+$idParent+" #"+$idChil).addClass("item_selected");
    }
    $("#"+$idParent+" select").removeClass("displayBlock");
    console.log("#"+$idParent+" #"+$idChil+" #"+$idAccessory+" #select-"+$idAccessory);
    $("#"+$idParent+" #"+$idAccessory+" #select-"+$idAccessory).addClass("displayBlock");
    var arr_quantity = new Array();
    var arr_price    = new Array();
    var total_price_config  = 0;
    var total_selected = $("#load-accessory-category .item_selected select").each(function (index, select) {
         arr_quantity.push(Number(select.value));
    });
    var total_selected = $("#load-accessory-category .item_selected span.price_default").each(function (index, span) {
         arr_price.push(Number(span.textContent));
    });
    for (var i = 0; i < arr_price.length; i++) {
        total_price_config += arr_quantity[i]*arr_price[i];
    };
    var price_product = Number($("#price_product").val());
    var total_price   = price_product+total_price_config;
    $("#total_price").val(total_price.toFixed(2));
    $("#total_price_config").val(total_price_config);
    $("#total_price_custom").val(formatter.format(total_price));
}

$('.item input').click(function (){
    var idAccessory = $(this).val(); //46
    var idChil      = $(this).parents().eq(0).attr("id"); //
    var idChilDiv   = $(this).parents().eq(1).attr("id"); //
    var idParent    = $(this).parents().eq(4).attr("id"); //change-configurator-38
    var priceAccessory = $("#"+idChilDiv+" #"+idAccessory+" span").text(); //53234
    console.log(" idAccessory: "+idAccessory+" idChil:"+idChil+" idChilDiv:"+idChilDiv);
    var nameAccessory  = $("#"+idChilDiv+" #"+idAccessory+" label").text();
    var priceDefault   = $("#"+idParent+" span.price_default").text();
    var urlImage = $("#"+idChilDiv+" #"+idAccessory+" img").attr("src");
    $("#"+idParent+" span").removeClass("price_default");
    $("#"+idChilDiv+" #"+idAccessory+" span").addClass("price_default");
    changed_item(idParent, idChil, idAccessory, priceAccessory, priceDefault, urlImage);
});

var array_check_limit = new Array();
$('.item select').change(function (){
    var idParent    = $(this).parents().eq(4).attr("id");
    var idChil = $(this).parents().eq(1).attr("id");
    var idAccessory = $(this).parents().eq(0).attr("id");
    $(this).parent().addClass("item_selected");
    $("#"+idChil+" span").addClass("price_default");
    var typeSelect  = $("#"+idParent+" p.type-select").attr("id");
    console.log(typeSelect);
    var limit  = $("#"+idParent+" p.type-select").text();
    if ($("#"+idAccessory+" input").attr("type") == "checkbox" &&  Number($(this).val()) > 0 )  {
        $("#"+idAccessory+" input").attr("checked", "checked");
    }
    if($("#"+idAccessory+" input").attr("type") == "checkbox" &&  Number($(this).val()) == 0) {
        $("#"+idAccessory+" input").removeAttr('checked');
        //$("#"+idChil+" span").removeClass("price_default");
        console.log($(this).val());
        $(this).parent().removeClass("item_selected");
    }
    //type_selects = ['Radio', 'Radio-limit', 'Select-limit', 'checked'];
    if (typeSelect == "Select-limit") {
        var limit_selected = $(this).val();
        var reset_limit = limit-limit_selected;
        var newOption = '';
        $(this).removeClass('displayBlock');
        $(this).addClass('selected');
        $("#"+idParent+" select.displayBlock").children().remove();
        for (var i = 0; i <= reset_limit; i++) {
           newOption += '<option value="'+i+'">'+i+'</option>';
        }
        $("#"+idParent+" select.displayBlock").html(newOption);
        // có 2 thẻ select class="selected"
        console.log(idParent);
        if ($("#"+idParent+" select.selected").length > 1) {
            var limit_selected = 0;
            var reset_limit    = 0;
            $("#"+idParent+" select.selected").each(function (index, select) {
                 limit_selected += Number(select.value);
            });
            reset_limit = limit-limit_selected;
            // ____reset option select non-selected____
            $("#"+idParent+" select.displayBlock").children().remove();
            var newOption = '';
            for (var i = 0; i <= reset_limit; i++) {
                newOption += '<option value="'+i+'">'+i+'</option>';
            }
            $("#"+idParent+" select.displayBlock").html(newOption);
        };
        //____reset option selected____ 
        //limit       = 12
        //reset_limit = 4
        //limit_selected = 7
        $("#"+idParent+" select.selected").each(function (index, select) {
            //select.value = 3
            var optionSelected = limit - (limit_selected - select.value) ;
            var newOption = '';
            for (var i = 0; i <= optionSelected; i++) {
                if(select.value == i){
                    newOption += '<option value="'+i+'" selected>'+select.value+'</option>';
                }
                else {
                    newOption += '<option value="'+i+'">'+i+'</option>';
                };
            };
            $("#"+select.id).html(newOption);
        });  
    }
    var arr_quantity = new Array();
    var arr_price    = new Array();
    var total_selected = $("#load-accessory-category .item_selected select").each(function (index, select) {
         arr_quantity.push(Number(select.value));
    });
    var total_selected = $("#load-accessory-category .item_selected span.price_default").each(function (index, span) {
         arr_price.push(Number(span.textContent));
    });
    var total_price_config = 0;
    for (var i = 0; i < arr_price.length; i++) {
        total_price_config = total_price_config + (arr_quantity[i]*arr_price[i]);
    };
    var price_product = Number($("#price_product").val());
    var total_price   = price_product+total_price_config;
    $("#total_price").val(total_price.toFixed(2));
    $("#total_price_config").val(total_price_config);
    $("#total_price_custom").val(formatter.format(total_price));

});

$('.item input').mouseover(function(){
    var idParent    = $(this).parents().eq(4).attr("id");
    var idChil      = $(this).parents().eq(1).attr("id");
    var idAccessory = $(this).val();
    var urlImage = $("#"+idChil+" #"+idAccessory+" img").attr("src");
    $("#"+idParent+" .right_image img").attr("src",urlImage);
});

$(".item .input-checked").on('click', function() {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    var idAccessory = $(this).val(); //46
    var idChil      = $(this).parents().eq(1).attr("id"); //div-item-40
    var idParent    = $(this).parents().eq(4).attr("id"); //change-configurator-38
    var priceAccessory = $("#"+idChil+" #"+idAccessory+" span").text(); //53234
    var priceDefault   = $("#"+idParent+" span.price_default").text();
    var urlImage = $("#"+idChil+" #"+idAccessory+" img").attr("src");
    if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
       $box.prop("checked", true);
       $("#"+idParent+" #"+idChil+" #"+idAccessory).addClass("item_selected");
       $("#"+idChil+" #"+idAccessory+" span").addClass("price_default");
       changed_item(idParent, idChil, idAccessory, priceAccessory, priceDefault, urlImage, true);
    } else {
        $box.prop("checked", false);
        $("#"+idParent+" #"+idChil+" #"+idAccessory).removeClass("item_selected");
        $("#"+idChil+" #"+idAccessory+" span").removeClass("price_default");
        changed_item(idParent, idChil, idAccessory, priceAccessory, priceDefault, urlImage, true);
    }
    
});
/*function reset_pic($setImageCategory){
    console.log($image);
    $("#change_pic_"+$id).attr("src",$url);
}*/
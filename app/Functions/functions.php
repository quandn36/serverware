<?php
use App\Models\Accessory;
function categoryRecursive($data, $parent=0, $str="", $select=0){
	foreach($data as $val){
    	$id 	  = $val['id'];
    	$name 	  = $val['name'];
    	$parentId = $select;
		if ($val['parent_category_id'] == $parent){
			if($select > 0){
				if( $select == $id) {
					echo "<option data-id='$parent' id='_sub_category' data-value='$parent' class='_sub_category' selected='selected' value='$id'>$str $name </option>";
				}else {
					echo "<option data-id='$parent' id='_sub_category' data-value='$parent' class='_sub_category' value='$id' > $str $name</option>";
				}
			}
            else{
				echo "<option data-id='$parent' id='_sub_category' data-value='$parent' class='_sub_category' value='$id'> $str $name</option>";
			}
			categoryRecursive($data,$id, $str."&emsp;&emsp;",$parentId);
		}
	}
}

function productCategories($data, $selected = null, $ajax = false){
    $html = '';
    foreach($data as $productParentCate){
        $html .= '<optgroup label="'.$productParentCate['name'].'">';
        if ($productParentCate->childrenCategories->isNotEmpty()){
            foreach ($productParentCate->childrenCategories as $category) {
               if ($selected != null) {
                    if (!is_array($selected)) {
                        if ($category['id'] == $selected) {
                            $html.= '<option selected  value="'.$category['id'].'"> '.$category['name'].' </option>'; 
                        }
                        else {
                            $html.= '<option  value="'.$category['id'].'"> '.$category['name'].' </option>';
                        }
                        
                    }
                    else {
                        if (in_array($category['id'], $selected)) {
                        $html.= '<option selected  value="'.$category['id'].'"> '.$category['name'].' </option>';  
                        }
                        else {
                            $html.= '<option  value="'.$category['id'].'"> '.$category['name'].' </option>';
                        }
                    }
                }
                else {
                    $html.= '<option id="cate-'.$category['id'].'" value="'.$category['id'].'"> '.$category['name'].' </option>';
                }

            }
        }
        $html.= '</optgroup>';
    }
    if ($ajax) { return $html;} else{ echo $html;}
}

//Load HTML  AccessoriesProduct __Cre:Tin//
function loadAjaxOptionCategory($data, $parent=0, $str="", $select=0){
    $html = '';
    foreach($data as $val){
        $id       = $val['id'];
        $name     = $val['name'];
        $parentId = $select;
        if ($val['parent_category_id'] == $parent){
            if($select > 0){
                if( $select == $id) {
                    $html.= '<option value="'.$id.'" selected="selected" >'.$str.$name.'</option>';
                }else {
                    $html.= '<option value="'.$id.'" >'.$str.$name.'</option>';
                }
            }else{
                $html.= '<option value="'.$id.'" >'.$str.$name.'</option>';
            }
            $html.= loadAjaxOptionCategory($data,$id, $str."&emsp;&emsp;",$parentId);
        }
    }
    return $html;
}

function loadAccessoriesProduct($data){
    // _____ $data <> table: accessory_categories ____cre:TinTon//
    $total_price_config = 0;
    $html = '';     
    foreach ($data as $category){
        $html.= '<div id="change-configurator-'.$category->id.'">';
        if ($category->type_of_select != null) {
            $type_select = json_decode($category->type_of_select);
            $html.= '<p id="'.$type_select->type.'" style="display:none" class="type-select">'.$type_select->limit.'</p>';
        }
            $html.= '<div class="item_type_holder" >'.
                '<h4 class="new_item_type" >'.
                $category->name.
                '<div class="right_over"><i class="fa fa-cog" aria-hidden="true"></i></div>'.
                '</h4>'.
                '<div class="right">'.
                '<div class="right_image">';

                $cover_image_cate_node = json_decode($category->image);
                if (!empty($cover_image_cate_node->url)){
                    $html.= '<img id="change_pic_'.$category->id.'" src="'.asset($cover_image_cate_node->url).'">';
                }
                else {
                    $html.= '<img id="change_pic_'.$category->id.'" src="'.asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg').'">';
                }
                    
        $html.= '</div>'.
                '</div>'.
                '<div class="holder">'.
                '<div class="configured_icons">'.
                '</div>';
               

                if ($category->childrenCategories->isNotEmpty()) {
                    if ($category->type_of_select != null) {
                        $render = loadChillCateProduct($category->type_of_select,$category->childrenCategories, $total_price_config);
                       $html.= $render['html'];
                       $total_price_config += $render['total_price_config'];
                    };
                    
                }
                else {
                    $html.= '<div class="item"><label>There is no accessory category here</label></div>';
                }
        $html.= '</div></div></div>';
    }
    ;
    $result = [
        'html'=>$html, 
        'total_price_config' => $total_price_config
    ];
    return $result;
}
function loadChillCateProduct($categoryType, $childrenCategories){
    $first = true;
    $html = '';
    $total_price_config = 0;
    foreach ($childrenCategories as $childCategory){

        $html.= '<p class="new_attribute_value">'.
                $childCategory->name.
                '</p>';
            $idNode     = $childCategory->parent_category_id;
            $idChil     = $childCategory->id;
            $accessries = Accessory::where('category_id',$idChil)->get();   
            if($accessries->isNotEmpty()){
                if ($first){
                    $render = loadAccessoryProduct($first, $idNode, $idChil, $accessries, $categoryType);
                    $html.=  $render['html'];
                    $total_price_config += $render['total_price_config'];
                    $first = false;
                }
                else{
                    $render = loadAccessoryProduct($first, $idNode, $idChil, $accessries, $categoryType);
                    $html.=  $render['html'];
                    $total_price_config += $render['total_price_config'];
                };
            }
            else {
                $html.= '<div class="item"><label>There are no accessories in this category</label></div>';
            }
    }
     return ['total_price_config' => $total_price_config, 'html' => $html] ;
}
function loadAccessoryProduct($thefirst, $idNode, $idChil, $accessries, $categoryType) {
    //type_selects = ['Radio', 'Radio-limit', 'Select', 'checked']
    $type_select        = json_decode($categoryType);
    $total_price_config = 0;
    $html               = '';

    if ($type_select->type == 'Radio') {
        if ($thefirst){
            $html.='<div id="div-item-'.$idChil.'">';
            $first = true;
            foreach($accessries as $accessory){
                $cover_image = json_decode($accessory->cover_image);
                $url         = $cover_image->url;
                $urlDefaul   = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
                if ($first){
                    $total_price_config = $total_price_config + $accessory->price;
                    $html.= '<div id="'.$accessory->id.'" class="item item_selected">'.
                        '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'" checked="checked">'. 
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select>'.
                        '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif price_default">'.$accessory->price.'</span>'.
                        '</div>';
                        $first = false;
                }
                else{
                    $html.= '<div id="'.$accessory->id.'" class="item">'.
                        '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'">'. 
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select>'.
                      
                        '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif ">'.$accessory->price.'</span>'.
                        '</div>';
                };
            };
            $html.= '</div>';
        }
        else{
            $html.='<div id="div-item-'.$idChil.'">';                         
            foreach($accessries as $accessory){
                $cover_image = json_decode($accessory->cover_image);
                $url         = $cover_image->url;
                $urlDefaul = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                        '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'">'.
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select>'.
                        '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif">'.$accessory->price.'</span>'.
                        '</div>';
            };
            $html.='</div>'; 
        };
        //end load accessries
    }
    //End load $select == 'Radio'

    if ($type_select->type == 'Radio-limit') {
        if ($thefirst){
            $html.='<div id="div-item-'.$idChil.'">';
            $first = true;
            foreach($accessries as $accessory){
                $cover_image = json_decode($accessory->cover_image);
                $url         = $cover_image->url;
                $urlDefaul   = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
                if ($first){
                    $total_price_config = $total_price_config + $accessory->price;
                    $html.= '<div id="'.$accessory->id.'" class="item item_selected">'.
                        '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'" checked="checked">'. 
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" >';
                    for ($i=1; $i <= $type_select->limit; $i++) { 
                       $html.= '<option value="'.$i.'" >'.$i.'</option>';
                    }
                    $html.= '</select>'.
                    '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif price_default">'.$accessory->price.'</span>'.
                    '</div>';
                    $first = false;
                }
                else{
                    $html.= '<div id="'.$accessory->id.'" class="item">'.
                        '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'">'. 
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone " >';
                    for ($i=1; $i <= $type_select->limit; $i++) { 
                       $html.= '<option value="'.$i.'" >'.$i.'</option>';
                    }
                    $html.= '</select>'.
                  
                    '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif ">'.$accessory->price.'</span>'.
                    '</div>';
                };
            };
            $html.= '</div>';
        }
        else{
            $html.='<div id="div-item-'.$idChil.'">';                
            foreach($accessries as $accessory){
                $cover_image = json_decode($accessory->cover_image);
                $url         = $cover_image->url;
                $urlDefaul = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                        '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'">'.
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'"  onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone">';
                for ($i=1; $i <= $type_select->limit; $i++) { 
                   $html.= '<option value="'.$i.'" >'.$i.'</option>';
                }
                $html.= '</select>'.
                '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif">'.$accessory->price.'</span>'.
                '</div>';
            };
            $html.='</div>'; 
        };
        //end load accessries
    }
    //End load $select == 'Radio-limit'

    if ($type_select->type == 'Select-limit') {
        if ($thefirst){
            $html.='<div id="div-item-'.$idChil.'">';
            $first = true;
            foreach($accessries as $accessory){
                $cover_image = json_decode($accessory->cover_image);
                $url         = $cover_image->url;
                $urlDefaul   = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                    '<img class="displayNone" src="'.$url.'">'.
                    '<input id="input-'.$accessory->id.'" type="checkbox" name="checked['.$idNode.'][]" value="'.$accessory->id.'"  style="display:none!important;" >'.
                    '<select id="select-'.$accessory->id.'" name="changeQuantity['.$accessory->id.']" class="displayBlock" >';
                for ($i=0; $i <= $type_select->limit; $i++) { 
                   $html.= '<option value="'.$i.'" >'.$i.'</option>';
                }
                $html.= '</select>'.
                'x'.
                '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif ">'.$accessory->price.'</span>'.
                '</div>';
                
            };
            $html.= '</div>';
        }
        else{
            $html.='<div id="div-item-'.$idChil.'">';                   
            foreach($accessries as $accessory){
                $cover_image = json_decode($accessory->cover_image);
                $url         = $cover_image->url;
                $urlDefaul = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                        '<img class="displayNone" src="'.$url.'">'.
                        '<input id="input-'.$accessory->id.'" type="checkbox" name="checked['.$idNode.'][]" value="'.$accessory->id.'"  style="display:none!important;" >'.
                        '<select id="select-'.$accessory->id.'" name="changeQuantity['.$accessory->id.']" class="displayBlock" >';
                        for ($i=0; $i <= $type_select->limit; $i++) { 
                           $html.= '<option value="'.$i.'" >'.$i.'</option>';
                        }
                        $html.= '</select>'.
                        'x'.
                        '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif">'.$accessory->price.'</span>'.
                        '</div>';
            };
            $html.='</div>'; 
        };
        //end load accessries
    }
    //endload $select == 'Select'

    if ($type_select->type == 'checked') {
        if ($thefirst){
            $html.='<div id="div-item-'.$idChil.'">';
            $first = true;
            foreach($accessries as $accessory){
                $cover_image = json_decode($accessory->cover_image);
                $url         = $cover_image->url;
                $urlDefaul   = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
                if ($first){
                    $total_price_config = $total_price_config + $accessory->price;
                    $html.= '<div id="'.$accessory->id.'" class="item item_selected">'.
                        '<input id="input-'.$accessory->id.'" type="checkbox" name="checked['.$idNode.']" value="'.$accessory->id.'" class="input-checked" checked>'.  
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select>'.
                        '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif price_default">'.$accessory->price.'</span>'.
                        '</div>';
                        $first = false;
                }
                else{
                    $html.= '<div id="'.$accessory->id.'" class="item">'.
                        '<input id="input-'.$accessory->id.'" type="checkbox" name="checked['.$idNode.']" value="'.$accessory->id.'" class="input-checked">'. 
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select>'.
                        '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif ">'.$accessory->price.'</span>'.
                        '</div>';
                };
            };
            $html.= '</div>';
        }
        else{
            $html.='<div id="div-item-'.$idChil.'">';                    
            foreach($accessries as $accessory){
                $cover_image = json_decode($accessory->cover_image);
                $url         = $cover_image->url;
                $urlDefaul = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                        '<input id="input-'.$accessory->id.'" type="checkbox" name="checked['.$idNode.']" value="'.$accessory->id.'" class="input-checked">'. 
                        '<img class="displayNone" src="'.$url.'">'.
                        '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select>'.
                        '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif">'.$accessory->price.'</span>'.
                        '</div>';
            };
            $html.='</div>'; 
        };
        //end load accessries
    }
    //endload $select== 'checked'
    return ['total_price_config' => $total_price_config, 'html' => $html] ;
}
//End

//Load HTML Edit AccessoriesProduct __Cre:Tin//
function qtySelectedCateProduct($categoryType, $childrenCategories,$arr_accessory_id, $arr_quantity_accessory){
    $type_select    = json_decode($categoryType);
    $limit          = $type_select->limit;
    $limit_selected = 0 ;
    foreach ($childrenCategories as $childCategory){
        $accessories = Accessory::where('category_id',$childCategory->id)->get(); 
        if($accessories->isNotEmpty() && $type_select->type == 'Select'){
            foreach($accessories as $accessory){
                if( in_array($accessory->id, $arr_accessory_id)){
                  $limit_selected += $arr_quantity_accessory[$accessory->id];
                };
            }
        }    
    }
    return $limit_selected;
}
function loadEditAccessoriesProduct($data,$arr_accessory_id, $arr_quantity_accessory){
    // _____ $data <> table: accessory_categories ____cre:TinTon//
    $total_price_config = 0;
    $html = '';     
    foreach ($data as $category){
        $html.= '<div id="change-configurator-'.$category->id.'">';
        if ($category->type_of_select != null) {
            $type_select = json_decode($category->type_of_select);
            $html.= '<p id="'.$type_select->type.'" style="display:none" class="type-select">'.$type_select->limit.'</p>';
        }
        $html.= '<div class="item_type_holder" >'.
            '<h4 class="new_item_type" >'.
            $category->name.
            '<div class="right_over"><i class="fa fa-cog" aria-hidden="true"></i></div>'.
            '</h4>'.
            '<div class="right">'.
            '<div class="right_image">';

            $cover_image_cate_node = json_decode($category->image);
        if (!empty($cover_image_cate_node->url)){
            $html.= '<img id="change_pic_'.$category->id.'" src="'.asset($cover_image_cate_node->url).'">';
        }
        else {
            $html.= '<img id="change_pic_'.$category->id.'" src="'.asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg').'">';
        }
        $html.= '</div>'.
                '</div>'.
                '<div class="holder">'.
                '<div class="configured_icons">'.
                '<img src="/img/system_imgs/configurator_imgs/on_off/on.png"><img src="/img/system_imgs/configurator_imgs/on_off/off.png">'.
                '</div>';

        if ($category->childrenCategories->isNotEmpty()) {
            if ($category->type_of_select != null) {
                $qtyselected = qtySelectedCateProduct($category->type_of_select, $category->childrenCategories,$arr_accessory_id, $arr_quantity_accessory);
                $render = loadEditChillCateProduct($category->type_of_select,$category->childrenCategories, $total_price_config,$arr_accessory_id,$arr_quantity_accessory, $qtyselected);
               $html.= $render['html'];
               $total_price_config += $render['total_price_config'];
            };   
        }
        else {
            $html.= '<div class="item"><label>There is no accessory category here</label></div>';
        }
        $html.= '</div></div></div>';
    };
    $result = [
        'html'=>$html, 
        'total_price_config' => $total_price_config
    ];
    return $result;
}
function loadEditChillCateProduct($categoryType, $childrenCategories, $total_price_config, $arr_accessory_id, $arr_quantity_accessory, $qtyselected){
    $html = '';
    $total_price_config = 0;
    foreach ($childrenCategories as $childCategory){
        $html.= '<p class="new_attribute_value cate-div-item-'.$childCategory->id.' ">'.
                $childCategory->name.
                '</p>';
            $idNode     = $childCategory->parent_category_id;
            $idChil     = $childCategory->id;
            $accessries = Accessory::where('category_id',$idChil)->get();   
            if($accessries->isNotEmpty()){
                $render = loadEditAccessoryProduct($idNode, $idChil, $accessries, $categoryType,$arr_accessory_id, $arr_quantity_accessory, $qtyselected);
                $html.=  $render['html'];
                $total_price_config += $render['total_price_config'];
            }
            else {
                $html.= '<div class="item"><label>There are no accessories in this category</label></div>';
            }
    }
     return ['total_price_config' => $total_price_config, 'html' => $html] ;
}
function loadEditAccessoryProduct($idNode, $idChil, $accessries, $categoryType, $arr_accessory_id, $arr_quantity_accessory, $qtyselected ) {
    //type_selects = ['Radio', 'Radio-limit', 'Select', 'checked'];
    $type_select        = json_decode($categoryType);
    $total_price_config = 0;
    $html               = '';

    if ($type_select->type == 'Radio') {
        $html.='<div id="div-item-'.$idChil.'">';
        foreach($accessries as $accessory){
            $cover_image = json_decode($accessory->cover_image);
            $url         = $cover_image->url;
            $urlDefaul   = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
            if (in_array($accessory->id, $arr_accessory_id)){
                $total_price_config = $total_price_config + $accessory->price;
                $html.= '<div id="'.$accessory->id.'" class="item item_selected">'.
                    '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'" checked="checked"> '. 
                    '<img class="displayNone" src="'.$url.'"> '.
                    '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select> '.
                    '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif price_default">'.$accessory->price.'</span> '.
                    '</div>';
            }
            else{
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                    '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'">'. 
                    '<img class="displayNone" src="'.$url.'">'.
                    '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select>'.
                    '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif ">'.$accessory->price.'</span>'.
                    '</div>';
            };
        };
        $html.= '</div>'; 
    }
    //endload $select== 'Radio'

    if ($type_select->type == 'Radio-limit') {
        $html.='<div id="div-item-'.$idChil.'">';
        foreach($accessries as $accessory){
            $cover_image = json_decode($accessory->cover_image);
            $url         = $cover_image->url;
            $urlDefaul   = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
            if (in_array($accessory->id, $arr_accessory_id)){
                $total_price_config =  $total_price_config + ($accessory->price*$arr_quantity_accessory[$accessory->id]);
                $html.= '<div id="'.$accessory->id.'" class="item item_selected">'.
                    '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'" checked="checked"> '. 
                    '<img class="displayNone" src="'.$url.'"> '.
                    '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" >';
                    for ($i=1; $i <= $type_select->limit; $i++) { 
                        if ($i == $arr_quantity_accessory[$accessory->id]  ) {
                            $html.= '<option selected value="'.$i.'" >'.$i.'</option>';
                        }
                        else {
                            $html.= '<option value="'.$i.'" >'.$i.'</option>';
                        }
                    }
                    $html.= '</select>'.
                    '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif price_default">'.$accessory->price.'</span>'.
                    '</div>';
            }
            else{
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                    '<input id="input-'.$accessory->id.'" type="radio" name="checked['.$idNode.']" value="'.$accessory->id.'"> '. 
                    '<img class="displayNone" src="'.$url.'"> '.
                    '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone " >';
                    for ($i=1; $i <= $type_select->limit; $i++) { 
                        $html.= '<option value="'.$i.'" >'.$i.'</option>';
                    }
                    $html.= '</select>'.
                    '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif ">'.$accessory->price.'</span>'.
                    '</div>';
            };
        };
        $html.= '</div>'; 
    }
     //endload $select== 'Radio-limit'

    if ($type_select->type == 'Select-limit') {
        $html.='<div id="div-item-'.$idChil.'">';
        $limit = $type_select->limit;
        $limit_selected = $qtyselected ;
        foreach($accessries as $accessory){
            $cover_image = json_decode($accessory->cover_image);
            $url         = $cover_image->url;
            $urlDefaul   = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');

            if (in_array($accessory->id, $arr_accessory_id)){
                $total_price_config = $total_price_config + ($accessory->price*$arr_quantity_accessory[$accessory->id]);

                $optionSelected = $limit - ($limit_selected - $arr_quantity_accessory[$accessory->id]) ;
                $html.= '<div id="'.$accessory->id.'" class="item item_selected">'.
                '<input id="'.$idChil.'" type="checkbox" name="checked['.$idNode.'][]" value="'.$accessory->id.'" checked="checked" style="display:none!important;" > '.
                '<img class="displayNone" src="'.$url.'"> '.
                '<select id="select-'.$accessory->id.'" name="changeQuantity['.$accessory->id.']" class="selected" >';

                for ($i=0; $i <= $optionSelected; $i++) {
                    if ($i == $arr_quantity_accessory[$accessory->id]  ) {
                       $html.= '<option selected value="'.$i.'" >'.$i.'</option>';
                    }
                    else {
                        $html.= '<option value="'.$i.'" >'.$i.'</option>';
                    }
                }
                $html.= '</select>'.
                ' x '.
                '<label for="'.$idChil.'">'.$accessory->name.'</label><span class="price_dif price_default">'.$accessory->price.'</span>'.
                '</div>';
            }
            else {
                $option = $limit - $limit_selected ;
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                '<img class="displayNone" src="'.$url.'">'.
                '<input id="'.$idChil.'" type="checkbox" name="checked['.$idNode.'][]" value="'.$accessory->id.'" style="display:none!important;"> '.
                '<select id="select-'.$accessory->id.'" name="changeQuantity['.$accessory->id.']" class="displayBlock" >';

                for ($i=0; $i <= $option; $i++) {
                        $html.= '<option value="'.$i.'" >'.$i.'</option>';
                }
                $html.= '</select>'.
                ' x '.
                '<label for="'.$idChil.'">'.$accessory->name.'</label><span class="price_dif ">'.$accessory->price.'</span>'.
                '</div>';
            }
            

        };
        $html.= '</div>';
    }
    //endload $select== 'Select'

    if ($type_select->type == 'checked') { 
        $html.='<div id="div-item-'.$idChil.'">';
        foreach($accessries as $accessory){
            $cover_image = json_decode($accessory->cover_image);
            $url         = $cover_image->url;
            $urlDefaul   = asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg');
            if (in_array($accessory->id, $arr_accessory_id)){
                $total_price_config = $total_price_config + $accessory->price;
                $html.= '<div id="'.$accessory->id.'" class="item item_selected">'.
                    '<input id="input-'.$accessory->id.'" type="checkbox" name="checked['.$idNode.']" value="'.$accessory->id.'" class="input-checked" checked="checked"> '. 
                    '<img class="displayNone" src="'.$url.'"> '.
                    '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1">1</option></select> '.
                    '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif price_default">'.$accessory->price.'</span> '.
                    '</div>';
            }
            else{
                $html.= '<div id="'.$accessory->id.'" class="item">'.
                    '<input id="input-'.$accessory->id.'" type="checkbox" name="checked['.$idNode.']" value="'.$accessory->id.'" class="input-checked"> '. 
                    '<img class="displayNone" src="'.$url.'"> '.
                    '<select id="select-'.$accessory->id.'" onmouseover="pic('.$idNode.','.$url.')" name="changeQuantity['.$accessory->id.']" class="displayNone displayBlock" style="display:none!important;"><option value="1" >1</option></select> '.
                    '<label for="input-'.$accessory->id.'">'.$accessory->name.'</label><span class="price_dif ">'.$accessory->price.'</span> '.
                    '</div>';
            };
        };
        $html.= '</div>';
    }
    //endload $select== 'checked'
    return ['total_price_config' => $total_price_config, 'html' => $html] ;
}
//End 

function loadCongigurationBill($data, $arr_accessory_id,$arr_quantity_accessory){
    $html = '<ul id="sl">';  
    foreach ($data as $category){ 
        if ($category->childrenCategories) {
            $html .='<div id="change-configurator-'.$category->id.'">';
            $arr_item   = array();
            foreach ($category->childrenCategories as $childCategory){
                $idNode     = $category->id;
                $idChil     = $childCategory->id;
                $accessries = Accessory::where('category_id', $idChil)->get();
                foreach($accessries as $accessory){
                    if (in_array($accessory->id, $arr_accessory_id)){
                        $quantity = $arr_quantity_accessory[$accessory->id];
                        if ($quantity>1) {
                            $html.= '<li id="'.$accessory->id.'"><i class="fa fa-check" aria-hidden="true"></i>'.$quantity.' x '.$accessory->name.'</li>';
                        }
                        else {
                            $html.= '<li id="'.$accessory->id.'"><i class="fa fa-check" aria-hidden="true"></i>'.$accessory->name.'</li>';
                        }
                        $item = [
                            'category_tree_name' => $category->name,
                            'category'           => $childCategory->id,
                            'category_name'      => $childCategory->name,
                            'accessory_id'       => $accessory->id,
                            'accessory_qty'      => $quantity,
                            'accessory_name'     => $accessory->name
                        ];
                        array_push($arr_item, $item);
                    }
                };
            }
            $html .= "<input type='hidden'  name='myConfig[]' value='".json_encode($arr_item)."' />";
            $html .='</div>';
        } 
    };
    $html.= '</ul>';
    return $html;
}
function loadHPBaseProduct($category_name, $cover_image_cate_node, $product_name){
        $html = '<div class="item_type_holder" >'.
                '<h4 class="new_item_type" >
                HP BASE SERVER
                <div class="right_over"><i class="fa fa-cog" aria-hidden="true"></i></div>'.
                '</h4>'.
                '<div class="right">'.
                '<div class="right_image">';
        $html.= '<img id="image-cover-base"  src="'.asset($cover_image_cate_node).'">';
        $html.= '</div>'.
                '</div>'.
                '<div class="holder">'.
                '<div class="configured_icons">'.
                '</div>';
        $html.= '<p class="new_attribute_value">'.$category_name.'</p>';
        $html.= '<div >
            <input  type="radio" checked="checked"> <label for="input-7">'.$product_name.'</label></div>';
        $html.= '</div></div>';
        return $html;
    }
?>
<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\CartHelper;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\ProductConfiguration;
use App\Models\AccessoryCategory;

class BasketController extends Controller
{  
	public function view(){
    return view(config('template.homeTemplateBladeURL').'basket');
	}

  public function add(CartHelper $cart, Request $request, $id){
    $product = Product::find($id);
    if ($cart->add($product, 1, $request->price_config, $request->myConfig) == true) {
     		return redirect()->route('home.basket.view');
    }
  }
  
 	public function remove(CartHelper $cart,$id){
    $cart->remove($id);
    return redirect()->back();
 	}

 	public function updateQty(CartHelper $cart, Request $request){
	  $update_qty = $request->update_qty;
	  foreach ($update_qty as $id => $quantity) {
	    	 $cart->update($id,$quantity);
	   }
    return redirect()->back();
 	}

  public function updateReConfigure(CartHelper $cart, Request $request, $id){
    if ($cart->update_re_configure((int)$id, $request->price_config, $request->myConfig) == true) {
      return redirect()->route('home.basket.view');
    }
    else {
      return "Erros Update Re-Configure";
    }
  }

 	public function clear(CartHelper $cart){
    $cart->clear();
    return redirect()->back();
 	}
 	public function reConfigure($slug, $id){
 		$basketItemAccessories = session('cart')[$id]['accessories'];
    $arr_accessory_id = array();
    $arr_quantity = array();
    foreach ($basketItemAccessories as $accessory) {
      $accessories = json_decode($accessory);
      if (!empty($accessories) && is_array($accessories) ) {
        foreach ($accessories as $accessoryItem) {
          if (!empty($accessoryItem->accessory_id)) {
            array_push($arr_accessory_id, $accessoryItem->accessory_id);
            array_push($arr_quantity, $accessoryItem->accessory_qty);
          }
        }
      }
      if(!empty($accessories) && !is_array($accessories)) {
        array_push($arr_accessory_id, $accessories->accessory_id);
        array_push($arr_quantity, $accessories->accessory_qty);
      }
    }
    $arr_quantity_accessory = array_combine($arr_accessory_id, $arr_quantity);
 		$product = Product::where('slug', $slug)->first();
	  $accessoryCategory  = $this->checkProductCategory($product->category_id);
    $config              = ProductConfiguration::where('product_id',$product->id)->get();
    $render              = loadEditAccessoriesProduct($accessoryCategory, $arr_accessory_id, $arr_quantity_accessory);
    $htmlAccessories     = $render['html'];
    $total_price_config  = $product->price+$render['total_price_config'];
    $bill = loadCongigurationBill($accessoryCategory, $arr_accessory_id, $arr_quantity_accessory);
    $basket_id = $id;
    return view(config('template.homeTemplateBladeURL').'re-configure', compact('product', 'total_price_config', 'htmlAccessories', 'bill', 'basket_id'));
 	}

  public function checkProductCategory($product_category_id){
    $collects = collect();
    $accessoryCategory = AccessoryCategory::where('parent_category_id',0) ->with('childrenCategories')->get();
    foreach ($accessoryCategory as $category) {
        if (in_array($product_category_id, json_decode($category->product_category_id))  ) {
           $collects->push($category);
        }
    }
    return $collects;
  }
}

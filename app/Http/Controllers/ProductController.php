<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Accessory;
use App\Models\AccessoryCategory;
use App\Models\ProductConfiguration;
use Illuminate\Support\Str;

class ProductController extends Controller
{	
	private $viewFolder = 'product';
	
    public function index(){
        $pageInfo = [
            'page' => $this->viewFolder
        ];
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
    }

    public function create(Request $request)
    {  
        $categories = Category::where('parent_category_id',0) ->with('childrenCategories')->get();
        $pageInfo = [
            'subtitle'  => 'Add new',
            'page'      => $this->viewFolder
        ];
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.create", compact('pageInfo', 'categories'));
    }

    public function store(Request $request)
    {   
        // ____________________SEO meta data___________________
        $seoMeta = [];
        if (isset($request->meta_title)) {
            $seoMeta['title'] = $request->meta_title;
        }
        if (isset($request->meta_description)) {
            $seoMeta['description'] = $request->meta_description;
        }
        if (isset($request->meta_image_cover)) {
            $seoMeta['image_cover'] = $request->meta_image_cover;
        }
        if (isset($request->meta_keywords)) {
            $seoMeta['keywords'] = $request->meta_keywords;
        }
        
        //_____________________hinh anh san pham_______________
        $coverImage = [
          'url'             =>  $request->cover_image,
          'alt_text_image'  =>  $request->alt_text_cover
        ];
        
        $product = Product::create([
            'name'           => $request->name,
            'price'          => $request->price_product,
            'price_config'   => $request->total_price_config,
            'category_id'    => $request->category_id,
            'is_popular'     => $request->is_popular == "on" ? 1 : 0,
            'drive_bay_size' => $request->drive_bay_size,
            'qty_drive'      => $request->qty_drive,
            'slug'           => $request->slug,
            'description'    => $request->description,
            'cover_image'    => json_encode($coverImage),
            'seo_metadata'   => empty($seoMeta)? null : json_encode($seoMeta),
        ]);
        $product->save();
        $status  = "error";
        $message = "Have error while creating new product.";
        if ($product != null) {
            $arrayQuantity = $request->changeQuantity;
            if(isset($request->checked)){
                foreach ($request->checked as $idCateNode => $idAccessory) {
                    if (is_array($idAccessory)) {
                        foreach ($idAccessory as $id) {
                            ProductConfiguration::create([
                            'product_id'   => $product->id,
                            'accessory_id' => $id,
                            'quantity'     => $this->getQtyAccesory($arrayQuantity, $id),
                            'price'        => $this->getPriceAccesory($id)
                            ]); 
                        }
                    }
                    else {
                        ProductConfiguration::create([
                        'product_id'   => $product->id,
                        'accessory_id' => $idAccessory,
                        'quantity'     => $this->getQtyAccesory($arrayQuantity, $idAccessory),
                        'price'        => $this->getPriceAccesory($idAccessory)
                        ]);
                    }
                };
            }
            
            $status  = "success";
            $message = "Create new Product successfully.";
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function getPriceAccesory($id){
       $accessory = Accessory::find($id);
       if (!empty($accessory)) {
           $price = $accessory->price;
           return $price;
       }
    }

    public function getQtyAccesory($arrayQuantity, $id){
        foreach ($arrayQuantity as $idAccessory => $quantity) {
           if ($idAccessory == $id) {
              return (int)$quantity;
           }
        }
    }
    
    public function edit($id)
    {
        $categories = Category::where('parent_category_id',0) ->with('childrenCategories')->get();
        $product    = Product::find($id);
        $pageInfo   = [
            'subtitle'  => 'Edit',
            'page'      => $this->viewFolder
        ];
        if ($product != null) {
            $accessoryCategory  = $this->checkProductCategory($product->category_id);
            $config              = ProductConfiguration::where('product_id',$product->id)->get();
             
            $arr_accessory_id    = $config->pluck('accessory_id')->toArray();
            $arr_quantity_accessory = $config->pluck('quantity', 'accessory_id')->toArray();
            $render              = loadEditAccessoriesProduct($accessoryCategory, $arr_accessory_id, $arr_quantity_accessory);
            $image = json_decode($product->cover_image);
            $htmlAccessories     = $render['html'];
           
            $total_price_config  = $product->price_config+$product->price;

            return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.edit", compact('product', 'pageInfo','categories', 'htmlAccessories', 'total_price_config'));
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', 'error')->with('message', 'Product is not found');
    }

    public function update(Request $request, $id)
    {   
        $product = Product::find($id);
        $status  = "error";
        $message = "Have error while updating product.";
        if ($product != null) {
            $cover_image = [
              'url'             =>  $request->cover_image,
              'alt_text_image'  =>  $request->alt_text_cover
            ];
    
            $product->category_id    = $request->category_id;
            $product->is_popular     = $request->is_popular == "on" ? 1 : 0;
            $product->drive_bay_size = $request->drive_bay_size;
            $product->qty_drive      = $request->qty_drive;
            $product->name           = $request->name;
            $product->price          = $request->price_product;
            $product->price_config   = $request->total_price_config;
            $product->slug           = $request->slug;
            $product->description    = $request->description;
            $product->cover_image    = json_encode($cover_image);
            $seoMeta = [];
            if (isset($request->meta_title)) {
                $seoMeta['title'] = $request->meta_title;
            }
            if (isset($request->meta_description)) {
                $seoMeta['description'] = $request->meta_description;
            }
            if (isset($request->meta_image_cover)) {
                $seoMeta['image_cover'] = $request->meta_image_cover;
            }
            if (isset($request->meta_keywords)) {
                $seoMeta['keywords']    = $request->meta_keywords;
            }
            $product->seo_metadata      =  (empty($seoMeta) ? null : json_encode($seoMeta));
            $product->save();
            $configProduct = ProductConfiguration::where('product_id', $product->id)->delete();
            //$idRemove = $configProduct->pluck('id');
            //__delete hien co__
            //ProductConfiguration::destroy($idRemove);
            $arrayQuantity = $request->changeQuantity;
            //__add cai moi__
            if (isset($request->checked)) {
                foreach ($request->checked as $idCateNode => $idAccessory) {
                    if (is_array($idAccessory)) {
                        foreach ($idAccessory as $id) {
                            ProductConfiguration::create([
                            'product_id'   => $product->id,
                            'accessory_id' => $id,
                            'quantity'     => $this->getQtyAccesory($arrayQuantity, $id),
                            'price'        => $this->getPriceAccesory($id)
                            ]);
                        }
                    }
                    else {
                        ProductConfiguration::create([
                        'product_id'   => $product->id,
                        'accessory_id' => $idAccessory,
                        'quantity'     => $this->getQtyAccesory($arrayQuantity, $idAccessory),
                        'price'        => $this->getPriceAccesory($idAccessory)
                        ]);
                    }
                };
            } 
            $status  = "success";
            $message = "Update product successfully.";
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $product = product::find($id);
        if ($product != null) {
            $product->delete();
            return response()->json([
                "title"     => "DELETE product",
                "status"    => "success",
                "msg"       => "Delete product successfully."
            ]);
        }
        return response()->json([
            "title"     => "DELETE product",
            "status"    => "error",
            "msg"       => "Have error while deleting new product."
        ]);
    }

    public function loadAJAX(Request $request)
    {
            ## Read value
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowperpage      = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = trim($search_arr['value']); // Search value

        // Total records
        $totalRecords           = Product::count();
        $totalRecordswithFilter = Product::where('name', 'like', "%$searchValue%")->count();

        // Fetch records
        $product = Product::orderBy($columnName, $columnSortOrder)
        ->where('name', 'like', "%$searchValue%")
        ->skip($start)
        ->take($rowperpage)
        ->get();
        
        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData"               => $product
        );

        echo json_encode($response);
        exit;
    }

    public function loadAccessoriesCreate(Request $request){
        $accessoryCategory = $this->checkProductCategory($request->id);
        $render            = loadAccessoriesProduct($accessoryCategory);
        $html              = $render['html'];
        $totalPriceConfig  = $render['total_price_config'];
        $totalPrice = (int)$request->product_price + (int)$render['total_price_config'];
        return response()->json([
            "html"               => $html,
            "total_price_config" => $totalPriceConfig,
            "total_price"        => $totalPrice,
            "message"            => "status:200",
        ]);
    }
    
    public function checkProductCategory($productCategoryId){
        $collects = collect();
        $accessoryCategory = AccessoryCategory::where('parent_category_id',0) ->with('childrenCategories')->get();
        foreach ($accessoryCategory as $category) {
            if (in_array($productCategoryId, json_decode($category->product_category_id))  ) {
               $collects->push($category);
            }
        }
        return $collects;
    }

    public function checkUnique(Request $request){
        $validator = $request->validate(['name' => 'unique:products']);
        return true;
    }
}

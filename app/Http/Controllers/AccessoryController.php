<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessory;
use App\Models\AccessoryCategory;
use App\Models\Category;
use App\Http\Requests\CheckDataUpdateAccessory;
use Illuminate\Support\Facades\Validator;

class AccessoryController extends Controller
{
    private $viewFolder = 'accessory';
	
   	public function index(){
   		$pageInfo = [
            'page'  => $this->viewFolder
        ];
   		return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
   	}

    public function edit($id)
    {   
        $accessory = Accessory::find($id);
        $categories = Category::where('parent_category_id',0) ->with('childrenCategories')->get();
        $accessoryCategories = AccessoryCategory::all();
        $accessoryCategory   = AccessoryCategory::where('id', $accessory->category_id )->first();
        $category_id =  $accessoryCategory->product_category_id;
        $pageInfo = [
            'subtitle'  => 'Edit',
            'page'      => $this->viewFolder
        ];
        if ($accessory != null) {
            return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.edit", compact('accessory', 'accessoryCategories', 'categories', 'category_id', 'pageInfo'));
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', 'error')->with('message', 'Product is not found');
    }

    public function update(CheckDataUpdateAccessory $request, $id)
    {   
        $accessory = Accessory::find($id);
        $status   = "error";
        $message  = "Have error while updating Category.";
        if ($accessory != null) {
            $cover_image = [
              'url'            =>  $request->cover_image,
              'alt_text_image' =>  $request->alt_text_cover
            ];
            $accessory->name           = $request->name;
            $accessory->accessory_code = $request->accessory_code;
            $accessory->category_id    = $request->category_id;
            $accessory->slug           = $request->slug;
            $accessory->price          = (float)$request->price;
            $accessory->cover_image    = json_encode($cover_image);
            $accessory->attributes     = !empty($request['attributes'])? $request['attributes']: '';
            $accessory->save();
            $status  = "success";
            $message = "Update Accessory successfully.";
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }
    
   	public function create(Request $request )
    {   
        $categories        = AccessoryCategory::all();
        $accessoryCategories = AccessoryCategory::where('parent_category_id',0)->get();
        $pageInfo = [
            'subtitle' => 'Add new',
            'page'     => $this->viewFolder,
            
        ];
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.create", compact('pageInfo', 'categories', 'accessoryCategories'));
    }

    public function store(Request $request)
    {   
        $cover_image = [
          'url'             =>  $request->cover_image,
          'alt_text_image'  =>  $request->alt_text_cover
        ];
     
        $accessory = Accessory::create([
            'name'           => $request->name,
            'accessory_code' => $request->accessory_code,
            'category_id'    => $request->category_id,
            'slug'           => $request->slug,
            'price'          => (float)$request->price,
            'cover_image'    => json_encode($cover_image),
            'attributes'     => isset($request['attributes'])? $request['attributes']: '',
        ]);

        $status  = "error";
        $message = "Have error while creating new product.";

        if ($accessory != null) {
            $status  = "success";
            $message = "Create new Product successfully.";
        }

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $accessoryCategory = Accessory::find($id);
        $countParent = AccessoryCategory::where('parent_category_id',$id)->count();

        if ($accessoryCategory != null) {
            if($countParent == 0) {
                $accessoryCategory->delete($id);
                return response()->json([
                    "title"     => "DELETE Accessory",
                    "status"    => "success",
                    "msg"       => "Delete Accessory successfully."
                ]);
            } else {
                return response()->json([
                    "title"     => "DELETE Accessory",
                    "status"    => "error",
                    "msg"       => "You cannot delete this AccessoryCategory, because there are many sub-categories"
                ]);
            }
        }
        return response()->json([
            "title"     => "DELETE Accessory",
            "status"    => "error",
            "msg"       => "Have error while deleting new AccessoryCategory."
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
        $totalRecords           = Accessory::count();
        $totalRecordswithFilter = Accessory::where('accessory_code', 'like', "%$searchValue%")->count();

        // Fetch records
        $categoryTree = Accessory::orderBy($columnName, $columnSortOrder)
        ->where('accessory_code', 'like', "%$searchValue%")
        ->skip($start)
        ->take($rowperpage)
        ->get();
        
        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData"               => $categoryTree
        );

        echo json_encode($response);
        exit;
    }

   	public function loadModalChooseProduct(Request $request){
        $product = Product::all();
        return response()->json([
            "products"  => $product,
            "message"   => "status:200"
        ]);
    }

    public function checkUnique(Request $request){
        $validator = $request->validate(['accessory_code' => 'unique:accessories']);
        return true;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessoryCategory;
use App\Models\Category;
use App\Models\Brand;

class AccessoryCategoryController extends Controller
{
    private $viewFolder = 'accessory-category';

    public function index()
    {
        $pageInfo = [
            'page'  => "Accessory's Categories",
        ];

        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
    }

    public function create(Request $request)
    {  
        $productCategories = Category::where('parent_category_id',0) ->with('childrenCategories')->get();
        $accessoryCategories = $accessoryCategories = AccessoryCategory::where('parent_category_id', 0)->get();

        $pageInfo = [
            'subtitle'  => 'Add new',
            'page'      => $this->viewFolder,
            'namepage'  => "Accessory's Categories"
        ];

        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.create", compact('pageInfo', 'productCategories', 'accessoryCategories'));
    }

    public function store(Request $request)
    {  
        $coverImage = [
            'url'               => $request->cover_image,
            'alt_text_image'    => $request->alt_text_cover,
        ];
      
        if (isset($request->type_select)) {
            foreach ($request->qty_max as $type => $limit) {
               if ($request->type_select ==  $type) {
                    $type_select = [
                        'type'  => $type,
                        'limit' => $limit
                    ];
               }
            };
        }
      
        $accessoryCategory = AccessoryCategory::create([
            'name'                => $request->name,
            'parent_category_id'  => $request->parent_category_id,
            'product_category_id' => json_encode([]),
            'slug'                => $request->slug,
            'image'               => json_encode($coverImage),
            'type_of_select'      => isset($type_select)? json_encode($type_select) : null
        ]);
   
        $status = "error";
        $message = "Have error while creating new AccessoryCategory.";

        if ($accessoryCategory != null ) {
            $status  = "success";
            $message = "Create new AccessoryCategory successfully.";

        }

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }
    
    public function edit($id)
    {
        $accessoryCate = AccessoryCategory::find($id);
        $accessoryCategories = AccessoryCategory::where('parent_category_id', 0)->get();

        $categories = Category::where('parent_category_id',0) ->with('childrenCategories')->get();
        $pageInfo = [
            'subtitle'  => 'Edit',
            'page'      => $this->viewFolder,
            'namepage'  => "Accessory's Categories"
        ];

        if ($accessoryCate != null) {
            return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.edit", compact('accessoryCate', 'pageInfo','accessoryCategories', 'categories'));
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', 'error')->with('message', 'AccessoryCategory is not found');
    }

    public function update(Request $request, $id)
    {  
        $category = AccessoryCategory::find($id);
        $status   = "error";
        $message  = "Have error while updating AccessoryCategory.";
        $coverImage = [
            'url'               => $request->cover_image,
            'alt_text_image'    => $request->alt_text_cover,
        ];
       
        if (isset($request->type_select)) {
            foreach ($request->qty_max as $type => $limit) {
               if ($request->type_select ==  $type) {
                    $type_select = [
                        'type'  => $type,
                        'limit' => $limit
                    ];
               }
            };
        }
        $arrCheckBox = [];
        if(isset($request->check) && !empty($request->check)) {
            if ((int)$request->parent_category_id == 0) {
                    foreach($request->check as $chkValue) {
                    $arrCheckBox[] = (int)$chkValue;
                }
            }
        } 
      
        if ($category != null) {
            $category->name                = $request->name;
            $category->slug                = $request->slug;
            $category->parent_category_id  = $request->parent_category_id;
            $category->image               = json_encode($coverImage);
            $category->type_of_select      = (empty($type_select) ? null : json_encode($type_select));
            $category->save();
            $status  = "success";
            $message = "Update AccessoryCategory successfully.";
        }

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    } 
   
    public function destroy(Request $request)
    {
        $id = $request->id;
        $AccessoryCategory = AccessoryCategory::find($id);
        $countParent = AccessoryCategory::where('parent_category_id',$id)->count();
        if ($AccessoryCategory != null) {
            if($countParent == 0) {
                $AccessoryCategory->delete($id);
                return response()->json([
                    "title"     => "DELETE AccessoryCategory",
                    "status"    => "success",
                    "msg"       => "Delete AccessoryCategory successfully."
                ]);
            } else {
                return response()->json([
                    "title"     => "DELETE AccessoryCategory",
                    "status"    => "error",
                    "msg"       => "You cannot delete this AccessoryCategory, because there are many sub-categories"
                ]);
            }  
        }
        return response()->json([
            "title"     => "DELETE AccessoryCategory",
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
        $totalRecords           = AccessoryCategory::count();
        $totalRecordswithFilter = AccessoryCategory::where('name', 'like', "%$searchValue%")->count();

        // Fetch records
        $AccessoryCategory = AccessoryCategory::orderBy($columnName, $columnSortOrder)
            ->where('name', 'like', "%$searchValue%")
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData"               => $AccessoryCategory
        );

        echo json_encode($response);
        exit;
    }


    public function loadSelectAccessoryCategory(Request $request)
    {   
        $product_category_id = $request->product_category_id;
        $parent_category_id  = $request->parent_category_id;
        $accessoryCategories = $this->checkProductCategory($product_category_id);
        $option = productCategories($accessoryCategories, null, true);
        return response()->json([
            "option"  => $option,
            "message" => "status:200"
        ]);
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

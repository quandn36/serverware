<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AccessoryCategory;
use App\Models\Brand;
use App\Http\Requests\CheckDataProductCategory;

class ProductCategoryController extends Controller
{
    private $viewFolder = 'product-categories';

    public function index()
    {
        $pageInfo = [
            'page'  => "Product's categories"
        ];

        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
    }

    public function create(Request $request)
    {
        $categories = Category::where('parent_category_id',0) ->with('childrenCategories')->get();
        $all_accessory_category = AccessoryCategory::where('parent_category_id',0)->get();

        $pageInfo = [
            'subtitle'  => 'Add new',
            'page'      => $this->viewFolder,
            'namepage'  => "Procduct's Categories"
        ];

        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.create", compact('pageInfo','categories','all_accessory_category'));
    }


    public function store(CheckDataProductCategory $request)
    {    
        if(isset($request->check) && !empty($request->check)) {
            foreach($request->check as $chkValue) {
                $arrCheckBox[] = (int)$chkValue;
            }
        } else {
            $arrCheckBox = [];
        }

        $imageBannerCategory = [
            'url'               =>  $request->url_banner_category,
            'alt_text_image'    =>  $request->alt_text_banner,
        ];

        $brandImageLogo = [
            'url'               => $request->url_image_logo,
            'alt_text_image'    => $request->alt_text_logo,
        ];

        $coverImage = [
            'url'               => $request->url_cover_image,
            'alt_text_image'    => $request->alt_text_cover,
        ];
      
        $category = Category::create([
            'name'                      => $request->name_category,
            'slug'                      => $request->slug_name,
            'short_name'                => $request->short_name_category,
            'code'                      => $request->code_name,
            'parent_category_id'        => $request->parent_category,
            'short_name_description'    => $request->short_name_description,
            'long_description'          => $request->long_description,
            'image_banner_category'     => json_encode($imageBannerCategory),
            'cover_image'               => json_encode($coverImage),
            'brand_image_logo'          => json_encode($brandImageLogo),
            'accessory_category_id'     => json_encode($arrCheckBox),

        ]);
        $category->save();

        //get latest id product category
        $id = $category->id;

        foreach($arrCheckBox as $access_cate_id)
        {
            $arrdata = [];
            $arrJsonAdd = [];

            $access_cate_id = AccessoryCategory::where('id',$access_cate_id)->first();
            
            $arrdata = json_decode($access_cate_id->product_category_id);
            if(!empty($arrdata)) {
                if(!in_array($id, $arrdata)) {
                    $arrdata[] = $id;
                }
            } else {
                $arrdata[] = $id; 
            }   
            
            $access_cate_id->product_category_id = json_encode($arrdata);
            $access_cate_id->save();
        }
        
        if ($category != null) {
            $status  = "success";
            $message = "Create new Category successfully.";
            return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);

        } else {
            $status = "error";
            $message = "Have error while creating new category.";
            return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);

        $all_accessory_category = AccessoryCategory::where('parent_category_id',0)->get();
       
        if ($category->parent_category_id != 0) {
            $categories = Category::where('parent_category_id',0) ->with('childrenCategories')->get();
        }
        else {
            $categories = Category::where('parent_category_id',0)->with('childrenCategories')->where('id', '!=', $category->id)->get();
        }
        // dd($all_accessory_category);
        $pageInfo = [
            'subtitle'  => 'Edit',
            'page'      => $this->viewFolder,
            'namepage'  => "Procduct's Categories"
        ];

        if ($category != null) {
            return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.edit", compact('category', 'pageInfo','categories','all_accessory_category'));
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', 'error')->with('message', 'Category is not found');
    }

    public function update(CheckDataProductCategory $request, $id)
    {
        // co du lieu thi xu ly vong lap, nguoc lai gan lai thanh mot mang rong roi luu xuong dadabase
        if(isset($request->check) && !empty($request->check) && $request->parent_category != 0) {
            foreach($request->check as $chkValue) {
                $arrCheckBox[] = (int)$chkValue;
            }
        } else {
            $arrCheckBox = [];
        }

        $category = Category::find($id);
        $status   = "error";
        $message  = "Have error while updating Category.";

        // lay ra hinh anh banner
        $imageBannerCategory = [
            'url'               =>  $request->url_banner_category,
            'alt_text_image'    =>  $request->alt_text_banner,
        ];

        $brandImageLogo = [
            'url'               => $request->url_image_logo,
            'alt_text_image'    => $request->alt_text_logo,
        ];

        $coverImage = [
            'url'               => $request->url_cover_image,
            'alt_text_image'    => $request->alt_text_cover,
        ];

        if ($category != null) {
            $accessory_category_id = $this->checkSaveAccessoryCategory($category->id,$arrCheckBox,$category->accessory_category_id) ;
            
            $category->name                     = $request->name_category;
            $category->slug                     = $request->slug_name;
            $category->short_name               = $request->short_name_category;
            $category->code                     = $request->code_name;
            $category->parent_category_id       = $request->parent_category;
            $category->short_name_description   = $request->short_name_description;
            $category->long_description         = $request->long_description;
            $category->cover_image              = json_encode($coverImage);
            $category->image_banner_category    = json_encode($imageBannerCategory);
            $category->brand_image_logo         = json_encode($brandImageLogo);
            $category->accessory_category_id    = $accessory_category_id;
            $category->save();
            $status  = "success";
            $message = "Update Category successfully.";
        }
     
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function checkSaveProductCategory($idCategory, $arrCheck, $remove = false){
        if (!empty($arrCheck)) {
            foreach($arrCheck as $id) {
                $arrdata    = [];
                $arrJsonAdd = [];
                $access_cate_id = AccessoryCategory::where('id',$id)->first();
                $arrdata = json_decode($access_cate_id->product_category_id);
                if ($remove) {
                    if(!empty($arrdata)) {
                        if(in_array($idCategory, $arrdata)) {
                            $key = array_search($idCategory, $arrdata);
                            unset($arrdata[$key]);
                        }
                    } 
                    $arrNew = array_values($arrdata); 
                    sort($arrNew);
                    $access_cate_id->product_category_id = json_encode($arrNew);
                    $access_cate_id->save();
                }
                else {
                    if(!empty($arrdata)) {
                        if(!in_array($idCategory, $arrdata)) {
                            $arrdata[] = $idCategory;
                        }
                    } 
                    else {
                        $arrdata[] = $idCategory; 
                    } 
                    $access_cate_id->product_category_id = json_encode($arrdata);
                    $access_cate_id->save();
                }
            }
        }
    }

    public function checkSaveAccessoryCategory($idCategory,$arrCheckBox,$accessory_category){
        $accessory_category_id = json_decode($accessory_category);
        if (!empty($accessory_category_id)) {
            $arrDelete = [];
            foreach ($accessory_category_id as $accessCate_id) {
                if (!in_array($accessCate_id, $arrCheckBox)) {
                    $arrDelete[] = $accessCate_id;
                }
            }

            if (!empty($arrDelete)) {
                $this->checkSaveProductCategory($idCategory,$arrDelete,true);
            }
           
            $arrNew = [];
            foreach ($arrCheckBox as $key => $access_cate_id) {
                if (!in_array($access_cate_id, $accessory_category_id)) {
                    $arrNew[] = $access_cate_id;
                }
            }
       
            if (!empty($arrNew)) {
                $this->checkSaveProductCategory($idCategory,$arrNew);
            }

            foreach ($accessory_category_id as $key => $access_cate_id) {
                if (in_array($access_cate_id, $arrDelete)) {
                   unset($accessory_category_id[$key]);
                }
            }
            
            foreach ($arrNew as $access_cate_id) {
                array_push($accessory_category_id, $access_cate_id);
            }
             
        }
        if (!empty($accessory_category_id)) {
            $result = array_values($accessory_category_id);
            sort($result);
            return json_encode($result);

        }
        return json_encode($arrCheckBox);
        
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        
        $countParent = Category::where('parent_category_id',$id)->count();

        if ($category != null) {
            if($countParent == 0) {
                $category->delete($id);
                return response()->json([
                    "title"     => "DELETE Category",
                    "status"    => "success",
                    "msg"       => "Delete Category successfully."
                ]);
            } else {
                return response()->json([
                    "title"     => "DELETE Category",
                    "status"    => "error",
                    "msg"       => "You cannot delete this category, because there are many sub-categories"
                ]);
            }
            
        }
        return response()->json([
            "title"     => "DELETE Category",
            "status"    => "error",
            "msg"       => "Have error while deleting new Category."
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
        $totalRecords           = Category::count();
        $totalRecordswithFilter = Category::where('name', 'like', "%$searchValue%")->count();

        // Fetch records
        $category = Category::orderBy($columnName, $columnSortOrder)
        ->where('name', 'like', "%$searchValue%")
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData"               => $category
        );

        echo json_encode($response);
        exit;
    }

    public function loadModalChooseBrandImage(Request $request)
    {
        $brands = Brand::all();
        return response()->json([
            "brands"        => $brands,
            "message"       => "status:200"
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\ProductConfiguration;
use App\Models\AccessoryCategory;
use App\Http\Requests\DataLoginHomepageRequest;
use App\Http\Requests\DataCreateAccountRequest;
use Session;

class HomeController extends Controller
{
    public function home() 
    {	
        $productPopular = Product::where('is_popular', 1)->get()->groupBy('parent_category_id');
        $popularCategories = Category::where('menu_status','=',1)->with('childrenCategories')->get();
      
        return view(config('template.homeTemplateBladeURL').'home', compact('productPopular', 'popularCategories'));
    }

    public function about() 
    {	
        return view(config('template.homeTemplateBladeURL').'about');
    }

    public function privacyPolicy() 
    {   
        return view(config('template.homeTemplateBladeURL').'privacy-policy');
    }

    public function logIn()
    {   
        if(Auth::guard('homepage')->check()) {
            return Redirect()->route('home.account');
        } else {
            return view(config('template.homeTemplateBladeURL').'my-account');
        }
    }

    public function SendMail(DataCreateAccountRequest $request) 
    {
        $data = [
            'email'     => trim($request->email),
            'name'      => trim($request->name),
            'company'   => trim($request->company),
            'tel'       => trim($request->tel),
            'password'  => trim(Str::random(8)),
        ];

        dispatch(new SendEmailJob($data));

        $customer = Customer::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'company'   => $data['company'],
            'tel'       => $data['tel'],
            'password'  => Hash::make($data['password']),
        ]);

        if( !$customer ) {
            return Redirect()->route('home.login')->with('status', 'danger')->with('message','Failed when sigup');
        } else {
            return Redirect()->route('home.login')->with('status','success')->with('message','Signup successfully');
        }
    }

    public function PostLogin(DataLoginHomepageRequest $request) {
        $credentials = [
            'email'     =>  trim($request->email),
            'password'  =>  trim($request->password),
        ];
        if(Auth::guard('homepage')->attempt($credentials,$request->remember_token)) {
            return Redirect()->route('home.account')->with('status','success')->with('message','Login successfully');
        } else {
            return Redirect()->back()->with('status','danger')->with('message','Login failed');
        }
    }

    public function account()
    {
        $list_order         = Invoice::where('status','<>',4)->where('user_id',Auth::guard('homepage')->user()->id)->get();
        $cancelled_order    = Invoice::where('status',4)->where('user_id',Auth::guard('homepage')->user()->id)->get();
        return view(config('template.homeTemplateBladeURL').'account',compact('list_order','cancelled_order'));
    }

    public function OrderDetail(Request $request)
    {

        $order_detail_id = InvoiceDetail::where('invoice_id',$request->id)->first();
        return view(config('template.homeTemplateBladeURL').'order-detail',compact('order_detail_id'));
    }

    public function ReOrder(Request $request){

        $find_re_order = Invoice::find($request->re_order_id);
        if(!$find_re_order)
        {
            return  response()->json([
                'status'    =>  'danger',
                'message'   =>  'Order does not exist'
            ],200);
        }

        /*xu ly dat lai san pham da huy*/
        $find_re_order->status = 0;
        $find_re_order->save();

        if($find_re_order){
            return  response()->json([
                'status'    =>  'succces',
                'message'   =>  'Re-order successfully'
            ],200); 
        }else{
            return  response()->json([
                'status'    =>  'danger',
                'message'   =>  'Re-order error'
            ],200); 
        }
    }
    
    public function CancelOrder(Request $request)
    {
        $order_cancel = Invoice::find($request->cancel_order_id);
        if(!$order_cancel)
        {
            return  response()->json([
                'status'    =>  'danger',
                'message'   =>  'Order does not exist'
            ],200);
        }

        // cancel order
        $order_cancel->status = 4;
        $order_cancel->save();

        if($order_cancel){
            return  response()->json([
                'status'    =>  'succces',
                'message'   =>  'Cancel order successfully'
            ],200); 
        }else{
            return  response()->json([
                'status'    =>  'danger',
                'message'   =>  'Cancel order error'
            ],200); 
        } 
    }

    public function logout()
    {
        Auth::guard('homepage')->logout();
        return redirect()->route('home.login')->with('status','success')->with('message','Logout successfully');;
    }

    public function contact()
    {   
        return view(config('template.homeTemplateBladeURL').'contact');
    }

    public function cart()
    {   
        return view(config('template.homeTemplateBladeURL').'cart');
    }

    public function productHoldDetail($id)
    {
        return view(config('template.homeTemplateBladeURL').'product-hold-detail');
    }

    public function productMenuDetail($id)
    {   
        $server = Server::find($id);
        return view(config('template.homeTemplateBladeURL').'product-type-detail', compact('server'));
    }

    public function categoryDetail($slug){
        $category = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $category->id)->get();
        $qty_drives = Product::where('category_id', $category->id)->pluck('qty_drive')->unique()->sortDesc()->toArray();
        $drive_bay_sizes = Product::where('category_id', $category->id)->pluck('drive_bay_size')->unique()->sortDesc()->toArray();
        $slugCate = $slug;
        return view(config('template.homeTemplateBladeURL').'category', compact('category', 'products', 'qty_drives', 'drive_bay_sizes', 'slugCate'));
    }

    public function productDetail($slugcate, $slug){
        $category = Category::where('slug', $slugcate)->first();
        $product = Product::where('slug', $slug)->first();
        if($product != null){
            $accessoryCategory      = $this->checkProductCategory($product->category_id);
            $config                 = ProductConfiguration::where('product_id',$product->id)->get();
            $arr_accessory_id       = $config->pluck('accessory_id')->toArray();
            $arr_quantity_accessory = $config->pluck('quantity', 'accessory_id')->toArray();
            $render                 = loadEditAccessoriesProduct($accessoryCategory, $arr_accessory_id, $arr_quantity_accessory);

            $image                  = json_decode($product->cover_image);
            //$renderHPBase           = loadHPBaseProduct($product->category_name, $image->url, $product->name);
            //$htmlAccessories        = $renderHPBase.$render['html'];
            $htmlAccessories        = $render['html'];
            $total_price_config     = $product->price_config+$product->price;
            $bill                   = loadCongigurationBill($accessoryCategory, $arr_accessory_id, $arr_quantity_accessory);

        }
        return view(config('template.homeTemplateBladeURL').'product-detail', compact('product', 'total_price_config', 'htmlAccessories', 'bill','category'));
    }

    public function basket(){
        $allCate = Category::where('menu_status','=',1)->get();

        $data = array();

        for($i=0; $i<count($allCate); $i++) {

            $item = Category::where('parent_category_id',$allCate[$i]->id)->get();
            array_push($data, $item);
        }  
        return view(config('template.homeTemplateBladeURL').'basket', compact('allCate', 'data'));
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

    public function LoadAJaxfilter(Request $request){
        $action       = $request->action;
        $driveBaySize = $request->drive_bay_size;
        $qtyDrive     = $request->qty_drive;
        $categoryId   = (int)$request->category_id;
        $filter  = [];
        $chose   = '';
        $removeFilter = $request->removeFilter;
        $check        = $this->checkFilter($categoryId,$driveBaySize,$qtyDrive,$action,$removeFilter);
        $products   = $check['products'];
        $filter     = $check['filter'];
        $chose      = $check['chose'];
        $message    = $check['message'];
        $remove     = $check['remove'];
        $whereQuery = $check['whereQuery'];
        return response()->json([
            "message"    => $message,
            "data"       => $products,
            "filter"     => $filter, 
            "chose"      => $chose,
            "remove"     => $remove,
            "whereQuery" => $whereQuery
        ]);
    }

    public function checkData($categoryId,$driveBaySize, $qtyDrive, $remove = -1){
        $whereQuery[] = ['category_id',$categoryId];
        if ($remove == -1) {
            if ($driveBaySize != -1 && $qtyDrive != -1) {
                $chose = [
                    'title' => 'Drive Bay Size & Qty Drives',
                    'data'  => [    
                    'drive_bay_size' => $driveBaySize,
                    'qty_drive'      => $qtyDrive
                    ]
                ];
                $whereQuery[]  = ['drive_bay_size',$driveBaySize];
                $whereQuery[]  = ['qty_drive',$qtyDrive];
                $check = '';
            }   
            else if ($qtyDrive != -1) {
                $chose = [
                    'title' => 'qty_drive',
                    'data'  => $qtyDrive
                ];
                $whereQuery[]  = ['qty_drive',$qtyDrive];
                $check = 'drive_bay_size';
            }
            else if($driveBaySize != -1){
                $chose = [
                    'title' => 'drive_bay_size',
                    'data'  => $driveBaySize
                ];
                $whereQuery[] = ['drive_bay_size', $driveBaySize];
                $check = 'qty_drive';
            }
        }
        // bỏ chọn drive_bay_size
        if ($remove == 0) {
            if ($driveBaySize != -1 && $qtyDrive != -1) {
                $chose = [
                'title' => 'drive_bay_size',                    'data'  => $driveBaySize
                ];
                $whereQuery[]  = ['drive_bay_size',$driveBaySize];
                $check = 'qty_drive';
            }
            else {
                $chose = [
                'title' => 'non-select'
                ];
                $check = [];
                $check[] = 'drive_bay_size';
                $check[] ='qty_drive';
            }
        }// bỏ chọn qty_drive
        if ($remove == 1) {
            if ($driveBaySize != -1 && $qtyDrive != -1) {
                $chose = [ 
                    'title' => 'qty_drive',
                    'data'  => $qtyDrive
                ];
                $whereQuery[]  = ['qty_drive',$qtyDrive];
                $check = 'drive_bay_size';
            }
            else {
                $chose = [
                    'title' => 'non-select'
                ];
                $check = [];
                $check[] = 'drive_bay_size';
                $check[] ='qty_drive';
            }
        } 
        return ['chose' => $chose, 'whereQuery' => $whereQuery, 'check' => $check ];
    }

    public function checkFilter($categoryId,$driveBaySize,$qtyDrive,$action, $removeFilter){
        //action = 1 đang thực hiện chức năng lọc 
        //remove = 0 => driveBaySize:remove, remove = 1 => qty_drive:remove
        //$check  kiểm tra filter còn lại để hiển thị lên 
        //$chose filter đang chọn
        $filter   = [];
        $products = [];
        $chose    = '';
        if ($action == 1) {$message = 'select';$remove  = false;}
        else {$message = 'none-select'; $remove  = true;}
        $checkData   = $this->checkData($categoryId,$driveBaySize,$qtyDrive,$removeFilter);
        $whereQuery  = $checkData['whereQuery'];
        $chose       = $checkData['chose'];
        $check       = $checkData['check'];
        $products    = Product::where($whereQuery)->get();
        if (!is_array($check) && $check != '') {
            $checkfilter =  Product::where($whereQuery)->pluck($check)->unique()->count();
            if($checkfilter > 1){
                $data =  Product::where($whereQuery)->pluck($check)->unique()->toArray();
                $filter = [ 'title' => $check,
                'data'  => $data
                ];
            }
        }
        if(is_array($check)) {
            $filter1 =  Product::where($whereQuery)->pluck($check[0])->unique()->toArray();
            $filter2 =  Product::where($whereQuery)->pluck($check[1])->unique()->toArray();
            $filter['title']   = 'non-select';
            $filter['data']['drive_bay_size']  = $filter1;
            $filter['data']['qty_drive']       = $filter2 ;
        }
        return [
            'products'   => $products,
            'filter'     => $filter,
            'chose'      => $chose,           
            'message'    => $message,
            'remove'     => $remove,
            'whereQuery' => $whereQuery
        ];
    }
   
    public function urlCategory($slugname,$id)
    {
        $categoryList       = Category::where('id',$id)->first();
        $popularProducts    = Product::where('is_popular', 1)->get()->groupBy('parent_category_id');
        $subCategoryList  = Category::where('parent_category_id',$categoryList->id)->get();
        $parentCategoryId = $categoryList->id;
        return view(config('template.homeTemplateBladeURL').'category-list',compact('categoryList','subCategoryList', 'parentCategoryId', 'popularProducts'));
    }
}

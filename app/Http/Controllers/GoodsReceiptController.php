<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsReceipt;
use App\Models\Supplier;
use App\Models\Accessory;

class GoodsReceiptController extends Controller
{
    private $viewFolder = 'goods-receipt';

    public function index()
    {
        $pageInfo = [
            'page' => "Goods receipt"
        ];
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
    }

    public function create()
    {
        $pageInfo = [
            'subtitle'  => 'Add new',
            'page'      => $this->viewFolder,
            'namepage'  => "Goods receipt"
        ];
        $suppliers   = Supplier::all();
        $accessories = Accessory::all();
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.create", compact('pageInfo', 'suppliers', 'accessories'));
    }

    public function store(Request $request)
    {   
        if ( !empty($request->accessories)) {
           $accessories = $request->accessories;
            if ($this->updateQty($accessories)) {
                $goodsReceipt = GoodsReceipt::create([
                    'goods_receipt_code' => $request->goods_receipt_code,
                    'input_date'         => $request->input_date,
                    'supplier_id'        => $request->supplier_id,
                    'accessories'  => json_encode($request->accessories),
                    'total_price'  => $request->total_price_goods,
                    'shipping_fee' => $request->shipping_fee,
                    'total_money'  => $request->total_money,
                    'note'         => $request->note
                ]);
            }
        }else {
            $goodsReceipt = [];
        }
        $status  = "error";
        $message = "Have error while creating new goods receipt.";
        if ($goodsReceipt != null) {
            $status  = "success";
            $message = "Create new goods receipt.";
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function updateQty($accessories){
        try {
            foreach ($accessories as $idAccessory => $qty) {
                $accessory = Accessory::find($idAccessory);
                $update_qty = $accessory->quantity_in_stock;
                $update_qty = (int)$update_qty+(int)$qty;
                $accessory->quantity_in_stock = $update_qty;
                $accessory->save();
            }
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function checkDelEdit($lastAccesoried, $arr_checked) { 
        foreach ($lastAccesoried as $id => $qty) {
            foreach ($arr_checked as $idAccessory) {
                if ($idAccessory != $id) {
                    $accessory = Accessory::find($id);
                    $update_qty = $accessory->quantity_in_stock;
                    $update_qty = (int)$update_qty-(int)$qty;
                    $accessory->quantity_in_stock = $update_qty;
                    $accessory->save();
                }
            }
        }
    }
    
    public function updateQtyEdit($goodsReceipt, $accessories){
        try {
            $lastAccesoried =  json_decode($goodsReceipt->accessories);
            $arr_checked = [];
            $arr_new     = array();
            foreach ($lastAccesoried as $id => $qty) {
                foreach ($accessories as $idAccessory => $newQty) {
                    if ($idAccessory == $id) {
                        $accessory = Accessory::find($idAccessory);
                        $update_qty = $accessory->quantity_in_stock;
                        $update_qty = (int)$update_qty-(int)$qty+(int)$newQty;
                        $accessory->quantity_in_stock = $update_qty;
                        $accessory->save();
                        $arr_checked[] = $id;
                    }
                    else {
                        $arr_new[$idAccessory] = $newQty;
                    }
                }
            }
            $this->checkDelEdit($lastAccesoried, $arr_checked);
            if (!empty($arr_new)) {
                $this->updateQty($arr_new);
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function edit($id)
    {   
        $goodsReceipt = GoodsReceipt::find($id);
        $pageInfo = [
            'subtitle'  => 'Edit',
            'page'      => $this->viewFolder,
            'namepage' => "Goods receipt"
        ];
        if ($goodsReceipt != null) {
            $suppliers      = Supplier::all();
            $supplierIndex  = Supplier::find($goodsReceipt->supplier_id);
            $accessories    = Accessory::all();
            return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.edit", compact('goodsReceipt', 'suppliers', 'supplierIndex', 'accessories','pageInfo'));
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', 'error')->with('message', 'Supplier is not found');
    }

    public function update(Request $request, $id)
    {   
        $status  = "error";
        $message = "Have error while updating Supplier.";
        $goodsReceipt = GoodsReceipt::find($id);
        if ( !empty($request->accessories) ) {
            $accessories  = $request->accessories;
            $chkUpdateQty = $this->updateQtyEdit($goodsReceipt, $accessories);
        } else {
            $goodsReceipt = [];
        }
        if ($goodsReceipt != null && $chkUpdateQty) {
            $goodsReceipt->goods_receipt_code = $request->goods_receipt_code;
            $goodsReceipt->input_date         = $request->input_date;
            $goodsReceipt->supplier_id        = $request->supplier_id;
            $goodsReceipt->accessories  = json_encode($request->accessories);
            $goodsReceipt->total_price  = $request->total_price_goods;
            $goodsReceipt->shipping_fee = (float)$request->shipping_fee;
            $goodsReceipt->total_money  = $request->total_money;
            $goodsReceipt->note         = $request->note;  
            $goodsReceipt->save();
            $status = "success";
            $message = "Update GoodsReceipt successfully.";
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $supplier = GoodsReceipt::find($id);
        if ($supplier != null) {
            $supplier->delete();
            return response()->json([
                "title"     => "DELETE GoodsReceipt",
                "status"    => "success",
                "msg"       => "Delete GoodsReceipt successfully."
            ]);
        }
        return response()->json([
            "title"     => "DELETE GoodsReceipt",
            "status"    => "error",
            "msg"       => "Have error while deleting GoodsReceipt."
        ]);
    }

    public function loadAJAX(Request $request)
    {
        // Read value
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
        $totalRecords           = GoodsReceipt::count();
        $totalRecordswithFilter = GoodsReceipt::where('input_date', 'like', "%$searchValue%")->count();
        if ($columnName == 'supplier_name') {$columnName = 'supplier_id';}
        // Fetch records
        $goodsReceipt = GoodsReceipt::orderBy($columnName, $columnSortOrder)
        ->where('input_date', 'like', "%$searchValue%")
        ->skip($start)
        ->take($rowperpage)
        ->get();
        
        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData"               => $goodsReceipt,
            "columnName"           => $columnName,
            "columnSortOrder"      => $columnSortOrder

        );

        echo json_encode($response);
        exit;
    }

    public function loadAJAXSearchAccessories(Request $request)
    {
        // Read value
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
        $totalRecords           = GoodsReceipt::count();
        $totalRecordswithFilter = GoodsReceipt::where('accessory_code', 'like', "%$searchValue%")->count();

        // Fetch records
        $product = GoodsReceipt::orderBy($columnName, $columnSortOrder)
        ->where('accessory_code', 'like', "%$searchValue%")
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

    public function getAccessoryAjax(Request $request){
        $accessory = Accessory::find($request->id);
        return response()->json([
            "accessory" => $accessory,
            "msg"  => "Ok get accessory"
        ]);
    }
    
    public function getSupplierCodeAjax(Request $request){
        $supplier = Supplier::find($request->id);
        return response()->json([
            "supplier" => $supplier,
            "msg"  => "Ok get supplier"
        ]);
    }
}

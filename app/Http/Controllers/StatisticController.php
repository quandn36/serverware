<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessory;
use App\Models\GoodsReceipt;
use App\Models\InvoiceDetail;
use App\Models\Invoice;

class StatisticController extends Controller
{
    private $viewFolder = 'statistic';

    public function accessoriesIndex()
    {
        $pageInfo = [
            'page' => $this->viewFolder,
            'namepage' => "Accessories"
        ];
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
    }

    public function getIDAccessoriesInput($goodsReceipts){
        $arrID = [];
        foreach ($goodsReceipts as $receipt) {
            foreach (json_decode($receipt->accessories) as $id => $quantity) {
                  $arrID[] = (int)$id;
            }
        }
        return  $arrID;
    }

    public function getQuantityAccessoriesInput($goodsReceipts, $idInput){
        $totalQuantity = 0;
        foreach ($goodsReceipts as $receipt) {
            foreach (json_decode($receipt->accessories) as $id => $quantity) {
                if ((int)$id == (int)$idInput) {
                    $totalQuantity = $totalQuantity + (int)$quantity;
                }
            }
        }
        return $totalQuantity;
    }

    public function getQuantitySale($invoices, $idCheck){
        $totalQuantity = 0;
        if (!empty($invoices)) {
            foreach ($invoices as $invoice) {
                $invoiceDetail = InvoiceDetail::where('invoice_id',$invoice->id)->first();
                $details = json_decode($invoiceDetail->detail);
                foreach ($details as $detail) {
                    $accessories =  $detail->accessories;
                    foreach($accessories as $json_accessory){
                        $accessory = json_decode($json_accessory);
                        if(!empty($accessory)){
                            if(is_array($accessory)){
                                foreach($accessory as $accessory){
                                    if ($accessory->accessory_id == $idCheck) {
                                       $totalQuantity = $totalQuantity+$accessory->accessory_qty;
                                    } 
                                }
                            }
                            else{
                                $totalQuantity = $totalQuantity+ $accessory->accessory_qty;
                            }
                        }  
                    }                                       
                }                                                   
            }
        }
        return $totalQuantity;
    }

    public function createQuickAccessories(Request $request)
    {   
        $data = [];
        if (isset($request->quick_select)) {
           $selected = $request->quick_select;
        }
        else {
            $selected = [
                'fromDate' => $request->fromDate,
                'toDate'   => $request->toDate
            ];
        }
       
        if(is_array($selected)) {
            if (strtotime($selected['fromDate']) <= strtotime($selected['toDate'])) {
               $fromDate = date('d-m-Y',strtotime($selected['fromDate']));
               $toDate   = date('d-m-Y',strtotime($selected['toDate']));
               $data     = $this->getStatistic($fromDate,$toDate);
            }
            //else fromDate > toDate => error => data []
        }
        else {
            if ($selected == "yesterday") {
                $yesterday    = $this->getDateFilter($selected);
                $yesterday_24 = $yesterday."23:59:59";
                $data         = $this->getStatistic($yesterday,$yesterday_24);
            }
            elseif ($selected == "lastweek") {
                $now      = date('d-m-Y');
                $lastweek = $this->getDateFilter($selected);
                $data     = $this->getStatistic($lastweek,$now);
            }
            elseif ($selected == "lastmonth") {
                $now       = date('d-m-Y');
                $lastmonth = $this->getDateFilter($selected);
                $data      = $this->getStatistic($lastmonth,$now);
            }

        }

        return response()->json([
            "status" => "ok",
            "data"   => $data 
        ]);
    }

    public function getDateFilter($selected){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now    = date('d-m-Y');
        $filter = '';
        if ($selected == 'yesterday') {
            $kq        = date_modify(date_create($now), '-1 day');
            $yesterday = date_format($kq,'d-m-Y');
            $filter    = $yesterday;
        }
        elseif ($selected == 'lastweek') {
            $kq       = date_modify(date_create($now), '-7 day');
            $lastweek = date_format($kq,'d-m-Y');
            $filter   = $lastweek;
        }
        elseif ($selected == 'lastmonth') {
            $kq        = date_modify(date_create($now), '-30 day');
            $lastmonth = date_format($kq,'d-m-Y');
            $filter    = $lastmonth;
        }
        return $filter;
    }

    public function getStatistic($fromDate, $toDate){
        $goodsReceipts = GoodsReceipt::whereBetween('input_date',[date_create($fromDate),date_create($toDate)])->get();
        $invoices      = Invoice::where('status',3)->whereBetween('created_at',[date_create($fromDate),date_create($toDate)])->get();
        $accessories   = Accessory::all();
        if (!empty($goodsReceipts)) {
            $idAccessoriesInputs = $this->getIDAccessoriesInput($goodsReceipts);
            foreach ($accessories as $accessory ) {
                if (in_array( $accessory->id, $idAccessoriesInputs)) {
                    $item = [
                        'parent_category_name' => $accessory->parent_category_name,
                        'category_name'        => $accessory->category_name,
                        'accessory_code'       => $accessory->accessory_code,
                        'name'                 => $accessory->name,
                        'quantity_in_stock'    => $accessory->quantity_in_stock,
                        'input_quantity'       => $this->getQuantityAccessoriesInput($goodsReceipts,$accessory->id),
                        'sale'               => $this->getQuantitySale($invoices,$accessory->id)
                    ];
                    $data[] = $item;
                }
                else {
                    $item = [
                        'parent_category_name' => $accessory->parent_category_name,
                        'category_name'        => $accessory->category_name,
                        'accessory_code'       => $accessory->accessory_code,
                        'name'                 => $accessory->name,
                        'quantity_in_stock'    => $accessory->quantity_in_stock,
                        'input_quantity'       => 0,
                        'sale'                 => $this->getQuantitySale($invoices,$accessory->id)
                    ];
                    $data[] = $item;
                } 
            }
        }
        else {
            foreach ($accessories as $accessory ) {
                $item = [
                    'parent_category_name' => $accessory->parent_category_name,
                    'category_name'        => $accessory->category_name,
                    'accessory_code'       => $accessory->accessory_code,
                    'name'                 => $accessory->name,
                    'quantity_in_stock'    => $accessory->quantity_in_stock,
                    'input_quantity'       => 0,
                    'sale'                 => $this->getQuantitySale($invoices,$accessory->id)
                ];
                $data[] = $item;
            }
        }
        return $data;
    }
}

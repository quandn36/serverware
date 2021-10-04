<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Customer;

class InvoiceController extends Controller
{   
    private $viewFolder = 'invoice';

    public function index()
    {
        return view(config('template.homeTemplateBladeURL').'check-out');
    }

    public function cmsList()
    {
        $pageInfo = [
            'page'  => $this->viewFolder
        ];
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
    }
    public function cmsDetail($id)
    {   $invoice = Invoice::find($id);
        if ($invoice != null) {
            $pageInfo = [
                'subtitle'  => 'Detail',
                'page'  => $this->viewFolder
            ];
            $invoiceDetail = InvoiceDetail::where('invoice_id', $invoice->id)->first();
            return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.detail", compact('invoice', 'pageInfo', 'invoiceDetail'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        if(session('billingInvoice')){  unset($billingInvoice);}
        $checkOut = [
            'name'          => $request->name,
            'email'         => $request->email,
            'company'       => $request->company,
            'address_1'     => $request->address1,
            'address_2'     => $request->address2,
            'address_3'     => $request->address3,
            'city'          => $request->city,
            'state'         => $request->state,
            'zip'           => $request->zip,
            'country'       => $request->country,
            'telephone'     => $request->telephone,
            'delivery_type' => $request->delivery_type,
            'total_price'   => $request->total_price,
            'comment'       => $request->comment
        ];
        session(['billingInvoice' => $checkOut]);
        return view(config('template.homeTemplateBladeURL').'confirm-check-out');
    }

    public function store(Request $request)
    {   
        $infor   = session('billingInvoice');
        $invoice = Invoice::create([
            'user_id'       => $request->user_id,
            'name'          => $infor['name'],
            'email'         => $infor['email'],
            'company'       => $infor['company'],
            'address_1'     => $infor['address_1'],
            'address_2'     => $infor['address_2'],
            'address_3'     => $infor['address_3'],
            'city'          => $infor['city'],
            'state'         => $infor['state'],
            'zip'           => $infor['zip'],
            'country'       => $infor['country'],
            'telephone'     => $infor['telephone'],
            'delivery_type' => $infor['delivery_type'],
            'total_price'   => $infor['total_price'],
            'comment'       => $infor['comment']
        ]);
        $status = "error";
        $message = "Have error while creating new Brand.";
        if ($invoice != null) {
            $detailCart = session('cart');
            if($this->storeInvoiceDetail($invoice->id, $detailCart)){
                session(['cart' => []]);
                //$status  = "success";
                //$message = "Create new Brand successfully.";
                return view(config('template.homeTemplateBladeURL').'success-check-out');
            };
        }
        //return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }
   
    public function storeInvoiceDetail($id, $detailCart){
        $detail = [];
        foreach ($detailCart as $details) {
           $item     = [
            'name'         => $details['name'],
            'cover_image'  => $details['cover_image'],
            'price_config' => $details['price_config'],
            'quantity'     => $details['quantity'],
            'accessories'  => $details['accessories']
           ];
           $detail[] = $item;
        }
        $invoiceDetail = InvoiceDetail::create([
            'invoice_id' => $id,
            'detail'     => json_encode($detail)
        ]);
        if ($invoiceDetail != null) {
            return true;
        }
        else {
            return false;
        }
    }

    public function checkUser(Request $request)
    {
        $user = Customer::where('email', $request->email)->first();
        $msg = "valid";
        if ($user != null) {
            return response()->json([
            "msg"   => $msg,
            "user"  => $user 
            ]);
        }
        else {
            $msg = "Invalid email";
            return response()->json([
                "msg"   => $msg,
                "user"  => $user 
            ]);
        }
    }

    public function edit($id)
    {
        //
    }

    public function updateAjax(Request $request)
    {
        $invoice = Invoice::find($request->id);
        if ($invoice != null) {
           $invoice->status = $request->status;
           $invoice->save();
            return response()->json([
            "title"     => "Update invoice",
            "status"    => "success",
            "msg"       => "Update invoice successfully."
             ]);

        }
        return response()->json([
            "title"     => "Update invoice",
            "status"    => "error",
            "msg"       => "Have error while updating."
        ]);
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if ($invoice != null) {
            $invoice->status = $request->status;
            $invoice->save();
            $status  = "success";
            $message = "Update product successfully.";
            return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
        } 
    }
    
    public function destroy(Request $request)
    {
        $id = $request->id;
        $invoice = Invoice::find($id);
        if ($invoice != null) {
            $invoice->delete();
            return response()->json([
                "title"     => "DELETE product",
                "status"    => "success",
                "msg"       => "Delete invoice successfully."
            ]);
        }
        return response()->json([
            "title"     => "DELETE invoice",
            "status"    => "error",
            "msg"       => "Have error while deleting invoice."
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
        $totalRecords           = Invoice::count();
        $totalRecordswithFilter = Invoice::where('created_at', 'like', "%$searchValue%")->count();

        // Fetch records
        $product = Invoice::orderBy($columnName, $columnSortOrder)
        ->where('created_at', 'like', "%$searchValue%")
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
}

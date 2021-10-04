<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    private $viewFolder = 'supplier';

    public function index()
    {
        $pageInfo = [
            'page' => $this->viewFolder
        ];
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
    }

    public function create()
    {
        $pageInfo = [
            'subtitle'  => 'Add new',
            'page'      => $this->viewFolder
        ];

        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.create", compact('pageInfo'));
    }

    public function store(Request $request)
    {  
        $supplier = Supplier::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'supplier_code' => $request->supplier_code,
            'address'       => $request->address,
            'telephone'     => $request->telephone,
        ]);

        $status = "error";
        $message = "Have error while creating new Supplier.";

        if ($supplier != null) {
            $status  = "success";
            $message = "Create new Supplier successfully.";
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function edit($id)
    {   
        $supplier = Supplier::find($id);
        $pageInfo = [
            'subtitle'  => 'Edit',
            'page'      => $this->viewFolder
        ];
        if ($supplier != null) {
            return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.edit", compact('supplier', 'pageInfo'));
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', 'error')->with('message', 'Supplier is not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $status = "error";
        $message = "Have error while updating Supplier.";
        if ($supplier != null) {
          $supplier->name      = $request->name;
          $supplier->address   = $request->address;
          $supplier->telephone = $request->telephone;
          $supplier->save();
          $status = "success";
          $message = "Update Supplier successfully.";
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $supplier = Supplier::find($id);
        if ($supplier != null) {
            $supplier->delete();
            return response()->json([
                "title"     => "DELETE Supplier",
                "status"    => "success",
                "msg"       => "Delete Supplier successfully."
            ]);
        }
        return response()->json([
            "title"     => "DELETE Supplier",
            "status"    => "error",
            "msg"       => "Have error while deleting Supplier."
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
        $totalRecords           = Supplier::count();
        $totalRecordswithFilter = Supplier::where('name', 'like', "%$searchValue%")->count();

        // Fetch records
        $product = Supplier::orderBy($columnName, $columnSortOrder)
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

    public function checkUnique(Request $request){
        $validator = $request->validate(['supplier_code' => 'unique:suppliers']);
        return true;
    }
}

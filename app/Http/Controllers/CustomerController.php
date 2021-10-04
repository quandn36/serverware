<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAccountCmsUser;
use App\Http\Requests\DataCreateAccountRequest;
use App\Models\Customer;
use Hash;

class CustomerController extends Controller
{
// --------------------| load view list customer |---------------------
    private $viewFolder = 'customers';
    public function index() {
        $pageInfo = [
            'page' => $this->viewFolder
        ];
        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.list", compact('pageInfo'));
    }

// --------------------| load view add new customer |---------------------
    public function create()
    {
        $pageInfo = [
            'subtitle'  => 'Add new',
            'page'      => $this->viewFolder
        ];

        return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.create", compact('pageInfo'));
    }

// -----------------------|save new customer into database|---------------------
    public function store(CreateAccountCmsUser $request)
    {
        $customer = Customer::create([

            'name'      => trim($request->name),
            'email'     => trim($request->email),
            'company'   => trim($request->company),
            'password'  => Hash::make($request->password),

        ]);

        $status = "error";
        $message = "Have error while creating new customer.";

        if ($customer != null) {
            $status  = "success";
            $message = "Create new customer successfully.";
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }


// -----------------------|edit customer|---------------------
    public function edit($id)
    {
        $customer = Customer::find($id);
        $pageInfo = [
            'subtitle'  => 'Edit',
            'page'      => $this->viewFolder
        ];
        if ($customer != null) {
            return view(config('template.cmsTemplateBladeURL') . "{$this->viewFolder}.edit", compact('customer', 'pageInfo'));
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', 'error')->with('message', 'customer is not found');
    }

// -----------------------|edit customer|---------------------
    public function update(DataCreateAccountRequest $request, $id)
    {
        $customer = Customer::find($id);
        $status = "error";
        $message = "Have error while updating customer.";
        if ($customer != null) {
          $customer->name           = trim($request->name);
          $customer->email          = trim($request->email);
          $customer->company        = trim($request->company);

          ## save customer to the database
          $customer->save();
          $status = "success";
          $message = "Update customer successfully.";
      }
      return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function resetPassword(Request $request)
    {
        if($request->password === $request->re_password ){
            $customer = Customer::find($request->id);

            $status = "error";
            $message = "Have error while updating password.";
            if ($customer != null) {
              $customer->password =  Hash::make($request->password);
              $customer->save();
              $status = "success";
              $message = "Update password successfully.";
          }
          return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
        }
        return redirect()->route("{$this->viewFolder}.list")->with('status', 'danger')->with('message', 'Confirmation password is not the same');
        
    }

// -----------------------|delete customer|---------------------
    public function destroy(Request $request)
    {
        $id = $request->id;
        $customer = Customer::find($id);
        if ($customer != null) {
            $customer->delete();
            return response()->json([
                "title"     => "DELETE customer",
                "status"    => "success",
                "msg"       => "Delete customer successfully."
            ]);
        }
        return response()->json([
            "title"     => "DELETE customer",
            "status"    => "error",
            "msg"       => "Have error while deleting customer."
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
        $totalRecords           = Customer::count();
        $totalRecordswithFilter = Customer::where('email', 'like', "%$searchValue%")->count();

        // Fetch records
        $customer = Customer::orderBy($columnName, $columnSortOrder)
                ->where('email', 'like', "%$searchValue%")
                ->skip($start)
                ->take($rowperpage)
                ->get();
        
        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData"               => $customer
        );

        echo json_encode($response);
        exit;
    }
}

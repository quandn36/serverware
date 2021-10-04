<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer;

class Invoice extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['id', 'user_id', 'name', 'email', 'company', 'address_1', 'address_2','address_3', 'city', 'state', 'zip','status', 'country', 'telephone', 'delivery_type', 'total_price', 'comment'];
   
    protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	  ];
	protected $appends = ['action', 'status_name', 'code_invoice', 'user_name'];

	public function getActionAttribute(){
	    $action = '<div style="display:flex;">'.
	    '<a href="'. route('invoice.detail', ['id' => $this->id]) .'" class="btn btn-warning waves-effect waves-light" style="margin-right:5%;"><i class="fa fa-eye"></i></a>'.
	    '</div>';
    	return $action; 
  	}

  	public function getCodeInvoiceAttribute(){
	    $codeInvoice = "HD-".$this->id;
    	return $codeInvoice; 
  	}

  	public function getUserNameAttribute(){
      $user = Customer::find($this->user_id);
      return $user->name; 
    }

  	public function getStatusNameAttribute(){
  		$name = '';
  		$html = '';
	    if ($this->status == 0) {
	    	$name = 'New';
	    }
	    else if($this->status == 1){
	    	$name = 'Approved';
	    }
	    else if($this->status == 2){
	    	$name = 'Delivery in progress';
	    }
	    else if($this->status == 3){
	    	$name = 'Delivered';
	    }
	    else {
	    	$name = 'Canceled';
	    }
	    $option = ['New', 'Approved', 'Delivery in progress', 'Delivered', 'Canceled'];
	    if ($name == 'Delivered') {
	    	$html = 'Delivered';
	    }
	    else 
	    {
	    	$html.= '<select id="'.$this->id.'" class="form-control form-control-sm select-status">';
	    	foreach ($option as $key => $status) {
	    		if($status == $name){
	    			$html.= '<option selected value="'.$key.'">'. $status.'</option>';
	    		}
	    		else {
	    			$html.= '<option  value="'.$key.'">'. $status.'</option>';
	    		}
	    	}
	    	$html.= '</select>';
	    }
  			
    	return $html; 
  	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Supplier;

class GoodsReceipt extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'goods_receipt_code', 'input_date', 'supplier_id', 'accessories', 'total_price', 'shipping_fee', 'total_money', 'note'];

    protected $casts = [
  		'created_at' => 'datetime:Y-m-d H:i:s',
      'input_date' => 'date:m-d-Y'
	  ];
    
    protected $appends = ['action', 'supplier_name', 'cast_input_date'];
    
    public function getActionAttribute(){
      $action = '<div style="display:flex;">'.
      '<a href="'. route('goods-receipt.edit', ['id' => $this->id]) .'" class="btn btn-warning waves-effect waves-light" style="margin-right:5%;"><i class="fas fa-edit"></i></a>'.
      '<a href="javascript:void;" class="btn btn-secondary waves-effect waves-light btn-delete" data-id="'.$this->id.'" data-title="'.$this->goods_receipt_code.'"><i class="fas fa-trash-alt"></i></a>'.
      '</div>';
      return $action; 
    }

    public function getSupplierNameAttribute(){
      $supplier = Supplier::find($this->supplier_id);
      return $supplier->name; 
    }

    public function getCastInputDateAttribute(){
      $tg = strtotime($this->input_date);
      $inputDate = date("Y-m-d",$tg);
      return $inputDate; 
    }
}

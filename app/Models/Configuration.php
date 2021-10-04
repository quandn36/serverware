<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Configuration extends Model
{
    
    use SoftDeletes;
    protected $fillable = ['id', 'id_config', 'id_product', 'name_config', 'input_type'];
    protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	  ];

  	protected $appends = ['action', 'product_name'];
    public function getActionAttribute(){
        $action = '<div style="display:flex;">'.
                  '<a href="'. route('configuration.edit', ['id' => $this->id]) .'" class="btn btn-warning waves-effect waves-light" style="margin-right:5%;"><i class="fas fa-edit"></i></a>'.
                  '<a href="javascript:void;" class="btn btn-secondary waves-effect waves-light btn-delete" data-id="'.$this->id.'" data-title="'.$this->name.'"><i class="fas fa-trash-alt"></i></a>'.
                  '</div>';
        return $action;
    }

    public function getProductNameAttribute(){
        $product = Product::find($this->id_product);
        $name    = $product->product_name;
        return $name;
    }
}

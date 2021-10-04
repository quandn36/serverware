<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConfiguration extends Model
{
  protected $fillable = ['id','product_id','accessory_id', 'quantity','price'];
  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
  ];
  
}

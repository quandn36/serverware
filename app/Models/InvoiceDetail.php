<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['id', 'invoice_id', 'detail'];
   
    protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	  ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupConfig extends Model
{
    use SoftDeletes;
    protected $fillable = ['id_config', 'name_group_config', 'item'];
    protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	  ];
}

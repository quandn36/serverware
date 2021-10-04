<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CategoryTree extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','name'];
    protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	  ];

  	protected $appends = ['action'];
    public function getActionAttribute(){
        $action = '<div style="display:flex;">'.
                  '<a href="'. route('categorytree.edit', ['id' => $this->id]) .'" class="btn btn-warning waves-effect waves-light" style="margin-right:5%;"><i class="fas fa-edit"></i></a>'.
                  '<a href="javascript:void;" class="btn btn-secondary waves-effect waves-light btn-delete" data-id="'.$this->id.'" data-title="'.$this->name.'"><i class="fas fa-trash-alt"></i></a>'.
                  '</div>';
        return $action; 
    }

}

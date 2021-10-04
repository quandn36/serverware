<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Category;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['id', 'name', 'price', 'price_config','category_id', 'is_popular', 'drive_bay_size', 'qty_drive', 'slug', 'description', 'cover_image','seo_metadata'];
   
    protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	  ];

    protected $appends = ['action', 'parent_category_name', 'parent_category_id', 'category_name'];

    public function getActionAttribute(){
      $action = '<div style="display:flex;">'.
      '<a href="'. route('product.edit', ['id' => $this->id]) .'" class="btn btn-warning waves-effect waves-light" style="margin-right:5%;"><i class="fas fa-edit"></i></a>'.
      '<a href="javascript:void;" class="btn btn-secondary waves-effect waves-light btn-delete" data-id="'.$this->id.'" data-title="'.$this->name.'"><i class="fas fa-trash-alt"></i></a>'.
      '</div>';
      return $action; 
    }
    public function getCategoryNameAttribute(){
      $category = Category::find($this->category_id);
      $categoryName = $category->name;
      return $categoryName; 
    }

    public function getParentCategoryNameAttribute(){
      $category = Category::find($this->category_id);
      $parent =Category::find($category->parent_category_id);
      if ($parent != null) {
        return $parent->name;
      }
       
    }

    public function getParentCategoryIdAttribute(){
      $category = Category::find($this->category_id);
      $parent =Category::find($category->parent_category_id);
      if ($parent != null) {
        return $parent->id;
      }
       
    }
}

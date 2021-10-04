<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessory;
use App\Models\Category;


class AccessoryCategory extends Model
{
  use SoftDeletes;
  protected $fillable = ['id','name','parent_category_id', 'product_category_id','slug','image', 'type_of_select'];
  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
  ];

  protected $appends = ['action', 'category_name', 'category_name_product'];
  public function getActionAttribute(){
    $action = '<div style="display:flex;">'.
    '<a href="'. route('accessory-category.edit', ['id' => $this->id]) .'" class="btn btn-warning waves-effect waves-light" style="margin-right:5%;"><i class="fas fa-edit"></i></a>'.
    '<a href="javascript:void;" class="btn btn-secondary waves-effect waves-light btn-delete" data-id="'.$this->id.'" data-title="'.$this->name.'"><i class="fas fa-trash-alt"></i></a>'.
    '</div>';
    return $action; 
  }

  public function categories()
  {
    return $this->hasMany(AccessoryCategory::class, 'parent_category_id');
  }

  public function childrenCategories()
  {
    return $this->hasMany(AccessoryCategory::class, 'parent_category_id')->with('categories');
  }
  
  public function getCategoryNameAttribute(){
        $category = AccessoryCategory::find($this->parent_category_id);
        if ($category) {
         return $categoryName = $category->name;
        }
        else {
          return $categoryName = "THIS IS THE NODE";
        }  
  }
  
  public function getCategoryNameProductAttribute(){
      $proids = json_decode($this->product_category_id);
      $stringNameProduct = '';
      if (is_array($proids) && !empty($proids)) {
        foreach ($proids as $proid) {
         $productcategory = Category::find($proid);
          if ($productcategory != null) {
            $stringNameProduct .= '- '.$productcategory->name.'</br>';
          }
        }
      }
      return $stringNameProduct;
    }
}

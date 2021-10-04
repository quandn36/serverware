<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\AccessoryCategory;

class Accessory extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','name', 'accessory_code', 'category_id','price', 'cover_image', 'slug', 'attributes', 'quantity_in_stock'];

    protected $casts = [
  		'created_at' => 'datetime:Y-m-d H:i:s'
	  ];

  	protected $appends = ['action', 'parent_category_name', 'category_name','product_category_name', 'add', 'format_price'];
    
    public function getActionAttribute(){
        $action = '<div style="display:flex;">'.
                  '<a href="'. route('accessory.edit', ['id' => $this->id]) .'" class="btn btn-warning waves-effect waves-light" style="margin-right:5%;"><i class="fas fa-edit"></i></a>'.
                  '<a href="javascript:void;" class="btn btn-secondary waves-effect waves-light btn-delete" data-id="'.$this->id.'" data-title="'.$this->name.'"><i class="fas fa-trash-alt"></i></a>'.
                  '</div>';
        return $action; 
    }

    public function getFormatPriceAttribute(){
        $price = '$'.number_format($this->price, 2);
        return $price; 
    }

    public function getAddAttribute(){
        $add = '<div style="display:flex;">'.
                  '<button onclick="addItem('.$this->id.')" type="button" class="btn btn-warning waves-effect waves-light add-acc" style="margin-right:5%;"><i class="fas fa-plus-square"></i></i></button></div>';
        return $add;
    }

    public function category()
    {
      $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function getCategoryNameAttribute(){
        $category = AccessoryCategory::find($this->category_id);
        if ($category != null) {
          $name = $category->name;
          return $name;
        }
       
    }
   

    public function getParentCategoryNameAttribute(){
        $category = AccessoryCategory::find($this->category_id);
        $parent = null;
        if ($category != null) {
          $parent = AccessoryCategory::find($category->parent_category_id);
        }
        if ($parent != null) {
          return $parent->name;
        }
        
    }
    /**
     * @Ngocquan
     * truy van lay ten danh muc san pham trong bang product category 
     */
    public function getProductCategoryNameAttribute(){
      $category = AccessoryCategory::find($this->category_id);
      $parent   = null;
      if ($category != null) {
        $parent = AccessoryCategory::find($category->parent_category_id);
      }
      $stringNameProduct = '';
      if ($parent != null) {
        $proids = json_decode($parent->product_category_id);
        if (is_array($proids) && !empty($proids)) {
          foreach ($proids as $proid) {
           $productcategory = Category::find($proid);
            if ($productcategory != null) {
              $stringNameProduct .= '- '.$productcategory->name.'</br>';
            }
          }
        }
      }
      return $stringNameProduct;
    }
}

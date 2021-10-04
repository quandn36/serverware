<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use SoftDeletes;
  
  protected $fillable = [
    'id',
    'name',
    'short_name',
    'code',
    'parent_category_id',
    'accessory_category_id',
    'slug',
    'short_name_description',
    'long_description',
    'cover_image',
    'brand_image_logo',
    'image_banner_category',
    'menu_status',
  ];

  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
  ];

  protected $appends = [
    'action',
    'category_name',
    'category_slug',
    'image',

  ];

  public function getActionAttribute()
  {
    $action = '<div style="display:flex;">'.
    '<a href="'. route('product-categories.edit', ['id' => $this->id]) .'" class="btn btn-warning waves-effect waves-light" style="margin-right:5%;"><i class="fas fa-edit"></i></a>'.
    '<a href="javascript:void;" class="btn btn-secondary waves-effect waves-light btn-delete" data-id="'.$this->id.'" data-title="'.$this->name.'"><i class="fas fa-trash-alt"></i></a>'.
    '</div>';
    return $action; 
  }

  public function categories()
  {
    return $this->hasMany(Category::class, 'parent_category_id');
  }

  public function childrenCategories()
  {
    return $this->hasMany(Category::class, 'parent_category_id')->with('categories');
  }



// get name parent category
  public function getCategoryNameAttribute()
  {
    $category = Category::find($this->parent_category_id);

    if($category == true) {
      $CategoryName = $category->name;
    }else {
      $CategoryName = "THIS IS THE NODE";
    }
    return $CategoryName;
  }
  // get name parent category
  public function getCategorySlugAttribute()
  {
    $category = Category::find($this->parent_category_id);

    if($category == true) {
      $categorySlug = $category->slug;
    }else {
      $categorySlug = "";
    }
    return $categorySlug;
  }


  //get url image category in Database
  public function getImageAttribute()
  {
    $images = json_decode($this->cover_image);

    if($images->url != null) {
      $image = '<img alt="'. $images->alt_text_image .'" style="width:50px; border-radius:2px;" src="'. asset($images->url) .'"></img>';
    }else {
      $image = '<img alt="'. $images->alt_text_image .'" style="width:50px; border-radius:2px;" src="'. asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') .'"></img>';
    }
    return $image; 
  }

}

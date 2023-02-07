<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable=['image_name','category_id','product_id'];

    //image is belongs to the category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //image is also belong to the products
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

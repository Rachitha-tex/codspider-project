<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $fillable=['category_name','slug','status'];

    //catgeory can have many products
    public function products(){
        return $this->hasMany(Product::class);
    }

    //catgeory can have many images
    public function images(){
        return $this->hasMany(Image::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image'];



    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_in_order', 'product_id', 'order_id')
            ->withPivot('count');
    }

    public function category()
    {
        return $this->belongsTo(CategoryType::class, 'category_type');
    }


}

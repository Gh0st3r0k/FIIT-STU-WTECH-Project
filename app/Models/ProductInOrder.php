<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInOrder extends Model
{
    protected $table = 'product_in_order';
    public $timestamps = false;

    protected $fillable = ['order_id', 'product_id', 'count'];
}

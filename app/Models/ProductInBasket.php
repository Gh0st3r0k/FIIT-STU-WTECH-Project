<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInBasket extends Model
{
    protected $table = 'product_in_basket';
    public $timestamps = false;

    protected $fillable = ['id_basket', 'id_product', 'count'];
}

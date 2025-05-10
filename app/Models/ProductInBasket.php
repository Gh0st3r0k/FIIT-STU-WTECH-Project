<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInBasket extends Model
{
    protected $fillable = ['id_basket', 'id_product', 'count'];
}

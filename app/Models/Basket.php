<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'basket';
    public $timestamps = false;

    protected $fillable = ['id_basket', 'id_product', 'count'];
}
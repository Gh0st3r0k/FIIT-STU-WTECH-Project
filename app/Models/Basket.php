<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'basket';
    public $timestamps = false;

    protected $fillable = ['id_user', 'id_non_user'];
}
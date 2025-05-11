<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    protected $table = 'category_type';
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_type');
    }
}
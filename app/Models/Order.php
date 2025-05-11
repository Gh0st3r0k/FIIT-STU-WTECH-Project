<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'non_user_id',
        'address', 'phone',
        'status', 'delivery_method',
        'payment_method', 'created_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nonUser()
    {
        return $this->belongsTo(UserNonRegistration::class, 'non_user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_in_order', 'order_id', 'product_id')
                    ->withPivot('count');
    }
    
}

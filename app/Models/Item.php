<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'availability',        
    ];
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function orderItems()
    {
        return $this->belongsTo(OrderItem::class);
    }

     public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderItem::class, 'item_id', 'id', 'id', 'order_id');
    }
}

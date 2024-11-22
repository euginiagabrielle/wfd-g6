<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    public $incrementing = false;

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

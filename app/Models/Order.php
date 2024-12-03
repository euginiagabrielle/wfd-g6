<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = false;
      protected $fillable = ['table_number', 'total_price', 'status'];
     public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

      public function items()
    {
        return $this->hasManyThrough(Item::class, OrderItem::class, 'order_id', 'id', 'id', 'item_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'value',
        'minimum',
        'item_id',
    ];
     public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

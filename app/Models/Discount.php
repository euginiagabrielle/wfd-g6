<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'value',
        'minimum',
        'item_id',
    ];
     public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}

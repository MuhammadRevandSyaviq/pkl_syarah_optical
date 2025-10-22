<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id','type','quantity','reason','note',
        'before_stock','after_stock','moved_at',
    ];

    protected $casts = [
        'quantity'     => 'integer',
        'before_stock' => 'integer',
        'after_stock'  => 'integer',
        'moved_at'     => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'product_id','quantity','unit_price','total_price',
        'customer_name','note','sold_at',
    ];

    protected $casts = [
        'quantity'    => 'integer',
        'unit_price'  => 'float',
        'total_price' => 'float',
        'sold_at'     => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

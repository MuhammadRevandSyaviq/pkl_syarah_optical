<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','sku',
        'category_id',      // <-- baru
        'category',         // string lama, diisi otomatis dari category_id
        'brand','price',
        'stock_quantity','min_stock',
        'description',
    ];

    protected $casts = [
        'price'          => 'float',
        'stock_quantity' => 'integer',
        'min_stock'      => 'integer',
    ];

    public function categoryRef()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function sales()
    {
        return $this->hasMany(\App\Models\Sale::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(\App\Models\StockMovement::class);
    }
}

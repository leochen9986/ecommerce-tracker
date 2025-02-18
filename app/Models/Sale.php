<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'sale_price',
        'cost_per_unit',
        'transaction_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;


class SalesOrderItem extends Model
{
    protected $fillable = ['sales_order_id', 'product_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

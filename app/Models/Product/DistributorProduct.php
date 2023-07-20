<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'stock_on_hand',
        'lot_number',
        'goods_in_transit',
        'stock_on_order',
        'avg_sales',
        'overstocked',
    ];

    public function distributor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function request()
    {
        return $this->hasMany(Request::class, 'gin_no');
    }
}

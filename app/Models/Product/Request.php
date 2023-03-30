<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'from_distributor',
        'to_distributor',
        'gin_no',
        'quantity',
        'status',
    ];

    public function fromDistributor()
    {
        return $this->belongsTo(User::class, 'from_distributor');
    }

    public function toDistributor()
    {
        return $this->belongsTo(User::class, 'to_distributor');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'gin_no');
    }

    protected $casts = [
        'created_at' => 'datetime',
    ];
}

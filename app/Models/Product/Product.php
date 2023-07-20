<?php

namespace App\Models\Product;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'GIN',
        'lot_no',
        'description',
        'UOM',
        'category',
        'status',
        'country_code',
        'created_by',
        'updated_by',
    ];

    public function disProduct()
    {
        return $this->hasMany(DistributorProduct::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }

    // public function request()
    // {
    //     return $this->hasMany(Request::class, 'gin_no');
    // }
}

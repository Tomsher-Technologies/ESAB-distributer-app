<?php

namespace App\Models\Product;

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
    ];
}

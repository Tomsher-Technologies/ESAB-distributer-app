<?php

namespace App\Models\Distributor;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Distributor extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'user_id',
        'company_name',
        'phone',
        'address',
        'country_code',
        'manager_id',
        'distributer_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }
}

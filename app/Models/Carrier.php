<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $fillable = [
        'name', // Nome da transportadora
    ];

    public function shippingMethods()
    {
        return $this->hasMany(ShippingMethod::class, 'carriers_id', 'id');
    }
}

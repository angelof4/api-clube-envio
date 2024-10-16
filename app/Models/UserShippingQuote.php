<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserShippingQuote extends Model
{
    // Define o relacionamento com a model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Define o relacionamento com a model ShippingMethod
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'id');
    }

    // Se houver um relacionamento com VtexShippingRates, adicione conforme necessário
    public function vtexShippingRates()
    {
        return $this->hasMany(VtexShippingRate::class, 'quote_id', 'id');
    }
}

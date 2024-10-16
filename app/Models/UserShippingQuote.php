<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserShippingQuote extends Model
{


    protected $fillable = ['user_id', 'quote_value', 'shipping_method_id'];

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


    public function scopeRegisterUserShippingRate($query, $userId, $quotas)
    {
        foreach ($quotas as $key => $quota) {
            $query->create([
                'user_id' => $userId,
                'shipping_method_id' => $quota->shippingMethod->id,
                'quote_value' => $quota->value,
            ]);
        }
    }

    public function scopeGetQuoteByUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}

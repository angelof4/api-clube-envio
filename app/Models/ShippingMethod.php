<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{

    // Caso a tabela tenha um nome diferente do pluralizado
    protected $table = 'shipping_methods';

    // Caso você tenha colunas que não são incrementais
    protected $fillable = ['method_name'];

    // Define o relacionamento com Carrier
    public function carrier()
    {
        return $this->belongsTo(Carrier::class, 'carriers_id', 'id');
    }

    public function shippingRates()
    {
        return $this->hasMany(VtexShippingRate::class, 'shipping_method_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VtexShippingRate extends Model
{
    use HasFactory;

    protected $table = 'vtex_shipping_rates'; // Nome da tabela

    protected $fillable = [
        'shipping_method_id', // id_serviço
        'delivery_time', // prazo_entrega
        'initial_weight', // peso_inicial
        'final_weight', // peso_final
        'value', // valor
        'start_zipcode', // cep_inicio
        'end_zipcode', // cep_final
        'created_at',
        'updated_at'
    ];

    // Define o relacionamento com a model ShippingMethod
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'id');
    }

    // Define o relacionamento com UserShippingQuote, se necessário
    public function userShippingQuotes()
    {
        return $this->hasMany(UserShippingQuote::class, 'quote_id', 'id');
    }
}


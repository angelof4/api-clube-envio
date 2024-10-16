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

    /**
     * Obtem preço de cotaçao baseado no peso e ceps informados
     * @param mixed $query // a model
     * @param mixed $weight // peso do produto
     * @param mixed $cepStart // cep de inicio 
     * @param mixed $cepFinal // cep de entrega
     * @return mixed
     */
    public function scopeGetQuote($query, $weight, $cepStart, $cepFinal)
    {

        return $query->where('initial_weight', '<=', $weight)
            ->where('final_weight', '>=', $weight)
            ->where('start_zipcode', '>=', $cepStart)
            ->where('end_zipcode', '<=', $cepFinal)
            ->with('shippingMethod');
    }



}


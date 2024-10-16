<?php

namespace App\Http\Controllers;

use App\Models\UserShippingQuote;
use App\Models\VtexShippingRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    public function getQuote(Request $request)
    {
        // Validação
        $validator = Validator::make($request->all(), [
            'peso' => 'required|numeric|min:0', // Peso deve ser numérico e maior ou igual a zero
            'cep_inicio' => 'required|string|size:8', // CEP deve ser uma string de 8 caracteres
            'cep_destino' => 'required|string|size:8', // CEP deve ser uma string de 8 caracteres

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400); // Retorna os erros de validação com código 400
        }

        $Vtex = VtexShippingRate::getQuote($request->peso, $request->cep_inicio, $request->cep_destino)->get();

        if ($Vtex->isEmpty()) {
            return response()->json(['message' => 'Nenhuma cotação para estes dados'], 404); // Retorna 404 se não houver cotações
        }

        UserShippingQuote::registerUserShippingRate($request->user('')->id, $Vtex);

        return response()->json($Vtex, 200); // Retorna as cotações com código 200

    }

    /**
     * Obtem todas as cotações de um usuário pelo ID do user
     * @param mixed $userId
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getQuoteByUserId($userId)
    {
        // Validação do userId
        $validator = Validator::make(['user_id' => $userId], [
            'user_id' => 'required|integer|exists:users,id', // Verifica se o user_id existe na tabela de usuários
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400); // Retorna os erros de validação
        }

        $userQuotes = UserShippingQuote::getQuoteByUserId($userId)->with('shippingMethod')->get();

        if ($userQuotes->isEmpty()) {
            return response()->json(['message' => 'Nenhuma cotação para estes usuário'], 404); // Retorna 404 se não houver cotações
        }

        return response()->json($userQuotes, 200); // Retorna as cotações com código 200

    }
}

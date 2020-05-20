<?php

namespace Pedroroccon\Farmacia\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntregaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente' => 'required', 
            'pago' => 'required', 
            'forma_pagamento' => 'nullable|required_if:pago,1', 
            'endereco' => 'required', 
            'numero' => 'required', 
            'bairro' => 'required', 
            'cidade' => 'required', 
            'estado' => 'required', 
            'valor' => 'required|numeric', 
            'troco' => 'nullable|numeric', 
            'envio' => 'required', 
            'envio_em' => 'required|date', 
            'responsavel' => 'required', 
        ];
    }
}
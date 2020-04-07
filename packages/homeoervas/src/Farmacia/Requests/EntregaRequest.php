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
            'endereco' => 'required', 
            'numero' => 'required', 
            'bairro' => 'required', 
            'cidade' => 'required', 
            'estado' => 'required', 
            'valor' => 'required|numeric', 
            'troco' => 'nullable|numeric', 
            //'itens' => 'numeric', 
            //'homeopatias' => 'numeric', 
            //'itens_geladeira' => 'required|boolean', 
            'envio' => 'required', 
            'envio_hoje' => 'required|boolean', 
            'responsavel' => 'required', 
        ];
    }
}
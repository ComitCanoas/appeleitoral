<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecursoAdministrarRequest extends FormRequest
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
            'cidade_id'     => 'required|numeric',
            'orgao_id'      => 'required|numeric',
            'acao'          => 'required',
            'instituicao'   => 'required',
            'ano'           => 'required|numeric',
            'processo'      => 'required|numeric',
            'situacao'      => 'required',
            'valor'         => 'required|regex:/^[0-9]{1,3}([.]([0-9]{3}))*[,]([.]{0})[0-9]{0,2}$/',
        ];
    }
}

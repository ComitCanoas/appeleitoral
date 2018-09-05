<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoliticoRequest extends FormRequest
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
        $cpf = '(^\d{3}\x2E\d{3}\x2E\d{3}\x2D\d{2}$)';

        return [
            'nome' => 'required',
            'telefone' => 'required',
            'data_nascimento' => 'required',
            'email' => 'required|email',
            'endereco' => 'required',
            'cep' => 'required',
            'cpf' => 'required|regex:'.$cpf,
            'foto' => 'image|max:2048',
        ];
    }
}
